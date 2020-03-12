<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php 
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
 include('template/user_auth.php');
?>
<!-- =======================   =================== -->
<?php
// Define variables and initialize with empty values
$username=$password=$usertype=$alertMessage="";

require_once "config.php";

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $usertype = test_input($_POST['usertype']);

    // Validate username
    if(empty($username)){
        $alertMessage = "Please enter a username.";
    }

    // Validate password
    if(empty($password)){
        $alertMessage = "Please enter a password.";
    }

    // Validate user type
    if(empty($usertype)){
        $alertMessage = "Please enter a user type.";
    }


    // Check input errors before inserting in database
    if(empty($alertMessage)){
        //Check if the username is already in the database
        $sql_check = "SELECT username FROM users WHERE username ='$username'";
        if($result = mysqli_query($link, $sql_check)){ //Execute query
                                 if(mysqli_num_rows($result) > 0){
                                    //If the username already exists
                                    //Try another username pop up
                                    echo "<script> window.alert('Username already exist, Please try again a different name')</script>";

                                     mysqli_free_result($result);
                                 } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database
                                    //Checking the values are existing in the database or not
                                    $query = "INSERT INTO users (username, password, usertype) 
                                                   VALUES ('$username', '$password', '$usertype')"; //Prepare query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute query

                                    if($result){
                                      //If execution is completed

                                      $alertMessage = "<div class='alert alert-success' role='alert'>
                                      New user successfully added.
                                      </div>";

                                      header("location: user-add.php");
                                    }else{
                                      //If execution failed

                                      $alertMessage = "<div class='alert alert-danger' role='alert'>
                                      Error adding data.
                                      </div>";}
                                    
                                 }
                             } else{
                                 echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                             }

        }
      }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//$_GET['alert'] = "";

if(@$_GET["alert"] == "success"){
    $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully added.</div>";
} else if(@$_GET["alert"] == "deletesuccess"){
    $alertMessage = "<div class='alert alert-danger' role='alert'>Data successfully deleted.</div>";  
}

?>
<!-- ================================================================ -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>DC Starr Gazes</title>
<!-- ======================= CSS ================================= -->
<?php include('template/css.php'); ?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <!-- ======================= MENU BAR =========================== -->
  <?php include('template/menu-bar.php'); ?>
  <!-- ======================= SIDEBAR ============================ -->
  <?php include('template/sidebar-manage.php'); ?>
  <!-- ======================== HEADER CONTENT ==================== -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Manage Returns<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">
       <?php echo $alertMessage; ?>
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Search for Returns Information</h3>
              <br><a href="returns-add.php" class="text-center">+ add new return</a>
<!--                <button type="button" class="btn btn-primary pull-right" onclick="exportTb()">Export Excel</button>-->
            </div>
            <div class="box-body" id='th'>
              
              <table id="example1" class="table table-bordered table-hover dataTable tb" role="grid" aria-describedby="example2_info">
                
                      <thead id='thead'>
                        <tr>
                          <th>No.</th>
                          <th>Date of Purchase</th>
                          <th>Date Returned</th>
                          <th>Transaction ID</th>
                          <th>Customer</th>
                          <th>Item</th>
                          <th>Quantity</th>
                          <th>Cashier</th>
                          <th>Remarks</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                  
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM returns ORDER BY created_at DESC";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_assoc($result)){
                              //$id = $row['custID'];
                              $ctr++;
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $row['date_purchase'] . "</td>";
                              echo "<td>" . $row['created_at'] . "</td>";  
                              echo "<td>" . $row['trans_id'] ."</td>";
                              echo "<td>" . $row['customer'] . "</td>";
                              echo "<td>" . $row['item'] . "</td>";
                              echo "<td>" . $row['qty'] . "</td>";
                              echo "<td>" . $row['cashier'] . "</td>";
                              echo "<td>" . $row['remarks'] . "</td>";
                              echo "<td>";
                              echo "<a href='return-delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
////                              echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
//                              echo "</td>";
                              echo "</tr>";
                            }
                            // Free result set
                            mysqli_free_result($result);
                          } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                          }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);
                        ?>
                      </tbody>
                    </table>
            </div>
          </div>
     
    </section>
  <!-- /.content-wrapper -->
    </div>
    </div>
    


<!-- =========================== FOOTER =========================== -->
  <footer class="main-footer">
      <?php include('template/footer.php'); ?>
  </footer>


<!-- =========================== JAVASCRIPT ========================= -->
      <?php include('template/js.php'); ?>

<script type="text/javascript">
// function ExportToExcel(tableID){
//        var htmltable= document.getElementById(tableID);
//        var html = htmltable.outerHTML;
//        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
//     }

function exportTb(){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById('example1');
    var table_html = '<table><thead><tr><th></th><th></th><th></th><th></th><th></th></tr></thead></table>';
    var tableHTML = table_html + tableSelect.outerHTML;
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    //document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob([tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob );
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ',' + tableHTML;
    
        //triggering the function
        downloadLink.click();
}

}


</script>



</body>
</html>
