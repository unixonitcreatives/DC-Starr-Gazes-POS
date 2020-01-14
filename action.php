<?php
session_start();
require_once 'config.php';
$output=$ins_amount=$ins_mop=$ins_ref_no=$ins_tx_date= "";

if($_POST['action']){
  //$amountP = valData($_POST['amount_p']);
  $ins_amount = valData($_POST['amountPaid']);
  $ins_mop = valData($_POST['mop']);
  $ins_ref_no = valData($_POST['refNum']);
  $ins_tx_date = valData($_POST['payment_date']);
  $card = valData($_POST['card']);
  $cheque = valData($_POST['cheque']);
  $si_id = valData($_POST['txNum']);

  if($ins_amount == "" || $ins_mop == "" || $ins_ref_no == "" || $ins_tx_date == ""){
    $IDtype = "SITX";
    $m = date('m');
    $y = date('y');
    $d = date('d');

    $qry = mysqli_query($link,"SELECT MAX(insID) FROM `installment_history`"); // Get the latest ID
    $resulta = mysqli_fetch_array($qry);
    $newID = $resulta['MAX(insID)'] + 1; //Get the latest ID then Add 1
    $custID = str_pad($newID, 6, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
    $custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID

    $in_tx_id = $custnewID;
  //  $q = 'SELECT si_id FROM installment_history';

    $loginUSer = $_SESSION['username'];

    $query = "INSERT INTO installment_history(in_tx_id, si_id, ins_amount, ins_mop, ins_ref_no, ins_tx_date, created_by)
    VALUES ('$in_tx_id','$si_id','$ins_amount','$ins_mop','$ins_ref_no','$ins_tx_date','$loginUSer')";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    //if($result){$amountP = $ins_amount;}

  }



  //return $output;
  //echo $output;
  //exit($output);
}

function valData($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

mysqli_close($link);
?>
