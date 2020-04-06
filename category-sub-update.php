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
$category=$alertMessage="";

require_once "config.php";


$get_subCategory_id = $_GET['id'];

$query = "SELECT categories.category_name as parent_category, categories_sub.sub_category_name as sub_category_name from categories_sub, categories WHERE categories_sub.id= '$get_subCategory_id' ";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)){
    $row_sub_category_name    =   $row['sub_category_name'];
    $row_parent_category_name =   $row['parent_category'];
  }
}


//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //Assigning posted values to variables.
    $category = test_input($_POST['category']);
    $p_category = test_input($_POST['p_category']);

    // Validate user type
    if(empty($category)){
        $alertMessage = "Please enter a category.";
    }

    // Check input errors before inserting in database
    if(empty($alertMessage)){
        //Check if the username is already in the database
        $sql_check = "SELECT sub_category_name FROM categories_sub WHERE sub_category_name ='$category' AND parent_category ='$p_category'";
        if($result = mysqli_query($link, $sql_check)){ //Execute query
                                 if(mysqli_num_rows($result) > 0){
                                    //If the username already exists
                                    //Try another username pop up
                                    echo "<script>Notify('Sub-Category Exist Already','Warn');</script>";
                                    //header("Location: category-add.php?alert=2");
                                    mysqli_free_result($result);
                                 } else{
                                    //If the username doesnt exist in the database
                                    //Proceed adding to database
                                    //Prepare Date for custom ID
                                    $IDtype = "SCT";
                                    $m = date('m');
                                    $y = date('y');
                                    $d = date('d');

                                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `categories_sub`"); // Get the latest ID
                                    $resulta = mysqli_fetch_array($qry);
                                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                                    $custID = str_pad($newID, 5, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                                    $custnewID = $IDtype.$custID; //Prepare custom ID

                                    $query = "UPDATE categories_sub SET sub_category_name='$category', parent_category='$p_category' WHERE id='$get_subCategory_id' ";
                                    $result = mysqli_query($link, $query) or die(mysqli_error($link)); //Execute  insert query

                                    if($result){
                                    //echo "<script>Notify('Category Added Succesfully','Success');</script>";
                                      $info = $_SESSION['username']." updated a sub-category";
                                      $info2 = "Details: sub-category name: ".$category.", parent-category: ".$p_category."";

                                      $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
                                      $r = mysqli_query($link, $q) or die(mysqli_error($link)); 
                                    header("Location: category-sub-manage.php?alert=updatesuccess");

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
         Add Sub-Category<br>
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
              <h3 class="box-title">Sub-Category Details</h3>
              <br>View all <a href="category-sub-manage.php" class="text-center">sub-categories</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $get_subCategory_id; ?>">
              <div class="box-body">
                <?php echo $alertMessage ?></p>
                <div class="form-group">
                  <label>Sub-Category Name</label> <code class="text-orange">Max. 20 characters</code>
                  <input type="text" class="form-control" placeholder="Category" name="category" oninput="upperCase(this)" maxlength="20"  value="<?php echo $row_sub_category_name; ?>" required>
                </div>

                 <div class="form-group">
                <label>Parent Category</label>
                <select class="form-control select2" style="width: 100%;" name="p_category" required>
                    <option><?php echo $row_parent_category_name; ?></option>
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
