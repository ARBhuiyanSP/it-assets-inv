<?php include 'header.php';
$mrr_no=$_GET['no']; ?>
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
.amountWords{
	text-decoration:underline;
	font-style:italic;
	color:#f26522;
}


</style>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Material Receive Details</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Material Receive Details
                            </div>
                            <div class="card-body" id="printableArea">
							<?php
				$sqld = "select * from `inv_receive` where `mrr_no`='$mrr_no'";
				$resultd = mysqli_query($conn, $sqld);
				$rowd = mysqli_fetch_array($resultd);
			?>
				<div class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-10">
						<div class="row">
							<div class="col-sm-6">	
								<p>
								<img src="assets/img/logo-wide.png" height="50px;"/>
								<h5>Saif Power Group </h5><span>Material Receive Details</span></p></div>
							<div class="col-sm-6">
								<table class="table table-bordered">
									<tr>
										<th>MRR No:</th>
										<td><?php echo $mrr_no; ?></td>
									</tr>
									<tr>
										<th>MRR Date:</th>
										<td><?php
										echo $rowd['mrr_date']; ?></td>
									</tr>
									<tr>
										<th>Store:</th>
										<td>
											<?php 
											$dataresult =   getDataRowByTableAndId('store', $rowd['warehouse_id']);
											echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
											?>
										</td>
									</tr>
									<tr>
										<th>Challan No:</th>
										<td>
											<?php
										echo $rowd['challanno']; ?>
										</td>
									</tr>
									<tr>
										<th>Supplier:</th>
										<td>
											<?php 
											$supplier_id = $rowd['supplier_id'];
											$sqlunit	=	"SELECT * FROM `suppliers` WHERE `code` = '$supplier_id' ";
											$resultunit = mysqli_query($conn, $sqlunit);
											$rowunit=mysqli_fetch_array($resultunit);
											echo $rowunit['name'];
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
									<th>Unit Price</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody id="material_receive_list_body">
								<?php
								$transfer_id=$_GET['no'];
								$sql = "select * from `inv_receivedetail` where `mrr_no`='$mrr_no'";
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
										$dataresult =   getDataRowByTableAndId('inv_item_unit', $row['unit_id']);
										echo (isset($dataresult) && !empty($dataresult) ? $dataresult->unit_name : '');
										?>
									</td>
									<td><?php echo $row['receive_qty'] ?></td>
									<td><?php echo $row['unit_price'] ?></td>
									<td><?php echo $row['total_receive'] ?></td>
								</tr>
								<?php } ?>
								<tr>
									<td colspan="3" class="grand_total">Grand Total:</td>
									<td>
										<?php 
										$sql2 			= "SELECT sum(receive_qty) FROM  `inv_receivedetail` where `mrr_no`='$mrr_no'";
										$result2 		= mysqli_query($conn, $sql2);
										for($i=0; $row2 = mysqli_fetch_array($result2); $i++){
										$totalReceived	=$row2['sum(receive_qty)'];
										echo $totalReceived ;
										}
										?>
									</td>
									<td></td>
									<td>
										<?php 
										$sql2			= "SELECT sum(total_receive) FROM  `inv_receivedetail` where `mrr_no`='$mrr_no'";
										$result2		= mysqli_query($conn, $sql2);
										for($i=0; $row2 = mysqli_fetch_array($result2); $i++){
										$totalAmount	= number_format((float)$row2['sum(total_receive)'], 2, '.', '');
										echo $totalAmount ;
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
						<b>Total Amount in words: 
							<span class="amountWords"><?php echo convertNumberToWords($totalAmount).' Only';?></span>
						</b> 
						<div class="row" style="text-align:center">
							<div class="col-sm-6"></br><?php 
										if($rowd['received_by']){
										$dataresult =   getDataRowByTableAndId('users', $rowd['received_by']);
										echo (isset($dataresult) && !empty($dataresult) ? $dataresult->first_name . ' ' .$dataresult->last_name : '');	
										}?></br>--------------------</br>Receiver Signature</div>
										
									
							
							<div class="col-sm-6"></br><?php 
										if($rowd['approved_by']){
										$dataresult =   getDataRowByTableAndId('users', $rowd['approved_by']);
										echo (isset($dataresult) && !empty($dataresult) ? $dataresult->first_name . ' ' .$dataresult->last_name : '');	
										}?></br>--------------------</br>Authorised Signature</div>
						</div></br>
						<div class="row">
							<div class="col-sm-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
								<h5>Notice***</br><span style="font-size:14px;color:#000000;">Please Check Everything Before Signature</span></h5>
								
							</div>
						</div>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>				
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