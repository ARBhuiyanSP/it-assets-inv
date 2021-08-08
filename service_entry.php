<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Service Area</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Service Area
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="" id="warehouse_stock_search_form" method="GET">
									<div class="table-responsive">          
										<table class="table table-borderless">
											<tbody>
												<tr>  
													<td>
														<div class="form-group">
															<label for="todate">Select Asset For Repair/Servicing</label>
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
													<?php
								$sql	=	"select * from ams_products where id=$id";
								$result = mysqli_query($conn, $sql);
								$row=mysqli_fetch_array($result);
								?>
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
										<th>Warranty:</th>
										<?php 
											$today = time(); // or your date as well
											//$puchase_date = strtotime($row['puchase_date']);
											$warranty	=	'1';
											$newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($row['puchase_date'])) . " + ".$warranty." year"));
											$datediff = strtotime($newEndingDate) - $today;
											$daysdiff	=	round($datediff / (60 * 60 * 24));
											
											if($daysdiff > 0){
												$remain_days	=	round($datediff / (60 * 60 * 24)).'  Days Remaining';
											}else{
												$remain_days	=	' None';
											}

											
										?>
										<td><?php if ($warranty!=""){echo $warranty.' Year || Warranty end at : '.$newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($row['puchase_date'])) . " + ".$warranty." year")).' || Warranty Status : '.$remain_days;}else{ echo $warranty.' None';} 
										
										
										?>
										
										
										</td>
										
									</tr>
									<tr>
										<th>Custody: </th>
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
												</center>
											</div>
											</div>			
										</div>
								</center>
								<?php }else{ 
									include('service_list.php');
								}?>
								<!--- Search Result--->
								
								
								
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>