<section class="wrapper">
<div class="row">
<div class="col-lg-12">
<h3 class="page-header"><i class="fa fa-tree"></i> Tree Allocation With Sponsorship </h3>
<ol class="breadcrumb">
  <li><i class="fa fa-home"></i><a href="admin.php?3ad70a78a1605cb4e480205df880705c">Home</a></li>
  <li><i class="fa fa-tree"></i>Tree Allocation</li>
  <li><i class="fa fa-file-text-o"></i>With Sponsorship</li>
</ol>
</div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Form Tree Allocation With Sponsorship
                </header>
                <div class="panel-body">

                    <!-- Form -->
                    <form class="form-horizontal " method="post" action="">

                    <!-- PARTISIPAN -->
                        <?php $parts=$_SESSION['nama_part'] ?>
                            <div class="form-group">
                            <label class="col-sm-2 control-label">Participants</label>
                            <div class="col-sm-10">
                            <input type="text" readonly="" class="form-control m-bot15" name="partisipan" value="<?php echo $parts  ?>">

                            </div>

                        </div>
                        <!-- CLOSE PARTISIPAN -->

                        <!-- NO ORDER -->
                        <?php
                          $no_order = $_REQUEST['no_order'] ;

                            $id_comp=$conn->query("SELECT id from t4t_participant where name='$parts'")->fetch();
                            $id_comp[0];
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">No Order</label>
                            <div class="col-sm-10">
                                <select class="form-control m-bot15" name="no_order" onchange="this.form.submit()" required>
                                    <option><?php
                                    if ($no_order=='') {
                                      echo "- No Order -";
                                    }else{
                                    echo $no_order; }?>
                                    </option>
                                    <option></option>
                                    <?php
                                    $data=$conn->query("select * from t4t_order where id_comp='$id_comp[0]' and acc='1' order by no desc");
                                    while ($data2=$data->fetch()) {

                                    ?>
                                    <option value="<?php echo $data2['no_order'] ?>"><?php echo $data2['no_order'] ?></option>
                                    <?php

                                    }
                                    ?>
                                </select>
                                <noscript><input type="submit" value="no_order"></noscript>
                            </div>
                        </div>

                        <!-- CLOSE NO ORDER -->

                        <!-- NO SHIPMENT -->
                        <?php
                          $no_ship = $_REQUEST['no_ship'] ;
                          if ($no_order) {
                            $id_comp=$conn->query("SELECT id from t4t_participant where name='$parts'")->fetch();
                            $date=date("dmy");
                            $jml_ns=$conn->query("select no_sh from add_htc where bl like '%$date%' and id_part='$id_comp[0]' order by no desc limit 1 ")->fetch();
                            $jml_ns2=$jml_ns[0]+1;
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">No Shipment</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly="" name="no_ship" value="<?php echo $id_comp[0];echo $date;?><?php echo $jml_ns2 ?>" required>
                            </div>
                            <label class="col-sm-2 "></label>
                            <div class="col-sm-10">
                             <font color="red">*No Shipment will start from this number</font>
                             </div>
                        </div>

                        <!-- CLOSE NO SHIPMENT -->

                        <!-- [OPEN] BL - TOTAL WINS - MIN. ALLOCATION -  TOT. ALLOCATION - AVA. ALLOCATION - M. UNIT -->
                        <?php
                          $no_order  =$_REQUEST['no_order'];
                           $data_ship=$conn->query("select * from t4t_shipment where no_shipment='$no_ship' and id_comp='$id_comp[0]' ")->fetch();

                        ?>
                          <!-- OPEN BL -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">BL</label>
                            <div class="col-sm-10">
                            <?php
                            $bl=$_REQUEST['bl'];

                            $jml_bl=$conn->query("select no_bl from add_htc where bl like '%$date%' and id_part='$id_comp[0]' order by no desc limit 1 ")->fetch();
                            $jml_bl2=$jml_bl[0]+1;
                            ?>
                                <input type="text" class="form-control" readonly="" name="bl" value="<?php echo $id_comp[0]?>BL<?php echo $jml_bl2 ?><?php echo $date ?>" required>
                            </div>
                        </div>
                          <!-- CLOSE BL -->

                          <!-- OPEN TOTAL WINS -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Total Allocation <b>(WINS)</b></label>
                            <?php
                              $tot_wins=1;
                            ?>
                            <div class="col-sm-10">
                                <input type="number" class="form-control x" onchange="hitung_pohon();" name="tot_wins" value="<?php echo $tot_wins ?>" required placeholder="WINS" readonly>
                            </div>
                        </div>

                            <!-- CLOSE TOTAL WINS -->

                            <!-- tp wins -->
                        <div class="form-group">
                        <?php $treeperwins=$_REQUEST['treeperwins'];
                        ?>
                            <label class="col-sm-2 control-label">Tree / Wins</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control y" onchange="hitung_pohon();" name="treeperwins" value="<?php echo $treeperwins ?>" min='1' required placeholder="Tree / Wins">
                            </div>
                        </div>
                            <!-- //tp wins -->

                            <!-- OPEN TOTAL ALLO -->

                        <div class="form-group">
                        <?php $total_allo=$_REQUEST['total_allo'];
                        //echo $total_allo; ?>

                            <label class="col-sm-2 control-label">Total Allocation <b>(Trees)</b></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control z" onchange="hitung_pohon();" name="total_allo" value="<?php echo $tot_wins*$treeperwins?>" required="" min="<?php echo $tot_wins ?>" placeholder="Tree Allocation" readonly>
                            </div>
                        </div>
                            <!-- CLOSE TOTAL ALLO -->

                            <!-- OPEN Destination -->

                        <div class="form-group">
                        <?php $destination=$_REQUEST['destination'];
                        //echo $total_allo; ?>

                            <label class="col-sm-2 control-label">Destination</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="destination" value="<?php echo $destination;?>" placeholder="Destination">
                            </div>
                        </div>
                            <!-- CLOSE Destination -->

                            <!-- fee -->
                            <div class="form-group">
                            <?php $fee=$_REQUEST['fee'];
                             ?>

                                <label class="col-sm-2 control-label">Fee</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name="fee" value="<?php echo $fee;?>" placeholder="Fee">
                                </div>
                            </div>
                            <!-- close fee -->

                            <!-- note -->
                            <div class="form-group">
                        <?php $note=$_REQUEST['note'];
                        //echo $total_allo; ?>

                            <label class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" name="note" value="<?php echo $note;?>" placeholder="Note"><?php echo $note;?></textarea>
                            </div>
                        </div>
                            <!-- close note -->

                            <!-- Buyer -->
                          <div class="form-group">
                            <?php
                            $buyer = $_REQUEST['buyer'];
                            $list_buyer = $conn->query("SELECT a.id_part,a.related_part,a.repeat_id,b.name from t4t_idrelation a, t4t_participant b where a.related_part=b.id and a.id_part='$id_comp[0]'");

                            $nama_buyer = $conn->query("SELECT NAME FROM t4t_participant WHERE id='$buyer'")->fetch();
                          ?>
                              <label class="col-sm-2 control-label">Buyer</label>
                              <div class="col-sm-10">
                                  <select class="form-control m-bot15" onchange="this.form.submit()" name="buyer">
                                    <?php if ($buyer!=''): ?>
                                      <option value="<?php echo $buyer?>"><?php echo $nama_buyer[0] ?></option>
                                      <?php else: ?>
                                      <option value="">- Choose -</option>
                                    <?php endif; ?>
                                    <option value="">- No Buyer -</option>
                                    <?php
                                    while ($list_buyers = $list_buyer->fetch(PDO::FETCH_OBJ)) {
                                    ?>
                                    <option value="<?php echo $list_buyers->related_part ?>"><?php echo $list_buyers->repeat_id; echo " (".$list_buyers->name.")"; ?></option>

                                    <?php
                                    }
                                    ?>

                                  </select>
                              </div>
                          </div>
                              <!-- //Buyer -->

                              <!-- WIN Owner -->
                            <div class="form-group">
                            <?php
                              $win_owner = $_REQUEST['win_owner'];
                            ?>
                                <label class="col-sm-2 control-label">WIN Owner</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-bot15" onchange="this.form.submit()" name="win_owner">
                                      <?php if ($win_owner==1): ?>
                                          <option value="1"><?php echo $nama_buyer[0] ?></option>
                                        <?php elseif($win_owner==0 or $buyer==''): ?>
                                          <option value="0"><?php echo $parts ?></option>
                                      <?php endif; ?>
                                      <option value="0"><?php echo $parts ?></option>
                                      <option value="1"><?php echo $nama_buyer[0] ?></option>

                                    </select>
                                </div>
                            </div>
                                <!-- //WIN Owner -->

                            <!-- START WINS -->
                        <div class="form-group">
                        <?php $ava_allo=$_REQUEST['ava_allo']; ?>


                            <label class="col-sm-2 control-label c">Wins</label>
                            <div class="col-sm-3">
                            <?php $start_w=$_REQUEST['start_w']; ?>
                                <input type="number" class="form-control" name="start_w" value="<?php echo $start_w ?>" required="">
                            </div>


                          <div class="col-lg-7"></div>
                        </div>
                            <!-- //START WINS -->


                            <!-- END WINS -->
                            <!-- //END WINS -->

                            <!-- OPEN MU -->
                         <?php $mu=$_REQUEST['mu'] ?>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Mangement Unit</label>
                            <div class="col-sm-10">

                                <select class="form-control m-bot15" name="mu" onchange='this.form.submit()'>
                                    <option><?php
                                    if ($mu=='') {
                                      echo "- Mangement Unit -";
                                    }else{
                                    echo $mu; }?>
                                    </option>
                                    <option></option>
                                    <?php
                                    $data=$conn->query("select count(no_pohon) as trees,kd_mu from current_tree where hidup=1 and used=0 and bl=''
                                      and no_shipment='' and koordinat!='' group by kd_mu order by trees desc");
                                    while ($data2=$data->fetch()) {

                                      $unit=$data2[1];
                                      $data_mu=$conn->query("select * from t4t_mu where kd_mu='$unit'")->fetch();
                                    ?>
                                    <option value="<?php echo $data_mu['nama'];?>"><?php


                                     echo $data_mu['nama'];?> (<?php echo $data2[0]; ?> Trees)</option>
                                    <?php
                                    } ?>
                                </select>
                                <noscript><input type="submit" value="mu"></noscript>
                            </div>
                        </div>
                            <!-- CLOSE MU -->

                        <?php  } ?>
                        <!-- [CLOSE] BL - TOTAL WINS - MIN. ALLOCATION -  TOT. ALLOCATION - AVA. ALLOCATION - M. UNIT -->

                        <!-- OPEN TYPE OF TREES - TOTAL TREES -->
                        <?php
                        $mu = $_REQUEST['mu'] ;
                          if ($mu) { ?>
                          <!-- TA -->
                        <?php
                          $ta=$_REQUEST['ta'];

                        ?>
                        <div class="form-group">
                          <label class="control-label col-sm-2">TA ID</label>
                          <div class="col-sm-3">
                            <select class="form-control" name="ta" onchange="this.form.submit()">
                              <option><?php
                              if ($ta=='') {
                                echo "- TA ID -";
                              }else{
                                echo $ta;
                                } ?>
                              </option>
                              <option></option>
                              <?php
                              $kab_kode=$conn->query("select kab_kode from t4t_mu where nama='$mu'")->fetch();
                              $data=$conn->query("select * from t4t_tamaster where kab_code='$kab_kode[0]'");
                              while ($data2=$data->fetch()) {
                              ?>
                              <option value="<?php echo $data2['kd_ta'] ?>"><?php echo $data2['nama'] ?> (<?php echo $data2['kd_ta'] ?>)</option>
                              <?php
                              }
                              ?>
                           </select>
                            <noscript><input type="submit" value='ta'></noscript>
                          </div>
                          <label class="control-label col-sm-2">Target Area</label>
                          <div class="col-lg-3">
                          <input class="form-control" type="text" readonly="" value="<?php $t=$conn->query("select nama from t4t_tamaster where kd_ta='$ta'")->fetch(); echo $t[0]; ?>">
                          </div>
                        </div>
                        <!-- TA Close -->






                        <div class="col-lg-12">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                            <th >Management Unit</th>
                            <th >Target Area</th>
                            <th >Village</th>
                            <th >Farmer</th>
                            <th >Land ID</th>
                            <th >Trees Qty</th>
                            <th >Allocation</th>
                            </tr>
                          </thead>
                          <?php
                         // echo $desa;
                          //echo $petani;
                          //echo $idmu2[0];
                          $i=1;
                          $idmu2=$conn->query("select kd_mu from t4t_mu where nama='$mu'")->fetch();
                          $data=$conn->query("select count(*) as jml_pohon,no,kd_petani,id_desa from add_jmlpohon_lahan where kd_mu='$idmu2[0]' and used=0 and bl='' and no_shipment='' and koordinat!='' and used=0 and hidup=1 and kd_ta='$ta' group by no_t4tlahan ");

                          while ( $load=$data->fetch()) {

                           ?>

                          <tbody>
                            <tr>
                            <td width="15%"><?php echo $mu ?></td>
                            <td width="15%"><?php
                            $nama_ta=$conn->query("select nama from t4t_tamaster where kd_ta='$ta'")->fetch();
                            echo $nama_ta[0] ?></td>
                            <td width="15%"><?php
                            $load_desa=$load['id_desa'];
                            $nama_desa=$conn->query("select * from t4t_desa where id_desa='$load_desa'")->fetch();
                            echo $nama_desa['desa'];
                                            ?></td>
                            <td width="15%"><?php
                            $load_kdpetani=$load['kd_petani'];
                            $nama_petani=$conn->query("select * from t4t_petani where id_desa='$load_desa' and kd_petani='$load_kdpetani'")->fetch();
                            echo $nama_petani['nm_petani'] ;?></td>
                            <td width="10%"><left><?php echo $load['no'] ?></left></td>
                            <td width="10%" align="left"><?php echo $load[0] ?></td>
                            <td width="10%"><input type="number" class="form-control o trees" name="alokasi_pohon<?php echo $i?>" max="<?php echo $load[0] ?>" min="1" value="<?php echo $_REQUEST['alokasi_pohon'.$i] ?>" ></td>

                             </tr>
                            <?php
                            $ap[]=$_REQUEST['alokasi_pohon'.$i];
                            $ava[]=$load[0];
                            $i++;
                            }
                            ?>
                           <tr>
                             <td colspan="5"></td>
                             <td><input type="text" class="form-control" value="<?php echo array_sum($ava)?> available" readonly></td>
                             <td><input type="text" class="form-control" id="totalTrees" name="total_trees" value="<?php echo array_sum($ap) ?> trees" readonly="" max="<?php echo $total_allo ?>" min="<?php echo $total_allo ?>"></td>
                           </tr>

                          </tbody>

                        </table>
                        </div>

                        <!-- CLOSE  -->
                        <div align="center">
                        <button type="submit" name="cek" value="cek" class="btn btn-success"><i class="fa fa-check"> Check</i></button><br><br><br>
                        </div>

                    </form>
                    <?php $pohon=$_REQUEST['total_trees'];
                            $unallocated=$total_allo-$pohon;

                        ?>
                    <!-- close form -->
                    <?php

                       //if submit check
                       $cek=$_REQUEST['cek'];
                       if ($cek) {



                         $unallocated;
                         date_default_timezone_set('Asia/Jakarta');
                         $time=date("Y-m-d");
                         $tanggal=date("dmy");
                         $cek_blocking=$conn->query("select * from t4t_wins where id_part='$id_comp[0]' and bl like '%BL10$tanggal%' and time='$time' limit 1")->fetch();
                         // $cek_kelipatan=$tree/$treeperwins;
                         // $tiga_dari_belakang= substr ($cek_kelipatan, -3, 1); // menghasilkan ","
                         // $dua_dari_belakang= substr ($cek_kelipatan, -2, 1); // menghasilkan ","
                         // $empat_dari_belakang= substr ($cek_kelipatan, -4, 1); // menghasilkan ","
                         // $tiga_dari_depan= substr ($cek_kelipatan, 2, 1); // menghasilkan ","
                         // $dua_dari_depan= substr ($cek_kelipatan, 1, 1); // menghasilkan ","

                         if ($cek_blocking[time]==$time) {// partisipan maks 10 per day
                        ?>
                        <!-- modal -->
                        <body onLoad="$('#my-modal-over').modal('show');">
                            <div id="my-modal-over" class="modal fade" align="center">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title alert alert-danger"><strong>Not Allowed!</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            Only allowed 10 times per day on this Participants, please try again next day...

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                        <!-- end modal -->
                        <?php
                       }//end part


                            //if unallocated
                            elseif ($unallocated > 0) {
                              ?>

                       <!-- modal -->
                        <body onLoad="$('#my-modal-over').modal('show');" >
                            <div id="my-modal-over" class="modal fade" align="center">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title alert alert-danger"><strong>Data do not match!</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            Please check the allocation trees ...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                        <!-- end modal -->
                        <?php

                         }//end unallocated

                         elseif ($unallocated==0) {
                           ?>
                           <!-- SUBMIT BUTTON -->
                        <form  id="form" action="action/blocking-process/ac_sponsorship.php" method="post">
                        <div align="center">
                        <?php $pohon=$_REQUEST['total_trees'];
                              $unallocated=$total_allo-$pohon;
                        ?>

                        <input type="hidden" name="partisipan" value="<?php echo $parts ?>">
                        <input type="hidden" name="no_ship" value="<?php echo $no_ship ?>">
                        <input type="hidden" name="bl" value="<?php echo $bl ?>">
                        <input type="hidden" name="tot_wins" value="<?php echo $tot_wins ?>">
                        <input type="hidden" name="total_allo" value="<?php echo $total_allo ?>">
                        <input type="hidden" name="mu" value="<?php echo $mu ?>">
                        <input type="hidden" name="total_trees" value="<?php echo $pohon ?>">
                        <input type="hidden" name="no_order" value="<?php echo $no_order ?>">
                        <input type="hidden" name="unallocated" value="<?php echo $unallocated ?>">
                        <input type="hidden" name="start_w" value="<?php echo $start_w ?>">
                        <input type="hidden" name="destination" value="<?php echo $destination ?>">
                        <input type="hidden" name="treeperwins" value="<?php echo $treeperwins ?>">
                        <input type="hidden" name="tpw_fix" value="<?php echo $total_allo/$tot_wins ?>">
                        <input type="hidden" name="jml_ns" value="<?php echo $jml_ns2 ?>">
                        <input type="hidden" name="fee" value="<?php echo $fee ?>">
                        <input type="hidden" name="note" value="<?php echo $note ?>">
                        <input type="hidden" name="log" value="<?php echo $_SESSION['ids']?>">
                        <input type="hidden" name="kd_targetarea" value="<?php echo $ta ?>">
                        <input type="hidden" name="buyer" value="<?php echo $buyer ?>">
                        <input type="hidden" name="win_owner" value="<?php echo $win_owner ?>">

                          <?php

                          $i=1;
                          $data=$conn->query("select count(*) as jml_pohon,no,kd_petani,id_desa from add_jmlpohon_lahan where kd_mu='$idmu2[0]' and used=0 and bl='' and no_shipment='' and koordinat!='' and used=0 and hidup=1 and kd_ta='$ta' group by no_t4tlahan ");

                          while ( $load=$data->fetch()) {

                           ?>
                             <input type="hidden" class="form-control o" name="land_pohon<?php echo $i?>" value="<?php echo $load['no'] ?>">
                            <input type="hidden" class="form-control o" name="alokasi_pohon<?php echo $i?>" value="<?php echo $_REQUEST['alokasi_pohon'.$i] ?>">

                            <?php

                            $i++;
                            }
                            ?>


                        <!-- modal -->
                        <body onLoad="$('#my-modal-allo').modal('show');">
                            <div id="my-modal-allo" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title alert alert-success"><strong>Data has been checked!</strong></h4>
                                        </div>
                                        <div class="modal-body">

                                           <table border="0">
                                                <tr><!-- partisipan -->
                                                  <td>Participants</td>
                                                  <td>:</td>
                                                  <td><?php echo $parts ?></td>
                                                </tr>
                                                <tr><!-- no order -->
                                                  <td>Order Number</td>
                                                  <td>:</td>
                                                  <td><?php echo $no_order ?></td>
                                                </tr>
                                                <tr><!-- no ship -->
                                                  <td>Shipment Number</td>
                                                  <td>:</td>
                                                  <td><?php echo $no_ship ?></td>
                                                </tr>
                                                <tr><!-- bl -->
                                                  <td>BL Number</td>
                                                  <td>:</td>
                                                  <td><?php echo $bl ?></td>
                                                </tr>
                                                <tr><!-- Tot wins -->
                                                  <td>Tot. Allocation <B>WINS</B></td>
                                                  <td>:</td>
                                                  <td><?php echo $tot_wins ?></td>
                                                </tr>
                                                <tr><!-- treeperwin -->
                                                  <td>Tree/Wins</td>
                                                  <td>:</td>
                                                  <td><?php echo $total_allo/$tot_wins ?></td>
                                                </tr>
                                                <tr><!-- tot tree -->
                                                  <td>Tot. Allocation <b>TREE</b></td>
                                                  <td>:</td>
                                                  <td><?php echo $total_allo ?></td>
                                                </tr>
                                                <tr><!-- destin -->
                                                  <td>Destination</td>
                                                  <td>:</td>
                                                  <td><?php echo $destination ?></td>
                                                </tr>

                                                <tr><!-- fee -->
                                                  <td>Fee</td>
                                                  <td>:</td>
                                                  <td><?php echo $fee ?></td>
                                                </tr>
                                                <tr><!-- start end wins -->
                                                  <td>Wins Number</td>
                                                  <td>:</td>
                                                  <td><?php echo $start_w ?></td>
                                                </tr>
                                                <tr><!-- mu -->
                                                  <td>Management Unit</td>
                                                  <td>:</td>
                                                  <td><?php echo $mu ?></td>
                                                </tr>
                                                <tr><!-- ta -->
                                                  <td>Target Area</td>
                                                  <td>:</td>
                                                  <td><?php echo $t[0] ?></td>
                                                </tr>

                                                <tr><!-- note -->
                                                  <td>Note</td>
                                                  <td>:</td>
                                                  <td><?php echo $note ?></td>
                                                </tr>
                                              </table>
                                              <br><br>
                                              <tr><!-- note -->

                                              <BR>

                                            Please <b>submit <i class="fa fa-save"></i></b> data now...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                        <!-- end modal -->
                            <button type="submit" value="save" name="save" class="btn btn-primary"><i class="fa fa-save"> Submit</i></button>
                            <a href="" name="" id="" class="btn btn-danger"><i class="fa fa-eraser"> Clear</i></a>

                        </div>
                        </form>

                           <?php
                         }//end pass
                       elseif ($unallocated<0) {//Trees over allocation
                        ?>
                        <!-- modal -->
                        <body onLoad="$('#my-modal-over').modal('show');" >
                            <div id="my-modal-over" class="modal fade" align="center">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title alert alert-danger"><strong>Data do not match!</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            Please check the allocation trees ...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </body>
                        <!-- end modal -->
                        <?php
                       }//end over





                      }//end check

                       ?>







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
