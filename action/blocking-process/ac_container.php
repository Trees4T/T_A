<?php
error_reporting(0);
ob_start();
include '../../koneksi/koneksi.php';

//for encription
include "../../assets/lib-encript/function.php";

// --------------
//POST from FORM
$id_part	=$_POST['partisipan'];
$no_ship	=$_POST['no_ship']; //no_shipment
$bl			=$_POST['bl']; //bl
$tot_wins	=$_POST['tot_wins'];
$min_allo	=$_POST['min_allo'];
$total_allo	=$_POST['total_allo'];
$win_num	=$_POST['win_num'];
$nama_mu	=$_POST['mu']; //mu name
$type_trees	=$_POST['type_trees'];
$total_trees=$_POST['total_trees'];
$no_order	=$_POST['no_order'];
$unallocated=$_POST['unallocated'];
$start_w 	=$_POST['start_w'];
$land 		=$_POST['land'];
$log        =$_POST['log'];
date_default_timezone_set('Asia/Jakarta');
$datetime	= date("Y-m-d H:i:s");


$id_pohon=$conn->query("select id_pohon from t4t_pohon where nama_pohon='$type_trees'")->fetch();
$mu=$conn->query("select kd_mu from t4t_mu where nama='$nama_mu'")->fetch();
$tujuan=$conn->query("select kota_tujuan from t4t_shipment where no_shipment='$no_ship'")->fetch(); //tujuan [0]
$no_t4tlahan=$conn->query("select no_t4tlahan,koordinat from current_tree where used='0' and hidup='1' and kd_mu='$mu[0]' and koordinat!='' limit $total_trees")->fetch();
$no=$no_t4tlahan[0];
$lahan=$conn->query("select * from t4t_lahan where no='$no'")->fetch();
$kd_lahan=$lahan['kd_lahan']; //kd_lahan
$no_lahan=$lahan['no_lahan']; //no_lahan
$luas=$lahan['luas_lahan']; //luas
$kd_petani=$lahan['kd_petani'];
$kd_desa=$lahan['id_desa'];
$desa=$conn->query("select desa from t4t_desa where id_desa='$kd_desa'")->fetch(); //desa [0]
$petani=$conn->query("select nm_petani from t4t_petani where kd_petani='$kd_petani' and id_desa='$kd_desa'")->fetch(); //petani [0]
$kd_ta=$lahan['kd_ta'];
$ta=$conn->query("select nama from t4t_tamaster where kd_ta='$kd_ta'")->fetch(); //ta [0]
$id_lahan=$lahan['id_lahan'];

$silvilkultur=$conn->query("select jenis_lahan from t4t_typelahan where id_lahan='$id_lahan'")->fetch(); //silvilkultur [0]
$geo=$no_t4tlahan['koordinat'];
$id_partisipan=$conn->query("select id from t4t_participant where name='$id_part'")->fetch();
$date=date("Y-m-d");



//update current tree
$z=1;
$select_current_tree=$conn->query("select count(*) as jml_pohon,kd_mu from add_jmlpohon_lahan where used=0 and bl='' and no_shipment='' and koordinat!='' and used=0 and hidup=1 group by kd_mu");

while ( $load=$select_current_tree->fetch()) {

   $kdman_unit   =$_POST['kdman_unit'.$z];
   $alokasi_pohon=$_POST['alokasi_pohon'.$z];

   $query_current_tree_update=$conn->query("update current_tree set used='1',bl='1111-11-11',no_shipment='$no_ship' where used='0' and hidup='1' and kd_mu='$kdman_unit' and koordinat!='' limit $alokasi_pohon");

$z++;
}

$cek_relation = $conn->query("SELECT relation,buyer from t4t_shipment where no_shipment='$no_ship'")->fetch();
if ($cek_relation[0]=="1") {
  $relation   ="$cek_relation[0]";
  $id_relation= $conn->query("SELECT related_part FROM t4t_idrelation WHERE id_part='$id_partisipan[0]' AND repeat_id='$cek_relation[1]'")->fetch();
  $relation_part=$id_relation[0];
}else{
  $relation      ='';
  $relation_part ='';
}

