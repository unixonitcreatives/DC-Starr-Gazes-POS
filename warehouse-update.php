<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
$Admin_auth = 1;
$Manager_auth = 0;
$Cashier_auth = 0;
include('template/user_auth.php');
?>

<?php
// Define variables and initialize with empty values
$warehouse_name=$address=$alertMessage="";

require_once "config.php";


$get_warehouse_id = $_GET['id'];

$query = "SELECT * from warehouse WHERE id='$get_warehouse_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)){
    $row_custID           =   $row['custID'];
    $row_warehouse_name   =   $row['warehouse_name'];
    $row_address          =   $row['address'];

  }
}

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //Assigning posted values to variables.
  $warehouse_name = test_input($_POST['warehouse']);
  $address = test_input($_POST['address']);

  // Validate warehouse name
  if(empty($warehouse_name)){
    $alertMessage = "Please enter warehouse name";
  }

  // Validate address
  if(empty($address)){
    $alertMessage = "Please enter an address.";
  }

  // Check input errors before inserting in database
  if(empty($alertMessage)){

    $query = "UPDATE warehouse SET warehouse_name='$warehouse_name', address='$address' WHERE id='$get_warehouse_id'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query


    if($result){
      header("Location: warehouse-manage.php?alert=updatesuccess");
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
          Add Warehouse<br>
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
              <h3 class="box-title">Warehouse' Information</h3>
              <br>View all <a href="warehouse-manage.php" class="text-center">warehouse</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $get_warehouse_id; ?>">
              <div class="box-body">
                <?php echo $alertMessage ?></p>
                <div class="form-group">
                  <label>Warehouse Name</label> <code class="text-orange">Max. 30 characters</code>
                  <input type="text" class="form-control" placeholder="Warehouse Name" name="warehouse" oninput="upperCase(this)" maxlength="30" value="<?php echo $row_warehouse_name; ?>"  required>
                </div>

                <div class="form-group">
                  <label>Address</label> <code class="text-orange">Max. 100 characters</code>
                  <textarea class="form-control" rows="3" maxlength="100" id="" oninput="upperCase(this)" placeholder="Enter Address" name="address"><?php echo $row_address; ?></textarea>

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
