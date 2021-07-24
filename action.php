<?php
	
include 'connection/connect.php';

	$update=false;
	$id="";
	$code="";
	$name="";
	$address="";
	$contact_person="";
	$supplier_phone="";
	$supplier_op_balance="";

	if(isset($_POST['add'])){
		$code					=$_POST['code'];
		$name					=$_POST['name'];
		$address				=$_POST['address'];
		$contact_person			=$_POST['contact_person'];
		$supplier_phone			=$_POST['supplier_phone'];
		$supplier_op_balance	=$_POST['supplier_op_balance'];

		
		
		$query = "INSERT INTO `suppliers` (`code`,`name`,`address`,`contact_person`,`supplier_phone`,`supplier_op_balance`) VALUES ('$code','$name','$address','$contact_person','$supplier_phone','$supplier_op_balance')";
        $conn->query($query);
		
		$query3 = "INSERT INTO `inv_supplierbalance` (`sb_ref_id`,`sb_date`,`sb_supplier_id`,`sb_dr_amount`,`sb_cr_amount`,`sb_remark`,`sb_partac_id`) VALUES ('OP','$date','$supplier_id','0','$supplier_op_balance','$remarks','OP')";
		$result2 = $conn->query($query3);
		
		$_SESSION['success']    =   "Supplier has been added successfully.";
		header("location: vendors.php");
		exit();
	}
	if(isset($_GET['delete'])){
		$id=$_GET['delete'];

		$query="DELETE FROM suppliers WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();

		header('location:vendors.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	if(isset($_GET['edit'])){
		$id=$_GET['edit'];

		$query="SELECT * FROM crud WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$id=$row['id'];
		$name=$row['name'];
		$email=$row['email'];
		$phone=$row['phone'];
		$photo=$row['photo'];

		$update=true;
	}
	if(isset($_POST['update'])){
		$id=$_POST['id'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$oldimage=$_POST['oldimage'];

		if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")){
			$newimage="uploads/".$_FILES['image']['name'];
			unlink($oldimage);
			move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
		}
		else{
			$newimage=$oldimage;
		}
		$query="UPDATE crud SET name=?,email=?,phone=?,photo=? WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ssssi",$name,$email,$phone,$newimage,$id);
		$stmt->execute();

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location:vendors.php');
	}

	if(isset($_GET['details'])){
		$id=$_GET['details'];
		$query="SELECT * FROM crud WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$vid=$row['id'];
		$vname=$row['name'];
		$vemail=$row['email'];
		$vphone=$row['phone'];
		$vphoto=$row['photo'];
	}
?>