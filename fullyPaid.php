<?php
include 'config.php';

$trans_id = $_GET['txID'];

if(isset($_POST['fullyPaid'])){
                          $q = "UPDATE sales_order SET mop = 'Fully Paid' WHERE txID = '$trans_id'";
                          $r = mysqli_query($link,$q);
                         echo "<script>window.location.href='si-credits.php';</script>";
                       }
?>