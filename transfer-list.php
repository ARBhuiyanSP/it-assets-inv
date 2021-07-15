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
						<th>TID</th>
						<th>Transfer Date</th>
						<th>From</th>
						<th>To</th>
					     <th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					if($_SESSION['logged']['user_type'] == 'whm') {
						$item_details = getTableDataByTableNameTid('inv_transfermaster', '', 'id');
					}else{
						$item_details = getTableDataByTableName('inv_transfermaster', '', 'id');
					}
					if (isset($item_details) && !empty($item_details)) {
						foreach ($item_details as $item) {
							?>
							<tr>
								<td><?php echo $item['transfer_id']; ?></td>
								<td><?php echo $item['transfer_date']; ?></td>
								<td>
									<?php 
									$dataresult =   getDataRowByTableAndId('store', $item['from_warehouse']);
									echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
									?>
								</td>
								<td>
									<?php 
									$dataresult =   getDataRowByTableAndId('store', $item['to_warehouse']);
									echo (isset($dataresult) && !empty($dataresult) ? $dataresult->name : '');
									?>
								</td>
								<td>
									<span><a class="action-icons c-approve" href="transfer-view.php?no=<?php echo $item['transfer_id']; ?>" title="View"><i class="fas fa-eye text-success"></i></a></span>
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
				