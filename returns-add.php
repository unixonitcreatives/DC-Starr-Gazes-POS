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
$alertMessage="";

require_once "config.php";

//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  //Assigning posted values to variables.
  $date_p = test_input($_POST['date_p']);
  $si = test_input($_POST['trans']);
  $customer = test_input($_POST['customer']);
  $item = test_input($_POST['item']);
  $qty = test_input($_POST['qty']);
  $cashier = test_input($_POST['cashier']);
  $remarks = test_input($_POST['remarks']);

  // Validate password
  if(empty($date_p)){
      $alertMessage = "Please enter a date of purchase.";
  }

  // Validate username
  if(empty($si)){
      $alertMessage = "Please enter a transaction id.";
  }

  // Validate user type
  if(empty($customer)){
      $alertMessage = "Please enter a customer.";
  }

  if(empty($item)){
      $alertMessage = "Please enter a item.";
  }

  if(empty($qty)){
      $alertMessage = "Please enter a quantity.";
  }

  if(empty($cashier)){
      $alertMessage = "Please enter a cashier name.";
  }

  // if(empty($remarks)){
  //     $alertMessage = "Please enter a remarks.";
  // }


  // Check input errors before inserting in database
//  if(empty($alertMessage)){
          //Check if the username is already in the database
      
          //Prepare Date for custom ID
//          $IDtype = "ACC";
//          $m = date('m');
//          $y = date('y');
//          $d = date('d');
//
//          $qry = mysqli_query($link,"SELECT MAX(id) FROM `users`"); // Get the latest ID
//          $resulta = mysqli_fetch_array($qry);
//          $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
//          $custID = str_pad($newID, 4, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
//          $custnewID = $IDtype.$m.$d.$y.$custID; //Prepare custom ID
          $date = date("Y-m-d");

          $query = "INSERT INTO returns (date_purchase, trans_id, customer, item, qty, cashier, remarks, created_at) 
                         VALUES ('$date_p', '$si', '$customer', '$item', '$qty', '$cashier', '$remarks', '$date')"; //Prepare insert query

          $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
          
          
        if($result){
            header('Location: returns-manage.php');
//          echo "<script>Notify('Return succesfully','Success');</script>";
//          echo "<script>console.log('new user added');</script>";
        }else{
          //If execution failed
          $alertMessage = "<div class='alert alert-danger' role='alert'>
          Error adding data.
          </div>";
        }
         
        
//      } else{
//       echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
//     }

   
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
<div class="content-wrapper" style="height: 879px">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
       Add Returns<br>
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
            <h3 class="box-title">Return Information</h3>
            <br>View all <a href="returns-manage.php" class="text-center">Returns</a>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="box-body">
              <p><?php echo $alertMessage ?></p>
              <div class="form-group">
                <label>Date of Purchase</label> <!--<code class="text-orange">Max. 10 characters</code>-->
                <input type="date" class="form-control" style="width: 100%;" name="date_p" required>
              </div>
              
              <div class="form-group">
                <label>Trans. ID</label> <!--<code class="text-orange">Max. 10 characters</code>-->
                <select class="form-control select2" style="width: 100%;" name="trans" required>
                <?php 
                  
                  $q = "SELECT * FROM sales_order WHERE mop='Cash' OR mop='Installment'";
                  $r = mysqli_query($link,$q);
              
                  while($row = mysqli_fetch_assoc($r)){
                  
                ?>      
                  
                <option value="<?php echo $row['txID']; ?>"> <?php echo $row['txID']; ?></option>
                
               <?php }?>
              </select>
              </div>
                
              <div class="form-group">
                <label>Customer</label> <!--<code class="text-orange">Max. 10 characters</code>-->
                <select class="form-control select2" style="width: 100%;" name="customer" required>
                <?php 
                  
              $q = "SELECT * FROM customers";
              $r = mysqli_query($link,$q);
              
              while($row = mysqli_fetch_assoc($r)){
                  
                ?>      
                  
                <option value="<?php echo $row['lastName'] . "," . $row['firstName']; ?>"> <?php echo $row['lastName'] . "," . $row['firstName'] ?></option>
                
               <?php }?>
              </select>
              </div>

          <div class="form-group">
              <label>Item</label>
              <select class="form-control select2" style="width: 100%;" name="item" required>
                  <?php
                  
                  $qq = "SELECT stock.custID, stock.PO_ID, product_model.product_description, product_model.product_SKU FROM stock INNER JOIN product_model on product_model.product_SKU = stock.PO_ID";
                  $rr = mysqli_query($link,$qq);
                  
                  while($row = mysqli_fetch_assoc($rr)){
                  ?>
                  
                  <option value="<?php echo $row['product_description']; ?>"><?php echo $row['custID'] . '-' . $row['product_description']; ?></option>
                
                  <?php }?>
              </select>
          </div>
                
          <div class="form-group">
              <label>Quantity</label>
              <input type="number" class="form-control" style="width: 100%;" name='qty' required>
          </div>
                
          <div class="form-group">
              <label>Cashier Name</label>
              <select class="form-control select2" style="width: 100%;" name="cashier" required>
                  <?php
                  
                  $qq = "SELECT * FROM users WHERE usertype='Cashier'";
                  $rr = mysqli_query($link,$qq);
                  
                  while($row = mysqli_fetch_assoc($rr)){
                  ?>
                  
                  <option value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></option>
                
                  <?php }?>
              </select>
          </div>
                
          <div class="form-group">
              <label>Remarks</label>
              <textarea class="form-control" style="width: 100%;" name='remarks' rows="4"></textarea>
          </div>      
              
            <!-- /.box-body -->
          </div>
              
            <div class="box-footer">
              <button type="submit" class="btn btn-default" onclick="this.disabled=true;this.value='Submitting...'; this.form.submit();" >Save</button>
            </div>
              
          </form> <!-- /.form -->
        </div>
        <!-- /.box -->

      </div>
  </section>
<!-- /.content-wrapper -->
      </div>
  </div>
  


<!-- =========================== FOOTER =========================== -->
<footer class="main-footer">
    <?php include('template/footer.php'); ?>
</footer>


<!-- =========================== JAVASCRIPT ========================= -->
    <?php include('template/js.php'); ?>



</body>
</html>
