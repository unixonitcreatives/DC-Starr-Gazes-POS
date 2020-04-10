

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script> -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Notify -->
<script src="dist/js/notify.min.js"></script>


<!-- =========================== PAGE SCRIPT ======================== -->

<!-- Alert animation -->
<script type="text/javascript">
  $(document).ready(function () {

    window.setTimeout(function() {
      $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove();
        var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
          var clean_uri = uri.substring(0, uri.indexOf("?"));
          window.history.replaceState({}, document.title, clean_uri);
        }
      });
    }, 1000);

  });
</script>

<script type="text/javascript">
  var orders=[];
  var custID;

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


  // November 18, 2019
  // codes begins here
  document.onkeydown = TabDetection;

  function TabDetection(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var tabKey = 9;

    if(evt.keyCode == tabKey) {
      var barcode=$('#my-putin').val();
      check_stock(barcode);
      $(this).blur();

    }
  }
  document.addEventListener("keypress", function (e) {
    if (e.target.tagName !== "INPUT") {
      var input = document.querySelector("#my-putin");
      input.focus();
      if (e.key.charCodeAt() == 13) {
        input.focus();
      }
      input.value = input.value + e.key;
      e.preventDefault();
    }


    $('#my-putin').blur(function (e) {

      $('#my-putin').val('');

    });
  });
  // button save only. not save print
  $('#btnsave').on('click',function(){
    changeModeOfPayment();
    $.ajax({
      type: 'POST',
      url: 'si-checkout.php',
      // need to stringify array object list
      data: {'orders': JSON.stringify(orders)},
      dataType: 'json',
      success: function(data){
        if(data.success===true) //if success close modal and reload page
        {
          $('#modal-checkout').modal('hide');
          location.reload();
        }
      }
    });
  });



   // $q="INSERT INTO logs (info, info2, created_at) VALUES ('$info', '$info2', CURRENT_TIMESTAMP)"; //Prepare insert query
   // $r = mysqli_query($link, $q) or die(mysqli_error($link))

  //manual data entry
  $('#btnadd').on('click',function(){
    check_stock($('#warehouse_name').val());
    $('#modal-add-product').modal('hide');
  });
  //loop trough object in array
  function findObjectByKey(array, key, value) {
    for (var i = 0; i < array.length; i++) {
      if (array[i][key] === value) {
        return array[i];
      }
    }
    return null;
  }

  function changeModeOfPayment() {
    for (var i in orders) {
      orders[i].mop = $('#mop_ID').val();
      orders[i].discount= $('#discount').val();
    }
  }

  function check_stock(id){

    $.ajax({
      type: 'POST',
      url: 'si-get_stocks.php',
      data: {'custID':id},
      dataType: 'json',
      success: function(response){

        if(response==null){
          Notify("No stocks.","");
        }else{
          var obj = findObjectByKey(orders, 'custID', response.custID);
          if(obj!=null){
            Notify("Product already exist.","");
            return;
          }
          var tmp={
            so_cust:$('#customer_ID').val(),
            custID:response.custID,
            warehouseID:response.warehouse_ID,
            product_SKU:response.product_SKU,
            Description:response.product_description,
            Category:response.category_name,
            Qty:1,
            UnitPrice:response.sell_price,
            TotalPrice:response.sell_price*1,
            mop:'',
            discount:0,
            username: $('#username_ID').val()
          }
          orders.push(tmp);
          console.table(orders);
          get_orders();
        }
      }

    });

  }

});
function get_orders(){
  var indx = 0;
  $('#tOrders').DataTable({
    destroy: true,
    paging: false,
    searching:false,
    lengthChange:false,
    data: orders,
    bInfo:false,
    columns: [
    { data: "Description" },
    { data: "Category" },
    { data: "Qty" },
    { data: "UnitPrice" },
    { data: "TotalPrice" },
    {
      data: function (data) {
        indx++;
        return '<input id="' + indx + '"  type="button" class="btn btn-small btn-danger" value="-"  onclick="RemoveItem(\'' + data.custID + '\')" />';
      }
    }
    ]
  });
  //bibilangin nya ung sales order items
  $('#num_items').text(orders.length);
  //computation para sa grand total ng mga inorder
  var grand_total=0;
  for (var i = 0; i < orders.length; i++) {
    grand_total=grand_total+orders[i].TotalPrice;
  }
  $('#grand_total').text(grand_total);
  $('#grand_total1').text(grand_total);
  $('#cust_name').text($('#customer_ID option:selected').text());
  $('#mop').text($('#mop_ID option:selected').text());
  $('#username_ID').text();
  console.log(orders);
}
function RemoveItem(id){
  var r = confirm("Are you sure you want to remove " + id + "?" );
  if (r == true) {
    for(var i=0 ; i<orders.length; i++)
    {
      if(orders[i].custID==id)
        orders.splice(i);
    }

    get_orders();
  }
}

</script>

<script>
  $(function() {
    $('#example2').DataTable()
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'scrollX'     : true
    })
  })
</script>


<script>
//uppercase text box
function upperCase(a){
  setTimeout(function(){
    a.value = a.value.toUpperCase();
    //$.notify("its woooorking","warn");
  }, 1);

}

function Notify(msg,mode){
  $.notify(msg,mode);
}
</script>

</script>

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

<script type="text/javascript">
  function changetextbox()
  {
    if (document.getElementById("mop").value === "Cash") {
      document.getElementById("ref").disabled='true';
      document.getElementById("ref").value='';
    } else {
      document.getElementById("ref").disabled='';
    }
  }
</script>


<script>
  //uppercase text box
  function upperCaseF(a){
    setTimeout(function(){
      a.value = a.value.toUpperCase();

    }, 1);
  }
</script>