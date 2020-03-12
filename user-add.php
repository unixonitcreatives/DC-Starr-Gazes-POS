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



    // Validate password
    if(empty($password)){
        $alertMessage = "Please enter a password.";
    }

    // Validate username
    if(empty($username)){
        $alertMessage = "Please enter a username.";
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
                                    echo "<script>$.notify('Username already exist','success');</script>";
                                    echo "<script>console.log('Username already exist');</script>";
                                    mysqli_free_result($result);
                                 } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database

                                    //Prepare Date for custom ID
                                    $IDtype = "ACC";
                                    $m = date('m');
                                    $y = date('y');
                                    $d = date('d');

                                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `users`"); // Get the latest ID
                                    $resulta = mysqli_fetch_array($qry);
                                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                    $custID = str_pad($newID, 4, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                    $custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID

                                    $query = "INSERT INTO users (custID, username, password, usertype) 
                                                   VALUES ('$custnewID', '$username', '$password', '$usertype')"; //Prepare insert query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
                                    
                                    
                                    if($result){
                                    echo "<script>Notify('new user added succesfully','Success');</script>";
                                    echo "<script>console.log('new user added');</script>";
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
         Add User Accounts<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">
          
          <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">User's Information</h3>
              <br>View all <a href="user-manage.php" class="text-center">user accounts</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="box-body">
                <p><?php echo $alertMessage ?></p>
                <div class="form-group">
                  <label>Username</label> <code class="text-orange">Max. 10 characters</code>
                  <input type="text" class="form-control" placeholder="Username" name="username" oninput="upperCase(this)" maxlength="10" required>
                </div>

                <div class="form-group">
                  <label>Password</label>  <code class="text-orange">Max. 20 characters</code>
                  <input type="password" class="form-control" placeholder="Password" name="password" maxlength="20" required>
                </div>

                <div class="form-group">
                <label>User Type</label>
                <select class="form-control select2" style="width: 100%;" name="usertype" required>
                  <option>Administrator</option>
                  <option>Manager</option>
                  <option>Cashier</option>
                </select>
              </div>
              <!-- /.box-body -->
            </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-default" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" >Save</button>
              </div>
            </form>
          </div>
          <!-- /.box -->


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


</body>
</html>
