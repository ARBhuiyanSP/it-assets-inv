<?php include('header.php'); ?>
<main>
	<div class="container-fluid px-4">
		<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
		<h1 class="mt-4">Dashboard</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active">Sample Page</li>
		</ol>
		<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
		<div class="card mb-4">
			<div class="card-header">
				<i class="fas fa-table me-1"></i>
				Sample Content
			</div>
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-md-6 mt-3 bg-info p-4 rounded">
						<h2 class="bg-light p-2 rounded text-center text-dark">ID : <?= $id; ?></h2>
						<h4 class="text-light">Name : <?= $name; ?></h4>
						<h4 class="text-light">Email : <?= $address; ?></h4>
						<h4 class="text-light">Phone : <?= $contact_person; ?></h4>
						<button class="btn btn-primary" style="width:100%;"><a href="vendors.php" class="text-light">Back To Vendors List</a></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php include('footer.php'); ?>