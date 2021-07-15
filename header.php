<?php 
session_start(); 
if(!isset($_SESSION['logged']['status'])){
    header("location: index.php");
    exit();
} 
include 'connection/connect.php';
include 'helper/utilities.php';
include 'helper/rlp_utilities.php';
include 'includes/item_process.php';
include 'includes/receive_process.php';
include 'includes/transfer_process.php';
include 'includes/store_process.php';
include 'includes/rlp_chain_process.php';
include 'includes/rlp_process.php';
include 'includes/issue_process.php';
include 'includes/search_process.php';
include 'includes/warehouse_search_process.php';
include 'includes/category_process.php';
include 'includes/unit_process.php';
include 'includes/package_process.php';
include 'includes/building_process.php';
include 'includes/warehouse_process.php';
include 'includes/suppliers_process.php';
include 'includes/format_process.php';
include 'includes/return_process.php';
include 'includes/payment_process.php';
include 'includes/consumption_process.php';
include 'includes/asset_process.php';
//include 'includes/assign_process.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>IT Assets Inventory</title>
		<link rel="icon" href="images/favicon.png" type="image/gif" sizes="16x16">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
				  <!-- Custom styles for this template-->
				  <!-- <link href="css/sb-admin.css" rel="stylesheet"> -->
				<link href="css/sweetalert.css" rel="stylesheet">
				  <link href="css/jquery-ui.css" rel="stylesheet">
				  <link href="css/site_style.css" rel="stylesheet">
				  <link href="css/form-entry.css" rel="stylesheet">
				  <link href="css/select2.min.css" rel="stylesheet">
				  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
				  <script type="text/javascript" src="js/select2.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard.php"><img src="assets/img/logo-wide.png" height="45px"/></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
				<li class="nav-item">
					<a class="nav-link" id="MyClockDisplay" style="color:#ffffff;font-weight:bold;"><i class="fas fa-clock-o"></i></a>
                </li>
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="includes/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <?php include('sidebar.php') ?>
                </nav>
            </div>
            <div id="layoutSidenav_content">