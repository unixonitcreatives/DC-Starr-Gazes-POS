<?php
    if($Admin_auth && $_SESSION["usertype"] == "Administrator"){

    }
    else if($Manager_auth && $_SESSION["usertype"] == "Manager"){

    }
    else if($Cashier_auth && $_SESSION["usertype"] == "Cashier"){

    }
    else {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('You have no privilege to access this page. Returning to dashboard.');
    window.location.href='index.php';
    </script>");
    }
?>