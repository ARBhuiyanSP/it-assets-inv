<?php
include "phpqrcode/qrlib.php";
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
if (isset($_POST['asset_submit']) && !empty($_POST['asset_submit'])) {
	
	// check duplicate:
	$sl_no		= $_POST['sl_no'];
    $table		= 'ams_products';
    $where		= "sl_no='$sl_no'";
    if(isset($_POST['asset_update_submit']) && !empty($_POST['asset_update_submit'])){
        $notWhere   =   "id!=".$_POST['asset_update_submit'];
        $duplicatedata = isDuplicateData($table, $where, $notWhere);
    }else{
        $duplicatedata = isDuplicateData($table, $where);
    }
	if ($duplicatedata) {
		$status     =   'error';
		$_SESSION['warning']    =   "Operation faild. Duplicate data found..!";
    }else{
			
	
	
    // how to save PNG codes to server 
     $sl_no 	= $_POST['sl_no'];
     
    $tempDir = "images/qr_images/"; 
	$todaysDate = date('Ymd');
	$model = "M".$_POST['model'];
	//$id = $_GET['id'];
    $codeContents = 'SPL-'.$sl_no; 
     
    // we need to generate filename somehow,  
    // with md5 or with database ID used to obtains $codeContents... 
    $fileName = time().'qrimage.png'; 
     
    $pngAbsoluteFilePath = $tempDir.$fileName; 
    $urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName; 
     
    // generating 
    if (!file_exists($pngAbsoluteFilePath)) { 
        QRcode::png($codeContents, $pngAbsoluteFilePath); 
         
    } 
    

	$sl_no 				= $_POST['sl_no'];
	$store_id 			= $_POST['store_id'];
	$received_by 		= $_POST['received_by'];
	$assets_category 	= $_POST['assets_category'];
	$item_name 			= $_POST['item_name'];
	$assets_description = $_POST['assets_description'];
	$brand 				= $_POST['brand'];
	$model 				= $_POST['model'];
	$manufacturing_sl 	= $_POST['manufacturing_sl'];
	$rlp_no 			= $_POST['rlp_no'];
	$purchase_order 	= $_POST['purchase_order'];
	$delivery_chalan 	= $_POST['delivery_chalan'];
	$vendor_name 		= $_POST['vendor_name'];
	$purchase_date 		= $_POST['purchase_date'];
	$warrenty 			= $_POST['warrenty'];
	$purchase_value 	= $_POST['purchase_value'];
	$origin 			= $_POST['origin'];
	$custody 			= $_POST['custody'];
	$status 			= $_POST['status'];
	$condition 			= $_POST['condition'];



	if (is_uploaded_file($_FILES['slfileToUpload']['tmp_name'])) 
	  {
		$slimg=time()."_".$_FILES['slfileToUpload']['name'];
		$temp_file=$_FILES['slfileToUpload']['tmp_name'];
		
		 move_uploaded_file($temp_file,"products_photo/".$slimg);
	  }

	if (is_uploaded_file($_FILES['profileToUpload']['tmp_name'])) 
	  {
		$proimg=time()."_".$_FILES['profileToUpload']['name'];
		$temp_file=$_FILES['profileToUpload']['tmp_name'];
		
		 move_uploaded_file($temp_file,"products_photo/".$proimg);
	  }
		
		
               
        $query = "INSERT INTO `ams_products`(`sl_no`,`assets_category`,`item_name`,`assets_description`,`brand`,`model`,`manu_sl`,`rlp_no`,`purchase_order`,`delivery_challam`,`vendor_name`,`puchase_date`,`warrenty`,`purchase_value`,`origin`,`custody`,`status`,`conditions`,`photo`,`pro_photo`,`qr_image`,`store_id`,`current_store`,`received_by`) VALUES ('$sl_no','$assets_category','$item_name','$assets_description','$brand','$model','$manufacturing_sl','$rlp_no','$purchase_order','$delivery_chalan','$vendor_name','$purchase_date','$warrenty','$purchase_value','$origin','$custody','$status','$condition','$slimg','$proimg','$pngAbsoluteFilePath','$store_id','$store_id','$received_by')";
        $conn->query($query);
		
		
    
    $_SESSION['success']    =   "Asset Entry process have been successfully completed.";
    header("location: assets_entry.php");
    exit();
	}
		

}

