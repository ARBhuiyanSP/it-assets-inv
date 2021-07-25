<?php 
include('header.php');
?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Vendors</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Vendors
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
									<div class="col-md-10">
										<?php if (isset($_SESSION['response'])) { ?>
										<div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
										  <button type="button" class="close" data-dismiss="alert">&times;</button>
										  <b><?= $_SESSION['response']; ?></b>
										</div>
										<?php } unset($_SESSION['response']); ?>
									</div>
								</div>
								<div class="row">
								  <div class="col-md-4">
									<h3 class="text-center">Add New Vendor</h3>
									<form action="action.php" method="post">
									  <input type="hidden" name="id" value="<?= $id; ?>">
									  
									  <!--- New Form Suppliers as Vendors--->
									  <!--- New Form Suppliers as Vendors--->
									  <div class="form-group">
										<input type="text" name="vendor_id" value="<?= $vendor_id; ?>" class="form-control" placeholder="Enter ID" required>
									  </div></br>
									  <div class="form-group">
										<input type="text" name="vendor_name" value="<?= $vendor_name; ?>" class="form-control" placeholder="Enter Name" required>
									  </div></br>
									  <div class="form-group">
										<input type="text" name="address" value="<?= $address; ?>" class="form-control" placeholder="Enter Adderss" required>
									  </div></br>
									  <div class="form-group">
										<input type="text" name="email" value="<?= $email; ?>" class="form-control" placeholder="Enter Contact email" >
									  </div></br>
									  <div class="form-group">
										<input type="text" name="phone" value="<?= $phone; ?>" class="form-control" placeholder="Enter Supplier Phone" >
									  </div></br>
									  <div class="form-group">
										<input type="text" name="web" value="<?= $web; ?>" class="form-control" placeholder="Enter web" >
									  </div></br>
									  <!--- New Form Suppliers as Vendors--->
									  <!--- New Form Suppliers as Vendors--->
									  
									  
									  
									  <div class="form-group">
										<?php if ($update == true) { ?>
										<input type="submit" name="update" class="btn btn-success btn-block" style="width:100%" value="Update Record">
										<?php } else { ?>
										<input type="submit" name="add" class="btn btn-primary btn-block" style="width:100%" value="Add Record">
										<?php } ?>
									  </div>
									</form>
								  </div>
								  <div class="col-md-8">
									<table class="table table-hover" id="datatablesSimple">
										<thead>
											<tr>
												<th width="10%"> ID</th>
												<th width="25%">Vendor Name</th>
												<th width="30%">Address</th>
												<th width="10%">Phone</th>
												<th width="25%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$projectsData = getTableDataByTableName('vendors');
											;
											if (isset($projectsData) && !empty($projectsData)) {
												foreach ($projectsData as $data) {
													?>
											<tr>
												<td><?php echo $data['vendor_id']; ?></td>
												<td><?php echo $data['vendor_name']; ?></td>
												<td><?php echo $data['address']; ?></td>
												<td><?php echo $data['phone']; ?></td>
												<td>
													<a href="vendor-details.php?details=<?php echo $data['id']; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
													<a href="action.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Do you want delete this record?');"><i class="fa fa-trash"></i></a>
													<a href="vendors.php?edit=<?= $data['id']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
												</td>
											</tr>
											<?php
												}
											}
											?>
										</tbody>
									</table>
								  </div>
								</div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>