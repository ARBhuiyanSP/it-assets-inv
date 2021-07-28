<?php


if (isset($_POST['s_transfer_submit'])) {
        /*
         *  Insert Data Into inv_transferdetail Table:
        */ 
        $product_id		= $_POST['product_id'];
        $from_store		= $_POST['from_store'];
        $to_store		= $_POST['to_store'];
        $transfer_date	= $_POST['transfer_date'];
        $remarks		= $_POST['remarks'];        
        $transfer_by  	= $_POST['transfer_by'];        
        /* Insert Data Into store_transfer Table: */       
        $query = "INSERT INTO `store_transfer` (`product_id`,`from_store`,`to_store`,`transfer_date`,`transfer_by`,`remarks`) VALUES ('$product_id','$from_store','$to_store','$transfer_date','$transfer_by','$remarks')";
        $conn->query($query);
    
		/* Update Data Into ams_products Table: */
		$query2 = "UPDATE `ams_products` SET `current_store`='$to_store' WHERE `id`='$product_id'";
		$result2 = $conn->query($query2);    
  
    
    $_SESSION['success']    =   "S2S transfer process have been successfully completed.";
    header("location: store-transfer.php?id=$product_id");
    exit();
	}


/*******************************************************************************
 * The following code will
 * Store Receive entry data.
 * There are 4 table to keet track on receive data. The are following:
 * 1. inv_receive (Store single row)      
 * 2. inv_receivedetail (Store Multiple row)
 * 3. inv_materialbalance (Store Multiple row)
 * 4. inv_supplierbalance (Store single row)
 * *****************************************************************************
 */
if (isset($_POST['store_transfer_submit']) && !empty($_POST['store_transfer_submit'])) {
	
	// check duplicate:
	$transfer_id		= $_POST['transfer_id'];
    $table		= 'inv_transfermaster';
    $where		= "transfer_id='$transfer_id'";
    if(isset($_POST['store_transfer_update_submit']) && !empty($_POST['store_transfer_update_submit'])){
        $notWhere   =   "id!=".$_POST['store_transfer_update_submit'];
        $duplicatedata = isDuplicateData($table, $where, $notWhere);
    }else{
        $duplicatedata = isDuplicateData($table, $where);
    }
	if ($duplicatedata) {
		$status     =   'error';
		$_SESSION['warning']    =   "Operation faild. Duplicate data found..!";
    }else{
		    $no_of_material     =   0;
    for ($count = 0; $count < count($_POST['quantity']); $count++) {
        
        /*
         *  Insert Data Into inv_transferdetail Table:
        */ 
        $transfer_date		= $_POST['transfer_date'];
        $transfer_id		= $_POST['transfer_id'];
        $from_store		= $_POST['from_store'];
        $to_store 		= $_POST['to_store'];
		


        $material_name      = $_POST['material_name'][$count];
        $material_id        = $_POST['material_id'][$count];
        $unit               = $_POST['unit'][$count];
        $quantity           = $_POST['quantity'][$count];
        $no_of_material     = $no_of_material+$quantity;
		
        $remarks            = $_POST['remarks'];        
               
        $query = "INSERT INTO `inv_tranferdetail` (`transfer_id`,`material_id`,`material_name`,`transfer_qty`,`unit`,`type`,`inwarehouse`,`outwarehouse`) VALUES ('$transfer_id','$material_id','$material_name','$quantity','$unit','1','$to_store','$from_store')";
        $conn->query($query);
        
        /*
         *  Insert Data Into inv_materialbalance Table:
        */
        $mb_ref_id      = $transfer_id;
        $mb_materialid  = $material_id;
        $mb_date        = (isset($transfer_date) && !empty($transfer_date) ? date('Y-m-d h:i:s', strtotime($transfer_date)) : date('Y-m-d h:i:s'));
        $mbfrom_in_qty       = 0;
        $mbfrom_out_qty      = $quantity;
        $mbfrom_type         = 'Transfer Out';
        $mbserial       = '1.1';
        $mbunit_id      = $unit;
        $mbserial_id    = 0;
        $jvno           = $transfer_id;    
		$mbin_val	=	0;		
		$mbout_val	=	0;		
		$mbprice	=	0;		
        
        $query_outmb = "INSERT INTO `inv_materialbalance` (`mb_ref_id`,`mb_materialid`,`mb_date`,`mbin_qty`,`mbin_val`,`mbout_qty`,`mbout_val`,`mbprice`,`mbtype`,`mbserial`,`mbserial_id`,`mbunit_id`,`jvno`, `warehouse_id`) VALUES ('$mb_ref_id','$mb_materialid','$mb_date','$mbfrom_in_qty','$mbin_val','$mbfrom_out_qty','$mbout_val','$mbprice','$mbfrom_type','$mbserial','$mbunit_id','$mbserial_id','$jvno','$from_store')";
        $conn->query($query_outmb);
		
		
		$mbin_in_qty       	= $quantity;
        $mbin_out_qty      	= 0;
        $mbfrom_type		= 'Transfer In';
        $query_inmb = "INSERT INTO `inv_materialbalance` (`mb_ref_id`,`mb_materialid`,`mb_date`,`mbin_qty`,`mbin_val`,`mbout_qty`,`mbout_val`,`mbprice`,`mbtype`,`mbserial`,`mbserial_id`,`mbunit_id`,`jvno`, `warehouse_id`) VALUES ('$mb_ref_id','$mb_materialid','$mb_date','$mbin_in_qty','$mbin_val','$mbin_out_qty','$mbout_val','$mbprice','$mbfrom_type','$mbserial','$mbunit_id','$mbserial_id','$jvno','$to_store')";
        $conn->query($query_inmb);
    }
    /*
    *  Insert Data Into inv_transfermaster Table:
    */
    $query2 = "INSERT INTO `inv_transfermaster` (`transfer_id`,`transfer_date`,`from_warehouse`,`to_warehouse`,`remarks`) VALUES ('$transfer_id','$transfer_date','$from_store','$to_store','$remarks')";
    $result2 = $conn->query($query2);    
  
    
    $_SESSION['success']    =   "P2P transfer process have been successfully completed.";
    header("location: store_transfer.php");
    exit();
	}

}
/*========================Project To project Transfer==================================================*/
/*========================Project To project Transfer==================================================*/

