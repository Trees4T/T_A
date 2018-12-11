
          <section class="wrapper">
      <div class="row">
        <div class="col-lg-12">

          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="admin.php?3ad70a78a1605cb4e480205df880705c">Home</a></li>
            <li><i class="fa fa"></i><font color="">Session Report Page</font></li>
          </ol>
        </div>
      </div>

       <!--  <div class="alert alert-success" align="center">Transaction Successful!</div> -->

              <div class="row">
                  <div class="col-lg-12">
                 <?php
                  $jumlah_sesi=$_SESSION['jml_sesi'];
                  date_default_timezone_set('Asia/Jakarta');
                  $waktu    = date("d/m/Y - h:i:sa");
                 ?>
                  <section class="panel">
                    <header class="" align="center"><br>

                    </header>
                    <div class="panel-body">
                    <div class="col-lg-5">
                      <table align="center" class=" ">
                          <tr>
                            <td><b>Username</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['users'] ?></td>
                          </tr>
                          <tr>
                            <td><b>Time Login</td>
                            <td>:</td>
                            <td><?php echo $_SESSION['start_login'] ?></td>
                          </tr>
                          <tr>
                            <td><b>Time Logout</td>
                            <td>:</td>
                            <td><?php echo $waktu;

                            //simpan wkt logout
                        $_SESSION['logout']=$waktu;
                        ?></td>
                          </tr>

                      </table>
                      <br><br><br>

                      </div>
                      <table align="center" class="table table-bordered table-striped">
                        <tr>
                        <th width="3%"><center>No</center></th>
                        <th width="8%"><center>Transaction Type</center></th>
                        <th width="15%"><center>Name</center></th>
                        <th width="12%"><center>Order</center></th>
                        <th width="10%"><center>Shipment</center></th>
                        <th width="5%"><center>HTC ID</center></th>
                        <th width="10%"><center>BL</center></th>
                        <th width="5%"><center>Qty Trees</center></th>
                        <th width="5%"><center>Qty WINS</center></th>
                        <th width="5%"><center>1st WINS</center></th>
                        </tr>
                        <tbody>
                        <?php


                        if ($jumlah_sesi==0) {
                          ?>
                          <tr>
                            <td colspan="10" align="center">No Transaction</td>
                          </tr>
                          <?php
                        }else{


                        for ($i=0; $i < $jumlah_sesi ; $i++) {

                          $jumlah=$i+1;
                           ?>

                        <tr>
                          <td align="center"><?php echo $i+1; ?></td>
                          <td><?php echo $_SESSION['type_transaksi'.$jumlah.'']   ?></td>
                          <td><?php echo $_SESSION['nama_partisipan'.$jumlah.''] ?></td>
                          <td><?php echo $_SESSION['no_order'.$jumlah.''] ?></td>
                          <td><?php echo $_SESSION['no_shipment'.$jumlah.''] ?></td>
                          <td><?php echo $_SESSION['htc_id'.$jumlah.''] ?></td>
                          <td><?php echo $_SESSION['bl'.$jumlah.''] ?></td>
                          <td align="right"><?php echo $_SESSION['qty_trees'.$jumlah.''] ?></td>
                          <td align="right"><?php echo $_SESSION['qty_wins'.$jumlah.''] ?></td>
                          <td align="right"><?php echo $_SESSION['first_wins'.$jumlah.''] ?></td>
                        </tr>
                        <?php
                        $tot_pohon+=$_SESSION['qty_trees'.$jumlah.''];
                        $tot_wins+=$_SESSION['qty_wins'.$jumlah.''];
                        }

                      }
                         ?>
                         <tr>
                           <td colspan="7" align="center"><b>Total</td>
                           <td align="right"><b><?php
                           if ($tot_pohon=="") {
                             echo "0";
                           }else{
                            echo $tot_pohon;
                            } ?></td>
                           <td align="right"><b><?php
                            if ($tot_wins=="") {
                             echo "0";
                           }else{
                           echo $tot_wins;
                            }
                            ?></td>

                         </tr>
                        </tbody>

                             <?php
                             $_SESSION['tot_pohon']=$tot_pohon;
                             $_SESSION['tot_wins']=$tot_wins;
                              ?>
                      </table>

                      <div class="col-lg-12">
                      <div align="left" class="col-lg-6"><br>
                      <a href="ext/session-report-pdf.php" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export to PDF</a>
                     <!--  <button class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</button> -->

                      </div>
                      <div align="right" class="col-lg-6"><br>
                        <a href="login/logout.php"> <button class="btn btn-primary"><i class="fa fa-sign-out"></i> OK</button></a>
                      </div>
                    </div>
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
