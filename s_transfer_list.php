<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mt-4 mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Store 2 Store Transfer List
                            </div>
                            <div class="card-body">
								<div class="table-responsive data-table-wrapper">
									<table id="datatablesSimple" class="table table-striped table-bordered">
										<thead>
                                        <tr>
											<th>Product ID</th>
											<th>Product Name</th>
											<th>From Store</th>
											<th>To store</th>
											<th>Transfer Date</th>
											<th>Transfer By</th>
											<th>Action</th>
                                        </tr>
                                        </thead>
										<tbody>
											<tr id="" bgcolor="#f2f2f2" class="edit_tr">
											<?php
											$sql	=	"select * from `store_transfer` ORDER BY `id` DESC";
											$result = mysqli_query($conn, $sql);
											while($row=mysqli_fetch_array($result))
											{
											
													$product_id=$row['product_id'];
													$sql2	=	"select * from `ams_products` where `id`='$product_id'";
													$result2 = mysqli_query($conn, $sql2);
													$rowp=mysqli_fetch_array($result2);
														$employee_id	=	$row['transfer_by'];
														$sqlemp			=	"select * from `employees` where `employee_id`='$employee_id'";
														$resultemp = mysqli_query($conn, $sqlemp);
														$rowemp=mysqli_fetch_array($resultemp);
													
												?>
												<td><span class="text"><?php echo $rowp['sl_no']; ?></span></td>
												<td><span class="text"><?php echo $rowp['item_name']; ?></span></td>
												<td><span class="text"><?php 
											$dataresult =   getDataRowByTableAndId('store', $row['from_store']);
											echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
											?></span></td>
												<td><span class="text"><?php 
											$dataresult =   getDataRowByTableAndId('store', $row['to_store']);
											echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
											?></span></td>
												<td><span class="text"><?php echo $row['transfer_date']; ?></span></td>
												<td><span class="text"><?php echo $rowemp['employee_name']; ?></span></td>
												<td class='text-center'> 
												<!-- <button onclick="window.location.href = 'assignqrview.php?id=<?php echo $row['id'] ?>'" class='' title="Details"> <i class="fa fa-eye text-success"></i></button>
												<button onclick="window.location.href = 'handover-receipt.php?id=<?php echo $row['id'] ?>'" class='' title="Handover Receipt"> <i class="fa fa-chart-area text-success"></i></button> -->
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
                    </div>
                </main>
                <?php include('footer.php'); ?>