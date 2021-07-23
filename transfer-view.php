<?php include 'header.php';
$transfer_id=$_GET['no']; ?>
<style>
.table-bordered {
	border: 1px solid #000000;
}
.table-bordered th, .table-bordered td{
	border: 1px solid #000000;
}
.table th, .table td {
	padding:2px 10px 2px 10px;
}

.challan{
	font-weight:bold;
}
</style>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Material Transfer Details</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Material Transfer Details
                            </div>
                            <div class="card-body" id="printableArea">
                                <div class="row">
									<div class="col-xs-6">	
										<p>
										<img src="assets/img/logo-wide.png" height="50px;"/>
										<h5>Saif Power Group </h5><span>Material Transfer Details</span></p></div>
									<div class="col-xs-6">
										<table class="table table-bordered">
											<tr>
												<th>Transfer ID:</th>
												<td><?php echo $transfer_id; ?></td>
											</tr>
											<tr>
												<th>Transfer Date:</th>
												<td><?php
													$sqld = "select * from `inv_transfermaster` where `transfer_id`='$transfer_id'";
													$resultd = mysqli_query($conn, $sqld);
													$rowd = mysqli_fetch_array($resultd);
												echo $rowd['transfer_date'] ?></td>
											</tr>
											<tr>
												<th>From Store:</th>
												<td>
													<?php 
													$dataresult =   getDataRowByTableAndId('store', $rowd['from_warehouse']);
													echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
													?>
												</td>
											</tr>
											<tr>
												<th>To Store:</th>
												<td>
													<?php 
													$dataresult =   getDataRowByTableAndId('store', $rowd['to_warehouse']);
													echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
													?>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="table table-bordered" id="material_receive_list"> 
									<thead>
										<tr>
											<th>SL #</th>
											<th>material_name</th>
											<th>Qty</th>
										</tr>
									</thead>
									<tbody id="material_receive_list_body">
										<?php
										$transfer_id=$_GET['no'];
										$sql = "select * from `inv_tranferdetail` where `transfer_id`='$transfer_id'";
										$result = mysqli_query($conn, $sql);
											for($i=1; $row = mysqli_fetch_array($result); $i++){
										?>
										<tr>
											<td>
												<?php echo $i; ?>
											</td>
											<td>
												<?php 
													$dataresult =   getDataRowByTableAndId('inv_material', $row['material_name']);
													echo (isset($dataresult) && !empty($dataresult) ? $dataresult->material_description : '');
												?>
											</td>
											<td>
												<?php echo $row['transfer_qty'] ?>
											</td>
										</tr>
										
										<?php } ?>
										<tr>
											<td colspan="2" class="grand_total">
												Grand Total:
											</td>
											<td>
												<?php 
												$sql2 = "SELECT sum(transfer_qty) FROM  `inv_tranferdetail` where `transfer_id`='$transfer_id'";
												$result2 = mysqli_query($conn, $sql2);
												for($i=0; $row2 = mysqli_fetch_array($result2); $i++){
												$fgfg2=$row2['sum(transfer_qty)'];
												echo $fgfg2 ;
												}
												?>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="row" style="text-align:center">
									<div class="col-xs-6"></br></br>--------------------</br>Receiver Signature</div>
									<div class="col-xs-6"></br></br>--------------------</br>Authorised Signature</div>
								</div></br>
								<div class="row">
									<div class="col-xs-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
										<center><h5>Notice***</br><span style="font-size:14px;color:#000000;">Please Check Everything Before Signature</span></h5></center>
									</div>
								</div>
                            </div>
							<center><button class="btn btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button></center>
							<script>
							function printDiv(divName) {
								 var printContents = document.getElementById(divName).innerHTML;
								 var originalContents = document.body.innerHTML;

								 document.body.innerHTML = printContents;

								 window.print();

								 document.body.innerHTML = originalContents;
							}
							</script>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>