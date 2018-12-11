<section class="wrapper">

    <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-home"></i> Dashboard</h3>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i><a href="admin.php?3ad70a78a1605cb4e480205df880705c">Home</a></li>
        </ol>
      </div>
    </div>
      <div class="row">
          <div class="col-lg-12">
          <!-- Current Tree -->
              <section class="panel">
                  <header class="panel-heading">
                     Tree Available for Allocation
                  </header>
                  <div class="panel-body">
                  <div class="col-lg-12" >
                  <?php
                  $data=$conn->query("SELECT count(*) from current_tree where used=0 and hidup=1 and bl='' and no_shipment='' and koordinat!=''")->fetch();

                  if ($data[0]<100000) {
                    ?>
                    <input align="center" class="form-control" readonly="" style="color:red;font-weight:bold;" value="<?php  echo number_format($data[0],0,',','.') ?> available">
                    <?php
                  }else{

                   ?>
                   <input align="center" class="form-control" readonly="" style="color:green;font-weight:bold;" value="<?php  echo number_format($data[0],0,',','.') ?> available">
                  <?php
                  }
                  ?>
                  </div><br>
                  <div class="col-lg-12">
                    <div class="col-lg-6">
                    <header class="panel-heading">
                      Management Unit
                  </header>
                      <table id="data" class="table table-hover">
                      <thead>
                      <tr>
                          <th width="5%">No</th>
                          <th>Management Unit</th>
                          <th width="27%">Number of Trees</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      $no=1;
                      $data=$conn->query("SELECT count(no_pohon) as trees,kd_mu from current_tree where hidup=1 and used=0 and bl='' and no_shipment='' and koordinat!='' group by kd_mu order by trees desc");
                      while ($data2=$data->fetch()) {
                      ?>
                      <tr>
                          <td><?php echo $no ?></td>
                          <td><?php
                          $unit=$data2[1];
                          $data_mu=$conn->query("SELECT * from t4t_mu where kd_mu='$unit'")->fetch();
                          echo $data_mu['nama']; ?></td>
                          <td align="right"><?php echo $data2[0] ?></td>
                      <?php
                      $no++;
                      }
                      ?>
                      </tr>

                      </tbody>
                  </table>
                    </div>
                    <div class="col-lg-6">
                    <header class="panel-heading">
                      Species
                  </header>
                      <table id="data2" class="table table-hover" >
                      <thead>
                      <tr>
                          <th width="5%">No</th>
                          <th>Species</th>
                          <th width="27%">Number of Trees</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      $no=1;
                      $data=$conn->query("SELECT count(no_pohon) as trees,id_pohon from current_tree where hidup=1 and used=0 and bl='' and no_shipment='' and koordinat!='' group by id_pohon order by trees desc");
                      while ($data2=$data->fetch()) {
                        ?>

                      <tr>
                          <td><?php echo $no ?></td>
                          <td><?php  $species=$data2[1];
                          $sp=$conn->query("SELECT * from t4t_pohon where id_pohon='$species'")->fetch();
                          if($sp['nama_pohon']==""){
                				    echo "Lainnya";
                				  }else{
                            echo $sp['nama_pohon'];
                          }
                          ?> <i>(<?php echo $sp['nama_latin'] ?>)</i></td>
                          <td align="right"><?php echo $data2[0]?></td>
                      <?php
                      $no++;
                      }
                      ?>
                      </tr>
                      </tbody>
                  </table>
                    </div>
                  </div>

                  </div>
              </section>

            <!-- HTC -->
              <section class="panel">
                <header class="panel-heading">
                  HTC
                </header>
                <div class="panel-body">
                  <div class="col-lg-12">
                  <table id="htc" class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>No Ship</th>
                        <th>BL</th>
                        <th>Destination</th>
                        <th>Geo</th>
                        <th>Silvilkultur</th>
                        <th>Land Area</th>
                        <th>Farmer</th>
                        <th>Village</th>
                        <th>TA</th>
                        <th>MU</th>
                        <th>Number of Tree</th>

                      </tr>
                    </thead>

                    </tbody>
                  </table>
                  </div>

                </div>
              </section>
              <!-- WINS -->
              <section class="panel">
                <header class="panel-heading">
                 Last WINS
                </header>
                <div class="panel-body">
                  <div class="col-lg-12">
                  <table id="" class="table table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Partisipan</th>
                        <th>No Ship</th>
                        <th>No Order</th>
                        <th>BL</th>
                        <th>WINS</th>
                      </tr>
                    </thead>
                    <?php
                    $no=1;
                    $htc=$conn->query("SELECT * from t4t_wins order by no desc limit 1");
                    while ($data=$htc->fetch()) {
                    ?>

                    <tbody>
                    <td><?php echo $no ?></td>
                    <td><?php $part=$data['id_part'];
                              $part2=$conn->query("SELECT no,id,type as tipe,name as nama,address as alamat,phone as tlp,fax,director as direktur,pic,
                                      product as prod_utama,outlet_qty as jml_outlet,material as bhn_utama, janjian,date_join as wkt_isi,email,
                                      email1 as email2,email2 as email3,website,introduction,header
                                      FROM t4t_participant
 where id='$part'")->fetch();
                              echo $part2['nama'] ?></td>
                    <td><?php echo $data['no_shipment']?></td>
                    <td><?php echo $data['no_order']?></td>
                    <td><?php echo $data['bl']?></td>
                    <td><?php echo $data['wins']?></td>

                    <?php
                    $no++;
                    }
                    ?>
                    </tbody>
                  </table>
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
