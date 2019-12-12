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
$product_description=$product_SKU=$product_category=$product_supplier=$supplier_price=$sell_price=$product_detail=$alertMessage="";
$row_custID=$row_product_description=$row_product_SKU=$row_category=$row_product_category=$row_product_supplier=$row_supplier_price= $row_sell_price=$row_srp=$row_product_detail="";

require_once "config.php";

$get_productModel_id = $_GET['id'];

$query = "SELECT * FROM product_model WHERE id= '$get_productModel_id' ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)){
    $row_custID    =   $row['custID'];
    $row_product_description    =   $row['product_description'];
    $row_product_SKU   =   $row['product_SKU'];
    $row_product_category    =   $row['product_category'];
    $row_product_sub_category    =   $row['product_sub_category'];
    $row_product_supplier    =   $row['product_supplier'];
    $row_supplier_price = $row['supplier_price'];
    $row_sell_price = $row['sell_price'];
    $row_srp = $row['suggested_retail_price'];
    $row_product_detail = $row['product_detail'];


  }
}


//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //Assigning posted values to variables.
  $product_description = test_input($_POST['product_description']);
  $product_SKU = test_input($_POST['product_SKU']);
  $product_category = test_input($_POST['product_category']);
  $product_sub_category = test_input($_POST['product_sub_category']);
  $product_supplier = test_input($_POST['product_supplier']);
  $supplier_price = test_input($_POST['supplier_price']);
  $sell_price = test_input($_POST['sell_price']);
  $SRP = test_input($_POST['SRP']);
  $product_detail = test_input($_POST['product_detail']);

  //validations
  if(empty($product_description)){
    $alertMessage = "Please enter product description.";
  }


  if(empty($product_SKU)){
    $alertMessage = "Please enter product SKU.";
  }


  if(empty($product_category)){
    $alertMessage = "Please enter product category.";
  }


  if(empty($product_supplier)){
    $alertMessage = "Please enter product supplier.";
  }

  // Check input errors before inserting in database
  if(empty($alertMessage)){
    //Check if the username is already in the database
    $sql_check = "SELECT product_SKU FROM product_model WHERE product_SKU ='$product_SKU'";
    if($result = mysqli_query($link, $sql_check)){ //Execute query

      $query = "UPDATE  product_model SET custID='$custnewID', product_description='$product_description', product_SKU='$product_SKU', product_category='$product_category', product_sub_category='$product_sub_category', product_supplier='$product_supplier', supplier_price='$supplier_price', sell_price='$sell_price', suggested_retail_price='$SRP', product_detail='$product_detail' WHERE id='$get_productModel_id'";
      $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

      if($result){
        //echo "<script>Notify('new product model added succesfully','Success');</script>";
        //echo "<script>console.log('new user added');</script>";
        header("Location: product-model-manage.php?alert=updatesuccess");
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
          Add Product Model<br>
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
                <h3 class="box-title">Product Model's Information</h3>
                <br>View all <a href="product-model-manage.php" class="text-center">product model</a>
              </div>

              

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
