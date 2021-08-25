<?php 
include('header.php');
include ('department_process.php');
?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <ol class="breadcrumb mt-4 mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Department List</li>
                        </ol>
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Department list
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
									<div class="col-md-10">
										<?php if (isset($_SESSION['response'])) { ?>
										<div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
										  <button type="button" class="close" data-dismiss="alert">&times;</button>
										  <b><?= $_SESSION['response']; ?></b>
										</div>
										<?php } unset($_SESSION['response']); ?>
									</div>
								</div>
								<div class="row">
								  <div class="col-md-4">
									<h3 class="text-center">Add New Department</h3>
									<form action="department_process.php" method="post">
									  <input type="hidden" name="id" value="<?= $id; ?>">
									  
									  <!--- New Form Suppliers as Vendors--->
									  <!--- New Form Suppliers as Vendors--->
									  <div class="form-group">
										<select name="company_id" class="form-control" id="company" required>
											<option value="">Select Company</option>
											<?php
											$query = "SELECT * FROM companies";
											$result = $conn->query($query);
											if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												if($company_id == $row['id']){
													$selected	= 'selected';
													}else{
													$selected	= '';
													}
												
											echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['company_name'].'</option>';
											}
											}else{
											echo '<option value="">Company not available</option>';
											}
											?>
										</select>
									  </div></br>
									  <div class="form-group">
										<select name="division_id" class="form-control" id="division" required>
											<option value="">Select Division</option>
										</select>
									  </div></br>
									  <div class="form-group">
										<input type="text" name="department_name" value="<?= $department_name; ?>" class="form-control" placeholder="Enter Name" required>
									  </div></br>
									  
									  <!--- New Form Suppliers as Vendors--->
									  <!--- New Form Suppliers as Vendors--->
									  
									  
									  
									  <div class="form-group">
										<?php if ($update == true) { ?>
										<input type="submit" name="update" class="btn btn-success btn-block" style="width:100%" value="Update Record">
										<?php } else { ?>
										<input type="submit" name="add" class="btn btn-primary btn-block" style="width:100%" value="Add Record">
										<?php } ?>
									  </div>
									</form>
								  </div>
								  <div class="col-md-8">
									<div class="card-header" style="background-color: #ffffff;">
										<button class="btn btn-primary linktext" onclick="window.location.href='companies.php';"> Company List</button>
										<button class="btn btn-primary linktext" onclick="window.location.href='divisions.php';"> Division List</button>
										<button class="btn btn-success linktext"> Department List</button>
										<button class="btn btn-primary linktext" onclick="window.location.href='prolocs.php';"> Project/Location List</button>
									</div>
									<table class="table table-hover" id="datatablesSimple">
										<thead>
											<tr>
												<th width="10%">SL No</th>
												<th width="20%">Company</th>
												<th width="20%">Division</th>
												<th width="25%">Department</th>
												<th width="25%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$projectsData = getTableDataByTableName('departments');
											if (isset($projectsData) && !empty($projectsData)) {
												$i=1;
												foreach ($projectsData as $data) {
													?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td>
												<?php 
												$dataresult =   getDataRowByTableAndId('companies', $data['company_id']);
												echo (isset($dataresult) && !empty($dataresult) ? $dataresult->company_name : ''); 
												?>
												</td>
												<td>
												<?php 
												$dataresult =   getDataRowByTableAndId('divisions', $data['division_id']);
												echo (isset($dataresult) && !empty($dataresult) ? $dataresult->division_name : ''); 
												?>
												</td>
												<td><?php echo $data['department_name']; ?></td>
												<td>
													<a href="vendor-details.php?details=<?php echo $data['id']; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
													<a href="department_process.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger" onclick="return confirm('Do you want delete this record?');"><i class="fa fa-trash"></i></a>
													<a href="departments.php?edit=<?= $data['id']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
												</td>
											</tr>
											<?php
												}
											}
											?>
										</tbody>
									</table>
								  </div>
								</div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>
				<script type="text/javascript">
$(document).ready(function(){
// Company dependent ajax
$("#company").on("change",function(){
	var companyId = $(this).val();
	$.ajax({
	url :"getcompany.php",
	type:"POST",
	cache:false,
	data:{companyId:companyId},
	success:function(data){
	$("#division").html(data);
	$('#department').html('<option value="">Select department</option>');
	}
	});
	});

// division dependent ajax
$("#division").on("change", function(){
	var divisionId = $(this).val();
	$.ajax({
	url :"getcompany.php",
	type:"POST",
	cache:false,
	data:{divisionId:divisionId},
	success:function(data){
	$("#department").html(data);
	$('#proloc').html('<option value="">Select project/location</option>');
	}
	});
	});
	
// department dependent ajax
$("#department").on("change", function(){
	var departmentId = $(this).val();
	$.ajax({
	url :"getcompany.php",
	type:"POST",
	cache:false,
	data:{departmentId:departmentId},
	success:function(data){
	$("#proloc").html(data);
	}
	});
	});
	
});
</script>