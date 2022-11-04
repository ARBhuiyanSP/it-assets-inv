<?php
	
include 'connection/connect.php';

	$update=false;
	$id="";
	$employee_id="";
	$employee_name="";
	$designation="";
	$division="";

	if(isset($_POST['add'])){
		$id				=	$_POST['id'];
		$employee_id		=	$_POST['employee_id'];
		$employee_name	=	$_POST['employee_name'];
		$designation		=	$_POST['designation'];
		$division			=	$_POST['division'];

		
		$query = "INSERT INTO `employees` (`employee_id`,`employee_name`,`designation`,`division`) VALUES ('$employee_id','$employee_name','$designation','$division')";
        $conn->query($query);
		
		
		$_SESSION['success']    =   "Employee has been added successfully.";
		header("location: employees.php");
		exit();
	}
	
	if(isset($_GET['delete'])){
		$id=$_GET['delete'];

		$query="DELETE FROM employees WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();

		header('location:employees.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	
	if(isset($_GET['edit'])){
		$id=$_GET['edit'];
		$query = "select * from `employees` where `id`='$id'";
		$resultd = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($resultd);
		
		
		$id				=	$row['id'];
		$employee_id		=	$row['employee_id'];
		$employee_name	=	$row['employee_name'];
		$designation		=	$row['designation'];
		$division			=	$row['division'];

		$update=true;
	}
	if(isset($_POST['update'])){
		
		$id				=	$_POST['id'];
		$employee_id		=	$_POST['employee_id'];
		$employee_name	=	$_POST['employee_name'];
		$designation		=	$_POST['designation'];
		$division			=	$_POST['division'];
		 /*
        *  Update Data Into inv_receive Table:
		*/
		
		$query2    = "UPDATE employees SET employee_id='$employee_id',employee_name='$employee_name',designation='$designation',division='$division' WHERE id=$id";
		$result2 = $conn->query($query2);
		
		
		$_SESSION['success']    =   "Updated Successfully!";
		header("location: employees.php");
		exit();
	}

	if(isset($_GET['details'])){
		$id=$_GET['details'];
		
		$query = "select * from `employees` where `id`='$id'";
		$resultd = mysqli_query($conn, $query);
		$row = mysqli_fetch_array($resultd);

		$id				=	$row['id'];
		$employee_id		=	$row['employee_id'];
		$employee_name	=	$row['employee_name'];
		$designation		=	$row['designation'];
		$division			=	$row['division'];
	}
?>