<?php include('header.php');
$id=$_GET['id']; ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Handover Receipt</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Handover Receipt
                            </div>
                            <div class="card-body">
								<?php
									$sql	=	"select * from `product_assign` where `id`='$id'";
									$result = mysqli_query($conn, $sql);
									$row=mysqli_fetch_array($result);
									
									
										$product_id=$row['product_id'];
										$sql2	=	"select * from `ams_products` where `id`='$product_id'";
										$result2 = mysqli_query($conn, $sql2);
										$rowp=mysqli_fetch_array($result2);
								?>
                                <center>
									
									<div class="row">
										<div class="col-md-12" id="printableArea">
											<div class="row">
												<center>
												<div class="col-sm-12">	
													<h1 align="center"><img src="assets/img/logo-wide.png" height="50"></h1>
													<h2>SAIF POWER GROUP</h2>
													<p>72,Mohakhali C/A, (8th Floor),Rupayan Center,Dhaka-1212,bangladesh</p>
													<h3>Assets Handover Receipt</h3>
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
												</center>
											</div>
												<center><div class="row">
													<div class="col-xs-6"></br></br>--------------------</br>Receiver Signature</div>
													<div class="col-xs-6"></br></br>--------------------</br>Authorised Signature</div>
												</div></center></br>
												<div class="row">
													<div class="col-sm-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
														<center><h5>Notice***</br><span style="font-size:14px;color:#000000;">Please Check Everything Before Signature</span></h5></center>
														
													</div>
												</div>
											</div>			
										</div>
										<center><button class="btn btn-success mt-4" onclick="printDiv('printableArea')"><i class="fa fa-print"> </i>Print</button></center>
								</center>
								<script>
								function printDiv(divName) {
									 var printContents = document.getElementById(divName).innerHTML;
									 var originalContents = document.body.innerHTML;

									 document.body.innerHTML = printContents;

									 window.print();

									 document.body.innerHTML = originalContents;
								}
								</script>
								<!--- Search Result--->
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>