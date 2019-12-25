<!-- ======================= SESSION =================== -->
<?php include('../template/session.php'); ?>

<?php

require_once "../config.php";

// Define variables and initialize with empty values
$in_tx_id=$si_id=$ins_amount=$ins_mop=$ins_ref_no=$in_tx_date=$created_by=$alertMessage=$loginUSer="";

$loginUSer = $_SESSION['username'];

if(isset($_POST['paymentBtn'])){
  //Assigning posted values to variables.
  $si_id = test_input($_POST['txNum']);
  $ins_amount = test_input($_POST['amount_paid']);
  $ins_mop = test_input($_POST['mop']);
  $ins_ref_no = test_input($_POST['refNum']);
  $ins_tx_date = test_input($_POST['paymentDate']);

  // Check input errors before inserting in database
  if(empty($alertMessage)){

  //Prepare Date for custom ID
    $IDtype = "SITX";
    $m = date('m');
    $y = date('y');
    $d = date('d');

    $qry = mysqli_query($link,"SELECT MAX(insID) FROM `installment_history`"); // Get the latest ID
    $resulta = mysqli_fetch_array($qry);
    $newID = $resulta['MAX(insID)'] + 1; //Get the latest ID then Add 1
    $custID = str_pad($newID, 6, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
    $custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID

    $in_tx_id = $custnewID; //eto bro SITXmmddyy000001 or SITX121619000001
    $query = "INSERT INTO installment_history(insID, in_tx_id, si_id, ins_amount, ins_mop, ins_ref_no, ins_tx_date, created_by)
    VALUES ('$insID','$in_tx_id','$si_id','$ins_amount','$ins_mop','$ins_ref_no','$ins_tx_date','$loginUSer')"; //Prepare insert query

    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

    if($result){
      //echo "<script>Notify('Category Added Succesfully','Success');</script>";
      header("Location: ../si-view-credits.php?alert=addsuccess");
    }else{
      header("Location: ../si-view-credits.php?alert=error");
      //header("Location: category-add.php?alert=3");
    }
    mysqli_close($link);

  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>
