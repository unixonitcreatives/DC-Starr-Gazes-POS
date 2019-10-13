<!-- ======================= SESSION =================== -->
<?php include('template/session.php'); ?>
<!-- ======================= USER AUTHENTICATION  =================== -->
<?php
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
 include('template/user_auth.php');
?>
<!-- ========================================== -->
<?php

require_once "config.php";
echo "<script>console.log('Post')</script>";
//If the form is submitted or not.
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){ //dito bro, hindi pumapasok dito kapag inapprove ko

        $alertMessage = "Please enter a user type.";



    // Check input errors before inserting in database
    if(empty($alertMessage)){
      //=======================================================================================================


    $query = "SELECT * FROM generate_po WHERE custID = '".$_GET['custID']."'"; // Get Data of the row approved
      echo $_GET['custID'];  echo "<script>console.log('Test')</script>";

          if($result = mysqli_query($link, $query)){ // Execute Query
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){ // This is where the Magic Begins
                $count = $row['qty']; //$count is equal to the quantity in the PO
                $j = 0; //set lng ng mga variable
                $product_SKU = $row['product_description']; //kukunin product description ng PO
                $warehouse_ID = $row['warehouse_name']; //kukunin warehouse info ng PO
                $stock_status = "In Stock"; //Automatic pag ka approve, In Stock na
                $approved_by = $_SESSION["username"]; //Kung sino nag pindot ng Approve (Check Button)
                $sold_to = "";
                $sold_by = "";

                for ($j = 0; $j < $count; $j++) {//LOOP Start.

                    $IDtype = "SC";//Set yung custom ID natin, mag sisimula lahat sa "SC"

                    $qry = mysqli_query($link,"SELECT MAX(id) FROM `stock`"); // Get the latest ID dun sa stock table
                    $resulta = mysqli_fetch_array($qry);//Execute and fetch data
                    $newID = $resulta['MAX(id)'] + 1; //Get the latest ID then Add 1
                    $custID = str_pad($newID, 8, '0', STR_PAD_LEFT); //Prepare custom ID with Paddings
                    $custnewID = $IDtype.$custID; //Prepare $custom new ID

                    $query = "INSERT INTO stock
                    (custID, product_SKU, warehouse_ID, stock_status, approved_by, sold_to, sold_by, approved_by)
                    VALUES
                    ('$custnewID', '$product_SKU', '$warehouse_ID', '$stock_status', '$sold_to', '$sold_by', '$approved_by')"; //Prepare insert query

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
                }//Loop End


                  }

                }
          }


          /*
          $j = 0;
          //count of product SKU posted
          $count = sizeof($_POST['product_SKU']);
          // Get the id of last table inserted and insert into new table
          $po_trans_id = $link->insert_id;
          //session loggedin user
          $user  = $_SESSION["username"];
          //for loop
          for ($j = 0; $j < $count; $j++) { // LOOP START
              $query = "INSERT INTO table (product_sku,warehouse,user) VALUES (
              '".$po_trans_id."',
              '".$_POST['product_sku'][$j]."',
              '".$_POST['warehouse'][$j]."',
              '".$user."')";

              $result = mysqli_multi_query($link, $query) or die(mysqli_error($link));

              if($result){
                 $alertMessage = "<div class='alert alert-success' role='alert'>
                 New user successfully added in database.
                 </div>";
               }else{
                 $alertMessage = "<div class='alert alert-danger' role='alert'>
                 Error Adding data in Database.
                 </div>";}
          }
          */


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
         Manage PO<br>
        <small>DC Starr Gazes Inventory Management System</small>
      </h1>
    </section>
  <!-- ======================== MAIN CONTENT ======================= -->
    <!-- Main content -->
    <section class="content">
          <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <br><a href="po-generate.php" class="text-center">+ generate new PO</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">PO No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Product SKU</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Warehouse</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Quantity</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Created by</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM generate_po ORDER BY custID, po_status asc";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $row['custID'] . "</td>";
                              echo "<td>" . $row['product_description'] . "</td>";
                              echo "<td>" . $row['warehouse_name'] . "</td>";
                              echo "<td>" . $row['qty'] . "</td>";

                              if($row['po_status']=="Pending"){
                                echo "<td><span class='badge bg-orange'>Pending</span></td>";
                              } elseif ($row['po_status']=="Approved"){
                                echo "<td><span class='badge bg-green'>Approved</span></td>";
                              } elseif ($row['po_status']=="Void"){
                                echo "<td><span class='badge bg-red'>Void</span></td>";
                              } else {
                                echo "<td><span class='badge bg-gray'>Error</span></td>";
                              }

                              echo "<td>" . $row['created_by']." on ". $row['created_at'] . "</td>";
                              echo "<td>";

                              if($row['po_status']=="Pending"){
                                echo "<a href='po-approve.php?custID=". $row['custID'] ."' methodtitle='Approve' data-toggle='tooltip'><span class='glyphicon glyphicon-ok'></span></a>";
                                echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='Void' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";

                              } elseif ($row['po_status']=="Approved"){


                              } elseif ($row['po_status']=="Void"){


                              } else {

                              }

                              echo "</td>";
                              echo "</tr>";
                            }
                            // Free result set
                            mysqli_free_result($result);
                          } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                          }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);
                        ?>
                      </tbody>
                    </table>
            </div>
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
