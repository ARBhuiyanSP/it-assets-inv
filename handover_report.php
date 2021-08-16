<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Employee's Handover Report</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Employee's Handover Report
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="" id="warehouse_stock_search_form" method="GET">
									<div class="table-responsive">          
										<table class="table table-borderless">
											<tbody>
												<tr>  
													<td>
														<div class="form-group">
															<label for="todate">Select an Employee</label>
															<select name="employee_id" class="form-control material_select_2" required>
																<option value="">Select Employee</option>
																<?php
																$sqlvs="SELECT * FROM `employees` ";
																$resultvs = mysqli_query($conn,$sqlvs);
																while($rowvs = mysqli_fetch_array($resultvs)) {
																	if($_GET['employee_id'] == $rowvs['employee_id']){
																	$selected	= 'selected';
																	}else{
																	$selected	= '';
																	}
																	
																?>
																<option value="<?php echo $rowvs['employee_id']; ?>" <?php echo $selected; ?>><?php echo $rowvs['employee_name'] ?> || <?php echo $rowvs['employee_id'] ?></option>
																<?php } ?>
															</select>
														</div>
													</td>
													<td>
														<div class="form-group">
															<label for="todate">From Date</label>
															<input type="text" class="form-control" id="from_date" name="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" autocomplete="off" required >
														</div>
													</td>
													<td>
														<div class="form-group">
															<label for="todate">To Date</label>
															<input type="text" class="form-control" id="to_date" name="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" autocomplete="off" required >
														</div>
													</td>
													
													<td colspan="2">
														<div class="form-group">
															<label for="todate">.</label>
															<button type="submit" name="submit" class="form-control btn btn-primary">Search</button>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</form>
								
								
								
								<!--- Search Result--->
								<?php
								if(isset($_GET['submit'])){
									
									$employee_id = $_GET['employee_id'];
									$from_date = $_GET['from_date'];
									$to_date = $_GET['to_date'];
									$sql	=	"select * from `employees` where `employee_id`='$employee_id'";
									$result = mysqli_query($conn, $sql);
									$row=mysqli_fetch_array($result);
									
									
								?>
								<center>
									
									<div class="row">
										<div class="col-md-12" id="printableArea">
											<div class="row">
												<center>
												<div class="col-sm-12">	
													<h1 align="center"><img src="assets/img/logo-wide.png" height="50"></h1>
													<h2>SAIF POWER GROUP</h2>
													<p>72,Mohakhali C/A, (8th Floor),Rupayan Center,Dhaka-1212,bangladesh</p>
													<h3>Assets Handover Receipt</h3>
													<h5>From <?php echo $from_date; ?> To <?php echo $to_date; ?></h5>
													<table class="table" style="width:50%">
														<tr>
															<td>Name</td>
															<td><?php echo $row['employee_name']; ?></td>
														</tr>
														<tr>
															<td>Employee ID</td>
															<td><?php echo $row['employee_id']; ?></td>
														</tr>
														<tr>
															<td>Division</td>
															<td><?php echo $row['division']; ?></td>
														</tr>
														<tr>
															<td>Company</td>
															<td><?php echo $row['company']; ?></td>
														</tr>
													</table>
												<table id="" class="table table-striped table-bordered" style="width:90%">
													<thead>
														<tr>
															<th>Assets Name</th>
															<th width="20%">Assign date</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$sqlh	=	"select * FROM `product_assign` WHERE `employee_id`='$employee_id' AND `assign_date` BETWEEN '$from_date' AND '$to_date'";
														$resulth = mysqli_query($conn, $sqlh);
														while ($rowh = mysqli_fetch_array($resulth)) { ?>
													
														<tr>
															<td>
															<?php 
																$product_id = $rowh['product_id'];
																$sqlname	=	"SELECT * FROM `ams_products` WHERE `id` = '$product_id' ";
																$resultname = mysqli_query($conn, $sqlname);
																$rowname=mysqli_fetch_array($resultname);
																echo $rowname['item_name'];
																echo '</br>' . $rowname['assets_description'];
															?>
															</td>
															<td><?php 
															if($rowh['assign_date']){
																$rDate = strtotime($rowh['assign_date']);
																$rfDate = date("jS \of F Y",$rDate);
																echo $rfDate;
															}else{
																echo '---';
															}
															?>
															</td>
														</tr>
														<?php } ?>
													</tbody>
												</table>
												</div>
												</center>
											</div>
												<center><div class="row">
													<div class="col-xs-6"></br></br>--------------------</br>Receiver Signature</div>
													<div class="col-xs-6"></br></br>--------------------</br>Authorised Signature</div>
												</div></center></br>
												<div class="row">
													<div class="col-sm-12" style="border:1px solid gray;border-radius:5px;padding:10px;color:#f26522;">
														<center><h5>Notice***</br><span style="font-size:14px;color:#000000;">Please Check Everything Before Signature</span></h5></center>
														
													</div>
												</div>
											</div>			
										</div>
										<center><button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true" style="    font-size: 17px;"> Print</i></button></center>
								</center>
								<?php }?>
								<script>
								function printDiv(divName) {
									 var printContents = document.getElementById(divName).innerHTML;
									 var originalContents = document.body.innerHTML;

									 document.body.innerHTML = printContents;

									 window.print();

									 document.body.innerHTML = originalContents;
								}
								</script>
								<!--- Search Result--->
								
								
								
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>
				<script>
    $(function () {
        $("#from_date").datepicker({
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
        $("#to_date").datepicker({
            inline: true,
            dateFormat: "yy-mm-dd",
            yearRange: "-50:+10",
            changeYear: true,
            changeMonth: true
        });
    });
</script>