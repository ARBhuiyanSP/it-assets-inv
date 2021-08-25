<?php
	
include 'connection/connect.php';

	$update=false;
	$id="";
	$company_name="";

	if(isset($_POST['add'])){
		$id				=	$_POST['id'];
		$company_name	=	$_POST['company_name'];

		
		
		$query = "INSERT INTO `companies` (`company_name`) VALUES ('$company_name')";
        $conn->query($query);
		
		
		$_SESSION['success']    =   "Company has been added successfully.";
		header("location: companies.php");
		exit();
	}
	
	if(isset($_GET['delete'])){
		$id=$_GET['delete'];

		$query="DELETE FROM companies WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();

		header('location:companies.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	if(isset($_GET['edit'])){
		$id=$_GET['edit'];
		$query = "select * from `companies` where `id`='$id'";
		$resultd = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($resultd);
		
		
		$id				=	$row['id'];
		$company_name	=	$row['company_name'];

		$update=true;
	}
	if(isset($_POST['update'])){
		
		$id				=	$_POST['id'];
		$company_name	=	$_POST['company_name'];
		
		 /*
        *  Update Data Into inv_receive Table:
		*/
		
		$query2    = "UPDATE companies SET company_name='$company_name' WHERE id=$id";
		$result2 = $conn->query($query2);
		
		/* $query    = "UPDATE inv_supplierbalance SET code='$code',name='$name',address='$address',contact_person='$contact_person',supplier_phone='$supplier_phone',supplier_op_balance='$supplier_op_balance' WHERE id=$id";
		$result = $conn->query($query); */
	
/* 
		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location:vendors.php'); */
		
		$_SESSION['success']    =   "Updated Successfully!";
		header("location: companies.php");
		exit();
	}

	if(isset($_GET['details'])){
		$id=$_GET['details'];
		
		$query = "select * from `companies` where `id`='$id'";
		$resultd = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($resultd);

		$id				=	$row['id'];
		$company_name	=	$row['company_name'];
	}
?>