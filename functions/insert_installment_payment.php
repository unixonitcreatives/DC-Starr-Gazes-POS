<!-- ======================= SESSION =================== -->
<?php include('../template/session.php'); ?>

<?php

require_once "../config.php";

// Define variables and initialize with empty values
$in_tx_id=$si_id=$ins_amount=$ins_mop=$ins_ref_no=$in_tx_date=$created_by=$alertMessage=$loginUSer="";

$loginUSer = $SESSION_['username'];

if(isset($_POST['paymentBtn'])){
  //Assigning posted values to variables.
  $in_tx_id = test_input($_POST['in_tx_id']);
  $si_id = test_input($_POST['si_id']);
  $ins_amount = test_input($_POST['ins_amount']);
  $ins_mop = test_input($_POST['ins_mop']);
  $ins_ref_no = test_input($_POST['ins_ref_no']);
  $in_tx_date = test_input($_POST['in_tx_date']);
  $created_by = test_input($_POST['created_by']);


  // Check input errors before inserting in database
  if(empty($alertMessage)){

  //Prepare Date for custom ID
    $IDtype = "IN";
    $m = date('m');
    $y = date('y');
    $d = date('d');

    $qry = mysqli_query($link,"SELECT MAX(id) FROM `installment_history`"); // Get the latest ID
    $resulta = mysqli_fetch_array($qry);
    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
    $custID = str_pad($newID, 4, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
    $custnewID = $IDtype.$custID; //Prepare custom ID

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
