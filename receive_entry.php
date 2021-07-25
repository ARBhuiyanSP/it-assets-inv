<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Receive Entry</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Receive Entry Form
                            </div>
                            <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
                    <div class="row" id="div1" style="">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>MRR Date</label>
                                <input type="text" autocomplete="off" name="mrr_date" id="mrr_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>MRR No</label>
								<?php 
									$store_id	=	$_SESSION['logged']['store_id'];
									$sql	=	"SELECT * FROM store WHERE `id`='$store_id'";
									$result = mysqli_query($conn, $sql);
									$row=mysqli_fetch_array($result);
									$short_name = $row['keyword'];
									$mrrcode= 'MRR-'.$short_name;
								?>
                                <input type="text" name="mrr_no" id="mrr_no" class="form-control" value="<?php echo getDefaultCategoryCodeByWarehouse('inv_receive', 'mrr_no', '03d', '001', $mrrcode) ?>" readonly>
                                <input type="hidden" name="receive_no" id="receive_no" value="<?php echo getDefaultCategoryCodeByWarehouse('inv_receive', 'mrr_no', '03d', '001', $mrrcode) ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Work Order ID</label>
                                <input type="text" name="purchase_id" id="purchase_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Work Order Date</label>
                                <input type="text" autocomplete="off" name="Purchase_date" id="Purchase_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">	
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Supplier Challan No</label>
                                <input type="text" name="challan_no" id="challan_no" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Challan Date</label>
                                <input type="text" autocomplete="off" name="challan_date" id="challan_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Requisition No.</label>
                                <input type="text" name="requisition_no" id="requisition_no" class="form-control">
								<!-- <input type="text" id="requisition_no" name="requisition_no" class="form-control" onkeypress="return event.charCode > 47 && event.charCode < 58;" pattern="[0-9]{5}" required></input> -->
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Requisition Date</label>
                                <input type="text" autocomplete="off" name="requisition_date" id="requisition_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id">Vendor</label><span class="reqfield"> ***required</span>
                                <select class="form-control" id="vendor_name" name="vendor_name" required >
                                    <option value="">Select</option>
                                    <?php
                                    $projectsData = getTableDataByTableName('vendors');

                                    if (isset($projectsData) && !empty($projectsData)) {
                                        foreach ($projectsData as $data) {
                                            ?>
                                            <option value="<?php echo $data['id']; ?>"><?php echo $data['vendor_name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
						<div class="col-md-2">
                            <div class="form-group">
                                <label>Store</label>
								
								<?php  
									$store_id = $_SESSION['logged']['store_id'];
									$sqlstore	= "select * from `store` where `id`='$store_id'";
									$resultstore = mysqli_query($conn, $sqlstore);
									$rowstore=mysqli_fetch_array($resultstore);
								?>
								<input type="text" class="form-control" readonly="readonly" value="<?php echo $rowstore['name']; ?>">
								
								<input type="hidden" name="warehouse_id" id="warehouse_id" class="form-control" readonly="readonly" value="<?php echo $_SESSION['logged']['store_id']; ?>">
								
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id">Received By</label>
								<?php 
									$employee_id = $_SESSION['logged']['employee_id'];
									$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
									$resultemployee = mysqli_query($conn, $sqlemployee);
									$rowemployee=mysqli_fetch_array($resultemployee);
								?>
                                <input type="text" class="form-control" id="" value="<?php echo $rowemployee["employee_name"]; ?>" readonly required />
                                <input name="received_by" type="hidden" id="received_by" value="<?php echo $rowemployee["employee_id"]; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row" id="div1"  style="padding-top:10px">
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
                                    <tr>
                                        <td>
                                            <select class="form-control material_select_2" id="material_name" name="material_name[]" required onchange="getItemCodeByParam(this.value, 'inv_material', 'material_id_code', 'material_id0', 'qty_unit');">
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
                                        <!-- <td>
                                            <select class="form-control material_select_2" id="brand0" name="brand[]">
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
                                            </select>
                                        </td> -->
                                        <td><input type="text" name="quantity[]" id="quantity0" onchange="sum(0)" class="form-control" required></td>
                                        <td><input type="text" name="unit_price[]" id="unit_price0" onchange="sum(0)" class="form-control" required></td>
                                        <td><input type="text" name="totalamount[]" id="sum0" class="form-control"></td>
                                        <td><button type="button" name="add" id="add" class="btn" style="background-color:#198754;color:#ffffff;">+</button></td>
                                    </tr>
                                </tbody>
                            </table>
							<table class="table table-bordered">
								<tr>
									<td width="" style="">VAT Challan No<span class="reqfield"> ***required</span></td>
									<td><input type="text" class="form-control" maxlength="30" name="vat_challan_no" required /></td>
									<td width="" style="text-align:right;">Total Amount</td>
									<td><input type="text" class="form-control" maxlength="30" name="sub_total_amount" id="allsum" readonly /></td>
								</tr>
							</table>
                        </div>
                    </div>
					<div class="row" style="">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <input type="file" accept="image/*"  name="file" id="picture">
								<p id="error1" style="display:none; color:#FF0000;">
								Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
								</p>
								<p id="error2" style="display:none; color:#FF0000;">
								Maximum File Size Limit is 500KB.
								</p>
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
						<!-- <div class="col-xs-6">
                            <div style="border:1px solid gray;height:150px;width:150px;">
								<img id="output" height="150px" width="150px"/>
                            </div>
                        </div> -->
                    </div>
                    <div class="row" style="">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea id="remarks" name="remarks" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-top:10px">
                            <div class="form-group">
                                 <input type="submit" name="receive_submit" id="submit" class="btn btn-block" style="background-color:#198754;color:#ffffff;width:100%" value="Save" />   
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
            $('#dynamic_field').append('<tr id="row' + i + '"><td><select class="form-control material_select_2" id="material_name' + i + '" name="material_name[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'," + "'material_id_code'," + "'material_id'," + "'qty_unit'" + ')"><option value="">Select</option><?php
                                                $projectsData = get_product_with_category();
                                                if (isset($projectsData) && !empty($projectsData)) {
                                                    foreach ($projectsData as $data) {
                                                        ?><option value="<?php echo $data['id']; ?>"><?php echo $data['material_name']; ?></option><?php }
                                                }
                                                ?></select></td><td><input type="text" name="material_id[]" id="material_id' + i + '" class="form-control" required readonly></td><td><select class="form-control select2" id="unit' + i + '" name="unit[]' + i + '" required onchange="getAppendItemCodeByParam(' + i + ",'inv_material'" + ",'material_id_code'" + ",'material_id''" + ",'qty_unit'" + ')" readonly><option value="">Select</option><?php
                                                $projectsData = getTableDataByTableName('inv_item_unit', '', 'unit_name');
                                                if (isset($projectsData) && !empty($projectsData)) {
                                                    foreach ($projectsData as $data) {
                                                        ?><option value="<?php echo $data['id']; ?>"><?php echo $data['unit_name']; ?></option><?php }
                                                }
                                                ?></select></td><td><input type="text" name="quantity[]" id="quantity' + i + '" onchange="sum(0)" class="form-control" required></td><td><input type="text" name="unit_price[]" id="unit_price' + i + '" onchange="sum(0)" class="form-control" required></td><td><input type="text" name="totalamount[]" id="sum' + i + '" class="form-control"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn_remove" style="background-color:#AF4940;color:#ffffff;">X</button></td></tr>');
												$(".material_select_2").select2();
            $('#quantity' + i + ', #unit_price' + i).change(function () {
                sum(i)
            });
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
            sum_total();
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
<script>
$('input[type="submit"]').prop("disabled", false);
var a=0;
//binds to onchange event of your input field
$('#picture').bind('change', function() {
if ($('input:submit').attr('disabled',false)){
 $('input:submit').attr('disabled',true);
 }
var ext = $('#picture').val().split('.').pop().toLowerCase();
if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
 $('#error1').slideDown("slow");
 $('#error2').slideUp("slow");
 a=0;
 }else{
 var picsize = (this.files[0].size);
 if (picsize > 500000){
 $('#error2').slideDown("slow");
 a=0;
 }else{
 a=1;
 $('#error2').slideUp("slow");
 }
 $('#error1').slideUp("slow");
 if (a==1){
 $('input:submit').attr('disabled',false);
 }
}
});
</script>
                <?php include('footer.php'); ?>