<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item ">Dashboard</li>
                            <li class="breadcrumb-item active">Asset Transfer</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Asset Transfer
                            </div>
                            <div class="card-body">
                                <div class="row">
									<div class="col-xs-12">
										<div class="page-title-box">
											<h4 class="page-title">Products View</h4>

											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<!-- end row -->
								<div class="row">
								<?php
								$id = $_GET['id'];
								$sql	=	"select * from ams_products where id=$id";
								$result = mysqli_query($conn, $sql);
								$row=mysqli_fetch_array($result);
								?>
								<div class="col-lg-4">
									<table style="" class="table table-bordered">
										<tr>
											<th>Item Name:</th>
											<td><?php echo $row['item_name'] ?></td>
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
											<th>RLP No:</th>
											<td><?php echo $row['rlp_no'] ?></td>
										</tr>
										<tr>
											<th>Country Origin:</th>
											<td><?php echo $row['origin'] ?></td>
										</tr>
										<tr>
											<th>Vendor Name:</th>
											<td><?php echo $row['vendor_name'] ?></td>
										</tr>
										<tr>
											<th>Purchase Date:</th>
											<td><?php echo $row['puchase_date'] ?></td>
										</tr>
										<tr>
											<th>Custody:</th>
											<td><?php echo $row['custody'] ?></td>
										</tr>
									</table>
								</div>
								<div class="col-lg-8">
									<h3>Scan Below Code</h3>
									<img src="<?php echo $row['qr_image'] ?>" height="250" />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<?php 
											$product_id= $row['id'];
											$sql2	= "SELECT * FROM product_assign WHERE product_id=$product_id ORDER BY id DESC LIMIT 1 ;";
											$result2 = mysqli_query($conn, $sql2);
											$row2=mysqli_fetch_array($result2);
											?>
										<label>Current User</label>
										<?php 
										$employee_id=$row2['employee_id'];
										$sql3	= "SELECT * FROM `employees` WHERE `employee_id`='$employee_id' ;";
										$result3 = mysqli_query($conn, $sql3);
										$row3=mysqli_fetch_array($result3);
										?>
										<input name="employee_id" type="text" class="form-control" id="" value="<?php echo $row3['employee_name'] ?>" readonly />
									</div>
								</div>
								<div class="col-xs-2">
									<div class="form-group">
										<label>Using From</label>
										<input name="assign_date" type="text" class="form-control" id="" value="<?php echo $row2['assign_date'] ?>" readonly />
									</div>
								</div>
								<div class="col-xs-8">
									<div class="form-group">
										<label>Remarks</label>
										<input name="remarks" type="text" class="form-control" id="" value="<?php echo $row2['remarks'] ?>" readonly />
									</div>
								</div>
							</div>
							<h3 style="color:red;">Want To Transfer This Product ?</h3>
							<form action="movetotransfer.php" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
								<div class="row">
									<div class="col-xs-4">
										<div class="form-group">
											<?php 
												$product_id= $row['id'];
												$sql2	= "SELECT * FROM `product_assign` WHERE `product_id`='$product_id' ORDER BY `id` DESC LIMIT 1 ;";
												$result2 = mysqli_query($conn, $sql2);
												$row2=mysqli_fetch_array($result2);
												?>
											<label>Transfer To</label>
											<select id="dv" name="employee_id" class="form-control material_select_2" required >
												<option value="">Select Employee</option>
												<?php 
												$sql	= "select * from employees ORDER BY id ASC";
												$result = mysqli_query($conn, $sql);
												while($row=mysqli_fetch_array($result))
													{
												?>
												<option value="<?php echo $row['employee_id'] ?>">
												<?php echo $row['employee_name'] ?>-<?php echo $row['employee_id'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label>Transfer Date</label>
											<input name="assign_date" type="text" class="form-control" id="rndate" value=""  autocomplete="off" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-8">
										<div class="form-group">
											<label for="ad">Remarks</label>
											<textarea id="ad" name="remarks" class="form-control" placeholder=""></textarea>
										</div>
									</div>
								</div>
								<input type="text" name="id" value="<?php echo $row2['id'] ?>" />
								<input type="hidden" name="product_id" value="<?php echo $product_id ?>" />
								<div class="row">
									<div class="col-md-8 mt-4">
										<div class="form-group">
											<button class="btn btn-danger" type="submit" id="transfer_submit" name="assign_submit" style="width:100%"> Transfer This Product</i></button>
										</div>
									</div>
								</div>
							</form>
                            </div>
                        </div>
                    </div>
                </main>
				<script>
					$(function() {
						$("#cldate").datepicker({
								inline: true,
								dateFormat:"yy-mm-dd",
								yearRange:"-50:+10",
								changeYear: true,
								changeMonth: true
						});
					});
				</script>
				<script>
					$(function() {
					$("#rndate").datepicker({
							inline: true,
							dateFormat:"yy-mm-dd",
							yearRange:"-50:+10",
							changeYear: true,
							changeMonth: true
						});
					});
				</script>
                <?php include('footer.php'); ?>