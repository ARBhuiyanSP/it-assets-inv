<?php include('header.php'); ?>
<main>
	<div class="container-fluid px-4">
		<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
		<ol class="breadcrumb mt-4 mb-4">
			<li class="breadcrumb-item">Dashboard</li>
			<li class="breadcrumb-item active">Vendor Details</li>
		</ol>
		<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
		<div class="card mb-4">
			<div class="card-header">
				<i class="fas fa-table me-1"></i>
				Vendor Details
			</div>
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-6 mt-3 p-4 rounded">
						<h2 class="bg-success p-2 rounded text-center text-light">ID : <?= $vendor_id; ?></h2>
						<h4 class="">Name : <?= $vendor_name; ?></h4>
						<h4 class="">Address : <?= $address; ?></h4>
						<h4 class="">Email : <?= $email; ?></h4>
						<h4 class="">Phone : <?= $phone; ?></h4>
						<button class="btn btn-primary" style="width:100%;"><a href="vendors.php" class="text-light">Back To Vendors List</a></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php include('footer.php'); ?>