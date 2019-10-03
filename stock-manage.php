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
         Stock<br>
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
              <!-- <br><a href="po-generate.php" class="text-center">+ generate new PO</a> -->
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SC No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">PO No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SKU</th>

                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Warehouse</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>

                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Approved By</th>

                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM stock ORDER BY custID, stock_status asc";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $row['custID'] . "</td>";
                              echo "<td>" . $row['product_SKU'] . "</td>";
                              echo "<td>" . $row['PO_ID'] . "</td>";
                              echo "<td><a href='warehouse-view.php?WHid=".$row['warehouse_ID']."'>" . $row['warehouse_ID'] . "</a></td>";

                              if($row['stock_status']=="In Stock"){
                                echo "<td><span class='badge bg-green'>In Stock</span></td>";
                              } elseif ($row['stock_status']=="Sold"){
                                echo "<td><span class='badge bg-orange'>Sold</span></td>";
                              } elseif ($row['stock_status']=="Void"){
                                echo "<td><span class='badge bg-red'>Void</span></td>";
                              } else {
                                echo "<td><span class='badge bg-gray'>Error</span></td>";
                              }

                              echo "<td>" . $row['approved_by']." on ". $row['created_at'] . "</td>";
                              echo "<td>";

                              if($row['stock_status']=="In Stock"){
                                echo " &nbsp; <a href='#". $row['id'] ."' title='Some Function Here' data-toggle='tooltip'><span class='glyphicon glyphicon-ok'></span></a>";

                                echo " &nbsp; <a href='#". $row['id'] ."' title='Some Function Here' data-toggle='tooltip'><span class='glyphicon glyphicon-cog'></span></a>";

                                echo " &nbsp; <a href='#". $row['id'] ."' title='Print Barcode' data-toggle='tooltip'><span class='glyphicon glyphicon-barcode'></span></a>";

                                echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='Void' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";

                              } elseif ($row['po_status']=="Sold"){


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


<!-- =========================== PAGE SCRIPT ======================== -->

<!-- Alert animation -->
<script type="text/javascript">
$(document).ready(function () {

  window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
      $(this).remove();
    });
  }, 1000);

});
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>



</body>
</html>
