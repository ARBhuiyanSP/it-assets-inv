<?php
	
include 'connection/connect.php';

	$update=false;
	$id="";
	$company_id="";
	$division_id="";
	$department_id="";
	$proloc_name="";

	if(isset($_POST['add'])){
		$id				=	$_POST['id'];
		$company_id		=	$_POST['company_id'];
		$division_id		=	$_POST['division_id'];
		$department_id		=	$_POST['department_id'];
		$proloc_name	=	$_POST['proloc_name'];

		
		
		$query = "INSERT INTO `prolocs` (`company_id`,`division_id`,`department_id`,`proloc_name`) VALUES ('$company_id','$division_id','$department_id','$proloc_name')";
        $conn->query($query);
		
		
		$_SESSION['success']    =   "Project/Location has been added successfully.";
		header("location: prolocs.php");
		exit();
	}
	
	if(isset($_GET['delete'])){
		$id=$_GET['delete'];

		$query="DELETE FROM prolocs WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();

		header('location:prolocs.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	if(isset($_GET['edit'])){
		$id=$_GET['edit'];
		$query = "select * from `prolocs` where `id`='$id'";
		$resultd = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($resultd);
		
		
		$id				=	$row['id'];
		$company_id		=	$row['company_id'];
		$division_id		=	$row['division_id'];
		$department_id		=	$row['department_id'];
		$proloc_name	=	$row['proloc_name'];

		$update=true;
	}
	if(isset($_POST['update'])){
		
		$id				=	$_POST['id'];
		$company_id		=	$_POST['company_id'];
		$division_id		=	$_POST['division_id'];
		$department_id		=	$_POST['department_id'];
		$proloc_name	=	$_POST['proloc_name'];
		
		 /*
        *  Update Data Into inv_receive Table:
		*/
		
		$query2    = "UPDATE prolocs SET company_id='$company_id',division_id='$division_id',department_id='$department_id',proloc_name='$proloc_name' WHERE id=$id";
		$result2 = $conn->query($query2);
		
		/* $query    = "UPDATE inv_supplierbalance SET code='$code',name='$name',address='$address',contact_person='$contact_person',supplier_phone='$supplier_phone',supplier_op_balance='$supplier_op_balance' WHERE id=$id";
		$result = $conn->query($query); */
	
/* 
		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location:vendors.php'); */
		
		$_SESSION['success']    =   "Updated Successfully!";
		header("location: prolocs.php");
		exit();
	}

	if(isset($_GET['details'])){
		$id=$_GET['details'];
		
		$query = "select * from `prolocs` where `id`='$id'";
		$resultd = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($resultd);

		$id				=	$row['id'];
		$company_id		=	$row['company_id'];
		$division_id		=	$row['division_id'];
		$department_id		=	$row['department_id'];
		$proloc_name	=	$row['proloc_name'];
	}
?>