<?php
session_start();
require_once 'config.php';
$get_warehouse_id = $_GET['id'];
$query = "DELETE from warehouse WHERE id='$get_warehouse_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
    header("Location: warehouse-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
