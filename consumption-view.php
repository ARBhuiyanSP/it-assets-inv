<?php include 'header.php';
$consumption_id=$_GET['no']; ?>
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
                            <li class="breadcrumb-item active">Material Consumption Details</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
											
						<?php
							$sqld = "select * from `inv_consumption` where `consumption_id`='$consumption_id'";
							$resultd = mysqli_query($conn, $sqld);
							$rowd = mysqli_fetch_array($resultd);
						?>
		
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Material Consumption Details
                            </div>
                            <div class="card-body" id="printableArea">
                                <div class="row">
									<div class="col-xs-6">	
										<p>
										<img src="assets/img/logo-wide.png" height="50px;"/>
										<h5>Saif Power Group </h5><span>Material Consumption Details</span></p>
									</div>
									<div class="col-xs-6">
										<table class="table table-bordered">
											<tr>
												<th>Consumption ID:</th>
												<td><?php echo $consumption_id; ?></td>
											</tr>
											<tr>
												<th>Consumption Date:</th>
												<td><?php
												echo $rowd['consumption_date'] ?></td>
											</tr>
											<tr>
												<th>From Store:</th>
												<td>
													<?php 
													$dataresult =   getDataRowByTableAndId('store', $rowd['warehouse_id']);
													echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
													?>
												</td>
											</tr>
											<tr>
												<th>Employee/User:</th>
												<td>
													<?php 
													
														$employee_id = $rowd['employee_id'];
														$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
														$resultemployee = mysqli_query($conn, $sqlemployee);
														$rowemployee=mysqli_fetch_array($resultemployee);
														echo $rowemployee["employee_id"] .'</br>'.$rowemployee["employee_name"];
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
											<th>Material Name</th>
											<th>Material Unit</th>
											<th>Quantity</th>
										</tr>
									</thead>
									<tbody id="material_receive_list_body">
										<?php
										$sql = "select * from `inv_consumptiondetails` where `consumption_id`='$consumption_id'";
										$result = mysqli_query($conn, $sql);
											for($i=1; $row = mysqli_fetch_array($result); $i++){
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td>
												<?php 
													$dataresult =   getDataRowByTableAndId('inv_material', $row['material_name']);
													echo (isset($dataresult) && !empty($dataresult) ? $dataresult->material_description : '');
												?>
											</td>
											<td>
												<?php 
												$dataresult =   getDataRowByTableAndId('inv_item_unit', $row['unit']);
												echo (isset($dataresult) && !empty($dataresult) ? $dataresult->unit_name : '');
												?>
											</td>
												
											<td><?php echo $row['consumption_qty'] ?></td>
										</tr>
										<?php } ?>
										<tr>
											<td colspan="3" class="grand_total">Grand Total:</td>
											<td>
												<?php 
												$sql2 = "SELECT sum(consumption_qty) FROM  `inv_consumptiondetails` where `consumption_id`='$consumption_id'";
												$result2 = mysqli_query($conn, $sql2);
												for($i=0; $row2 = mysqli_fetch_array($result2); $i++){
												$fgfg2=number_format((float)$row2['sum(consumption_qty)'], 2, '.', '');
												
												echo $fgfg2 ;
												}
												?>
											</td>
										</tr>
										<tr>
											<td colspan="4">Remarks:</br>
												<?php 
												echo $rowd['remarks'];
												?>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="row" style="text-align:center">
									<div class="col-xs-6"></br><?php echo $rowd['received_by'];?></br>--------------------</br>Receiver Signature</div>	
									
									
									<div class="col-xs-6"></br><?php 
												if($rowd['approved_by']){
												$dataresult =   getDataRowByTableAndId('users', $rowd['approved_by']);
												echo (isset($dataresult) && !empty($dataresult) ? $dataresult->first_name . ' ' .$dataresult->last_name : '');	
												}?></br>--------------------</br>Authorised Signature</div>
								</div></br>
								<div class="row">
									<div class="col-sm-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
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