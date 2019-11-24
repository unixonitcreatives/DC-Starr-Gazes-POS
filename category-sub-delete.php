<?php
session_start();
require_once 'config.php';
$get_subCategory_id = $_GET['id'];
$query = "DELETE from categories_sub WHERE id='$get_subCategory_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if ($result){
    header("Location: category-sub-manage.php?alert=deletesuccess");
}else {
    echo "Error deleteing record: " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
?>
