<section class="wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="page-header"><i class="fa fa-tree"></i> Tree Allocation With Donation</h3>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="admin.php?3ad70a78a1605cb4e480205df880705c">Home</a></li>
            <li><i class="fa fa-tree"></i>Tree Allocation</li>
            <li><i class="fa fa-file-text-o"></i>With Donation</li>
          </ol>
        </div>
      </div>
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Form Tree Allocation With Donation
                          </header>
                          <div class="panel-body">

                              <!-- Form -->
                              <form class="form-horizontal " method="post" action="">

                              <!-- PARTISIPAN -->
                              <?php $parts=$_REQUEST['partisipan'] ?>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Participants</label>
                                      <div class="col-sm-10">
                                          <select class="form-control m-bot15" name="partisipan" onchange='this.form.submit()'>
                                              <option value="<?php if ($parts=='') {
                                                                echo "";
                                                                }else{
                                                                  echo $parts;
                                                                } ?>"><?php
                                              if ($parts=='') {
                                                echo "- Participants -";
                                              }else{
                                              echo $parts; }?>
                                              </option>
                                              <?php
                                              $data=$conn->query("SELECT no,id,type as tipe,name as nama,address as alamat,phone as tlp,fax,director as direktur,pic,
                                      product as prod_utama,outlet_qty as jml_outlet,material as bhn_utama, janjian,date_join as wkt_isi,email,
                                      email1 as email2,email2 as email3,website,introduction,header
                                      FROM t4t_participant
 order by nama asc");
                                              while ($data2=$data->fetch()) {
                                              ?>
                                              <option value="<?php echo $data2['nama']?>"><?php echo $data2['nama'] ?></option>
                                              <?php
                                              } ?>
                                          </select>
                                          <noscript><input type="submit" value="partisipan"></noscript>
                                      </div>

                                  </div>
                                  <!-- CLOSE PARTISIPAN -->

                                  <!-- JENIS -->
                              <?php $type=$_REQUEST['type'] ?>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Donation Type</label>
                                      <div class="col-sm-10">
                                          <select class="form-control m-bot15" name="type" onchange='this.form.submit()'>
                                              <option value="<?php if ($type=='') {
                                                                echo "";
                                                                }elseif($type=='2'){
                                                                echo "2";
                                                                }elseif($type=='3'){
                                                                echo "3";
                                                                }elseif($type=='4'){
                                                                echo "4";
                                                                }
                                              ?>"><?php
                                              if ($type=='') {
                                                echo "- Donation Type -";
                                              }elseif($type=='2'){
                                              echo "Individual Donation";
                                              }elseif($type=='3'){
                                              echo "Merchant / Corporate Donation";
                                              }elseif($type=='4'){
                                              echo "Sponsorship Donation";
                                              }

                                              ?>
                                              </option>

                                              <option value="2">Individual Donation</option>
                                              <option value="3">Merchant / Corporate Donation</option>
                                              <option value="4">Sponsorship Donation</option>


                                          </select>
                                          <noscript><input type="submit" value="type"></noscript>
                                      </div>

                                  </div>
                                  <!-- CLOSE JENIS -->


                                  <?php
                                  if ($parts!='' && $type!='') {

                                    $_SESSION['nama_part']=$parts;
                                    //echo $parts;
                                  ?>
                                   <div align="center">
                                  <a href="?<?php
                                    if ($type=="2") {
                                      echo paramEncrypt('hal=with-donation');
                                    }elseif ($type=="3") {
                                      echo paramEncrypt('hal=with-shipment');
                                    }elseif ($type=="4") {
                                      echo paramEncrypt('hal=with-sponsorship');
                                    }
                                  ?>" type="submit" name="cek" value="cek" class="btn btn-primary"><i class="fa fa-share"> Next</i></a><br><br><br>
                                  </div>
                                  <?php
                                  }
                                   ?>


                              </form>

                              <!-- close form -->

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
