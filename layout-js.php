
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui-1.10.4.min.js"></script>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="js/owl.carousel.js" ></script>
    <!-- jQuery full calendar -->
    <script src="js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js" ></script>
    <script src="assets/chart-master/Chart.js"></script>
   
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>  
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>    
    <script src="js/charts.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script src="assets/pace/pace.min.js"></script>
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
      
      /* ---------- Map ---------- */
    $(function(){
      $('#map').vectorMap({
        map: 'world_mill_en',
        series: {
          regions: [{
            values: gdpData,
            scale: ['#000', '#000'],
            normalizeFunction: 'polynomial'
          }]
        },
        backgroundColor: '#fff',
        onLabelShow: function(e, el, code){
          el.html(el.html()+' (GDP - '+gdpData[code]+')');
        }
      });
    });

function hitung(){
    var a = $(".a").val();
    var b = $(".b").val();
    c= a-b;
    $(".c").val(c);
}
function hitung_pohon(){
    var x = $(".x").val();
    var y = $(".y").val();
    z= x*y;
    $(".z").val(z);
}
function hitung_alokasi(){
    var o = $(".o").val();
    r += o;
    $(".r").val(r);
}


  </script>
<script>
// we used jQuery 'keyup' to trigger the computation as the user type
$('.trees').keyup(function () {
 
    // initialize the sum (total price) to zero
    var sum = 0;
     
    // we use jQuery each() to loop through all the textbox with 'price' class
    // and compute the sum for each loop
    $('.trees').each(function() {
        sum += Number($(this).val());
    });
     
    // set the computed value to 'totalPrice' textbox
    $('#totalTrees').val(sum);
     
});
</script>
  <!-- datatable -->
  <script type="text/javascript" src="assets/data-table/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="assets/data-table/js/dataTables.bootstrap.js"></script>
  <script type="text/javascript">
  $(function() {
      $('#data').DataTable( {
                // "bJQueryUI":true,
              "bPaginate":true,
              "sPaginationType": "full_numbers",
              "iDisplayLength":10
      } );

  } );
  </script>
  <script type="text/javascript">
  $(function() {
      $('#data2').DataTable( {
                // "bJQueryUI":true,
              "bPaginate":true,
              "sPaginationType": "full_numbers",
              "iDisplayLength":10
      } );

  } );
  </script>
  <script type="text/javascript">
  $(function() {
      $('#data3').DataTable( {
                // "bJQueryUI":true,
              "bPaginate":true,
              "sPaginationType": "full_numbers",
              "iDisplayLength":10
      } );

  } );
  </script>
  <script type="text/javascript">
  $(function() {
      $('#data4').DataTable( {
                // "bJQueryUI":true,
              "bPaginate":true,
              "sPaginationType": "full_numbers",
              "iDisplayLength":10
      } );

  } );
  </script>
        <script>
            $(document).ready(function () {
                var t = $('#htc').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": 'assets/data-table/server-side/htc.php',
                    "columns": [
                        {"data": "no"},
                        {"data": "no_shipment"},
                        {"data": "bl"},
                        {"data": "tujuan"},
                        {"data": "geo"},
                        {"data": "silvilkultur"},
                        {"data": "luas"},
                        {"data": "petani"},
                        {"data": "desa"},
                        {"data": "ta"},
                        {"data": "mu"},
                        {"data": "jml_phn"}
                    ],
                    "order": [[0, 'desc']]
                });
            });
        </script>

  </body>
</html>
