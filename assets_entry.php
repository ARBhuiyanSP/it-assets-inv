<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Assets Entry</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Assets Entry Form
                            </div>
                            <div class="card-body">
            <!--here your code will go-->
            <div class="form-group">
                <form action="" method="post" name="add_name" id="receive_entry_form" enctype="multipart/form-data" onsubmit="showFormIsProcessing('receive_entry_form');">
                    <div class="row" id="div1" style="">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>SL No</label>
								<?php 
									$store_id	=	$_SESSION['logged']['store_id'];
									$sql	=	"SELECT * FROM store WHERE `id`='$store_id'";
									$result = mysqli_query($conn, $sql);
									$row=mysqli_fetch_array($result);
									$short_name = $row['keyword'];
									$mrrcode= $short_name.'-';
								?>
                                <input type="text" name="sl_no" id="sl_no" class="form-control" value="<?php echo getDefaultCategoryCodeByStore('ams_products', 'sl_no', '03d', '001', $mrrcode) ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Store</label>
                                <?php 
									$store_id = $_SESSION["store_id"];
									$sqlstore	= "select * from `store` where `id`='$store_id'";
									$resultstore = mysqli_query($conn, $sqlstore);
									$rowstore=mysqli_fetch_array($resultstore);
								?>
								<input name="" type="text" class="form-control" id="laptop" value="<?php echo $rowstore['name']; ?>" size="30" required readonly />
								<input name="store_id" type="hidden" value="<?php echo $_SESSION["store_id"]; ?>" />
                            </div>
                        </div>
						
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Category</label>
                                <select id="ac" name="assets_category" class="form-control material_select_2" required >
									<option value="">Select</option>
									<?php 
									$sql	= "select * from assets_categories ORDER BY assets_id ASC";
									$result = mysqli_query($conn, $sql);
									while($row=mysqli_fetch_array($result))
										{
									?>
									<option value="<?php echo $row['assets_id'] ?>"><?php echo $row['assets_category'] ?></option>
									<?php } ?>
								</select>
                            </div>
                        </div>
						
						<!-- <div class="col-md-2">
                            <div class="form-group">
                                <label>Type</label>
                                <select id="assets_type" name="assets_type" class="form-control material_select_2" required >
									<option>Select</option>
									<option value="Official">Official</option>
									<option value="Business">Business</option>
								</select>
                            </div>
                        </div> -->
						
						<div class="col-md-3">
                            <div class="form-group">
                                <label>Vendor Name</label>
                                <select id="vendor_name" name="vendor_name" class="form-control material_select_2" required >
									<option value="">Select Vendor</option>
									<?php 
									$sql	= "select * from vendors ORDER BY vendor_id ASC";
									$result = mysqli_query($conn, $sql);
									while($row=mysqli_fetch_array($result))
										{
									?>
									<option value="<?php echo $row['vendor_id'] ?>"><?php echo $row['vendor_name'] ?></option>
									<?php } ?>
								</select>
                            </div>
                        </div>
						
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Purchase Date</label>
                                <input type="text" autocomplete="off" name="purchase_date" id="requisition_date" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
						
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Assets Name</label>
                                <input type="text" autocomplete="off" name="item_name" id="item_name" class="form-control">	
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Brand</label>
                                <input type="text" name="brand" id="brand" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">Model</label>
                                <input type="text" name="model" id="model" class="form-control">
                            </div>
                        </div>
						
						
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Assets Description</label>
                                <textarea id="assets_description" name="assets_description" class="form-control" required></textarea>
                            </div>
                        </div>
						
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Manufacturing SL</label>
                                <input type="text" name="manufacturing_sl" id="manufacturing_sl" class="form-control">
                            </div>
                        </div>
						<div class="col-md-2">
                            <div class="form-group">
                                <label for="id">RLP No</label>
                                <input type="text" name="rlp_no" id="rlp_no" class="form-control">
                            </div>
                        </div>
						<div class="col-md-2">
                            <div class="form-group">
                                <label for="id">PO No</label>
                                <input type="text" name="purchase_order" id="purchase_order" class="form-control">
                            </div>
                        </div>
						<div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Delivery Challan</label>
                                <input type="text" name="delivery_chalan" id="delivery_chalan" class="form-control">
                            </div>
                        </div>
						
						
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Warranty</label>
                                <input type="text" autocomplete="off" name="warrenty" id="warrenty" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Purchase value</label>
                                <input type="text" name="purchase_value" id="purchase_value" class="form-control">
								
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="id">Country of Origin</label>
                                <input name="origin" type="text" class="form-control" id="pendrive" value="" size="30" required />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="id">Custody</label>
                                <select class="form-control material_select_2" id="custody" name="custody" required >
                                    <option value="">Select Name</option>
									<option value="MD. Babul Farajee">MD. Babul Farajee</option>
									<option value="Sheikh Ahmed Adil">Sheikh Ahmed Adil</option>
                                </select>
                            </div>
                        </div>
						
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Status</label>
                                <select class="form-control material_select_2" id="status" name="status" required >
									<option value="active">Active</option>
									<option value="non-active">Non-Active</option>
                                </select>
                            </div>
                        </div>
						
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="id">Condition</label>
                                <select class="form-control material_select_2" id="condition" name="condition" required >
									<option value="good">Good</option>
									<option value="bad">Bad</option>
                                </select>
                            </div>
                        </div>
                    </div>
					<div class="row" style="">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">Product Serial Photo</label>
								<input class="form-control" type="file" accept="image/*"  name="slfileToUpload" id="picture">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">Product Original Photo</label>
								<input class="form-control" type="file" accept="image/*"  name="profileToUpload" id="picture">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id">Received By</label>
								<?php 
									$employee_id = $_SESSION["employee_id"];
									$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
									$resultemployee = mysqli_query($conn, $sqlemployee);
									$rowemployee=mysqli_fetch_array($resultemployee);
								?>
                                <input type="text" class="form-control" id="" value="<?php echo $rowemployee["employee_name"]; ?>" readonly required />
                                <input name="received_by" type="hidden" id="received_by" value="<?php echo $rowemployee["employee_id"]; ?>" />
                            </div>
                        </div>
                    </div>
					
                    <div class="row" style="">
                        <div class="col-md-12" style="padding-top:10px">
                            <div class="form-group">
                                 <input type="submit" name="asset_submit" id="submit" class="btn btn-block" style="background-color:#198754;color:#ffffff;width:100%;" value="Save" />   
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