/* function getAssetDataDetailsById($id){
    global $conn;
    $assets      =   "";
    $assetDetails =   "";
    
    // get receive data
    $sql1           = "SELECT * FROM ams_products where id=".$id;
    $result1        = $conn->query($sql1);

    if ($result1->num_rows > 0) {
        $assets = $result1->fetch_object();
        // get receive details data
        $table                  =   'inv_receivedetail where mrr_no='."'$assets->mrr_no'";
        $order                  =   'DESC';
        $column                 =   'receive_qty';
        $dataType               =   'obj';
        $assetDetailsData     = getTableDataByTableName($table, $order, $column, $dataType);
        if(isset($assetDetailsData) && !empty($assetDetailsData)){
            $assetDetails     =   $assetDetailsData;
        }
    }
    $feedbackData   =   [
        'assetData'           =>  $assets,
        'assetDetailsData'    =>  $assetDetails
    ];
    
    return $feedbackData;
} */

/*******************************************************************************
 * The following code will
 * Update Receive entry data.
 * There are 4 table to keet track on receive data. The are following:
 * 1. inv_receive (Update single row)      
 * 2. inv_receivedetail (First Delete all rows then Store Multiple row)
 * 3. inv_materialbalance (First Delete all rows then Store Multiple row)
 * 4. inv_supplierbalance (Update single row)
 * *****************************************************************************
 */

if(isset($_POST['asset_update_submit']) && !empty($_POST['asset_update_submit'])){
    //$receive_total      =   0;
		// how to save PNG codes to server 
		 $sl_no 	= $_POST['sl_no'];
		 
		$tempDir = "images/qr_images/"; 
		$todaysDate = date('Ymd');
		$model = "M".$_POST['model'];
		$id = $_GET['id'];
		$codeContents = 'SPL-'.$sl_no; 
		 
		// we need to generate filename somehow,  
		// with md5 or with database ID used to obtains $codeContents... 
		$fileName = time().'qrimage.png'; 
		 
		$pngAbsoluteFilePath = $tempDir.$fileName; 
		$urlRelativeFilePath = EXAMPLE_TMP_URLRELPATH.$fileName; 
		 
		// generating 
		if (!file_exists($pngAbsoluteFilePath)) { 
			QRcode::png($codeContents, $pngAbsoluteFilePath); 
			 
		} 
		

		$sl_no 				= $_POST['sl_no'];
		$store_id 			= $_POST['store_id'];
		$received_by 		= $_POST['received_by'];
		$assets_category 	= $_POST['assets_category'];
		$item_name 			= $_POST['item_name'];
		$assets_description = $_POST['assets_description'];
		$brand 				= $_POST['brand'];
		$model 				= $_POST['model'];
		$manufacturing_sl 	= $_POST['manufacturing_sl'];
		$rlp_no 			= $_POST['rlp_no'];
		$purchase_order 	= $_POST['purchase_order'];
		$delivery_chalan 	= $_POST['delivery_chalan'];
		$vendor_name 		= $_POST['vendor_name'];
		$purchase_date 		= $_POST['purchase_date'];
		$warrenty 			= $_POST['warrenty'];
		$purchase_value 	= $_POST['purchase_value'];
		$origin 			= $_POST['origin'];
		$custody 			= $_POST['custody'];
		$status 			= $_POST['status'];
		$condition 			= $_POST['condition'];
		
		if (is_uploaded_file($_FILES['slfileToUpload']['tmp_name'])) 
				{
					$temp_file=$_FILES['slfileToUpload']['tmp_name'];
					$slimg=time().$_FILES['slfileToUpload']['name'];
					$q = move_uploaded_file($temp_file,"products_photo/".$slimg);
				}
				else
				{
				 $slimg = $_POST["old_slfileToUpload"];
				}

		if (is_uploaded_file($_FILES['profileToUpload']['tmp_name'])) 
				{
					$temp_file=$_FILES['profileToUpload']['tmp_name'];
					$proimg=time().$_FILES['profileToUpload']['name'];
					$q = move_uploaded_file($temp_file,"products_photo/".$proimg);
				}
				else
				{
				 $proimg = $_POST["old_profileToUpload"];
				}
		
		/* Update Data Into ams_products Table: */
		
		$queryupdate   = "UPDATE `ams_products` SET `sl_no`='$sl_no',`assets_category`='$assets_category',`item_name`='$item_name',`assets_description`='$assets_description',`brand`='$brand',`model`='$model',`manu_sl`='$manufacturing_sl',`rlp_no`='$rlp_no', `purchase_order`='$purchase_order',`delivery_challam`='$delivery_chalan',`vendor_name`='$vendor_name',`puchase_date`='$purchase_date',`warrenty`='$warrenty',`purchase_value`='$purchase_value',`origin`='$origin',`custody`='$custody',`status`='$status',`conditions`='$condition',`photo`='$slimg',`pro_photo`='$proimg',`qr_image`='$pngAbsoluteFilePath',`store_id`='$store_id',`current_store`='$store_id',`received_by`='$received_by' WHERE `id`='$id'";
		$resultupdate = $conn->query($queryupdate);
		
		$_SESSION['success']    =   "Asset UPDATE process have been successfully updated.";
		header("location: assets_edit.php?id=".$id);
		exit();
		
}

