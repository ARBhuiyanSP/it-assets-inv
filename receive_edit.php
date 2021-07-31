<?php include('header.php');
if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $data = getReceiveDataDetailsById($edit_id);
    $receiveData = $data['receiveData'];
    $receiveDetailsData = $data['receiveDetailsData'];
} 


?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Receive Edit</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Receive Edit Form
                            </div>
                            <div class="card-body">
                                <!--here your code will go-->
								<div class="form-group">
									<form action="" method="post" name="update_receive" id="update_receive" enctype="multipart/form-data">
										<div class="row" id="div1" style="">
											<div class="col-xs-2">
												<div class="form-group">
													<label>MRR Date</label>
													<input type="text" autocomplete="off" name="mrr_date" id="mrr_date" class="form-control datepicker" value="<?php echo date('Y-m-d', strtotime($receiveData->mrr_date)); ?>">
												</div>
											</div>
											<div class="col-xs-2">
												<div class="form-group">
													<label>MRR No</label>
													<input type="text" name="mrr_no" id="mrr_no" class="form-control" readonly="readonly" value="<?php echo $receiveData->mrr_no; ?>">
													<input type="hidden" name="receive_no" id="receive_no" value="<?php echo $receiveData->mrr_no; ?>">
												</div>
											</div>
											<div class="col-xs-2">
												<div class="form-group">
													<label>Work Order ID</label>
													<input type="text" name="purchase_id" id="purchase_id" class="form-control" value="<?php echo (isset($receiveData->purchase_id) && !empty($receiveData->purchase_id) ? $receiveData->purchase_id : ''); ?>">
												</div>
											</div>
											<div class="col-xs-2">
												<div class="form-group">
													<label>Work Order Date</label>
													<input type="text" autocomplete="off" name="Purchase_date" id="Purchase_date" class="form-control datepicker" value="<?php echo (isset($receiveData->mrr_date) && !empty($receiveData->mrr_date) ? date('Y-m-d', strtotime($receiveData->mrr_date)) : ''); ?>">	
												</div>
											</div>
											<div class="col-xs-2">
												<div class="form-group">
													<label for="id">Supplier Challan No</label>
													<input type="text" name="challan_no" id="challan_no" class="form-control" value="<?php echo (isset($receiveData->challanno) && !empty($receiveData->challanno) ? $receiveData->challanno : ''); ?>">
												</div>
											</div>
											<div class="col-xs-2">
												<div class="form-group">
													<label for="id">Challan Date</label>
													<input type="text" autocomplete="off" name="challan_date" id="challan_date" class="form-control datepicker" value="<?php echo (isset($receiveData->challan_date) && !empty($receiveData->challan_date) ? $receiveData->challan_date : ''); ?>">
												</div>
											</div>
											<div class="col-xs-2">
												<div class="form-group">
													<label for="id">Requisition No.</label>
													<input type="text" name="requisition_no" id="requisition_no" class="form-control" value="<?php echo (isset($receiveData->requisitionno) && !empty($receiveData->requisitionno) ? $receiveData->requisitionno : ''); ?>">
												</div>
											</div>
											<div class="col-xs-2">
												<div class="form-group">
													<label for="id">Requisition Date</label>
													<input type="text" autocomplete="off" name="requisition_date" id="requisition_date" class="form-control datepicker" value="<?php echo (isset($receiveData->requisition_date) && !empty($receiveData->requisition_date) ? $receiveData->requisition_date : ''); ?>">
												</div>
											</div>
											<div class="col-xs-3">
												<div class="form-group">
													<label for="id">Vendor</label>
													<select class="form-control" id="vendor_name" name="vendor_name" required>
														<option value="">Select</option>
														<?php
														$projectsData = getTableDataByTableName('vendors');

														if (isset($projectsData) && !empty($projectsData)) {
															foreach ($projectsData as $data) {
																?>
																<option value="<?php echo $data['id']; ?>" <?php if (isset($receiveData->supplier_id) && $receiveData->supplier_id == $data['id']) {
															echo 'selected';
														} ?>><?php echo $data['vendor_name']; ?></option>
																<?php
															}
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-xs-2">
												<div class="form-group">
													<label>Store</label>
													
													<?php  
														$store_id = $receiveData->warehouse_id;
														$sqlstore	= "select * from `store` where `id`='$store_id'";
														$resultstore = mysqli_query($conn, $sqlstore);
														$rowstore=mysqli_fetch_array($resultstore);
													?>
													<input type="text" class="form-control" readonly="readonly" value="<?php echo $rowstore['name']; ?>">
													
													<input type="hidden" name="warehouse_id" id="warehouse_id" class="form-control" readonly="readonly" value="<?php echo $receiveData->warehouse_id; ?>">
													
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="id">Received By</label>
													<?php 
														$employee_id = $receiveData->received_by;
														$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
														$resultemployee = mysqli_query($conn, $sqlemployee);
														$rowemployee=mysqli_fetch_array($resultemployee);
													?>
													<input type="text" class="form-control" id="" value="<?php echo $rowemployee["employee_name"]; ?>" readonly required />
													<input name="received_by" type="hidden" id="received_by" value="<?php echo $receiveData->received_by; ?>" />
												</div>
											</div>
										</div>
										<div class="row" id="div1"  style="">
											<div class="table-responsive">
												<table class="table table-bordered" id="dynamic_field">
													<thead>
														<th width="45%">Material Name<span class="reqfield"> ***</span></th>
														<th width="10%">Material ID</th>
														<th width="10%">Unit</th>
														<!-- <th width="10%">Brand</th> -->
														<th width="10%">Qty<span class="reqfield"> ***</span></th>
														<th width="10%">Unit Price<span class="reqfield"> ***</span></th>
														<th width="10%">Total Amount</th>
														<th width="5%"></th>
													</thead>
													<tbody>
														<?php
														$productSerial = 0;
														if (isset($receiveDetailsData) && !empty($receiveDetailsData)) {
															foreach ($receiveDetailsData as $key => $editDatas) {
																$productSerial++;
																?>
																<tr id="row<?php echo $key; ?>">
																	<td>
																		<select class="form-control select2" id="material_name<?php echo $key; ?>" name="material_name[]" required onchange="getAppendItemCodeByParam('<?php echo $key; ?>', 'inv_material', 'material_id_code', 'material_id', 'unit_id');">
																			<option value="">Select</option>
																			<?php
																			$projectsData = get_product_with_category();
																			if (isset($projectsData) && !empty($projectsData)) {
																				foreach ($projectsData as $data) {
																					?>
																					<option value="<?php echo $data['id']; ?>"<?php if (isset($editDatas->material_id) && $editDatas->material_id == $data['item_code']) {
																		echo 'selected';
																	} ?>><?php echo $data['material_name']; ?></option>
																					<?php
																				}
																			}
																			?>
																		</select>
																	</td>
																	<td><input type="text" name="material_id[]" id="material_id<?php echo $key; ?>" class="form-control" value="<?php echo (isset($editDatas->material_id) && !empty($editDatas->material_id) ? $editDatas->material_id : ''); ?>"></td>
																	<td>
																		<select class="form-control" id="unit<?php echo $key; ?>" name="unit[]" required>
																			<option value="">Select</option>
																			<?php
																			$projectsData = getTableDataByTableName('inv_item_unit', '', 'unit_name');
																			if (isset($projectsData) && !empty($projectsData)) {
																				foreach ($projectsData as $data) {
																					?>
																					<option value="<?php echo $data['id']; ?>"<?php if (isset($editDatas->unit_id) && $editDatas->unit_id == $data['id']) {
																		echo 'selected';
																	} ?>><?php echo $data['unit_name']; ?></option>
									<?php
								}
							}
							?>
																		</select>
																	</td>
																	<!-- <td>
																		<select class="form-control material_select_2" id="brand0" name="brand[]">
																			<option value="">Select</option>
																			<?php
																			$brandData = getmaterialbrand();
																			if (isset($brandData) && !empty($brandData)) {
																				foreach ($brandData as $data) {
																					?>
																					<option value="<?php echo $data['id']; ?>"<?php if (isset($editDatas->brand_id) && $editDatas->brand_id == $data['id']) {
																		echo 'selected';
																	} ?>><?php echo $data['brand_name']; ?></option>
																					<?php
																				}
																			}
																			?>
																		</select>
																	</td> -->
																	
																	
																	
																	<td><input type="text" name="quantity[]" id="quantity<?php echo $key; ?>" onchange="sum(<?php echo $key; ?>)" class="form-control" value="<?php echo (isset($editDatas->receive_qty) && !empty($editDatas->receive_qty) ? $editDatas->receive_qty : ''); ?>"></td>
																	<td><input type="text" name="unit_price[]" id="unit_price<?php echo $key; ?>" onchange="sum(<?php echo $key; ?>)" class="form-control" value="<?php echo (isset($editDatas->unit_price) && !empty($editDatas->unit_price) ? $editDatas->unit_price : ''); ?>"></td>
																	<td><input type="text" name="totalamount[]" id="sum<?php echo $key; ?>" class="form-control" value="<?php echo (isset($editDatas->total_receive) && !empty($editDatas->total_receive) ? $editDatas->total_receive : ''); ?>"></td>
																<?php if ($key == 0) { ?>
																		<td><button type="button" name="add" id="add" class="btn" style="background-color:#2e3192;color:#ffffff;">+</button></td>
																<?php } else { ?>
																		<td><button type="button" name="remove" id="<?php echo $key; ?>" class="btn btn_remove" style="background-color:#f26522;color:#ffffff;">X</button></td>
																<?php } ?>
																</tr>
							<?php
						}//End of foreach
					} else {
						?>
															<tr>
																<td>
																	<select class="form-control select2" id="material_name" name="material_name[]" required onchange="getItemCodeByParam(this.value, 'inv_material', 'material_id_code', 'material_id0', 'qty_unit');">
																		<option value="">Select</option>
																		<?php
																		$projectsData = get_product_with_category();
																		if (isset($projectsData) && !empty($projectsData)) {
																			foreach ($projectsData as $data) {
																				?>
																				<option value="<?php echo $data['id']; ?>"><?php echo $data['material_name']; ?></option>
								<?php
							}
						}
						?>
																	</select>
																</td>
																<td><input type="text" name="material_id[]" id="material_id0" class="form-control"></td>
																<td>
																	<!--<input type="text" name="unit[]" id="unit0" class="form-control">-->
																	<select class="form-control" id="unit0" name="unit[]" required>
																		<option value="">Select</option>
																		<?php
																		$projectsData = getTableDataByTableName('inv_item_unit', '', 'unit_name');
																		if (isset($projectsData) && !empty($projectsData)) {
																			foreach ($projectsData as $data) {
																				?>
																				<option value="<?php echo $data['id']; ?>"><?php echo $data['unit_name']; ?></option>
								<?php
							}
						}
						?>
																	</select>
																</td>
																<!-- <td><select class="form-control material_select_2" id="brand0" name="brand[]">
																			<option value="">Select</option>
																			<?php
																			$brandData = getmaterialbrand();
																			if (isset($brandData) && !empty($brandData)) {
																				foreach ($brandData as $data) {
																					?>
																					<option value="<?php echo $data['id']; ?>"><?php echo $data['brand_name']; ?></option>
																					<?php
																				}
																			}
																			?>
																		</select></td> -->
																
																
																
																
																<td><input type="text" name="quantity[]" id="quantity0" onchange="sum(0)" class="form-control"></td>
																<td><input type="text" name="unit_price[]" id="unit_price0" onchange="sum(0)" class="form-control"></td>
																<td><input type="text" name="totalamount[]" id="sum0" class="form-control"></td>
																<td><button type="button" name="add" id="add" class="btn" style="background-color:#2e3192;color:#ffffff;">+</button></td>
															</tr>
					<?php } ?>
													</tbody>
												</table>
												<table class="table table-bordered">
													<tr>
														
														<td width="80%" style="text-align:right;">Total Amount</td>
														<td><input type="text" class="form-control" maxlength="30" name="sub_total_amount" id="allsum" readonly /></td>
													</tr>
												</table>
											</div>
										</div>
										<div class="row" style="">
											<div class="col-xs-3">
												<div class="form-group">
													<input type="hidden" name="sn_old_image" value="<?php if (isset($receiveData->mrr_image)) {
						echo $receiveData->mrr_image;
					} ?>"  /> 
													<input type="file" accept="image/*" name="sn_prt_image" onchange="loadFile(event)">
													<p style="color:red;">*** Select an image file like .jpg or .png</p>
													<script>
													  var loadFile = function(event) {
														var output = document.getElementById('output');
														output.src = URL.createObjectURL(event.target.files[0]);
														output.onload = function() {
														  URL.revokeObjectURL(output.src) // free memory
														}
													  };
													  
													</script>
												</div>
											</div>
											
											<div class="col-xs-6">
												<div style="border:1px solid gray;height:150px;width:150px;">
													<img id="output" <?php if ($receiveData->mrr_image){ ?> src="images/<?php echo $receiveData->mrr_image; ?>" <?php } ?> height="150px" width="150px"/>
												</div>
											</div>
										</div>
										<div class="row" style="">
										   
											<div class="col-xs-12">
												<div class="form-group">
													<label>Remarks</label>
													<textarea id="remarks" name="remarks" class="form-control"><?php if (isset($receiveData->remarks)) {
						echo $receiveData->remarks;
					} ?></textarea>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group">
													<div class="modal-footer">
														<input type="hidden" name="edit_id" value="<?php echo $receiveData->id; ?>">
														<input type="submit" name="receive_update_submit" id="submit" class="btn btn-block" style="background-color:#f26522;color:#ffffff;" value="Update" />
													</div>    
												</div>
											</div>
										</div>
									</form>
								</div>
								<!--here your code will go-->
                            </div>
                        </div>
                    </div>
                </main>
				<script>
    var i = <?php echo $productSerial; ?>;
    $(document).ready(function () {
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><select class="form-control select2" id="material_name' + i + '" name="material_name[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'" + ",'material_id_code'" + ",'material_id'," + "'qty_unit'" + ')"><option value="">Select</option><?php
$projectsData = get_product_with_category();
if (isset($projectsData) && !empty($projectsData)) {
    foreach ($projectsData as $data) {
        ?><option value="<?php echo $data['id']; ?>"><?php echo $data['material_name']; ?></option><?php }
}
?></select></td><td><input type="text" name="material_id[]" id="material_id' + i + '" class="form-control"></td><td><select class="form-control select2" id="unit' + i + '" name="unit[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'" + ",'material_id_code'" + ",'material_id''" + ",'qty_unit'" + ')"><option value="">Select</option><?php
$projectsData = getTableDataByTableName('inv_item_unit', '', 'unit_name');
if (isset($projectsData) && !empty($projectsData)) {
    foreach ($projectsData as $data) {
        ?><option value="<?php echo $data['id']; ?>"><?php echo $data['unit_name']; ?></option><?php }
}
?></select></td><td><input type="text" name="quantity[]" id="quantity' + i + '" onchange="sum(0)" class="form-control"></td><td><input type="text" name="unit_price[]" id="unit_price' + i + '" onchange="sum(0)" class="form-control"></td><td><input type="text" name="totalamount[]" id="sum' + i + '" class="form-control"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn_remove" style="background-color:#f26522;color:#ffffff;">X</button></td></tr>');
            $('#quantity' + i + ', #unit_price' + i).change(function () {
                sum(i)
            });
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            sum_total();
        });

        $('#submit').click(function () {
            $.ajax({
                url: "name.php",
                method: "POST",
                data: $('#add_name').serialize(),
                success: function (data)
                {
                    alert(data);
                    $('#add_name')[0].reset();
                }
            });
        });

    });

    $(document).ready(function () {
        //this calculates values automatically 
        sum(0);
    });

    function sum(i) {
        var quantity1 = document.getElementById('quantity' + i).value;
        var unit_price1 = document.getElementById('unit_price' + i).value;
        var result = parseFloat(quantity1) * parseFloat(unit_price1);
        if (!isNaN(result)) {
            document.getElementById('sum' + i).value = result;
        }
        sum_total();
    }
    function sum_total() {
        var newTot = 0;
        for (var a = 0; a <= i; a++) {
            aVal = $('#sum' + a);
            if (aVal && aVal.length) {
                newTot += aVal[0].value ? parseFloat(aVal[0].value) : 0;
            }
        }
        document.getElementById('allsum').value = newTot.toFixed(2);
    }
</script>
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
<script>
    $(function () {
        $("#challan_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>
<script>
    $(function () {
        $("#requisition_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>
                <?php include('footer.php'); ?>