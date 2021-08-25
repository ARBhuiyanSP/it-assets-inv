<?php 
include('header.php');
include ('company_process.php');
?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Company List</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Company list
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
									<h3 class="text-center">Add New Company</h3>
									<form action="company_process.php" method="post">
									  <input type="hidden" name="id" value="<?= $id; ?>">
									  
									  <!--- New Form Suppliers as Vendors--->
									  <!--- New Form Suppliers as Vendors--->
									  <div class="form-group">
										<input type="text" name="company_name" value="<?= $company_name; ?>" class="form-control" placeholder="Enter Company Name" required>
									  </div></br>
									  <!--- New Form Suppliers as Vendors--->
									  <!--- New Form Suppliers as Vendors--->
									  
									  
									  
									  <div class="form-group">
										<?php if ($update == true) { ?>
										<input type="submit" name="update" class="btn btn-success btn-block" style="width:100%" value="Update Company">
										<?php } else { ?>
										<input type="submit" name="add" class="btn btn-primary btn-block" style="width:100%" value="Add Company">
										<?php } ?>
									  </div>
									</form>
								  </div>
								  <div class="col-md-8">
									<div class="card-header" style="background-color: #ffffff;">
										<button class="btn btn-success linktext"> Company List</button>
										<button class="btn btn-primary linktext" onclick="window.location.href='divisions.php';"> Division List</button>
										<button class="btn btn-primary linktext" onclick="window.location.href='departments.php';"> Department List</button>
										<button class="btn btn-primary linktext" onclick="window.location.href='prolocs.php';"> Project/Location List</button>
									</div>
									<table class="table table-hover" id="datatablesSimple">
										<thead>
											<tr>
												<th width="10%">SL No</th>
												<th width="60%">Company Name</th>
												<th width="30%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php 
											$projectsData = getTableDataByTableName('companies');
											if (isset($projectsData) && !empty($projectsData)) {
												$i=1;
												foreach ($projectsData as $data) { ?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $data['company_name']; ?></td>
												<td>
													<a href="vendor-details.php?details=<?php echo $data['id']; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
													<a href="company_process.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Do you want delete this record?');"><i class="fa fa-trash"></i></a>
													<a href="companies.php?edit=<?= $data['id']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
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