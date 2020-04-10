
<?php
include 'config.php';

if(isset($_POST['orders'])){
	$orders = $_POST['orders'];
	$lo1 = json_decode(json_encode($orders),true);
	$arr= json_decode($lo1,true);
	$date = date("Y-m-d");

												//start
	$IDtype = "SI";
	$m = date('m');
	$y = date('y');
	$d = date('d');

	// Attempt select query execution
	$qry = mysqli_query($link,"SELECT MAX(soID) FROM `sales_order`"); // Get the latest ID sa database ng sales_order
	$resulta = mysqli_fetch_assoc($qry);
	$newID = $resulta['MAX(soID)'] + 1; //Get the latest ID then Add 1
	$custID = str_pad($newID, 5, '0', STR_PAD_LEFT); //Prepare custom ID with 8 Paddings
	$custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID
		//output nyan ay (ex: SI1129201900001)

	foreach ($arr as $p) {
		$sql = 'INSERT INTO sales_order ( txID, stock_ID, so_desc, so_qty, so_price, so_cust, so_warehouse, mop,discount, created_by, created_at)
		VALUES ("'. $custnewID . '","'.$p['custID'].'","'.$p['product_SKU'].'",1,'.$p['UnitPrice'].',"'.$p['so_cust'].'","'.$p['warehouseID'].'","'.$p['mop'].'","'.$p['discount'].'", "'.$p['username'].'","'.$date.'")';
		
		$qq = 'INSERT INTO void_so ( txID, stock_ID, so_desc, so_qty, so_price, so_cust, so_warehouse, mop,discount, created_by, created_at)
		VALUES ("'. $custnewID . '","'.$p['custID'].'","'.$p['product_SKU'].'",1,'.$p['UnitPrice'].',"'.$p['so_cust'].'","'.$p['warehouseID'].'","'.$p['mop'].'","'.$p['discount'].'", "'.$p['username'].'","'.$date.'")';
		
		if ($link->query($sql) === TRUE) {
			$validator['success'] = true;
			$link->query($qq);
			
		} else {
			echo "Error: " . $sql . "<br>" . $link->error;
		}
	}

	$validator['success'] = true;

	echo json_encode($validator);

}
?>

<input type="hidden" value="<?php echo $custnewID?>" id='custnewID'>
