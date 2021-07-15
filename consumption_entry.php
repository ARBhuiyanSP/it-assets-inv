<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->                        
						<ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Consumption</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Consumption Entry Form
                            </div>
                            <div class="card-body">
								<!--here your code will go-->
								<div class="form-group">
									<form action="" method="post" name="add_issue" id="issue_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('issue_entry_form');">
										<div class="row" id="div1" style="">
											<div class="col-xs-3">
												<div class="form-group">
													<label>Consumption Date</label>
													<input type="text" autocomplete="off" name="consumption_date" id="issue_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
												</div>
											</div>
											<div class="col-xs-3">
												<div class="form-group">
													<label>Consumption No</label>
													<?php
													
													$store_id	=	$_SESSION['logged']['store_id'];
													$sql	=	"SELECT * FROM store WHERE `id`='$store_id'";
													$result = mysqli_query($conn, $sql);
													$row=mysqli_fetch_array($result);
													$short_name = $row['keyword'];
													$consumptionCode= 'CSM-'.$short_name;
													?>
													<input type="text" name="consumption_id" id="consumption_id" class="form-control" value="<?php echo getDefaultCategoryCodeByWarehouse('inv_consumption', 'consumption_id', '03d', '001', $consumptionCode) ?>" readonly>
													<input type="hidden" name="issue_no" id="issue_no" value="<?php echo getDefaultCategoryCodeByWarehouse('inv_consumption', 'consumption_id', '03d', '001', $consumptionCode) ?>">
												</div>
											</div>
											<div class="col-xs-3">
												<div class="form-group">
													<label>Store </label>

													<?php  
														$store_id = $_SESSION['logged']['store_id'];
														$sqlstore	= "select * from `store` where `id`='$store_id'";
														$resultstore = mysqli_query($conn, $sqlstore);
														$rowstore=mysqli_fetch_array($resultstore);
													?>
													<input type="text" class="form-control" readonly="readonly" value="<?php echo $rowstore['name']; ?>">

													<input type="hidden" name="warehouse_id" id="warehouse_id" class="form-control" readonly="readonly" value="<?php echo $_SESSION["store_id"]; ?>">

												</div>

												<!-- <div class="form-group">
						<label>Warehouse</label>
														
												<?php
												if ($_SESSION['logged']['user_type'] == 'whm') {
													$warehouse_id = $_SESSION['logged']['warehouse_id'];
													$dataresult = getDataRowByTableAndId('inv_warehosueinfo', $warehouse_id);
													?>
															<input type="text" class="form-control" readonly="readonly" value="<?php echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : ''); ?>">
															
															<input type="hidden" name="warehouse_id" id="warehouse_id" class="form-control" readonly="readonly" value="<?php echo $_SESSION['logged']['warehouse_id']; ?>">
					<?php } else { ?>
															<select class="form-control" id="warehouse_id" name="warehouse_id" required>
								<option value="">Select</option>
													<?php
													$projectsData = getTableDataByTableName('inv_warehosueinfo');
													;
													if (isset($projectsData) && !empty($projectsData)) {
														foreach ($projectsData as $data) {
															?>
												<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
															<?php
														}
													}
													?>
							</select>
					<?php } ?>
					</div> -->
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="id">Consumption By</label>
													<?php 
														$employee_id = $_SESSION['logged']['employee_id'];
														$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
														$resultemployee = mysqli_query($conn, $sqlemployee);
														$rowemployee=mysqli_fetch_array($resultemployee);
													?>
													<input type="text" class="form-control" id="" value="<?php echo $rowemployee["employee_name"]; ?>" readonly required />
													<input name="consumption_by" type="hidden" id="consumption_by" value="<?php echo $rowemployee["employee_id"]; ?>" />
												</div>
											</div>


											<!------------test-------------
											<div class="form-group">
						<label class="control-label col-sm-5" for="parent_code">Package:</label>
						<div class="col-sm-7">
							<select class="form-control" id="main_item_id" name="parent_item_id" onchange="getBuildingByPackage(this.value);">
								<option value="">Select</option>
											<?php
											$parentCats = getTableDataByTableName('packages', '', 'name');
											if (isset($parentCats) && !empty($parentCats)) {
												foreach ($parentCats as $pcat) {
													?>
												<option value="<?php echo $pcat['id'] ?>"><?php echo $pcat['name'] ?></option>
												<?php }
											}
											?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-5" for="parent_code">Building:</label>
						<div class="col-sm-7">
							<select class="form-control" id="building_id" name="sub_item_id">
								<option value="">Select</option>
											<?php
											$parentCats = getTableDataByTableName('buildings', '', 'building_id');
											if (isset($parentCats) && !empty($parentCats)) {
												foreach ($parentCats as $pcat) {
													?>
												<option value="<?php echo $pcat['id'] ?>"><?php echo $pcat['building_id'] ?></option>
						<?php }
					}
					?>
							</select>
						</div>
					</div>
											------------test------------->



										</div>
										<div class="row" id="div1"  style="padding-top:10px">
											<div class="table-responsive">
												<table class="table table-bordered" id="dynamic_field">
													<thead>
													<th width="30%">Material Name<span class="reqfield"> ***required</span></th>
													<th width="10%">Material ID</th>
													<th width="10%">Unit</th>
													<th width="10%">Brand</th>
													<th width="10%">In Stock</th>
													<th width="10%">Qty<span class="reqfield"> ***required</span></th>
													<th width="15%">Site</th>
													<th width="5%"></th>
													</thead>
													<tbody>
														<tr>
															<td>
																<select class="form-control" id="material_name" name="material_name[]" required onchange="getItemCodeByParam(this.value, 'inv_material', 'material_id_code', 'material_id0', 'qty_unit');">
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
															<td><input type="text" name="material_id[]" id="material_id0" class="form-control" required readonly></td>
															<td>
																<select class="form-control" id="unit0" name="unit[]" required readonly>
																	<option value="">Select Unit</option>
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
															<td>
																<select class="form-control" id="brand0" name="brand[]" readonly>
																	<option value="">Select Brand</option>
																	<?php
																	$brandData = getmaterialbrand();
																	if (isset($brandData) && !empty($brandData)) {
																		foreach ($brandData as $data) {
																			?>
																			<option value="<?php echo $data['brand_name']; ?>"><?php echo $data['brand_name']; ?></option>
																			<?php
																		}
																	}
																	?>
																</select>
															</td>
															<td><input type="text" name="material_total_stock[]" id="material_total_stock0" class="form-control" readonly ></td>
															<td><input type="text" name="quantity[]" id="quantity0" onchange="sum(0)" onkeyup="check_stock_quantity_validation(0)" class="form-control common_issue_quantity" required></td>
															<td>
																<?php
																	if ($_SESSION['logged']['user_type'] == 'whm') {
																	$warehouse_id = $_SESSION['logged']['warehouse_id'];
																	$dataresult = getDataRowByTableAndId('inv_warehosueinfo', $warehouse_id);
																	?>
																	<input type="text" class="form-control" readonly="readonly" value="<?php echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : ''); ?>">
																	<input type="hidden" name="site_id[]" id="site_id0" class="form-control" readonly="readonly" value="<?php echo $_SESSION['logged']['warehouse_id']; ?>">
																<?php } else { ?>
																<select class="form-control" id="site_id0" name="site_id[]" required>
																	<option value="">Select</option>
																	<?php
																	$projectsData = getTableDataByTableName('inv_warehosueinfo');

																	if (isset($projectsData) && !empty($projectsData)) {
																		foreach ($projectsData as $data) {
																			?>
																			<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
																			<?php
																		}
																	}
																	?>
																</select>
																<?php } ?>
															</td>
															<td><button type="button" name="add" id="add" class="btn" style="background-color:#198754;color:#ffffff;">+</button></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="row" style="">
											<div class="col-xs-12">
												<div class="form-group">
													<label>Remarks</label>
													<textarea id="remarks" name="remarks" class="form-control"></textarea>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group">
													<div class="modal-footer">
														<input type="submit" name="consumption_submit" id="consumption_submit" class="btn btn-block" style="background-color:#198754;color:#ffffff;width:100%;" value="Save" />
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
    var i = 0;
    $(document).ready(function () {
        $('#add').click(function () {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '"><td><select class="form-control select2" id="material_name' + i + '" name="material_name[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'," + "'material_id_code'," + "'material_id'," + "'qty_unit'" + ')"><option value="">Select</option><?php
                                    $projectsData = get_product_with_category();
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?><option value="<?php echo $data['id']; ?>"><?php echo $data['material_name']; ?></option><?php
                                        }
                                    }
                                    ?></select></td><td><input type="text" name="material_id[]" id="material_id' + i + '" class="form-control" required readonly></td><td><select class="form-control select2" id="unit' + i + '" name="unit[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'" + ",'material_id_code'" + ",'material_id''" + ",'qty_unit'" + ')"><option value="">Select</option><?php
                                    $projectsData = getTableDataByTableName('inv_item_unit', '', 'unit_name');
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?><option value="<?php echo $data['id']; ?>"><?php echo $data['unit_name']; ?></option><?php
                                        }
                                    }
                                    ?></select></td><td><select class="form-control select2" id="brand' + i + '" name="brand[]' + i + '"><option value="">Select</option><?php
                                    $projectsData = getmaterialbrand();
                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?><option value="<?php echo $data['brand_name']; ?>"><?php echo $data['brand_name']; ?></option><?php
                                        }
                                    }
                                    ?></select></td><td><input type="text" name="material_total_stock[]" id="material_total_stock' + i + '" class="form-control" readonly></td><td><input type="text" name="quantity[]" id="quantity' + i + '" onchange="sum(0)"  onkeyup="check_stock_quantity_validation(' + i + ')" class="form-control common_issue_quantity" required></td><td><?php if ($_SESSION['logged']['user_type'] == 'whm') {$warehouse_id = $_SESSION['logged']['warehouse_id'];$dataresult = getDataRowByTableAndId('inv_warehosueinfo', $warehouse_id); ?><input type="text" class="form-control" readonly="readonly" value="<?php echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : ''); ?>"><input type="hidden" name="site_id[]" id="site_id' + i + '" class="form-control" readonly="readonly" value="<?php echo $_SESSION['logged']['warehouse_id']; ?>"><?php } else { ?> <select class="form-control" id="site_id' + i + '" name="site_id[]" required><option value="">Select</option><?php $projectsData = getTableDataByTableName('inv_warehosueinfo');if (isset($projectsData) && !empty($projectsData)) { foreach ($projectsData as $data) { ?><option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option><?php } } ?></select><?php } ?></td><td><button type="button" name="remove" id="' + i + '" class="btn btn_remove" style="background-color:#AF4940;color:#ffffff;">X</button></td></tr>');
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
</script>
<script>
    $(function () {
        $("#issue_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>
<script>
    $('input[type="submit"]').prop("disabled", false);
    var a = 0;
//binds to onchange event of your input field
    $('#picture').bind('change', function () {
        if ($('input:submit').attr('disabled', false)) {
            $('input:submit').attr('disabled', true);
        }
        var ext = $('#picture').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            $('#error1').slideDown("slow");
            $('#error2').slideUp("slow");
            a = 0;
        } else {
            var picsize = (this.files[0].size);
            if (picsize > 500000) {
                $('#error2').slideDown("slow");
                a = 0;
            } else {
                a = 1;
                $('#error2').slideUp("slow");
            }
            $('#error1').slideUp("slow");
            if (a == 1) {
                $('input:submit').attr('disabled', false);
            }
        }
    });

</script>
                <?php include('footer.php'); ?>