<?php
session_start();
require_once 'config.php';
$get_po_id = $_GET['id'];
$query = "DELETE from categories WHERE id='$get_po_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
    header("Location: po-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
