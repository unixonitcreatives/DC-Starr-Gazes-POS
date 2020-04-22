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

$get_supplier_id = $_GET['id'];

$query = "SELECT * from supplier WHERE id='$get_supplier_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)){
    $row_custID           =   $row['custID'];
    $row_supplier_name    =   $row['supplier_name'];
    $row_contact_person   =   $row['supplier_contact_person'];
    $row_contact_no       =   $row['supplier_contact_no'];
    $row_supplier_email   =   $row['supplier_email'];
    $row_supplier_address =   $row['supplier_address'];
    $row_created_at       =   $row['created_at'];
  }
}

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //Assigning posted values to variables.
  $supplier_name = test_input($_POST['supplier_name']);
  $supplier_contact_person = test_input($_POST['supplier_contact_person']);
  $supplier_contact_no = test_input($_POST['supplier_contact_no']);
  $supplier_email = test_input($_POST['supplier_email']);
  $supplier_address = test_input($_POST['supplier_address']);

  // Validate inputs
  if(empty($supplier_name)){
    $alertMessage = "Please enter a supplier name";
  }
  if(empty($supplier_contact_person)){
    $alertMessage = "Please enter a contact person";
  }
  if(empty($supplier_contact_no)){
    $alertMessage = "Please enter a email address";
  }
  if(empty($supplier_address)){
    $alerMessage = "Please enter a address";
  }

  // Check input errors before inserting in database
  if(empty($alertMessage)){
    //Check if the username is already in the database
    $sql_check = "UPDATE supplier SET supplier_name='$supplier_name', supplier_contact_person='$supplier_contact_person', supplier_contact_no='$supplier_contact_no', supplier_email='$supplier_email', supplier_address='$supplier_address' WHERE  id='$get_supplier_id'  ";
    $result = mysqli_query($link, $sql_check); //Execute query
    if($result){
      $info = $_SESSION['username']." updated a supplier data";
      $info2 = "Details: supplier name: ".$supplier_name. "";

      $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
      $r = mysqli_query($link, $q) or die(mysqli_error($link)); 

      header("Location: supplier-manage.php?alert=success");
      //echo "<script>Notify('Supplier Info Updated','Success');</script>";
      //echo "<script>console.log('Error Updating Supplier Info');</script>";
    }else{
      //If execution failed
      $alertMessage = "<div class='alert alert-danger' role='alert'>
      Error Updating Supplier Info
      </div>";}
      mysqli_close($link);
    }
  } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }

  mysqli_close($link);



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
          Add Supplier<br>
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
                <h3 class="box-title">Supplier's Information</h3>
                <br>View all <a href="supplier-manage.php" class="text-center">supplier accounts</a>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $get_supplier_id; ?>">
                <div class="box-body">
                  <?php echo $alertMessage ?></p>

                  <div class="form-group">
                    <label>Supplier</label> <code class="text-orange">Max. 50 characters</code>
                    <input type="text" class="form-control" placeholder="Supplier Name" name="supplier_name" oninput="upperCase(this)" maxlength="50" value="<?php echo $row_supplier_name; ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Contact Person</label> <code class="text-orange">Max. 50 characters</code>
                    <input type="text" class="form-control" placeholder="Contact Person" name="supplier_contact_person" oninput="upperCase(this)" maxlength="50" value="<?php echo $row_contact_person; ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" class="form-control" id="" placeholder="Contact No." data-inputmask='"mask": "(999) 999-9999"' name="supplier_contact_no" value="<?php echo $row_contact_no; ?>" data-mask>
                  </div>

                  <div class="form-group">
                    <label>E-mail</label> <code class="text-orange">Max. 30 characters</code>
                    <input type="email" class="form-control" placeholder="E-mail" name="supplier_email" oninput="" maxlength="30" value="<?php echo $row_supplier_email; ?>" required>
                  </div>

                  <div class="form-group">
                    <label>Address</label> <code class="text-orange">Max. 100 characters</code>
                    <textarea class="form-control" rows="3" maxlength="100" id="" oninput="upperCase(this)" placeholder="Enter Address" name="supplier_address" ><?php echo $row_supplier_address; ?></textarea>
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
        <!-- /.wrapper -->
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
