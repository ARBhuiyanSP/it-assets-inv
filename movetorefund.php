<?php
include 'connection/connect.php';

	$id 			= $_POST['id'];
	$product_id 	= $_POST['product_id'];
	$refund_date 	= $_POST['refund_date'];
	$status 		= 'Refund';




	$sql	=	"UPDATE `product_assign`  set `refund_date`='$refund_date', `status`='$status' where `id`='$id'";

	mysqli_query($conn, $sql);

    $sql2	=	"UPDATE `ams_products`  set `assign_status`='' where `id`='$product_id'";

    mysqli_query($conn, $sql2);

echo "<script>alert('1 Record Update Added')</script>";
ECHO "<script>location.href='assets-list.php'</script>";

?>