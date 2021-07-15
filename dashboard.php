<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <?php
								$sql	=	"select * from vendors";
								$result = mysqli_query($conn, $sql);
								$rowcount=mysqli_num_rows($result);
							?>
							<div class="col-xl-4 col-md-4">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Vendors<small> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> <?php echo $rowcount; ?></small></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							<?php
								$sqlemp	=	"select * from employees";
								$resultemp = mysqli_query($conn, $sqlemp);
								$empcount=mysqli_num_rows($resultemp);
							?>
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Employees<small> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> <?php echo $empcount; ?></small></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							<?php
								$store_id = $_SESSION["store_id"];
								$sqlpro	=	"select * from `ams_products` where `store_id`='$store_id' ";
								$resultpro = mysqli_query($conn, $sqlpro);
								$procount=mysqli_num_rows($resultpro);
							?>
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Total Products<small> <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> <?php echo $procount; ?></small></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Recently Assigned & Handovered Assets
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
						<div class="row">
                            <?php 
								$sql = "select * FROM `assets_categories`";
								$result = mysqli_query($conn, $sql);
								while ($row = mysqli_fetch_array($result)) {
							?>
							<div class="col-xl-2 col-md-2">
								<?php
									$store_id = $_SESSION["store_id"];
									$assets_category	=	$row['assets_id'];
									$sqlpro	=	"select * FROM `ams_products` WHERE `assets_category`='$assets_category' AND `store_id`='$store_id'";
									$resultpro = mysqli_query($conn, $sqlpro);
									$procount=mysqli_num_rows($resultpro);
								?>
								<div class="card bg-success text-white mb-4">
                                    <div class="card-body"><span style="background-color:#AF4940;color:#ffffff;padding:3px;border-radius:5px;"><?php echo $row['assets_category']; ?></span>
										</br><small>Total Item <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> <?php echo $procount; ?></small>
										<?php
											$store_id = $_SESSION["store_id"];
											$assets_category	=	$row['assets_id'];
											$sqlstock	=	"select * FROM `ams_products` WHERE `assets_category`='$assets_category' AND `store_id`='$store_id' AND `assign_status`!='assigned'";
											$resultstock = mysqli_query($conn, $sqlstock);
											$stockcount=mysqli_num_rows($resultstock);
										?>
										</br><small> Instock <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> <?php echo $stockcount; ?></small>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							<?php } ?>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>