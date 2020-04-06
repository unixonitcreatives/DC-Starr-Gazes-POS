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
$id = $_GET['id'];

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $usertype = test_input($_POST['usertype']);
    $hash = password_hash($password,PASSWORD_DEFAULT);

                                    $IDtype = "ACC";
                                    $m = date('m');
                                    $y = date('y');
                                    $d = date('d');

                                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `users`"); // Get the latest ID
                                    $resulta = mysqli_fetch_array($qry);
                                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                    $custID = str_pad($newID, 4, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                    $custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID

                                   $query = "UPDATE users SET username='$username',password='$hash',usertype='$usertype' WHERE id='$id'";
                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
                                    
                                    
                                    if($result){

                                     //logs
                                    $info = $_SESSION['username']." updated a user";
                                    $info2 = "Details: ".$username." as ".$usertype." IP:".getRealIpAddr();

                                    $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
                                    $r = mysqli_query($link, $q) or die(mysqli_error($link));
                                      
                                    echo "<script>Notify('User Updated succesfully','Success');</script>";
                                    echo "<script>window.location.href='user-manage.php?alert=updatesuccess'</script>";
                                    }else{
                                      //If execution failed

                                      $alertMessage = "<div class='alert alert-danger' role='alert'>
                                      Error adding data.
                                      </div>";
                                    }
                                      mysqli_close($link);                                  
      }
function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
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
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $id; ?>">
              <div class="box-body">
                <?php echo $alertMessage ?></p>
                <?php

                $q = "SELECT * FROM users WHERE id='$id'";
                $r = mysqli_query($link,$q); 

                while($row = mysqli_fetch_assoc($r)){
                  $username = $row['username'];
                  $usertype = $row['usertype'];
                  $password = $row['password'];

                ?>
                <div class="form-group">
                  <label>Username</label> <code class="text-orange">Max. 10 characters</code>
                  <input type="text" class="form-control" placeholder="Username" name="username" oninput="upperCase(this)" maxlength="10" value="<?php echo $username; ?>">
                </div>

                <div class="form-group">
                  <label>Password</label>  <code class="text-orange">Max. 20 characters</code>
                  <input type="password" class="form-control" placeholder="Password" name="password" maxlength="20" value="<?php echo $password; ?>">
                </div>

                <div class="form-group">
                <label>User Type</label>
                <select class="form-control select2" style="width: 100%;" name="usertype" required>
                  <option value="<?php echo $usertype; ?>"><?php echo $usertype; ?></option>
                  <option>Administrator</option>
                  <option>Manager</option>
                  <option>Cashier</option>
                </select>
              </div>
            <?php  } ?>
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
