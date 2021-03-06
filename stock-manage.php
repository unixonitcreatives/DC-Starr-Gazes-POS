  <!-- ======================= SESSION =================== -->
  <?php include('template/session.php'); ?>
  <!-- ======================= USER AUTHENTICATION  =================== -->
  <?php
  $Admin_auth = 1;
  $Manager_auth = 0;
  $Cashier_auth = 0;
  include('template/user_auth.php');

  ?>
  <!-- ====================Expired Script====================== -->
  <?php
  $alertMessage = "";

  // Include config file
  include ('config.php');

  $curdate = date("Y-m-d");

    //insert into expired product table
    $insertToExpList = "INSERT INTO expired_stocks (custID, PO_ID, product_SKU, warehouse_ID, stock_status, expiry_date, approved_by, created_at) SELECT custID, PO_ID, product_SKU, warehouse_ID, stock_status,  expiry_date, approved_by, created_at FROM stock WHERE expiry_date = '".$curdate."' ";
    $insertResult = mysqli_query($link, $insertToExpList);

    //if already inserted, delete from product list
    if($insertResult){
        $updateStatus = "UPDATE stock SET stock_status = 'Expired' WHERE expiry_date <= '$curdate'";
        $updateResult = mysqli_query($link, $updateStatus);

      if($updateResult){
        $deleteFromList = "DELETE from stock WHERE stock_status = 'Expired' ";
        $deleteResult = mysqli_query($link, $deleteFromList);

        $updateExpired = "UPDATE expired_stocks SET stock_status = 'Expired'";
        $updateResultEx = mysqli_query($link,$updateExpired);

        $alertMessage = "<div class='alert alert-success' role='alert'>Expired products transfered to expired section.</div>";
      }else {
        $alertMessage = "<div class='alert alert-danger' role='alert'>Error updating stocks.</div>";
      }
    }

    include("simple_html_dom.php");


//$rows = $tables->children(0)->children();


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
            Stock Manage (In-Stock)<br>
            <small>DC Starr Gazes Inventory Management System <?php echo $curdate; ?></small>
          </h1>
        </section>
        <!-- ======================== MAIN CONTENT ======================= -->
        <!-- Main content -->
        <section class="content">    
            <!-- general form elements -->
            <div class="box box-default">
                <!-- <br><a href="po-generate.php" class="text-center">+ generate new PO</a> -->
    
              <div class="box-body">
                <button type="button" class="btn btn-primary pull-right" id='export' onclick="ExportToExcel()">Export To Excel</button>
                  <br><br>
                
                <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  
                    
                  <thead id="headers">
                      
                    <tr>
                        
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SC No.</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SKU</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">PO No.</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Warehouse</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Expiry Date</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Approved By</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Attempt select query execution
                    $query = "SELECT * FROM stock WHERE stock_status='In Stock' ORDER BY custID, warehouse_ID asc";
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
                            echo "<td>" . $row['expiry_date'] . "</td>";
                          } elseif ($row['stock_status']=="Sold"){
                            echo "<td><span class='badge bg-orange'>Sold</span></td>";
                            echo "<td>" . $row['expiry_date'] . "</td>";
                          } elseif ($row['stock_status']=="Void"){
                            echo "<td><span class='badge bg-red'>Void</span></td>";
                            echo "<td>" . $row['expiry_date'] . "</td>";
                          } else {
                            echo "<td><span class='badge bg-gray'>Error</span></td>";
                            echo "<td>" . $row['expiry_date'] . "</td>";
                          }

                          echo "<td>" . $row['approved_by']." on ". $row['created_at'] . "</td>";
               
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
        </section>
        <!-- /.content-wrapper -->
      </div>

      



      <!-- =========================== FOOTER =========================== -->
      <footer class="main-footer">
        <?php include('template/footer.php'); ?>
      </footer>

      <!-- =========================== JAVASCRIPT ========================= -->
      <?php include('template/js.php'); ?>


      

     <script type="text/javascript">


function ExportToExcel(){
       var downloadLink;
       var htmltable= document.getElementById('example1');
       var tb = "<table><thead></thead></table>"
       var html = htmltable.outerHTML + tb;

       // var headers = $('#headers').remove();
       // var html = headers + htmltable.outerHTML;
     
     downloadLink = document.createElement("a");

       //window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
     if(navigator.msSaveOrOpenBlob){
        var blob = new Blob([html], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob );
    }else{
        // Create a link to the file
        downloadLink.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
    
        //triggering the function
        downloadLink.click();
}


    }


   
</script>

    </body>
    </html>
