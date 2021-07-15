<?php include('header.php');
$id=$_GET['id']; ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Asset Detail View</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Asset Detail View
                            </div>
                            <div class="card-body">
                                <div class="row" id="printableArea" style="display:block;">
							<div class="row">
								<?php
								$sql	=	"select * from `product_assign` where `id`='$id'";
								$result = mysqli_query($conn, $sql);
								$row=mysqli_fetch_array($result);
								
								
									$product_id=$row['product_id'];
									$sql2	=	"select * from `ams_products` where `id`='$product_id'";
									$result2 = mysqli_query($conn, $sql2);
									$rowp=mysqli_fetch_array($result2);
								?>
                            <div class="col-lg-4">
								<table style="" class="table table-bordered">
									<tr>
										<th>Item Name:</th>
										<td><?php echo $rowp['item_name'] ?></td>
									</tr>
									<tr>
										<th>Brand:</th>
										<td><?php echo $rowp['brand'] ?></td>
									</tr>
									<tr>
										<th>Model:</th>
										<td><?php echo $rowp['model'] ?></td>
									</tr>
									<tr>
										<th>RLP No:</th>
										<td><?php echo $rowp['rlp_no'] ?></td>
									</tr>
									<tr>
										<th>Country Origin:</th>
										<td><?php echo $rowp['origin'] ?></td>
									</tr>
									<tr>
										<th>Vendor Name:</th>
										<td><?php echo $rowp['vendor_name'] ?></td>
									</tr>
									<tr>
										<th>Purchase Date:</th>
										<td><?php echo $rowp['puchase_date'] ?></td>
									</tr>
									<tr>
										<th>Custody:</th>
										<td><?php echo $rowp['custody'] ?></td>
									</tr>
								</table>
							</div>
                            <div class="col-lg-8">
								<h3>Scan Below Code</h3>
								<img src="<?php echo $rowp['qr_image'] ?>" height="250" />
								</div>
							</div>
							<div class="row">
								<div class="col-lg-8">
									<table style="" class="table table-bordered">
										<tr>
											<th>Assign date:</th>
											<td><?php 
											$cDate = strtotime($row['assign_date']);
											$dDate = date("jS \of F Y",$cDate);
											echo $dDate;?></td>
											
										</tr>
										<tr>
											<th>Refund date:</th>
											<td><?php 
											if($row['refund_date']){
												$rDate = strtotime($row['refund_date']);
												$rfDate = date("jS \of F Y",$rDate);
												echo $rfDate;
											}else{
												echo '--';
											}
											?>
											</td>

										</tr>
										<tr>
											<th>Assign To:</th>
											<td><?php 
											$employee_id=$row['employee_id'];
											$sql4	=	"select * from `employees` where `employee_id`='$employee_id'";
											$result4 = mysqli_query($conn, $sql4);
											$rowe=mysqli_fetch_array($result4);
											echo $rowe['employee_name'];
											echo '-'.$row['employee_id'];

											 ?></td>
										</tr>
										<tr>
											<th>Remarks:</th>
											<td><?php echo $row['remarks']; ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<button class="btn btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
							
							<script>
							function printDiv(divName) {
								 var printContents = document.getElementById(divName).innerHTML;
								 var originalContents = document.body.innerHTML;

								 document.body.innerHTML = printContents;

								 window.print();

								 document.body.innerHTML = originalContents;
							}
							</script>
							<button class="btn btn-info" onclick="window.location.href = 'assign-list.php'"><i class="fa fa-outdent"></i> Back To Assign List</button>
							
							<button class="btn btn-danger" onclick="window.location.href = 'transfer.php?id=<?php echo $row['product_id'] ?>'"><i class="fa fa-outdent"></i> Transfer To Another User</button>
							
							<button class="btn btn-warning" onclick="window.location.href = 'refund.php?id=<?php echo $row['product_id'] ?>'"><i class="fa fa-outdent"></i> Return From User</button>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>