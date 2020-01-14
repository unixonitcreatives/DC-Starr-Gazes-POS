<?php
require_once 'config.php';


if($_POST["action"]){

$trans_id = $_POST['txID'];

$response = "";
$query = "SELECT * FROM installment_history WHERE si_id='$trans_id'";
$result = mysqli_query($link,$query);

// $q = "SELECT * FROM installment_history";
// $r = mysqli_query($link,$q);
  $response .= '<table id="example1" class="table table-bordered table-hover dataTable" role="grid">
  <thead>
  <tr>
    <th>No.</th>
    <th>Transaction ID</th>
    <th>Amount</th>
    <th>MOP</th>
    <th >Ref. No.</th>
    <th>Date Receive</th>
    <th>Created by</th>
    <th>Action/s</th>
  </tr>
  </thead>';

if(mysqli_num_rows($result) > 0){
  $ctr = 0;
  while($row = mysqli_fetch_array($result)){
    $insID = $row['insID'];
    $in_tx_id = $row['in_tx_id'];
    $si_id = $row['si_id'];
    $ins_amount = $row['ins_amount'];
    $ins_mop = $row['ins_mop'];
    $ins_ref_no = $row['ins_ref_no'];
    $ins_tx_date = $row['ins_tx_date'];
    $created_by = $row['created_by'];
    $ctr++;

    $response .= "
              <tbody>
                <tr>
                  <td>". $ctr ."</td>
                  <td>". $in_tx_id ."</td>
                  <td>". $ins_amount ."</td>
                  <td>". $ins_mop ."</td>
                  <td>". $ins_ref_no ."</td>
                  <td>". $ins_tx_date ."</td>
                  <td>". $created_by ."</td>
                  <td></td>
                </tr>
                </tbody>";
  }
  //exit($response);
  //echo $response;
  $response .= "</table>";
  echo $response;
} else{
  $response.= "<tr><td>No Data Found</td></tr>";
}

mysqli_close($link);

}

?>
<script>
$(function() {
  $('#example2').DataTable()
  $('#example1').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : true,

  });
});
</script>
