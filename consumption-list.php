<?php include('header.php'); ?>
                <main>
                    <div class="container-fluid px-4">
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
						<!--  +++++++++++++++ Url/Breadcrumb ++++++++++++++ -->
                        <div class="card mt-4 mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Consumption List
                            </div>
                            <div class="card-body">
            <table id="datatablesSimple" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Consumption ID</th>
						<th>Consumption Date</th>
						<th>Store</th>
					    <th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					$role = $_SESSION['logged']['role'];
					$store_id = $_SESSION['logged']['store_id'];
					if($role == 'user'){
						$item_details = getTableDataByTableNameWid('inv_consumption', '', 'id');
					}else{
						$item_details = getTableDataByTableName('inv_consumption', '', 'id');
					}
					
					/* if($_SESSION['logged']['user_type'] == 'whm') {
						$item_details = getTableDataByTableNameWid('inv_consumption', '', 'id');
					}else{
						$item_details = getTableDataByTableName('inv_consumption', '', 'id');
					} */
					
					
					if (isset($item_details) && !empty($item_details)) {
						foreach ($item_details as $item) {
							if($item['approval_status'] == 0){
							?>
							<tr style="background-color: #FFC107;max-height:10px;">
							<?php  }else{ ?>
							<tr style="background-color: #218838;max-height:10px;">
							<?php  }?>
								<td><?php echo $item['consumption_id']; ?></td>
								<td><?php echo $item['consumption_date']; ?></td>
								<td>
									<?php 
									$dataresult =   getDataRowByTableAndId('store', $item['warehouse_id']);
									echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
									?>
								</td>
								<td>
									<span><a class="action-icons c-approve" href="consumption-view.php?no=<?php echo $item['consumption_id']; ?>" title="View"><i class="fas fa-eye text-success"></i></a></span>
									<!-- <span><a class="action-icons c-delete" href="consumption_edit.php?edit_id=<?php echo $item['id']; ?>" title="edit"><i class="fa fa-edit text-info mborder"></i></a></span> -->
									<?php if($_SESSION['logged']['user_type'] == 'superAdmin') {?>
										<span><a class="action-icons c-delete" href="consumption_approve.php?issue=<?php echo $item['consumption_id']; ?>" title="approve"><i class="fa fa-check text-info mborder"></i></a></span>
										<?php } ?>
							<span><a class="action-icons c-delete" href="#" title="delete"><i class="fa fa-trash text-danger"></i></a></span>
								</td>
							</tr>
							<?php
						}
					}else{ ?>
						  <tr>
							  <td colspan="7">
									<div class="alert alert-info" role="alert">
										Sorry, no data found!
									</div>
								</td>
							</tr>  
					<?php } ?>
				</tbody>
			</table>
        </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>
				