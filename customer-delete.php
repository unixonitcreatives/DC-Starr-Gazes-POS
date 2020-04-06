<?php
session_start();
require_once 'config.php';
$get_customer_id = $_GET['id'];
$custf = $_GET['custf'];
$custl = $_GET['custl'];

$query = "DELETE from customers WHERE id='$get_customer_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
       //logs
    $info = $_SESSION['username']." deleted a customer";
    $info2 = "Details: customer: ". $custf . "&nbsp;" . $custl .", id: ".$get_customer_id."";

    $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
    $r = mysqli_query($link, $q) or die(mysqli_error($link));
    header("Location: customer-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
