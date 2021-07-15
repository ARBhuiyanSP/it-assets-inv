<?php
include 'connection/connect.php';

	$product_id 	= $_POST['product_id'];
	$employee_id 	= $_POST['employee_id'];
	$assign_date 	= $_POST['assign_date'];
	$remarks 		= $_POST['remarks'];
	$status 		= 'Active';
	$create 		= date('Y-m-d');
	$id 			= $_POST['id'];




	$sql	=	"insert into product_assign values('','$product_id','$employee_id','$assign_date','','$remarks','$status','$create','')";

	mysqli_query($conn, $sql);

    $sql2	=	"UPDATE `product_assign`  set `refund_date`='$assign_date', `status`='Transfered' where `id`='$id'";

    mysqli_query($conn, $sql2);
	
	
	    $_SESSION['success']    =   "Asset transfer process have been successfully Completed.";
		header("location: assets-list.php");
		exit();



?>