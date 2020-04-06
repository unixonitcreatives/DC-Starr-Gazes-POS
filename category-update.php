<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
$Admin_auth = 1;
$Manager_auth = 0;
$Cashier_auth = 0;
include('template/user_auth.php');
?>

<!-- =========================== PAGE PHP =========================== -->
<?php
// Define variables and initialize with empty values
$alertMessage="";

require_once "config.php";

$get_category_id = $_GET['id'];

$query = "SELECT * from categories WHERE id='$get_category_id'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)){
    $row_category    =   $row['category_name'];
  }
}

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //Assigning posted values to variables.
  $category = test_input($_POST['category']);

  // Validate user type
  if(empty($category)){
    $alertMessage = "Please enter a category.";
  }

  // Check input errors before inserting in database
  if(empty($alertMessage)){

    $query = "UPDATE categories SET category_name='$category' WHERE id='$get_category_id' ";

    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

    if($result){
      //echo "<script>Notify('Category Added Succesfully','Success');</script>";
      $info = $_SESSION['username']." updated a category";
      $info2 = "Details: category name: ".$category.", id: ".$get_category_id."";

      $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)";
      $r = mysqli_query($link,$q); //Prepare insert query
      header("Location: category-manage.php?alert=success");
    }else{
      echo "<script>Notify('Category Add Failed','Error');</script>";
      //header("Location: category-add.php?alert=3");
    }
    mysqli_close($link);
  }
} else{
  echo "ERROR: Could not able to execute. " . mysqli_error($link);
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
          Add Category<br>
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
              <h3 class="box-title">Category Details</h3>
              <br>View all <a href="category-manage.php" class="text-center">categories</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $get_category_id; ?>">
              <div class="box-body">
                <?php echo $alertMessage ?></p>
                <div class="form-group">
                  <label>Category Name</label> <code class="text-orange">Max. 20 characters</code>
                  <input type="text" class="form-control" placeholder="Category" name="category" oninput="upperCase(this)" maxlength="20" value="<?php echo $row_category; ?>" required>
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

    <!-- =========================== JAVASCRIPT ========================= -->
    <?php include('template/js.php'); ?>

    <!-- =========================== FOOTER =========================== -->
    <footer class="main-footer">
      <?php include('template/footer.php'); ?>
    </footer>


  </body>
  </html>
