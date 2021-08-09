<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Service Area</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Service Area
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="" id="warehouse_stock_search_form" method="GET">
									<div class="row" id="div1" style="padding-bottom:10px;">
										<div class="col-xs-8">
											<div class="form-group">
												<label for="todate">Select Asset For Repair/Servicing</label>
												<select name="id" class="form-control material_select_2">
													<option>Select Product</option>
													<?php
													$sqlvs="SELECT * FROM `ams_products` WHERE `status`='active' ";
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
										<div class="col-xs-4">
											<div class="form-group">
												<label for="todate">.</label>
												<button type="submit" name="submit" class="form-control btn btn-primary">Search</button>
											</div>
										</div>
									</div>
								</form>
								
								
								
								<!--- Search Result--->
								<?php
								if(isset($_GET['submit'])){
									
									$id = $_GET['id'];
									$sql	=	"select * from `ams_products` where `id`='$id'";
									$result = mysqli_query($conn, $sql);
									$row=mysqli_fetch_array($result);
									
									include('service_entry_form.php');
								}else{ 
									include('service_list.php');
								}?>
								<!--- Search Result--->
								
								
								
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>