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
      $updateStatus = "UPDATE expired_stocks SET stock_status = 'Expired' ";
      $updateResult = mysqli_query($link, $updateStatus);

      if($updateResult){
        $deleteFromList = "DELETE from stocks WHERE expiry_date = '".$curdate."' ";
        $deleteResult = mysqli_query($link, $deleteFromList);

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
        <?php echo $alertMessage; ?>
        <!-- Main content -->
        <section class="content">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-default">
           
               
                <!-- <br><a href="po-generate.php" class="text-center">+ generate new PO</a> -->
    
              <div class="box-body">
                
                 <div id="tb-w">
                <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <button type="button" class="btn btn-primary pull-right" id='export' onclick="ExportToExcel()">Export To Excel</button>
                  <thead id="headers">
                    <tr>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SC No.</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">PO No.</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">SKU</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Warehouse</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Expiry Date</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Approved By</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="ex1">
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
                          echo "<td>";

                          if($row['stock_status']=="In Stock"){
                            echo " &nbsp; <a href='#". $row['id'] ."' title='Some Function Here' data-toggle='tooltip'><span class='glyphicon glyphicon-ok'></span></a>";


                            echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='Void' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";

                          } elseif ($row['stock_status']=="Sold"){
                            echo " &nbsp; <a href='#". $row['id'] ."' title='Some Function Here' data-toggle='tooltip'><span class='glyphicon glyphicon-ok'></span></a>";

                            echo " &nbsp; <a href='#". $row['id'] ."' title='Some Function Here' data-toggle='tooltip'><span class='glyphicon glyphicon-cog'></span></a>";

                            echo " &nbsp; <a href='#". $row['id'] ."' title='Print Barcode' data-toggle='tooltip'><span class='glyphicon glyphicon-barcode'></span></a>";

                            echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='Void' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";


                          } elseif ($row['stock_status']=="Void"){
                            echo " &nbsp; <a href='#". $row['id'] ."' title='Some Function Here' data-toggle='tooltip'><span class='glyphicon glyphicon-ok'></span></a>";

                            echo " &nbsp; <a href='#". $row['id'] ."' title='Some Function Here' data-toggle='tooltip'><span class='glyphicon glyphicon-cog'></span></a>";

                            echo " &nbsp; <a href='#". $row['id'] ."' title='Print Barcode' data-toggle='tooltip'><span class='glyphicon glyphicon-barcode'></span></a>";

                            echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='Void' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";

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
// function ExportToExcel(tableID){
//        var htmltable= document.getElementById(tableID);
//        var html = htmltable.outerHTML;
//        window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
//     }

// function exportTableToExcel(){
//     var downloadLink;
//     var dataType = 'application/vnd.ms-excel';
//     var tableSelect = document.getElementById('example1');
//     var table_html = '<table><thead><tr><th>NO.</th><th>SC No.</th><th>PO NO.</th><th>SKU</th><th>Warehouse</th><th>Status</th><th>Expiry Date</th><th>Approved by</th></tr></thead></table>';
//     var tableHTML = table_html + tableSelect.outerHTML.replace(/ /g, '%20');
    
//     // Create download link element
//     downloadLink = document.createElement("a");
    
//     //document.body.appendChild(downloadLink);
    
//     if(navigator.msSaveOrOpenBlob){
//         var blob = new Blob([tableHTML], {
//             type: dataType
//         });
//         navigator.msSaveOrOpenBlob( blob );
//     }else{
//         // Create a link to the file
//         downloadLink.href = 'data:' + dataType + ',' + tableHTML;
    
//         //triggering the function
//         downloadLink.click();
// }

// }

function ExportToExcel(){
       var downloadLink;
       var htmltable= document.getElementById('example1');
       var table_html = '<table><thead><tr><th>NO.</th><th>SC No.</th><th>PO NO.</th><th>SKU</th><th>Warehouse</th><th>Status</th><th>Expiry Date</th><th>Approved by</th></tr></thead></table>';
       var html = table_html + htmltable.outerHTML;

       window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));


    }

</script>

    </body>
    </html>
