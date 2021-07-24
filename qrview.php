<?php include('header.php'); 
$id=$_GET['id'];?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Asset Details View</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Asset Details View
                            </div>
                            <div class="card-body" id="printableArea" style="display:block;">
								<?php
								$sql	=	"select * from ams_products where id=$id";
								$result = mysqli_query($conn, $sql);
								$row=mysqli_fetch_array($result);
								?>
                                <table width='100%'>				
									<tr>
										<td style="text-align:center">
											<div class="headbody">
												<h1 align="center"><img src="assets/img/logo-wide.png" width="162" height=""></h1>
												<h2 align="center">SAIF POWER GROUP</h2>
												<p align="center">Rupayan Centre(8th Floor),72, Mohakhali C/A,Dhaka-1212,Bangladesh</p>
												<h3 align="center">Assets Details</h3>
												<h1 align="center"><img src="<?php echo $row['qr_image'] ?>" height="200" /></h1>
											</div>
										</td>
									</tr>
								</table>
								<table class="table table-bordered">
									<tr>
										<th>Product Photo:</th>
										<td><img src="products_photo/<?php echo $row['pro_photo'] ?>" height="150" /></td>
									</tr>
									<tr>
										<th>Item Name:</th>
										<td><?php echo $row['item_name'] ?></td>
									</tr>
									<tr>
										<th>Item Description:</th>
										<td><?php echo $row['assets_description'] ?></td>
									</tr>
									<tr>
										<th>Brand:</th>
										<td><?php echo $row['brand'] ?></td>
									</tr>
									<tr>
										<th>Model:</th>
										<td><?php echo $row['model'] ?></td>
									</tr>
									<tr>
										<th>Manufacturing SL No:</th>
										<td><?php echo $row['manu_sl'] ?></td>
									</tr>
									<tr>
										<th>Description:</th>
										<td><?php echo $row['assets_description'] ?></td>
									</tr>
									<tr>
										<th>RLP No:</th>
										<td><?php echo $row['rlp_no'] ?></td>
									</tr>
									<tr>
										<th>Country Origin:</th>
										<td><?php echo $row['origin'] ?></td>
									</tr>
									<tr>
										<th>Vendor Name:</th>
											<?php 
												$vendor_id = $row['vendor_name'];
												$sqlvendor	= "select * from `vendors` where `vendor_id`='$vendor_id'";
												$resultvendor = mysqli_query($conn, $sqlvendor);
												$rowvendor=mysqli_fetch_array($resultvendor);
											?>
										<td><?php echo $rowvendor['vendor_name']; ?></td>
									</tr>
									<tr>
										<th>Purchase Date:</th>
										<td><?php echo $row['puchase_date']; ?></td>
									</tr>
									<tr>
										<th>Custody:</th>
										<td><?php echo $row['custody']; ?></td>
									</tr>
									<tr>
										<th>User:</th>
											<?php if($row['assign_status']=='assigned'){ 
											$products_id	=	$row['id'];
												$sqlassign	= "select * FROM `product_assign` WHERE `product_id`='$products_id' ORDER BY `id` DESC LIMIT 1 ";
												$resultassign = mysqli_query($conn, $sqlassign);
												$rowassign=mysqli_fetch_array($resultassign);
												
													$employee_id = $rowassign['employee_id'];
													$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
													$resultemployee = mysqli_query($conn, $sqlemployee);
													$rowemployee=mysqli_fetch_array($resultemployee);
											?>
										<td><?php echo $rowassign['employee_id']; ?> || <?php echo $rowemployee["employee_name"]; ?> || <?php echo $rowemployee["division"]; ?>-<?php echo $rowemployee["department"]; ?></td>
											<?php }else{ ?>
										<td>---</td>
										<?php } ?>
									</tr>
								</table>
                            </div>
                        </div>
							<div class="row">
								<div class="col-md-6">
									<button class="btn btn-success mx-2 px-3" onclick="printDiv('printableArea')" role="button"><i class="fa fa-print"></i> Print</button>
									<script>
									function printDiv(divName) {
										 var printContents = document.getElementById(divName).innerHTML;
										 var originalContents = document.body.innerHTML;

										 document.body.innerHTML = printContents;

										 window.print();

										 document.body.innerHTML = originalContents;
									}
									</script>
									<button class="btn btn-primary mx-2 px-3" onclick="window.location.href = 'assets-list.php'" role="button"><i class="fa fa-outdent"></i> Back To Products Lis</button>
								</div>
								<div class="col-md-6">
								</div>
							</div>
                    </div>
                </main>
                <?php include('footer.php'); ?>