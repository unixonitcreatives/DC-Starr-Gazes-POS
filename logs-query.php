<?php
   include 'config.php';

   $info = $_POST['info'];
   $info2 = $_POST['info2'];

   $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; 
   //Prepare insert query
   $r = mysqli_query($link, $q) or die(mysqli_error($link));

 ?>