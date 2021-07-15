<?php
include 'connection/connect.php';
if(isset($_POST['assign_submit'])){
        $product_id 	= $_POST['product_id'];
		$employee_id 	= $_POST['employee_id'];
		$assign_date 	= $_POST['assign_date'];
		$remarks 		= $_POST['remarks'];
		$status 		= 'Active';
		$create 		= date('Y-m-d');
		
		/* Insert Data Into product_assign Table: */
		
		$query = "INSERT INTO `product_assign`(`product_id`,`employee_id`,`assign_date`,`remarks`,`status`,`created_at`) VALUES ('$product_id','$employee_id','$assign_date','$remarks','$status','$create')";
        $conn->query($query);
		
		/* Update Data Into ams_products Table: */
		
		$queryupdate   = "UPDATE `ams_products` SET `assign_status`='assigned' WHERE `id`='$product_id'";
		$conn->query($queryupdate);
		
		$_SESSION['success']    =   "Asset Assign process have been successfully Completed.";
		header("location: assets-list.php");
		exit();
}
?>