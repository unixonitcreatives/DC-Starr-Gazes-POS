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
$lastname=$firstname=$contact=$address=$alertMessage="";

require_once "config.php";
//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $lastname = test_input($_POST['lastname']);
    $firstname = test_input($_POST['firstname']);
    $contact = test_input($_POST['contact']);
    $address = test_input($_POST['address']);
    $id = test_input($_POST['custID']);

    // Validate password
    if(empty($firstname)){
        $alertMessage = "Please enter customer first name.";
    }

    // Validate username
    if(empty($lastname)){
        $alertMessage = "Please enter customer last name.";
    }

    // Check input errors before inserting in database
    if(empty($alertMessage)){

        //Prepare Date for custom ID
        $IDtype = "CS";
        $m = date('m');
        $y = date('y');
        $d = date('d');

        $qry = mysqli_query($link,"SELECT MAX(id) FROM `customers`"); // Get the latest ID
        $resulta = mysqli_fetch_array($qry);
        $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
        $custID = str_pad($newID, 4, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
        $custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID

        $query = "INSERT INTO customers (custID, lastName, firstName, contact, address) 
        VALUES ('$custnewID', '$lastname', '$firstname', '$contact' ,'$address')"; //Prepare insert query

        $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
                                    
                            
        if($result){
//        echo "<script>Notify('new user added succesfully','Success');</script>";

           //logs
        $info = $_SESSION['username']." added a new customer";
        $info2 = "Details: customer: ".$firstname . "&nbsp;". $lastname . ", id: ".$custID."";

        $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
        $r = mysqli_query($link, $q) or die(mysqli_error($link));
        echo "<script>console.log('new user added');</script>";
//        echo "<script>window.href='customer-manage.php'</script>";    
            header("Location: customer-manage.php?alert=addsuccess");
        }else{
        //If execution failed

        $alertMessage = "<div class='alert alert-danger' role='alert'>
        Error adding data.
        </div>";
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
<style>
  textarea {
  resize: none;
}
</style>
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
         Add Customer Accounts<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">
          <div class="row">
          <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Customer's Information</h3>
              <br>View all <a href="customer-manage.php" class="text-center">customer accounts</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="box-body">
                <p><?php echo $alertMessage ?></p>
                <div class="form-group">
                  <label>Last Name</label> <code class="text-orange">Max. 20 characters</code>
                  <input type="text" class="form-control" placeholder="Last Name" name="lastname" oninput="upperCase(this)" maxlength="20" required>
                </div>

                <div class="form-group">
                  <label>First Name</label> <code class="text-orange">Max. 20 characters</code>
                  <input type="text" class="form-control" placeholder="First Name" name="firstname" oninput="upperCase(this)" maxlength="20" required>
                </div>

                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control" id="" placeholder="Phone" name="contact" data-mask>
                </div>

                <div class="form-group">
                  <label>Address</label> <code class="text-orange">Max. 50 characters</code>

                  <textarea class="form-control" rows="3" maxlength="" id="" oninput="upperCase(this)" placeholder="Enter Address" name="address"></textarea>
            
                </div>

              <!-- /.box-body -->
            </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" >Save</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
            
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



</body>
</html>
