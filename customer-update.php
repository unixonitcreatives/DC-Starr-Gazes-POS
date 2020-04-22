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

$id = $_GET['id'];

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
    //$id = test_input($_POST['id']);

        $query = "UPDATE customers SET lastName='$lastname', firstName='$firstname',contact='$contact',address='$address' WHERE custID='$id'";  
        $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute query
                                    
                            
        if($result){
             //logs
        $info = $_SESSION['username']." updated a customer";
        $info2 = "Details: customer: ". $firstname . "&nbsp;" . $lastname .", id: ".$id."";

        $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
        $r = mysqli_query($link, $q) or die(mysqli_error($link)); 

        echo "<script>window.location.href='customer-manage.php?alert=updatesuccess'</script>";
        echo "<script>Notify('Customer Updated','Success');</script>";
        echo "<script>console.log('user updated');</script>";
        }else{
        //If execution failed

        $alertMessage = "<div class='alert alert-danger' role='alert'>
        Error updating data.
        </div>";
        }
        //mysqli_close($link);
    
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
          
          <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Customer's Information</h3>
              <br>View all <a href="customer-manage.php" class="text-center">customer accounts</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $id;?>">
              <div class="box-body">
                <?php echo $alertMessage ?></p>
                <?php
                  $q = "SELECT * FROM customers WHERE custID='$id'";
                  $r = mysqli_query($link,$q);

                  while($row = mysqli_fetch_assoc($r)){

                ?>
                <div class="form-group">
                  <label>Last Name</label> <code class="text-orange">Max. 20 characters</code>
                  <input type="text" class="form-control" placeholder="Last Name" name="lastname" oninput="upperCase(this)" maxlength="20" value='<?php echo $row['lastName']; ?>'>
                </div>

                <div class="form-group">
                  <label>First Name</label> <code class="text-orange">Max. 20 characters</code>
                  <input type="text" class="form-control" placeholder="First Name" name="firstname" oninput="upperCase(this)" maxlength="20" value="<?php echo $row['firstName']; ?>">
                </div>

                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control" id="" placeholder="Phone" data-inputmask='"mask": "(999) 999-9999"' name="contact" data-mask value="<?php echo $row['contact']; ?>">
                </div>

                <div class="form-group">
                  <label>Address</label> <code class="text-orange">Max. 50 characters</code>

                  <textarea class="form-control" rows="3" maxlength="" id="" oninput="upperCase(this)" placeholder="Enter Address" name="address" ><?php echo $row['address']; ?></textarea>
            
                </div>

              <?php }?>

              <!-- /.box-body -->
            </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success pull-right" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" >Save</button>
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