if(isset($_POST['assign_submit'])){
        $product_id 	= $_POST['product_id'];
		$employee_id 	= $_POST['employee_id'];
		$assign_date 	= $_POST['assign_date'];
		$remarks 		= $_POST['remarks'];
		$status 		= 'Active';
		$create 		= date('Y-m-d');
		$assigned_by 		= $_POST['assigned_by'];
		
		/* Insert Data Into product_assign Table: */
		
		$query = "INSERT INTO `product_assign`(`product_id`,`employee_id`,`assign_date`,`remarks`,`assigned_by`,`status`,`created_at`) VALUES ('$product_id','$employee_id','$assign_date','$remarks','$assigned_by','$status','$create')";
        $conn->query($query);
		$last_id = $conn->insert_id;
		
		/* Update Data Into ams_products Table: */
		
		$queryupdate   = "UPDATE `ams_products` SET `assign_status`='assigned' WHERE `id`='$product_id'";
		$conn->query($queryupdate);
		
		$_SESSION['success']    =   "Asset Assign process have been successfully Completed.";
		header("location: assets-list.php");
		exit();
		
		/* if ($conn->query($query) === TRUE) {
				  $_SESSION['success']    =   "Asset Assign process have been successfully Completed.";
					header("location: handover-receipt.php?id='$last_id'");
					exit();
				} else {
				  header("location: product-assign.php?id='$product_id'");
					exit();
				} */
}

/* if(isset($_POST['transfer_submit'])){

	$product_id 	= $_POST['product_id'];
	$employee_id 	= $_POST['employee_id'];
	$assign_date 	= $_POST['assign_date'];
	$remarks 		= $_POST['remarks'];
	$status 		= 'Active';
	$create 		= date('Y-m-d');
	$id 			= $_POST['id'];

		
		
		
		$query = "insert into product_assign values('','$product_id','$employee_id','$assign_date','','$remarks','$status','$create','')";
        $conn->query($query);
		
		
		
		
		$queryupdate   = "UPDATE `product_assign`  set `refund_date`='$assign_date', `status`='Transfered' where `id`='$id'";
		$result	= $conn->query($queryupdate);
		
		$_SESSION['success']    =   "Asset transfer process have been successfully Completed.";
		header("location: assets-list.php");
		exit();
} */

if(isset($_POST['return_submit'])){

	$id 			= $_POST['id'];
	$product_id 	= $_POST['product_id'];
	$refund_date 	= $_POST['refund_date'];
	$status 		= 'Refund';

		
		/* Insert Data Into product_assign Table: */
		
		$query = "UPDATE `product_assign`  set `refund_date`='$refund_date', `status`='$status' where `id`='$id'";
        $conn->query($query);
		
		/* Update Data Into product_assign Table: */
		$assign_date 	= $_POST['assign_date'];
		
		
		$queryupdate   = "UPDATE `ams_products`  set `assign_status`='' where `id`='$product_id'";
		$conn->query($queryupdate);
		
		$_SESSION['success']    =   "Asset transfer process have been successfully Completed.";
		header("location: assets-list.php");
		exit();
}
	

?>