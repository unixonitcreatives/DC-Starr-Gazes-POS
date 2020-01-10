<?php
  // require_once 'config.php'
  //
  // if(isset($_POST['txNum'])){
  //   $output = array();
  //
  //   $procedure = "CREATE PROCEDURE whereUser(IN txID varchar(150)) BEGIN SELECT * FROM installment_history WHERE si_id = txID END";
  //
  //   if(mysqli_query($link,$procedure)){
  //     $query = "CALL whereUser(". $_POST['txNum'] .")";
  //     $result = mysqli_query($connect,$query);
  //
  //     while($row = mysqli_fetch_array($result)){
  //       $output['amount_paid'] = $row['ins_amount'];
  //       $output['mop']         = $row['ins_mop'];
  //       $output['refNum']      = $row['ins_ref_no'];
  //       $output['paymentDate'] = $row['ins_tx_date'];
  //
  //     }
  //
  //     echo json_encode($output);
  //   }
  // }


  $server = "localhost";
  $name = "root";
  $pw = "";
  $db = "mh_db";

  /* Attempt to connect to MySQL database */
  $link = mysqli_connect($server, $name, $pw, $db) or die("Something Went Wrong" . mysqli_connect_error());

if(isset($_POST['action'])){
  $query = "SELECT * FROM users ORDER BY id DESC";
  $result = mysqli_query($link,$query);

  if(mysqli_num_rows($result) > 0){
    $response = "";
    while($row = mysqli_fetch_array($result)){
      $response = "";
      $response .= "<tr>
                    <td>".echo $row['username']."</td>
                    <td>".echo $row['usertype']."</td>
                  </tr>
                  ";
    }
    //exit($response);
    echo $response;
  }
}

?>
