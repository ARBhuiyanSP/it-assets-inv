<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Disposal</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Disposal
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="" id="warehouse_stock_search_form" method="GET">
									<div class="row" id="div1" style="padding-bottom:10px;">  
										<div class="col-md-8">
											<div class="form-group">
												<label for="todate">Select Asset For Disposal</label>
												<select name="id" class="form-control material_select_2" required >
													<option value="">Select Asset</option>
													<?php
													$sqlvs="SELECT * FROM `ams_products` WHERE `status`='active'";
													$resultvs = mysqli_query($conn,$sqlvs);
													while($rowvs = mysqli_fetch_array($resultvs)) {
														if($_GET['id'] == $rowvs['id']){
														$selected	= 'selected';
														}else{
														$selected	= '';
														}
														
													?>
													<option value="<?php echo $rowvs['id']; ?>" <?php echo $selected; ?>><?php echo $rowvs['sl_no'] ?> || <?php echo $rowvs['item_name'] ?> || <?php echo $rowvs['model'] ?> || <?php echo $rowvs['assets_description'] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>		
										<div class="col-md-4">
											<div class="form-group">
												<label for="todate">.</label>
												<button type="submit" name="submit" class="form-control btn btn-primary">Search</button>
											</div>
										</div>
									</div>
								</form>
								<?php
									if(isset($_GET['submit'])){
									$id = $_GET['id'];
									$sql	=	"select * from `ams_products` where `id`='$id'";
									$result = mysqli_query($conn, $sql);
									$row=mysqli_fetch_array($result);?>
									<table style="" class="table table-bordered">
									<tr>
										<th>Item Name:</th>
										<td><?php echo $row['item_name'] ?></td>
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
										<th>RLP No:</th>
										<td><?php echo $row['rlp_no'] ?></td>
									</tr>
									<tr>
										<th>Country Origin:</th>
										<td><?php echo $row['origin'] ?></td>
									</tr>
									<tr>
										<th>Vendor Name:</th>
										<td><?php echo $row['vendor_name'] ?></td>
									</tr>
									<tr>
										<th>Purchase Date:</th>
										<td><?php echo $row['puchase_date'] ?></td>
									</tr>
									<tr>
										<th>Custody:</th>
										<td><?php echo $row['custody'] ?></td>
									</tr>
								</table>
								<h3 style="color:red;">Want To Dispose This Product ?</h3>
								<form action="" method="post" onsubmit="showFormIsProcessing('receive_entry_form');">
									<div class="row">
										<div class="col-xs-4">
											<div class="form-group">
												<label>Disposal Date</label>
												<input name="disposal_date" type="text" class="form-control" id="mrr_date" value="" size="30" autocomplete="off"/>
											</div>
										</div>
										<div class="col-xs-4">
											<div class="form-group">
												<label>Disposal Value</label>
												<input name="disposal_value" type="text" class="form-control" id="" value="" size="30" autocomplete="off"/>
											</div>
										</div>
										<div class="col-xs-4">
											<div class="form-group">
												<label for="id">Disposal By</label>
												<?php 
													$employee_id = $_SESSION['logged']['employee_id'];
													$sqlemployee	= "select * from `employees` where `employee_id`='$employee_id'";
													$resultemployee = mysqli_query($conn, $sqlemployee);
													$rowemployee=mysqli_fetch_array($resultemployee);
												?>
												<input type="text" class="form-control" id="" value="<?php echo $rowemployee["employee_name"]; ?>" readonly required />
												<input name="disposal_by" type="hidden" id="disposal_by" value="<?php echo $rowemployee["employee_id"]; ?>" />
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-6">
											<div class="form-group">
												<label for="ad">Disposal Reason</label>
												<textarea id="ad" name="reason" class="form-control" placeholder="Disposal Reason"></textarea>
											</div>
										</div>
										<div class="col-xs-6">
											<div class="form-group">
												<label for="ad">Remarks</label>
												<textarea id="ad" name="remarks" class="form-control" placeholder="Remarks"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12" style="padding-top:10px">
											<input type="hidden" name="store_id" value="<?php echo $row['current_store']; ?>" />
											<input type="hidden" name="product_id" value="<?php echo $id; ?>" />
											<button class="btn btn-danger" type="submit" name="disposal_submit" style="width:100%"> Dispose This Product</i></button>
										</div>
									</div>
									
								</form>
								<?php } else{ 
								
								include('disposal_list.php');} ?>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>
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