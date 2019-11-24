<?php


	include 'config.php';

	if(isset($_POST['custID'])){
		$id = $_POST['custID'];
		$sql = "SELECT a.custID,a.warehouse_ID,b.product_description,
					   b.product_SKU,b.sell_price,c.category_name
					   FROM stock a
					 INNER JOIN product_model b on b.product_SKU=a.PO_ID
					 INNER JOIN  categories c on c.custID=b.product_category
					 WHERE a.qty>0 and a.custID= '$id'";
		$query = $link->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>
