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
$product_SKU=
$warehouse_name=
$po_status=
$created_by=
$qty=
$expiry="";

require_once "config.php";

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $product_SKU = test_input($_POST['product_SKU']);
    $warehouse_name = test_input($_POST['warehouse_name']);
    $qty = test_input($_POST['qty']);
    $expiry = test_input($_POST['expiry']);


    if(empty($product_SKU)){
        $alertMessage = "Please enter product model.";
    }

    if(empty($warehouse_name)){
        $alertMessage = "Please enter warehouse name.";
    }

    if(empty($qty)){
        $alertMessage = "Please enter product quantity.";
    }

    if(empty($expiry)){
        $alertMessage = "Please enter expiry date.";
    }



    if(empty($alertMessage)){

        $sql_check = "SELECT custID FROM generate_po WHERE custID ='asd'";
        if($result = mysqli_query($link, $sql_check)){ //Execute query
                                 if(mysqli_num_rows($result) > 0){
                                    mysqli_free_result($result);
                                 } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database

                                    //Prepare Date for custom ID
                                    $IDtype = "PO";
                                    $m = date('m');
                                    $y = date('y');
                                    $d = date('d');

                                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `generate_po`"); // Get the latest ID
                                    $resulta = mysqli_fetch_array($qry);
                                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                    $custID = str_pad($newID, 7, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                    $custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID

                                    $query = "INSERT INTO generate_po
                                    (custID, product_description, warehouse_name, qty, expiry_date, po_status, created_by)
                                    VALUES
                                    ('$custnewID', '$product_SKU', '$warehouse_name', '$qty', '$expiry','Pending', 'Vince')"; //Prepare insert query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query


                                    if($result){
                                    echo "<script>Notify('new product model added succesfully','Success');</script>";
                                    echo "<script>console.log('new user added');</script>";
                                    echo "<script>window.location('po-manage.php');</script>";
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
         Generate PO<br>
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
              <h3 class="box-title">Purchase Order's Details</h3>
              <br><a href="po-manage.php" class="text-center">Manage PO</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="box-body">
                <?php echo $alertMessage ?></p>
              <div class="col-md-12">
                <div class="form-group">
                <label>Product SKU</label>
                <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)"  data-placeholder="Input SKU" name="product_SKU" required>
                        <?php
                        // Include config file
                        require_once "config.php";
                        // Attempt select query executions
                        $query = "";
                        $query = "SELECT * FROM product_model ORDER BY product_SKU asc";
                        // $query = "SELECT * FROM orders WHERE name LIKE '%$name%' AND item LIKE '%$item%' AND status LIKE '%$status%'";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){

                        echo "<option value='".$row['product_SKU']."'>" . $row['product_SKU'] .  "</option>";
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
                <label>Warehouse</label>
                <select class="form-control select2" style="width: 100%;" oninput="upperCase(this)" name="warehouse_name" required>
                        <?php
                        // Include config file
                        require_once "config.php";
                        // Attempt select query execution
                        $query = "";
                        $query = "SELECT * FROM warehouse ORDER BY warehouse_name asc";
                        if($result = mysqli_query($link, $query)){
                        if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){

                        echo "<option value='".$row['custID']."'>" . $row['warehouse_name'] .  "</option>";
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
                  <label>Quantity</label>
                  <input type="text" class="form-control" placeholder="Quantity" name="qty" oninput="upperCase(this)" maxlength="50" required>
                </div>

                <div class="form-group">
                  <label>Expirtation Date:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="expiry" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                  </div>
                  <!-- /.input group -->
                </div>

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
