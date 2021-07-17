<?php
if(isset($_POST['assign_submit']) && !empty($_POST['assign_submit'])){
		
		// Received Values From Assign Form 
		
		$product_id 	= $_POST['product_id'];
		$employee_id 	= $_POST['employee_id'];
		$assign_date 	= $_POST['assign_date'];
		$remarks 		= $_POST['remarks'];
		$status 		= 'Active';
		$create 		= date('Y-m-d');
		
		/* Insert Data Into product_assign Table: */
		
		$query = "INSERT INTO `product_assign`(`product_id`,`employee_id`,`assign_date`,`remarks`,`status`,`created_at`) VALUES ('$product_id','$employee_id','$assign_date','$remarks','$status','$create')";
        $conn->query($query);
		//$last_id = $conn->insert_id;
		
		/* Update Data Into ams_products Table: */
		
		$queryupdate   = "UPDATE `ams_products` SET `assign_status`='assigned' WHERE `id`='$product_id'";
		$resultupdate = $conn->query($queryupdate);
		
		/* get id from  product_assign Table: */
		$queryget = "select `id` FROM `product_assign`(`product_id`,`employee_id`,`assign_date`,`remarks`,`status`,`created_at`) VALUES ('$product_id','$employee_id','$assign_date','$remarks','$status','$create')";
        $conn->query($queryget);
		
		
		
		$_SESSION['success']    =   "Asset Assign process have been successfully Completed.";
		header("location: handover-receipt.php?id='$product_id'");
		exit();
		
		
		/* if ($conn->query($query) === TRUE) {
				  $last_id = $conn->insert_id;
				  $_SESSION['success']    =   "Asset Assign process have been successfully Completed.";
					header("location: handover-receipt.php?id='$last_id'");
					exit();
				} else {
				  echo "Error: " . $sql . "<br>" . $conn->error;
				} */
			
}
 ?>