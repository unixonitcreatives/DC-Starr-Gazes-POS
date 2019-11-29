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


		//eto gawa ko bro
		$IDtype = "SI";
        $m = date('m');
        $y = date('y');
        $d = date('d');

        $qry = mysqli_query($link,"SELECT MAX(id) FROM `sales_order`"); // Get the latest ID sa database ng sales_order
        $resulta = mysqli_fetch_array($qry);
        $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
        $custID = str_pad($newID, 5, '0', STR_PAD_LEFT); //Prepare custom ID with 8 Paddings
        $custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID
        	//output nyan ay (ex: SI1129201900001)


	
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
