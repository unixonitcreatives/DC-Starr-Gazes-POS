<?php
$server = "localhost";
$name = "root";
$pw = "";
$db = "jp_db";

/* Attempt to connect to MySQL database */
$link = mysqli_connect($server, $name, $pw, $db) or die("Something Went Wrong" . mysqli_connect_error());

if($_POST["action"]){
//   $procedure = "CREATE PROCEDURE selectUser()
//   BEGIN
//   SELECT * FROM users ORDER BY id DESC;
//   END;
//   ";
// if(mysqli_query($link, "DROP PROCEDURE IF EXIST selectUser")){
//   if(mysqli_query($link,$procedure)){
//     $query = "CALL selectUser()";
//     $result = mysqli_query($link,$query);
//
//     $output .= '
//     <table class="table table-bordered" >
//                   <tr>
//                     <th>First Name</th>
//                     <th>Last Name</th>
//                     <th>Edit</th>
//                     <th>Delete</th>
//                   </tr>';
//
//
//     if(mysqli_num_rows($result) > 0){
//       while($row = mysqli_fetch_array($result)){
//         $output .= '<tr>
//                       <td>'. $row['first_name'] .'</td>
//                       <td>'. $row['last_name'] .'</td>
//                       <td><button type="button" id="'.$row['id'].'" name="edit" class="btn btn-success">Update</button></td>
//                       <td><button type="button" id="'.$row['id'].'" name="delete" class="btn btn-danger">Delete</button></td>
//                     </tr>';
//       }
//     } else{
//       $output .= '<tr>
//                     <td colspan="4">No data found</td>
//                   </tr>';
//     }
//     $output .= '</table>';
//     mysqli_free_result($output); //--- test
//     echo json_encode($output);  // <-- test
//     echo $output;
//     //exit($output);
//     }
//   }
$response = "";
$query = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($link,$query);
  $response = "<table class='table table-bordered'>
                     <tr>
                       <th>First Name</th>
                       <th>Last Name</th>
                     </tr>";

if(mysqli_num_rows($result) > 0){

  while($row = mysqli_fetch_array($result)){

    $response .= "<tr>
                  <td>". $row['first_name']."</td>
                  <td>". $row['last_name']."</td>
                </tr>
                ";
  }
  //exit($response);
  //echo $response;
  $response .= "</table>";
  echo $response;
} else{
  $response.= "<tr><td>No Data Found</td></tr>";
}


}


?>
