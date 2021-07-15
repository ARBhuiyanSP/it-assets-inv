<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Assets Category</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Assets Category
                            </div>
                            <div class="card-body">
								<!--here your code will go-->
								<div class="form-group">
									<form action="" method="post" name="add_name" id="add_name">
										<div class="row" id="div1" style="">
											<div class="col-md-4">
												<div class="form-group">
													<label>Category ID</label>
													<input type="text" name="assets_id" id="assets_id" class="form-control" readonly="readonly" value="<?php echo getDefaultCategoryCode('assets_categories', 'assets_id', '03d', '001', 'A-') ?>">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Category Name</label>
													<input type="text" name="assets_category" id="assets_category" class="form-control">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>.</label>
													<input type="submit" name="category_submit" id="submit" class="form-control btn btn-block" style="background-color:#007BFF;color:#ffffff;" value="Save" />   
												</div>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col-xs-12">
												<table id="datatablesSimple" class="table table-bordered table-striped table-hover">
													<thead>
														<tr>
															<th>Category ID</th>
															<th>Category Name</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$projectsData = getTableDataByTableName('assets_categories');
														;
														if (isset($projectsData) && !empty($projectsData)) {
															foreach ($projectsData as $data) {
																?>
														<tr>
															<td><?php echo $data['assets_id']; ?></td>
															<td><?php echo $data['assets_category']; ?></td>
															<td>
																<a href="#"><i class="fas fa-edit text-success"></i></a>
																<a href="#"><i class="fa fa-trash text-danger"></i></a>
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
									</form>
								</div>
								<!--here your code will go-->
							</div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>