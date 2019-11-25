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
require_once "config.php";

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
                                 if(mysqli_num_rows($result) > 0){
                                    //If the username already exists
                                    //Try another username pop up
                                    echo "<script>alert('product SKU already exist','success');</script>";
                                    echo "<script>console.log('Username already exist');</script>";
                                    mysqli_free_result($result);
                                 } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database

                                    //Prepare Date for custom ID
                                    $IDtype = "PM";
                                    $m = date('m');
                                    $y = date('y');
                                    $d = date('d');

                                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `product_model`"); // Get the latest ID
                                    $resulta = mysqli_fetch_array($qry);
                                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                    $custID = str_pad($newID, 7, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                    $custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID

                                    $query = "INSERT INTO product_model (custID, product_description, product_SKU, product_category, product_sub_category, product_supplier, supplier_price, sell_price, suggested_retail_price, product_detail)
                                    VALUES ('$custnewID', '$product_description', '$product_SKU', '$product_category','$product_sub_category', '$product_supplier', '$supplier_price', '$sell_price', '$SRP', '$product_detail')"; //Prepare insert query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query


                                    if($result){
                                    //echo "<script>Notify('new product model added succesfully','Success');</script>";
                                    //echo "<script>console.log('new user added');</script>";
                                    header("Location: product-model-manage.php?alert=addsuccess");
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
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="box-body">
                <?php echo $alertMessage ?></p>

                <div class="form-group">
                  <label>Product Description</label>
                  <input type="text" class="form-control" placeholder="Product Description" name="product_description" oninput="upperCase(this)" maxlength="150" required>
                </div>

                <div class="form-group">
                  <label>SKU</label>
                  <input type="text" class="form-control" placeholder="Stock Keeping Unit" name="product_SKU" oninput="upperCase(this)" maxlength="50" required>
                </div>

                <div class="form-group">
                <label>Category</label>
                <select class="form-control select2" style="width: 100%;" name="product_category" required>
                        <?php
                        // Include config file
                        require_once "config.php";
                        // Attempt select query execution
                        $query = "";
                        $query = "SELECT * FROM categories ORDER BY category_name asc";
                        // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){

                        echo "<option value='".$row['custID']."'>" . $row['category_name'] .  "</option>";
                        }

                         // Free result set
                        mysqli_free_result($result);
                        } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }


                        ?>
                </select>
              </div>

              <div class="form-group">
                <label>Sub-Category</label>
                <select class="form-control select2" style="width: 100%;" name="product_sub_category" required>
                        <?php
                        // Include config file
                        require_once "config.php";
                        // Attempt select query execution
                        $query = "";
                        $query = "SELECT * FROM categories_sub ORDER BY sub_category_name asc";
                        // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){

                        echo "<option value='".$row['custID']."'>" . $row['sub_category_name'] .  "</option>";
                        }

                         // Free result set
                        mysqli_free_result($result);
                        } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }


                        ?>
                </select>
              </div>

              <div class="form-group">
                <label>Supplier</label>
                <select class="form-control select2" style="width: 100%;" name="product_supplier" required>
                        <?php
                        // Include config file
                        require_once "config.php";
                        // Attempt select query execution
                        $query = "";
                        $query = "SELECT * FROM supplier ORDER BY supplier_name asc";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){

                        echo "<option value='".$row['custID']."'>" . $row['supplier_name'] .  "</option>";
                        }

                         // Free result set
                        mysqli_free_result($result);
                        } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        mysqli_close($link);

                        ?>
                </select>
              </div>

                <div class="form-group">
                  <label>Supplier Price</label>
                  <input type="text" class="form-control" placeholder="Supplier Price" name="supplier_price" oninput="upperCase(this)" maxlength="50" required>
                </div>

                <div class="form-group">
                  <label>Sell Price</label>
                  <input type="text" class="form-control" placeholder="Sell Price" name="sell_price" oninput="upperCase(this)" maxlength="50" required>
                </div>

                <div class="form-group">
                  <label>Suggested Retail Price (SRP)</label>
                  <input type="text" class="form-control" placeholder="SRP" name="SRP" oninput="upperCase(this)" maxlength="50" required>
                </div>

                <div class="form-group">
                  <label>Detail</label>
                  <textarea class="form-control" rows="3" maxlength="300" id="" oninput="upperCase(this)" placeholder="This text area has a limit of 300 char" name="product_detail"></textarea>
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
