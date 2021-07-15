<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Saif Power Group <?php echo date('Y'); ?></div>
                            <div>
                                Design & Development By <a href="#">Saif Power Group - Software Team</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
		
		
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>

		<!-- Core plugin JavaScript-->
		<script src="js/jquery.easing.min.js"></script>
		<script src="js/jquery.dataTables.js"></script>
		<script src="js/dataTables.bootstrap4.min.js"></script>
		<script src="js/sweetalert.min.js"></script>
		<!-- Custom scripts for all pages-->
		<script src="js/sb-admin.min.js"></script>

		<script type="text/javascript" src="js/site_url.js"></script>
		<script type="text/javascript" src="js/site_js.js"></script>
		<script src="js/general_operation.js"></script>
		<script type="text/javascript" type="text/javascript">
					$(document).ready(function() {
						var table = $('#example').DataTable( {
							scrollY:        "300px",
							scrollX:        true,
							scrollCollapse: true,
							paging:         false,
							fixedColumns:   {
								leftColumns: 1,
								rightColumns: 1
							}
						} );
					} );
		</script>
		<script type="text/javascript" type="text/javascript">
			jQuery(document).ready(function ($) {
				$('#dataTable').DataTable();
				$("#item_information").accordion();
				if ($('#material_receive_list')) {
					$('#material_receive_list').DataTable();
				}
			});
			function getSupplierIdBySupplierName(supplier_id) {
				if (supplier_id) {
					var url = baseUrl + "function/supplier_ajax_info.php?process_type=getSupplierIdBySupplierName";
					$.ajax({
						url: url,
						type: "POST",
						dataType: "json",
						data: "supplier_id=" + supplier_id,
						success: function (response) {
							if (response.status == 'success') {
								$('#supplier_id').val(response.data.code);
							}
						}
					});
				} else {
					$('#supplier_id').val('');
				}
			}

			// the following function will be use for cross check receive
			// Added by Tanveer Qureshee:2021-05-29
			function get_all_rcv_details_table(form_id) {
				if (form_id) {
					var url = baseUrl + "cross_checking/rcv_details_table.php";
					$.ajax({
						url: url,
						type: "GET",
						dataType: "html",
						data: $("#" + form_id).serialize(),
						success: function (response) {
							$('#showDataArea').html(response);
						}
					});
				} else {
					$('#supplier_id').val('');
				}
			}
			
			function cross_update_invoice_receive(form_id, table_update_type, message_selector) {
				if (form_id) {
					var url = baseUrl + "cross_checking/rcv_details_update.php?cross_update="+table_update_type;
					$.ajax({
						url     : url,
						type    : "POST",
						dataType: "html",
						data    : $("#" + form_id).serialize(),
						success : function (response) {
							$('#'+message_selector).html(response);
							setTimeout(function(){ 
								$('#'+message_selector).html(""); 
							}, 4000);
						}
					});
				} else {
					$('#supplier_id').val('');
				}
			}

		</script>
		<script>
			$(".material_select_2").select2();
		</script>
		
		<script>
function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}
 
showTime();
</script> 
		
		
		
		
    </body>
</html>
<?php include 'modal/parent_item_added_form.php'; ?>
<?php include 'modal/sub_item_added_form.php'; ?>
<?php include 'modal/item_added_form.php'; ?>
<?php include 'modal/item_edit_form.php'; ?>
<?php include 'modal/sub_item_edit_form.php'; ?>
<?php include 'modal/parent_item_edit_form.php'; ?>