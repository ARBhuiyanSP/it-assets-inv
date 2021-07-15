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
                                <form class="form-horizontal" action="" id="warehouse_stock_search_form" method="GET">
									<div class="table-responsive">          
										<table class="table table-borderless">
											<tbody>
												<tr>  
													<td>
														<div class="form-group">
															<label for="todate">Select Asset For History Check</label>
															<select name="id" class="form-control material_select_2">
																<option>Select Product</option>
																<?php
																$sqlvs="SELECT * FROM `ams_products` ";
																$resultvs = mysqli_query($conn,$sqlvs);
																while($rowvs = mysqli_fetch_array($resultvs)) {
																	if($_GET['id'] == $rowvs['id']){
																	$selected	= 'selected';
																	}else{
																	$selected	= '';
																	}
																	
																?>
																<option value="<?php echo $rowvs['id']; ?>" <?php echo $selected; ?>><?php echo $rowvs['sl_no'] ?> || <?php echo $rowvs['item_name'] ?> || <?php echo $rowvs['model'] ?> || <?php echo $rowvs['assets_description'] ?></option>
																<?php } ?>
															</select>
														</div>
													</td>
													
													
													<td colspan="2">
														<div class="form-group">
															<label for="todate">.</label>
															<button type="submit" name="submit" class="form-control btn btn-primary">Search</button>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</form>
								
								
								
								<!--- Search Result--->
								<?php
								if(isset($_GET['submit'])){
									
									$id = $_GET['id'];
									$sql	=	"select * from `ams_products` where `id`='$id'";
									$result = mysqli_query($conn, $sql);
									$row=mysqli_fetch_array($result);
									
									
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
													<h3>Assets History Report</h3>
													<table class="table" style="width:80%">
														<tr>
															<th>Name:</th>
															<td><?php echo $row['item_name']; ?>
															</td>
															<th>INV SL No:</th>
															<td><?php echo $row['manu_sl'] ?></td>
															<th>Brand:</th>
															<td><?php echo $row['brand'] ?></td>
															<td rowspan="2"><img src="<?php echo $row['qr_image'] ?>" height="100" /></td>
															
														</tr>
														<tr>
															<th>Model:</th>
															<td><?php echo $row['model'] ?></td>
															<th>Origin:</th>
															<td><?php echo $row['origin'] ?></td>
															<th>Purchase Date:</th>
															<td><?php echo $row['puchase_date'] ?></td>
														</tr>
													</table>
													<table id="" class="table table-striped table-bordered" style="width:90%">
														<thead>
															<tr>
																<th>Employee ID</th>
																<th>Employee Name</th>
																<th>Date From Assign</th>
																<th>Date To Assign</th>
															</tr>
														</thead>
														<tbody>
														<?php
															$product_id = $row['id'];
															$sqlh	=	"select * from `product_assign` where `product_id`='$product_id'";
															$resulth = mysqli_query($conn, $sqlh);
															while ($rowh = mysqli_fetch_array($resulth)) { ?>
														
															<tr>
																<td><?php echo $rowh['employee_id']; ?></td>
																
																<?php
																	$employee_id=$rowh['employee_id'];
																	$sqlemp	=	"select * from `employees` where `employee_id`='$employee_id'";
																	$resultemp = mysqli_query($conn, $sqlemp);
																	$rowemp = mysqli_fetch_array($resultemp);
																?>
																<td><?php echo $rowemp['employee_name']; ?></td>
																<td><?php 
																if($rowh['assign_date']){
																	$rDate = strtotime($rowh['assign_date']);
																	$rfDate = date("jS \of F Y",$rDate);
																	echo $rfDate;
																}else{
																	echo '---';
																}
																?>
																</td>
																<td><?php 
																if($rowh['refund_date']){
																	$rfDate = strtotime($rowh['refund_date']);
																	$rffDate = date("jS \of F Y",$rfDate);
																	echo $rffDate;
																}else{
																	echo '---';
																}
																?>
																</td>
															</tr>
															<?php } ?>
														</tbody>
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
										<center><button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true" style="    font-size: 17px;"> Print</i></button></center>
								</center>
								<?php }?>
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