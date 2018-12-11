<?php 

session_start();

include 'koneksi/koneksi.php';

?>

<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">

    <meta name="author" content="Rio Jerico Widyatama">

    <meta name="keyword" content="">

    <link rel="shortcut icon" href="img/favicon.png">



    <title>Tree Allocation  - Trees4Trees.org</title>



    <!-- Bootstrap CSS -->    

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- bootstrap theme -->

    <link href="css/bootstrap-theme.css" rel="stylesheet">

    <!--external css-->

    <!-- font icon -->

    <link href="css/elegant-icons-style.css" rel="stylesheet" />

    <link href="css/font-awesome.min.css" rel="stylesheet" />    

    <!-- full calendar css-->

    <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />

    <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />

    <!-- easy pie chart-->

    <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>

    <!-- owl carousel -->

    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">

    <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">

    <!-- Custom styles -->

    <link rel="stylesheet" href="css/fullcalendar.css">

    <link href="css/widgets.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

    <link href="css/style-responsive.css" rel="stylesheet" />

    <link href="css/xcharts.min.css" rel=" stylesheet"> 

    <link href="css/jquery-ui-1.10.4.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->

    <!--[if lt IE 9]>

      <script src="js/html5shiv.js"></script>

      <script src="js/respond.min.js"></script>

      <script src="js/lte-ie7.js"></script>

    <![endif]-->

    <link rel="stylesheet" href="assets/pace/pace.min.css">

  <!-- datatable -->

<!--   <link rel="stylesheet" href="assets/data-table/dataTables.bootstrap.css"> -->





    <SCRIPT type="text/javascript">

    // window.history.forward();

    // function noBack() { window.history.forward(); }

    </SCRIPT>





  </head>



  <body> <!-- onload="noBack();"onpageshow="if (event.persisted) noBack();" onunload=""> -->

  <!-- container section start -->

  <section id="container" class="">

     

      

      <header class="header dark-bg">

            <div class="toggle-nav">

                <div class="icon-reorder tooltips" data-original-title="Navigation" data-placement="bottom"><i class="icon_menu"></i></div>

            </div>



            <!--logo start-->

            <a href="index.html" class="logo">Trees4Trees <span class="lite">.org</span></a>

            <!--logo end-->



            <div class="nav search-row" id="top_menu">

                <!--  search form start -->

                <!-- <ul class="nav top-menu">                    

                    <li>

                        <form class="navbar-form">

                            <input class="form-control" placeholder="Search" type="text">

                        </form>

                    </li>                    

                </ul> -->

                <!--  search form end -->                

            </div>



            <div class="top-nav notification-row">                

                <!-- notificatoin dropdown start-->

                <ul class="nav pull-right top-menu">

                    



                    <!-- user login dropdown start-->

                    <li class="dropdown">

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <span class="">

                                <img alt="" width="100" src="img/logo.png">

                            </span>

                            <span class="username">Trees4Trees.org</span>

                            <b class="caret"></b>

                        </a>

                        <ul class="dropdown-menu extended logout">

                            <div class="log-arrow-up"></div>

                            <li class="eborder-top">

                                <a href="#"><i class="icon_profile"></i> My Profile</a>

                            </li>

                            

                            <li>
                                <a href="admin.php?5bd4fdf06142226e694c4ae97a108112fd4c264e7395d62dbc72c5c75000afa7"><i class="icon_key_alt"></i> Logout</a>
                            </li>

                        </ul>

                    </li>

                    <!-- user login dropdown end -->

                </ul>

                <!-- notificatoin dropdown end-->

            </div>

      </header>      

      <!--header end-->

