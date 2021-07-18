<div class="sb-sidenav-menu">
	<div class="nav">
		
		<a class="nav-link" href="dashboard.php">
			<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
			Dashboard
		</a>
		
		<!-- =============================++++ Settings Area ++++=============================-->
		<!-- =============================++++ Settings Area ++++=============================-->
		<!-- =============================++++ Settings Area ++++=============================-->
		<?php if($_SESSION["role"] == 'admin'){ ?>
		<div class="sb-sidenav-menu-heading" style="background-color:#AF4940;color:#ffffff;">Settings</div>
		<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
			<div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
			Master Setup
			<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
		</a>
		<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
			<nav class="sb-sidenav-menu-nested nav">
				<a class="nav-link" href="material.php">Material</a>
				<a class="nav-link" href="assets-category.php">Assets Category</a>
			</nav>
		</div>
		<?php } ?>
		<!-- =============================++++ User Area ++++=============================-->
		<!-- =============================++++ User Area ++++=============================-->
		<!-- =============================++++ User Area ++++=============================-->
		<div class="sb-sidenav-menu-heading" style="background-color:#AF4940;color:#ffffff;">User Area</div>
		<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReceive" aria-expanded="false" aria-controls="collapseReceive">
			<div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
			Material Receive
			<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
		</a>
		<div class="collapse" id="collapseReceive" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
			<nav class="sb-sidenav-menu-nested nav">
				<a class="nav-link" href="receive_entry.php">Receive Entry</a>
				<a class="nav-link" href="receive-list.php">Receive List</a>
			</nav>
		</div>
		
		<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTransfer" aria-expanded="false" aria-controls="collapseTransfer">
			<div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
			Material Transfer
			<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
		</a>
		<div class="collapse" id="collapseTransfer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
			<nav class="sb-sidenav-menu-nested nav">
				<a class="nav-link" href="store_transfer.php">Transfer Entry</a>
				<a class="nav-link" href="transfer-list.php">Transfer List</a>
			</nav>
		</div>
		
		<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseConsumption" aria-expanded="false" aria-controls="collapseConsumption">
			<div class="sb-nav-link-icon"><i class="fas fa-thumbs-up"></i></div>
			Consumption
			<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
		</a>
		<div class="collapse" id="collapseConsumption" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
			<nav class="sb-sidenav-menu-nested nav">
				<a class="nav-link" href="consumption_entry.php">Consumption Entry</a>
				<a class="nav-link" href="consumption-list.php">Consumption List</a>
			</nav>
		</div>
		
		<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAssets" aria-expanded="false" aria-controls="collapseAssets">
			<div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
			Assets
			<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
		</a>
		<div class="collapse" id="collapseAssets" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
			<nav class="sb-sidenav-menu-nested nav">
				<a class="nav-link" href="assets_entry.php">Assets Entry</a>
				<a class="nav-link" href="assets-list.php">Assets List</a>
			</nav>
		</div>
		
		<a class="nav-link" href="assign-list.php">
			<div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
			Assign List
		</a>
		
		<!-- =============================++++ Reports Area ++++=============================-->
		<!-- =============================++++ Reports Area ++++=============================-->
		<!-- =============================++++ Reports Area ++++=============================-->
		<div class="sb-sidenav-menu-heading" style="background-color:#AF4940;color:#ffffff;">Reports</div>
		<a class="nav-link" href="assets-history.php">
			<div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
			Assets History
		</a>
		<a class="nav-link" href="employee-history.php">
			<div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
			Employee's History
		</a>
		<a class="nav-link" href="stock_report.php">
			<div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
			Material Stock
		</a>
		
	</div>
</div>
<div class="sb-sidenav-footer">
	<div class="small">Logged in as:</div>
	<?php echo $_SESSION['logged']['username']; ?> [<?php echo $_SESSION['logged']['user_type']; ?>]
</div>