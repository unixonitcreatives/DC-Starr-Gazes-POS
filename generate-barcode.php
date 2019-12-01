<?php

 $text=$_GET['id'];
 $price ="8.50";

 echo "<img alt='testing' src='barcode.php?codetype=Code39&size=40&text=".$text."&print=true'/>";

?>
