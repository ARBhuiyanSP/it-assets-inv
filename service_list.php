

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

                            <div class="row">
                            <div class="col-xs-12">
                            <div class="card-body">
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr style="background-color:#049458;color:#ffffff;">
											<th style="min-width:60px;">SRV No</th>
											<th style="min-width:100px;">Assets SL No</th>
											<th style="min-width:250px;">Vendor</th>
											<th style="min-width:100px;">Handover date</th>
											<th style="min-width:100px;">Status</th>
											<th style="min-width:180px;">Action</th>
										</tr>
									</thead>
									<tbody>
										 <?php
											$role = $_SESSION['logged']['role'];
											$store_id = $_SESSION['logged']['store_id'];
											
											if($role == 'user'){
												$sql = "select * from inv_services where `store_id`='$store_id'";
											}else{
												$sql = "select * from inv_services";
											}
											
											//$sql = "select * from ams_products where `store_id`='$store_id'";
											$result = mysqli_query($conn, $sql);
											while ($row = mysqli_fetch_array($result)) {
												
											if($row['status']=='at_servicing'){
												?>
										<tr class="edit_tr" style="background-color:#F5A143;color:#ffffff;">
											<?php } else{?>
										<tr class="edit_tr" style="background-color:#64D55F;color:#ffffff;">
											<?php } ?>
												<td><span class="text"><?php echo $row['srv_no'] ?></span></td>
												<td><span class="text"><?php echo $row['assets_slno'] ?></span></td>
												<td><span class="text"><?php echo $row['vendor'] ?></span></td>
												<td><span class="text"><?php echo $row['handover_date'] ?></span></td>
												<td><span class="text"><?php echo $row['status'] ?></span></td>
												<td class='text-center'> 

													<button onclick="window.location.href = 'srv-handover-receipt.php?id=<?php echo $row['id'] ?>'" class=''><i class="fa fa-eye text-success"></i></button>
													
													<?php if($row['status']=='at_servicing'){ ?>
													<a href="#"><button><i class="fa fa-edit text-success"></i></button></a>
													<!-- <a href="assets_edit.php?id=<?php echo $row['id'] ?>"><button><i class="fa fa-edit text-success"></i></button></a> -->
													<button onclick="window.location.href = 'srv_return.php?id=<?php echo $row['id'] ?>'"  title="Return"><i class="fa fa-outdent text-success"></i></button>
													<?php }?>
													
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
							