//insert into t4t_wins
$ex_win=explode(",", $win_num);
$ex_win2=count($ex_win);

$a=0;
$c=0;
$hasil=array();
while ( $a < $ex_win2) {

    for ($i=0; $i < 1 ; $i++) {
        $isi = explode("-", $ex_win[$a]);
        $start=trim($isi[0]);
        if (!trim($isi[1])) {
            $end=trim($isi[0]);
        }else {
            $end=trim($isi[1]);
        }

        $hasil=trim($start);

        for ($i=$start; $i <= $end ; $i++) {
            //no - win - no_order - pesen? - used? - unused? - vc? - bl - id_part - no shipment - time - log user - type
            $query_wins=$conn->query("insert into t4t_wins (no,wins,no_order,pesen,used,unused,vc,bl,id_part,no_shipment,time,log_user,trans_type,relation,id_retailer) values ('','$hasil','$no_order','','','','','$bl','$id_partisipan[0]','$no_ship','$date','$log','1','$relation','$relation_part')");

            // jika nomor wins banyak tanpa tanda "-"
            if (!$isi[1]) {
                break;
            }
            // jika wins banyak menggunakan tanda "-" tidak perlu break
            $hasil++;
        }


    }

$a++;
}





//insert into t4t_htc
$k=1;
while ($k <= 1 ) {

$data_lahan=$conn->query("select * from current_tree where bl='1111-11-11' and no_shipment='$no_ship' group by no_t4tlahan");

$i=1;
while ( $data=$data_lahan->fetch()) {
    $no_lahan2      =$data['no_t4tlahan'];
    $get_lahan      =$conn->query("select * from t4t_lahan where no='$no_lahan2'")->fetch();
    $kd_lahan2      =$get_lahan['kd_lahan'];
    $geo2           =$data['koordinat'];
    $kd_sil         =$get_lahan['id_lahan'];
    $silvilkultur2  =$conn->query("select jenis_lahan from t4t_typelahan where id_lahan='$kd_sil'")->fetch();
    $luas2          =$get_lahan['luas_lahan'];
    $kd_ptn         =$get_lahan['kd_petani'];
    $kd_ds          =$get_lahan['id_desa'];
    $desa2          =$conn->query("select desa from t4t_desa where id_desa='$kd_ds'")->fetch();
    $petani2        =$conn->query("select nm_petani from t4t_petani where kd_petani='$kd_ptn' and id_desa='$kd_ds'")->fetch();
    $kdta           =$get_lahan['kd_ta'];
    $ta2            =$conn->query("select nama from t4t_tamaster where kd_ta='$kdta'")->fetch();
    $kdman_unit0    =$get_lahan['kd_mu'];
    $kdman_unit     =$conn->query("select nama from t4t_mu where kd_mu='$kdman_unit0'")->fetch();
    $a=$conn->query("select count(*) from current_tree where bl='1111-11-11' and no_shipment='$no_ship' group by no_t4tlahan");

    $j=1;
    while ($jml_pohon=$a->fetch()) {
        $jml_pohon2[$j]=$jml_pohon[0];
    $j++;
    }


    //no - bl - tujuan - kd lahan - no lahan - geo - silvilkultur - luas - petani - desa - ta - mu - jml phn - geo 2 - no shipment - time
   $query_htc=$conn->query("insert into t4t_htc (no,bl,tujuan,kd_lahan,no_lahan,geo,silvilkultur,luas,petani,desa,ta,mu,jml_phn,geo2,no_shipment,time) values ('','$bl','$tujuan[0]','$kd_lahan2','$no_lahan2','$geo2','$silvilkultur2[0]','$luas2','$petani2[0]','$desa2[0]','$ta2[0]','$kdman_unit[0]','$jml_pohon2[$i]','','$no_ship','$date')");

$i++;
}
  $k++;
}//end while

$date=date("Y-m-d");
//update current_tree kedua
$query_current_tree_update2=$conn->query("update current_tree set bl='$bl' where bl='1111-11-11'");


// header("location:../../admin.php?4c079fe60164545aca6a15d1da3842b26d13fa85a72a1c4d0d323d98934f6d2f"); awal
header("location:ac_transaction.php");



?>
