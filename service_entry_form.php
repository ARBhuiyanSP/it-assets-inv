<div class="row">
	<div class="col-md-12" id="printableArea">
		<div class="row">
			<div class="col-sm-12">	
									<?php
				$sql	=	"select * from ams_products where id=$id";
				$result = mysqli_query($conn, $sql);
				$row=mysqli_fetch_array($result);
				?>
				<table class="table table-bordered">
					<tr>
						<th>Product Photo:</th>
						<td><img src="products_photo/<?php echo $row['pro_photo'] ?>" height="150" /></td>
					</tr>
					<tr>
						<th>Item Name:</th>
						<td><?php echo $row['item_name'] ?></td>
					</tr>
					<tr>
						<th>Item Description:</th>
						<td><?php echo $row['assets_description'] ?></td>
					</tr>
					<tr>
						<th>Brand:</th>
						<td><?php echo $row['brand'] ?></td>
					</tr>
					<tr>
						<th>Model:</th>
						<td><?php echo $row['model'] ?></td>
					</tr>
					<tr>
						<th>Manufacturing SL No:</th>
						<td><?php echo $row['manu_sl'] ?></td>
					</tr>
					<tr>
						<th>Description:</th>
						<td><?php echo $row['assets_description'] ?></td>
					</tr>
					<tr>
						<th>RLP No:</th>
						<td><?php echo $row['rlp_no'] ?></td>
					</tr>
					<tr>
						<th>Country Origin:</th>
						<td><?php echo $row['origin'] ?></td>
					</tr>
					<tr>
						<th>Vendor Name:</th>
							<?php 
								$vendor_id = $row['vendor_name'];
								$sqlvendor	= "select * from `vendors` where `vendor_id`='$vendor_id'";
								$resultvendor = mysqli_query($conn, $sqlvendor);
								$rowvendor=mysqli_fetch_array($resultvendor);
							?>
						<td><?php echo $rowvendor['vendor_name']; ?></td>
					</tr>
					<tr>
						<th>Purchase Date:</th>
						<td><?php echo $row['puchase_date']; ?></td>
					</tr>
					<tr>
						<th>Warranty:</th>
						<?php 
							$today = time(); // or your date as well
							//$puchase_date = strtotime($row['puchase_date']);
							$warranty	=	$row['warrenty'];
							$newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($row['puchase_date'])) . " + ".$warranty));
							$datediff = strtotime($newEndingDate) - $today;
							$daysdiff	=	round($datediff / (60 * 60 * 24));
							
							if($daysdiff > 0){
								$remain_days	=	round($datediff / (60 * 60 * 24)).'  Days Remaining';
							}else{
								$remain_days	=	' None';
							}

							
						?>
						<td><?php if ($warranty!=""){echo $warranty.' || Warranty end at : '.$newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($row['puchase_date'])) . " + ".$warranty)).' || Warranty Status : '.$remain_days;}else{ echo $remain_days;} 
						
						
						?>
						
						
						</td>
						
					</tr>
					<tr>
						<th>Custody: </th>
						<td><?php echo $row['custody']; ?></td>
					</tr>
					<tr>
						<th>User:</th>
							<?php if($row['assign_status']=='assigned'){ 
							$products_id	=	$row['id'];
								$sqlassign	= "select * FROM `product_assign` WHERE `product_id`='$products_id' ORDER BY `id` DESC LIMIT 1 ";
								$resultassign = mysqli_query($conn, $sqlassign);
								$rowassign=mysqli_fetch_array($resultassign);
								
									$employee_id = $rowassign['employee_id'];
									$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
									$resultemployee = mysqli_query($conn, $sqlemployee);
									$rowemployee=mysqli_fetch_array($resultemployee);
							?>
						<td><?php echo $rowassign['employee_id']; ?> || <?php echo $rowemployee["employee_name"]; ?> || <?php echo $rowemployee["division"]; ?>-<?php echo $rowemployee["department"]; ?></td>
							<?php }else{ ?>
						<td>---</td>
						<?php } ?>
					</tr>
				</table>
				<form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
					<div class="row" id="div1" style="">
						<div class="col-md-2">
							<div class="form-group">
								<label>Date</label>
								<input type="text" autocomplete="off" name="handover_date" id="mrr_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>SRV SL No</label>
								<?php 
									$store_id	=	$_SESSION['logged']['store_id'];
									$sql	=	"SELECT * FROM store WHERE `id`='$store_id'";
									$result = mysqli_query($conn, $sql);
									$rows=mysqli_fetch_array($result);
									$short_name = $rows['keyword'];
									$mrrcode= 'SRV-'.$short_name;
								?>
								<input type="text" name="" id="" class="form-control" value="<?php echo getDefaultCategoryCodeByStore('inv_services', 'srv_no', '03d', '001', $mrrcode) ?>" readonly>
								<input type="hidden" name="srv_no" id="srv_no" value="<?php echo getDefaultCategoryCodeByStore('inv_services', 'srv_no', '03d', '001', $mrrcode) ?>">
							</div>
						</div>
						
						<input type="hidden" autocomplete="off" name="assets_id" id="assets_id" class="form-control datepicker" value="<?php echo $row['id'] ?>">
						
						<input type="hidden" autocomplete="off" name="assets_slno" id="assets_slno" class="form-control datepicker" value="<?php echo $row['sl_no'] ?>">
						
						<input type="hidden" autocomplete="off" name="warranty" id="warranty" class="form-control datepicker" value="<?php if ($warranty!=""){echo $warranty.' Year || Warranty end at : '.$newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($row['puchase_date'])) . " + ".$warranty." year")).' || Warranty Status : '.$remain_days;}else{ echo $remain_days;}?>">
						
						<div class="col-md-4">
                            <div class="form-group">
                                <label>Vendor Name</label>
                                <select id="vendor" name="vendor" class="form-control material_select_2" required >
									<option value="">Select Vendor</option>
									<?php 
									$sql	= "select * from vendors ORDER BY vendor_id ASC";
									$result = mysqli_query($conn, $sql);
									while($row=mysqli_fetch_array($result))
										{
									?>
									<option value="<?php echo $row['vendor_id'] ?>"<?php if ($rowvendor['vendor_id'] == $row['vendor_id']) {
                                        echo 'selected';
                                    } ?> ><?php echo $row['vendor_name'] ?></option>
									<?php } ?>
								</select>
                            </div>
                        </div>
                        
						<input name="store_id" class="form-control" type="hidden" id="store_id" value="<?php echo $store_id = $_SESSION['logged']['store_id']; ?>" />
						
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">Handover By</label>
								<?php 
									$employee_id = $_SESSION['logged']['employee_id'];
									$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
									$resultemployee = mysqli_query($conn, $sqlemployee);
									$rowemployee=mysqli_fetch_array($resultemployee);
								?>
                                <input type="text" class="form-control" id="" value="<?php echo $rowemployee["employee_name"]; ?>" readonly required />
                                <input name="handover_by" type="hidden" id="handover_by" value="<?php echo $rowemployee["employee_id"]; ?>" />
                            </div>
                        </div>
					</div>
                    <div class="row" style="">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea id="ho_remarks" name="ho_remarks" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-top:10px">
                            <div class="form-group">
                                 <input type="submit" name="service_submit" id="submit" class="btn btn-block" style="background-color:#198754;color:#ffffff;width:100%" value="Save" />   
                            </div>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>			
</div>
<script>
$(function () {
	$("#mrr_date").datepicker({
		inline: true,
		dateFormat: "yy-mm-dd",
		yearRange: "-50:+10",
		changeYear: true,
		changeMonth: true
	});
});
</script>
								