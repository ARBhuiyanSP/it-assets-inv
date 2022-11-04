<?php 
include('header.php');
include ('employee_action.php');
?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Employees</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Employees
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
								  <div class="col-md-3">
									<h3 class="text-center">Add New</h3>
									<form action="employee_action.php" method="post">
									  <input type="hidden" name="id" value="<?= $id; ?>">
									  
									  <!--- New Form Suppliers as Vendors--->
									  <!--- New Form Suppliers as Vendors--->
									  <div class="form-group">
										<input type="text" name="employee_id" value="<?= $employee_id; ?>" class="form-control" placeholder="Enter Employee ID" required>
									  </div></br>
									  <div class="form-group">
										<input type="text" name="employee_name" value="<?= $employee_name; ?>" class="form-control" placeholder="Enter Name" required>
									  </div></br>
									  <div class="form-group">
										<input type="text" name="designation" value="<?= $designation; ?>" class="form-control" placeholder="Enter Designation" required>
									  </div></br>
									  <div class="form-group">
										<input type="text" name="division" value="<?= $division; ?>" class="form-control" placeholder="Enter Division" >
									  </div></br>
									  <!--- New Form Suppliers as Vendors--->
									  <!--- New Form Suppliers as Vendors--->
									  
									  
									  <div class="form-group">
										<?php if ($update == true) { ?>
										<input type="submit" name="update" class="btn btn-success btn-block" style="width:100%" value="Update Data">
										<?php } else { ?>
										<input type="submit" name="add" class="btn btn-primary btn-block" style="width:100%" value="Add Employee">
										<?php } ?>
									  </div>
									</form>
								  </div>
								  <div class="col-md-9">
									<table class="table table-hover" id="datatablesSimple">
										<thead>
											<tr>
												<th width="15%">Office ID</th>
												<th width="25%">Employee Name</th>
												<th width="25%">Designation</th>
												<th width="15%">Division</th>
												<th width="20%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$projectsData = getTableDataByTableName('employees');
											;
											if (isset($projectsData) && !empty($projectsData)) {
												foreach ($projectsData as $data) {
													?>
											<tr>
												<td><?php echo $data['employee_id']; ?></td>
												<td><?php echo $data['employee_name']; ?></td>
												<td><?php echo $data['designation']; ?></td>
												<td><?php echo $data['division']; ?></td>
												<td>
													<a href="vendor-details.php?details=<?php echo $data['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
													<a href="employee_action.php?delete=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Do you want delete this record?');"><i class="fa fa-trash"></i></a>
													<a href="employees.php?edit=<?= $data['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
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