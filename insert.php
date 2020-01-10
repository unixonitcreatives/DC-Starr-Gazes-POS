<?php
$server = "localhost";
$name = "root";
$pw = "";
$db = "jp_db";

/* Attempt to connect to MySQL database */
$link = mysqli_connect($server, $name, $pw, $db) or die("Something Went Wrong" . mysqli_connect_error());

// if($_POST["action"]){
//
//   $output = '';
//   $firstname = mysqli_real_escape_string($link,$_POST["fname"]);
//   $lastname = mysqli_real_escape_string($link,$_POST["lname"]);
//
//   $procedure = "CREATE PROCEDURE insertUser(IN fname varchar(150), lname varchar(150))
//   BEGIN
//   INSERT INTO users (first_name,last_name) VALUES(fname,lname);
//   END;
//   ";
//
//   if(mysqli_query($link,"DROP PROCEDURE IF EXIST insertUser")){
//     if(mysqli_query($link,$procedure)){
//       $query = "CALL insertUser('".$firstname.",".$lastname."')";
//       mysqli_query($link,$query);
//       //echo json_encode($result);
//       echo $query;
//       echo 'DATA INSERTED';
//     }
//   }
// }

$output= "";

if($_POST['action']){
  $firstname = valData($_POST['firstName']);
  $lastname = valData($_POST['lastName']);

  if($firstname == "" || $lastname == ""){
    $output .= "<label class='text-danger'>Fields Required</label>";
  } else{
    $query = "INSERT INTO users (first_name, last_name) VALUES ('$firstname','$lastname')";
    $result = mysqli_query($link,$query);
    if($result){
      $output .= '<label class="text-success">DATA INSERTED</label>';
    }
  }



  //return $output;
  echo $output;
  //exit($output);
}

function valData($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
