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
                                      mysqli_close($link);
                                 }
                             } else{
                                 echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                             }

                             mysqli_close($link);

        }
      }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<?php
  if(@$_GET['alert'] == "updatesuccess"){
          $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully updated.</div>";
        }else if(@$_GET['alert'] == "deletesuccess"){
          $alertMessage = "<div class='alert alert-danger' role='alert'>Data successfully deleted.</div>";
        }else if(@$_GET['alert'] == "addsuccess"){
          $alertMessage = "<div class='alert alert-success' role='alert'>Data successfully added.</div>";
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
         Manage Logs<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">
        <?php echo $alertMessage; ?>
        <div class="row">
          <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Search for Logs Information</h3>
              
            </div>
            <div class="box-body">
              <!-- <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Logs</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Details</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Date / Time Created</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM logs ORDER BY id DESC";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;
                              echo "<tr>";
                              echo "<td>" . $row['info'] . "</td>";
                              echo "<td>" . $row['info2'] . "</td>";
                              echo "<td>" . $row['created_at'] . "</td>";
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
                    </table> -->
              
              <div id='table-holder'>
            </div>
          </div>
      </div>
            </div>
    
    </section>
  <!-- /.content-wrapper -->
</div>


<!-- =========================== FOOTER =========================== -->
  <footer class="main-footer">
      <?php include('template/footer.php'); ?>
  </footer>


<!-- =========================== JAVASCRIPT ========================= -->
      <?php include('template/js.php'); ?>


<script>

    var table = $('#example2');  

    $(document).ready(function(){
    refreshTable();
    });

    function refreshTable(){
    $('#table-holder').load('getLogsTable.php', function(){
         setTimeout(refreshTable, 500);
    });
    }

</script>

</body>
</html>
