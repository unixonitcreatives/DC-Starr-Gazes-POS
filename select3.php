<?php
require_once 'config.php';

if($_POST["action"]){
$response = "";

$trans_id = $_POST['txID'];

$query = "SELECT SUM(ins_amount) AS AmountPaid from installment_history WHERE  si_id = '$trans_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {

  while ($row = mysqli_fetch_assoc($result)){
    $amountPaid = $row['AmountPaid'];
  }
  $num_rows = mysqli_num_rows($result);
} else{
  echo "<p class='lead'><em>No records were found.</em></p>";
}

    $response .= '
        <tr>
          <td id="amountP">'. $amountPaid .'</td>
        </tr>
            ';

  //exit($response);
  echo $response;

}



?>
