<?php include('header.php');
$id = $_GET['id']; ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Store To Store Transfer</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Store To Store Transfer
                            </div>
                            <div class="card-body">
                                <div class="row">
									<div class="col-md-12">
										<div class="page-title-box">
											<h4 class="page-title">Products View</h4>

											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<!-- end row -->
								<div class="row">
								<?php
								$sql	=	"select * from ams_products where id=$id";
								$result = mysqli_query($conn, $sql);
								$row=mysqli_fetch_array($result);
								?>
								<div class="col-md-4">
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
								<div class="col-md-8">
									<h3>Scan Below Code</h3>
									<img src="<?php echo $row['qr_image'] ?>" height="250" />
								</div>
							</div>
								<h3 style="color:red;">Want To Transfer This Product to Another Store ?</h3>
								<form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
									<div class="row">
										<div class="col-xs-2">
											<div class="form-group">
												<label>Current Store</label>
												<?php
													$store_id = $row['current_store'];
													$sqlstore	= "select * from `store` where `id`='$store_id'";
													$resultstore = mysqli_query($conn, $sqlstore);
													$rowstore=mysqli_fetch_array($resultstore);
												?>
												<input type="text" class="form-control" readonly="readonly" value="<?php echo $rowstore['name']; ?>">
												<input type="hidden" name="from_store" class="form-control" id="" value="<?php echo $row['current_store']; ?>" readonly required />
											</div>
										</div>
										<div class="col-xs-2">
												<div class="form-group">
													<label for="id">Transfer To</label>
													<select class="form-control material_select_2" id="to_store" name="to_store" required>
														<option value="">Select</option>
														<?php
														$projectsData = getTableDataByTableName('store');

														if (isset($projectsData) && !empty($projectsData)) {
															foreach ($projectsData as $data) {
																?>
																<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
																<?php
															}
														}
														?>
													</select>
												</div>
											</div>
										<div class="col-xs-2">
											<div class="form-group">
												<label>Transfer Date</label>
												<input name="transfer_date" type="text" class="form-control" id="transfer_date" value="" size="30" required />
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="id">Transfer By</label>
												<?php 
													$employee_id = $_SESSION['logged']['employee_id'];
													$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
													$resultemployee = mysqli_query($conn, $sqlemployee);
													$rowemployee=mysqli_fetch_array($resultemployee);
												?>
												<input type="text" class="form-control" id="" value="<?php echo $rowemployee["employee_name"]; ?>" readonly required />
												<input name="transfer_by" type="hidden" id="transfer_by" value="<?php echo $rowemployee["employee_id"]; ?>" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="form-group">
												<label for="ad">Remarks</label>
												<textarea id="ad" name="remarks" class="form-control" placeholder=""></textarea>
											</div>
										</div>
									</div>
									<input type="hidden" name="product_id" value="<?php echo $id ?>" />
									<div class="row">
										<div class="col-md-8 mt-4">
											<div class="form-group">
												<button class="btn btn-danger" type="submit" id="s_transfer_submit" name="s_transfer_submit" style="width:100%"> Transfer This Product</i></button>
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
						$("#transfer_date").datepicker({
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