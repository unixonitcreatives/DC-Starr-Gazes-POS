<?php
	include 'config.php';

	if(isset($_POST['product_SKU'])){
		$id = $_POST['product_SKU'];
		$sql = "SELECT a.id,a.product_description,
					   a.product_SKU,a.suggested_retail_price,
					   b.category_name
					   FROM product_model a
					 INNER JOIN categories b on b.custID=a.product_category WHERE a.product_SKU = '$id'";
		$query = $link->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>
