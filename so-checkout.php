<?php 
	include 'config.php';

	if(isset($_POST['orders'])){
		
		// $sql = "INSERT INTO sales_order (stock_ID, so_desc, so_qty,so_price,so_cust,so_warehouse)
		// 		VALUES ('John', 'Doe', 1,1,'aaa','WH')";

		// if ($link->query($sql) === TRUE) {
  //   		echo "New record created successfully";
		// } else {
  //   		echo "Error: " . $sql . "<br>" . $conn->error;
		// }


		$orders = $_POST['orders'];
		$lo1 = json_decode(json_encode($orders),true);
		$arr= json_decode($lo1,true);

		foreach ($arr as $p) {

			 $sql = 'INSERT INTO sales_order (stock_ID, so_desc, so_qty,so_price,so_cust,so_warehouse)
		 		VALUES ("'.$p['custID'].'","'.$p['product_SKU'].'",1,'.$p['UnitPrice'].',"'.$p['so_cust'].'","'.$p['warehouseID'].'")';
		 	
			if ($link->query($sql) === TRUE) {
	    		$validator['success'] = true;
			} else {
	    		echo "Error: " . $sql . "<br>" . $link->error;
			}
		}
		$validator['success'] = true;
		echo json_encode($validator);
	}
?>