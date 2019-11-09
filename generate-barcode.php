<?php

 $text=$_GET['id']; 
 $price = '$20';
 echo "<img alt='testing' src='barcode.php?codetype=Codabar&size=40&text=".$text."&print=true'/>";


?>

