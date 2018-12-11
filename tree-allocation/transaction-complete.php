
          <section class="wrapper">
      <div class="row">
        <div class="col-lg-12">

          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="admin.php?3ad70a78a1605cb4e480205df880705c">Home</a></li>
            <li><i class="fa "></i><font color="">Transaction Page</font></li>
          </ol>
        </div>
      </div>

       <!--  <div class="alert alert-success" align="center">Transaction Successful!</div> -->

              <div class="row">
                  <div class="col-lg-12">


                 <?php

$jumlah_sesi=$_SESSION['jml_sesi']; ?>
                  <section class="panel">

                  <?php

                  if ($_SESSION['pesan']=="") {

                  }elseif ($_SESSION['pesan']=="Message has been sent") {
                    ?>
                    <!-- info email terkirim -->
                    <div class="alert alert-success fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove">X</i>
                                  </button>
                                  <strong></strong> Message has been sent.
                              </div>
                  <!-- end info email terkirim -->
                    <?php
                  }else{
                    ?>
                    <!-- info email gagal terkirim -->
                    <div class="alert alert-danger fade in">
                                  <button data-dismiss="alert" class="close close-sm" type="button">
                                      <i class="icon-remove">X</i>
                                  </button>
                                  <strong></strong> <b>Message could not be sent.</b> <?php echo $_SESSION['pesan'] ?>
                              </div>
                  <!-- end info email gagal terkirim -->
                    <?php
                  }
                  unset($_SESSION['pesan']);

                   ?>


                    <header class="" align="center"><br>
                    <?php if ($jumlah_sesi==0) {
                      ?>
                      <font color=""><h4><b>No Transaction</b></h1></font>
                    <?php
                    }else{ ?>
                      <font color="green"><h4><b>Transaction Successful!</b></h1></font>
                    </header>
                    <?php } ?>
                    <div class="panel-body">
                    <?php

                    if ($jumlah_sesi==0) {

                    }else{
                     ?>

                      <table align="center" class="">
                          <tr>
                            <td><b>Username</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['users'.$jumlah_sesi.''] ?> </td>
                          </tr>
                          <tr class="">
                            <td><b>Datetime</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['waktu'.$jumlah_sesi.'']  ?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>

                          <tr class="">
                            <td><b>Transaction Type</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['type_transaksi'.$jumlah_sesi.'']   ?></td>
                          </tr>
                          <tr>
                            <td><b>Name</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['nama_partisipan'.$jumlah_sesi.''] ?></td>
                          </tr>
                          <tr>
                            <td><b>Order</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['no_order'.$jumlah_sesi.''] ?></td>
                          </tr>
                          <tr>
                            <td><b>Shipment</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['no_shipment'.$jumlah_sesi.''] ?></td>
                          </tr>
                          <tr>
                            <td><b>HTC ID</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['htc_id'.$jumlah_sesi.''] ?></td>
                          </tr>
                          <tr>
                            <td><b>BL</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['bl'.$jumlah_sesi.'']   ?></td>
                          </tr>
                          <tr>
                            <td><b>Qty Trees</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['qty_trees'.$jumlah_sesi.''] ?> </td>
                          </tr>
                          <tr>
                            <td><b>Qty WINS</td>
                            <td>:</td>
                            <td> <?php echo $_SESSION['qty_wins'.$jumlah_sesi.''] ?> </td>
                          </tr>
                          <tr>
                            <td><b>1st WINS</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['first_wins'.$jumlah_sesi.''] ?></td>
                          </tr>
                          <tr>
                            <td><b>Last WINS</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['last_wins'.$jumlah_sesi.''] ?></td>
                          </tr>

                      </table>
                      <div align="center"><br>
                      <form method="post" action="../ext/mail-partisipan/index.php">
                      <button class="btn btn-warning" data-toggle="modal" href="#myModal" type="submit"><i class="fa fa-envelope"></i> Send Email to Partisipan</button>

                      <?php
                      $tipe=$_SESSION['type_transaksi'.$jumlah_sesi.''];
                      if ($tipe=="Container") {
                        $link="admin.php?4c079fe60164545aca6a15d1da3842b26d13fa85a72a1c4d0d323d98934f6d2f";
                      }elseif ($tipe=="Donation") {
                        $link="admin.php?a1a839ee8e9795202c5ebbcbe25ee83662484a4b355c150b26c3c6c68cde7ef7";
                      }elseif ($tipe=="Merchant") {
                        $link="admin.php?c3b00eb86cd337880f1639111f2af716061ba997b556a75c89e9bad84f0eb324";
                      }elseif ($tipe=="Sponsorship") {
                        $link="admin.php?a46082f9f5d6e76572879db4b9985b5b4b7497d6f82e256c83ca11d154eeb94a";
                      }
                       ?>
                      <a href="<?php echo $link ?>" class="btn btn-info"><i class="fa fa-reply"></i> Return to Allocation</a>


                      </form>
                      </div>
                      <?php
                      } ?>
                    </div>

                  </section>




                  </div>
              </div>
              <!-- Basic Forms & Horizontal Forms-->

                      </div>
                  </div>
              </div>
              <!-- page end-->
          </section>



                                  <!-- modal -->
                                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                  <h4 class="modal-title alert alert" align="center"><strong>Are you sure you want to sending this report?</strong></h4>
                                                  </div>
                                                  <div class="modal-body">


                                                       <?php

                                                        $nama_partisipan=$_SESSION['nama_partisipan'.$jumlah_sesi.''];
                                                        $get_email=$conn->query("SELECT email,email1 as email2,email2 as email3
                                                         FROM t4t_participant where name='$nama_partisipan'")->fetch();
                                                         $get_email[0];
                                                         ?>

                                                         Sending email to: <?php echo $get_email[0] ?> <br><br>

                                                     <!--  <input type="hidden" name="email2" value="<?php// echo $get_email[1] ?>">
                                                      <input type="hidden" name="email3" value="<?php //echo $get_email[2] ?>">

                                                      Email 1 : <?php //echo $get_email[0] ?> <br>
                                                      Email 2 : <?php //echo $get_email[1] ?> <br>
                                                      Email 3 : <?php //echo $get_email[2] ?>  -->

                                                      <br><br>
                                                      <div align="center">
                                                      <form action="ext/mail-partisipan/index.php" method="post">

                                                      <input type="hidden" name="email" value="<?php echo $get_email[0] ?>">

                                                      <button data-dismiss="modal" class="btn btn-default" type="button">No, I'm not sure</button>
                                                      <button class="btn btn-success" type="submit" name="send" value="send">Yes, I'm sure</button>
                                                      </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </body>
                                  <!-- end modal -->
