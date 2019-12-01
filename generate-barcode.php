<?php

 $text=$_GET['id'];

 echo "<img alt='testing' src='barcode.php?codetype=code128&size=40&text=".$text."&print=true'/>";

?>