if (isset($_POST['project_transfer_submit']) && !empty($_POST['project_transfer_submit'])) {
	
	// check duplicate:
	$transfer_id		= $_POST['transfer_id'];
    $table		= 'inv_projectstransfer';
    $where		= "transfer_id='$transfer_id'";
    if(isset($_POST['project_transfer_update_submit']) && !empty($_POST['project_transfer_update_submit'])){
        $notWhere   =   "id!=".$_POST['project_transfer_update_submit'];
        $duplicatedata = isDuplicateData($table, $where, $notWhere);
    }else{
        $duplicatedata = isDuplicateData($table, $where);
    }
	if ($duplicatedata) {
		$status     =   'error';
		$_SESSION['warning']    =   "Operation faild. Duplicate data found..!";
    }else{
		    $no_of_material     =   0;
    for ($count = 0; $count < count($_POST['quantity']); $count++) {
        
        /*
         *  Insert Data Into inv_transferdetail Table:
        */ 
        $transfer_date		= $_POST['transfer_date'];
        $transfer_id		= $_POST['transfer_id'];
		
        $from_site			= $_POST['from_site'];
        //$from_warehouse		= $_POST['from_warehouse'];
        $from_project      	= $_POST['from_project'];
        $to_project         = $_POST['to_project'];
        $to_site         	= $_POST['to_site'];
		


        $material_name      = $_POST['material_name'][$count];
        $material_id        = $_POST['material_id'][$count];
        $unit               = $_POST['unit'][$count];
        $quantity           = $_POST['quantity'][$count];
        $no_of_material     = $no_of_material+$quantity;
		
        $remarks            = $_POST['remarks'];        
               
        $query = "INSERT INTO `inv_projectstransferdetails` (`transfer_id`,`material_id`,`material_name`,`transfer_qty`,`unit`,`type`,`inprojects`,`insite`,`outprojects`,`outsite`) VALUES ('$transfer_id','$material_id','$material_name','$quantity','$unit','1','$to_project','$to_site','$from_project','$from_site')";
        $conn->query($query);
        
        /*
         *  Insert Data Into inv_materialbalance Table:
        */
        $mb_ref_id      = $transfer_id;
        $mb_materialid  = $material_id;
        $mb_date        = (isset($transfer_date) && !empty($transfer_date) ? date('Y-m-d h:i:s', strtotime($transfer_date)) : date('Y-m-d h:i:s'));
        $mbfrom_in_qty       = 0;
        $mbfrom_out_qty      = $quantity;
        $mbfrom_type         = 'Transfer Out';
        $mbserial       = '1.1';
        $mbunit_id      = $project_id;
        $mbserial_id    = 0;
        $jvno           = $transfer_id;       
        
        $query_outmb = "INSERT INTO `inv_materialbalance` (`mb_ref_id`,`mb_materialid`,`mb_date`,`mbin_qty`,`mbin_val`,`mbout_qty`,`mbout_val`,`mbprice`,`mbtype`,`mbserial`,`mbserial_id`,`mbunit_id`,`jvno`, `project_id`, `warehouse_id`) VALUES ('$mb_ref_id','$mb_materialid','$mb_date','$mbfrom_in_qty','$mbin_val','$mbfrom_out_qty','$mbout_val','$mbprice','$mbfrom_type','$mbserial','$mbunit_id','$mbserial_id','$jvno','$from_project','$from_site')";
        $conn->query($query_outmb);


    }
    /*
    *  Insert Data Into inv_projectstransfer Table:
    */
    $query2 = "INSERT INTO `inv_projectstransfer` (`transfer_id`,`transfer_date`,`from_project`,`from_site`,`to_project`,`to_site`,`remarks`) VALUES ('$transfer_id','$transfer_date','$from_project','$from_site','$to_project','$to_site','$remarks')";
    $result2 = $conn->query($query2);    
  
    
    $_SESSION['success']    =   "P2P transfer process have been successfully completed.";
    header("location: project_transfer.php");
    exit();
	}

}

?>