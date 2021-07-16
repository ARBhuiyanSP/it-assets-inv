<?php include('header.php'); ?>
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.bootstrap4.min.css" rel="stylesheet" />

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js" crossorigin="anonymous"></script>
<style>
/* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
</style>

                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
						<ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Assets List</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Assets List
                            </div>
                            <div class="card-body">
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr style="background-color:#049458;color:#ffffff;">
											<th style="min-width:60px;">PID</th>
											<th style="min-width:100px;">Category</th>
											<th style="min-width:250px;">Description</th>
											<th style="min-width:100px;">Model</th>
											<th style="min-width:150px;">Manufacturing SL</th>
											<th style="min-width:150px;">Custodian</th>
											<th style="min-width:100px;">Status</th>
											<th style="min-width:180px;">Action</th>
										</tr>
									</thead>
									<tbody>
										 <?php
											$role = $_SESSION['logged']['role'];
											$store_id = $_SESSION['logged']['store_id'];
											
											if($role == 'user'){
												$sql = "select * from ams_products where `store_id`='$store_id'";
											}else{
												$sql = "select * from ams_products";
											}
											
											//$sql = "select * from ams_products where `store_id`='$store_id'";
											$result = mysqli_query($conn, $sql);
											while ($row = mysqli_fetch_array($result)) {
												
											if($row['assign_status']=='assigned'){
												?>
										<tr class="edit_tr" style="background-color:#F5A143;color:#ffffff;">
											<?php } else{?>
										<tr class="edit_tr" style="background-color:#64D55F;color:#ffffff;">
											<?php } ?>
												<td><span class="text"><?php echo $row['sl_no'] ?></span></td>
											<td><span class="text"><?php
											$cat_id = $row['assets_category'];
											$sqlc = "select `assets_category` from `assets_categories` where `assets_id`='$cat_id';";
											$resultc = mysqli_query($conn, $sqlc);
											$rowc = mysqli_fetch_array($resultc);
											echo $rowc['assets_category']
												?></span></td>
												<td><span class="text"><?php echo $row['assets_description'] ?></span></td>
												<td><span class="text"><?php echo $row['model'] ?></span></td>
												<td><span class="text"><?php echo $row['manu_sl'] ?></span></td>
												<td><span class="text"><?php echo $row['custody'] ?></span></td>
												<td><span class="text"><?php echo $row['assign_status'] ?></span></td>
												<td class='text-center'> 
													<a href="assets_edit.php?id=<?php echo $row['id'] ?>"><button><i class="fa fa-edit text-success"></i></button></a>

													<!-- <a href="del-product.php?id=<?php echo $row['id'] ?>"><button onclick="" class=''><i class="fa fa-trash text-danger"></i></button></a> -->
													<button onclick="window.location.href = 'qrview.php?id=<?php echo $row['id'] ?>'" class=''><i class="fa fa-eye text-success"></i></button>
													<button onclick="window.location.href = 'qrprintview.php?id=<?php echo $row['id'] ?>'" class=''><i class="fa fa-print text-success"></i></button>
													
													
													<?php if($row['assign_status']=='assigned'){ ?>
													<button onclick="window.location.href = 'transfer.php?id=<?php echo $row['id'] ?>'" title="Transfer"><i class="fa fa-user text-success"></i></button>
													<button onclick="window.location.href = 'refund.php?id=<?php echo $row['id'] ?>'"  title="Return"><i class="fa fa-outdent text-success"></i></button>
													<?php }else{ ?>
													<button onclick="window.location.href = 'product-assign.php?id=<?php echo $row['id'] ?>'" title="Assign"><i class="fa fa-user text-success"></i></button>
													<?php } ?>
												</td>
											</tr>

											<?php
										}
										?>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </main>

                <?php include('footer.php'); ?>
				