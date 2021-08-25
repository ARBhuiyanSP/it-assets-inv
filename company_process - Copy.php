<?php
	
include 'connection/connect.php';

	$update=false;
	$id="";
	$vendor_id="";
	$vendor_name="";
	$address="";
	$email="";
	$phone="";
	$web="";

	if(isset($_POST['add'])){
		$id				=	$_POST['id'];
		$vendor_id		=	$_POST['vendor_id'];
		$vendor_name	=	$_POST['vendor_name'];
		$address		=	$_POST['address'];
		$email			=	$_POST['email'];
		$phone			=	$_POST['phone'];
		$web			=	$_POST['web'];
		$date			=	date('Y-m-d');
		$status			=	'1';

		
		
		$query = "INSERT INTO `vendors` (`vendor_id`,`vendor_name`,`address`,`email`,`phone`,`web`,`status`) VALUES ('$vendor_id','$vendor_name','$address','$email','$phone','$web','$status')";
        $conn->query($query);
		
		
		$_SESSION['success']    =   "Vendor has been added successfully.";
		header("location: vendors.php");
		exit();
	}
	
	if(isset($_GET['delete'])){
		$id=$_GET['delete'];

		$query="DELETE FROM vendors WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();

		header('location:vendors.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	if(isset($_GET['edit'])){
		$id=$_GET['edit'];
		$query = "select * from `vendors` where `id`='$id'";
		$resultd = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($resultd);
		
		
		$id				=	$row['id'];
		$vendor_id		=	$row['vendor_id'];
		$vendor_name	=	$row['vendor_name'];
		$address		=	$row['address'];
		$email			=	$row['email'];
		$phone			=	$row['phone'];
		$web			=	$row['web'];
		$date			=	$row['date'];
		$status			=	$row['status'];

		$update=true;
	}
	if(isset($_POST['update'])){
		
		$id				=	$_POST['id'];
		$vendor_id		=	$_POST['vendor_id'];
		$vendor_name	=	$_POST['vendor_name'];
		$address		=	$_POST['address'];
		$email			=	$_POST['email'];
		$phone			=	$_POST['phone'];
		$web			=	$_POST['web'];
		$date			=	date('Y-m-d');
		$status			=	'1';
		
		 /*
        *  Update Data Into inv_receive Table:
		*/
		
		$query2    = "UPDATE vendors SET vendor_id='$vendor_id',vendor_name='$vendor_name',address='$address',email='$email',phone='$phone',web='$web' WHERE id=$id";
		$result2 = $conn->query($query2);
		
		/* $query    = "UPDATE inv_supplierbalance SET code='$code',name='$name',address='$address',contact_person='$contact_person',supplier_phone='$supplier_phone',supplier_op_balance='$supplier_op_balance' WHERE id=$id";
		$result = $conn->query($query); */
	
/* 
		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location:vendors.php'); */
		
		$_SESSION['success']    =   "Updated Successfully!";
		header("location: vendors.php");
		exit();
	}

	if(isset($_GET['details'])){
		$id=$_GET['details'];
		
		$query = "select * from `vendors` where `id`='$id'";
		$resultd = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($resultd);

		$id				=	$row['id'];
		$vendor_id		=	$row['vendor_id'];
		$vendor_name	=	$row['vendor_name'];
		$address		=	$row['address'];
		$email			=	$row['email'];
		$phone			=	$row['phone'];
		$web			=	$row['web'];
		$date			=	$row['date'];
		$status			=	$row['status'];
	}
?>