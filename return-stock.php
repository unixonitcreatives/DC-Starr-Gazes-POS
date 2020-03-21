<?php
include('config.php');

$sku = $_GET['sku'];

 $qq = "UPDATE stock SET stock_status='In stock',qty=1 WHERE custID='$sku'";
 $rr = mysqli_query($link,$qq);

if($rr){
	header('Location: returns-manage.php?alert=returned');
}

?>