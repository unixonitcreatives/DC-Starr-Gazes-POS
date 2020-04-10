<?php
// Define variables and initialize with empty values
$status="";


require_once "config.php"; //void query


if($_SERVER["REQUEST_METHOD"] == "POST"){
  $txID = $_POST['txID'];
  $stockID = $_POST['stockID'];
  //$userid = $_POST['userid'];    
  //$qty = $_POST['qty'];

  $soUpdateQuery = "UPDATE sales_order SET mop = 'Void' WHERE txID = '$txID' "; 
  $s0UpdateResult = mysqli_query($link, $soUpdateQuery) or die(mysqli_error($link));


  if($s0UpdateResult){
    $date_n = date('Y-m-d');

    $up = "UPDATE void_so SET mop = 'Void', created_at = '$date_n' WHERE txID = '$txID'";
    $rr = mysqli_query($link,$up);

    //$i=0; //define i = 0
    //$count = count($id); //count qty element
    $data = array(
      'stockID' => $stockID    
    );


    for($i=0; $i<count($data); $i++){ //loop

      
      $sc = $stockID;
      

      $scUpdateQuery =  "UPDATE stock SET stock_status = 'In Stock', qty = '1' WHERE custID = '$sc'";  
      $scUpdateResult = mysqli_query($link, $scUpdateQuery) or die(mysqli_error($link));
      
    }

    

  }

}

?>