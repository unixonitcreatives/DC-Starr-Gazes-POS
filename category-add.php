<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php 
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
 include('template/user_auth.php');
?>
<!-- =========================== JAVASCRIPT ========================= -->
<?php include('template/js.php'); ?>
<!-- =========================== PAGE PHP =========================== -->
<?php
// Define variables and initialize with empty values
$category=$alertMessage="";

require_once "config.php";



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
        //Check if the username is already in the database
        $sql_check = "SELECT category_name FROM categories WHERE category_name ='$category'";
        if($result = mysqli_query($link, $sql_check)){ //Execute query
                                 if(mysqli_num_rows($result) > 0){
                                    //If the username already exists
                                    //Try another username pop up
                                    echo "<script>Notify('Category Exist Already','Warn');</script>";
                                    //header("Location: category-add.php?alert=2");
                                    mysqli_free_result($result);
                                 } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database

                                    //Prepare Date for custom ID
                                    $IDtype = "CT";
                                    $m = date('m');
                                    $y = date('y');
                                    $d = date('d');

                                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `categories`"); // Get the latest ID
                                    $resulta = mysqli_fetch_array($qry);
                                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                    $custID = str_pad($newID, 4, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                    $custnewID = $IDtype.$custID; //Prepare custom ID

                                    $query = "INSERT INTO categories (custID, category_name) 
                                                   VALUES ('$custnewID', '$category')"; //Prepare insert query

                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query
                                    
                                    if($result){
                                    echo "<script>Notify('Category Added Succesfully','Success');</script>";
                                    //header("Location: category-add.php?alert=1");
                                    }else{
                                    echo "<script>Notify('Category Add Failed','Error');</script>";
                                    //header("Location: category-add.php?alert=3");
                                    }
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
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="box-body">
                <?php echo $alertMessage ?></p>
                <div class="form-group">
                  <label>Category Name</label> <code class="text-orange">Max. 20 characters</code>
                  <input type="text" class="form-control" placeholder="Category" name="category" oninput="upperCase(this)" maxlength="20" required>
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




</body>
</html>
