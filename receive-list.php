<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mt-4 mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Receive List
                            </div>
                            <div class="card-body">
								<div class="table-responsive data-table-wrapper">
									<table id="datatablesSimple" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>MRR No</th>
												<th>MRR Date</th>
												<th>Purchase ID</th>
												<th>Vendor name</th>
												<th>Challan No</th>
												<th>Total Qty</th>
												<th>Total Amount</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											
											if($_SESSION['logged']['user_type'] == 'whm') {
												$item_details = getTableDataByTableNameWid('inv_receive', '', 'id');
											}else{
												$item_details = getTableDataByTableName('inv_receive', '', 'id');
											}
											if (isset($item_details) && !empty($item_details)) {
												foreach ($item_details as $item) {
													if($item['approval_status'] == 0){
													?>
													<tr style="background-color: #FFC107;max-height:10px;">
													<?php  }else{ ?>
													<tr style="background-color: #218838;max-height:10px;">
													<?php  }?>
														<td><?php echo $item['mrr_no']; ?></td>
														<td><?php echo $item['mrr_date']; ?></td>
														<td><?php echo $item['purchase_id']; ?></td>
														<td>
															<?php 
															$supplier_id = $item['supplier_id'];
															$sqlunit	=	"SELECT * FROM `vendors` WHERE `id` = '$supplier_id' ";
															$resultunit = mysqli_query($conn, $sqlunit);
															$rowunit=mysqli_fetch_array($resultunit);
															echo $rowunit['vendor_name'];
															?>
														</td>
														<td><?php echo $item['challanno']; ?></td>
														<td><?php echo $item['no_of_material']; ?></td>
														<td><?php echo $item['receive_total']; ?></td>
														<td>
															<span><a class="action-icons c-approve" href="receive-view.php?no=<?php echo $item['mrr_no']; ?>" title="View"><i class="fas fa-eye text-success mborder"></i></a></span>
															<span><a class="action-icons c-delete" href="receive_edit.php?edit_id=<?php echo $item['id']; ?>" title="edit"><i class="fa fa-edit text-info mborder"></i></a></span>
															<?php if($_SESSION['logged']['user_type'] == 'superAdmin') {?>
															<span><a class="action-icons c-delete" href="receive_approve.php?mrr=<?php echo $item['mrr_no']; ?>" title="approve"><i class="fa fa-check text-info mborder"></i></a></span>
															<?php } ?>
															<span><a class="action-icons c-delete" href="#" title="delete"><i class="fa fa-trash text-danger mborder"></i></a></span>
														</td>
													</tr>
													<?php
												}
											}else{ ?>
												  <tr>
													  <td colspan="7">
															<div class="alert alert-info" role="alert">
																Sorry, no data found!
															</div>
														</td>
													</tr>  
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>