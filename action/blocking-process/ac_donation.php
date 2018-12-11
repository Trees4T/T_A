<?php
error_reporting(0);
ob_start();
include '../../koneksi/koneksi.php';

//for encription
include "../../assets/lib-encript/function.php";

// --------------
//POST from FORM
 $id_part    =$_POST['partisipan'];
 $no_ship    =$_POST['no_ship']; //no_shipment
 $bl         =$_POST['bl']; //bl
 $win_num    =$_POST['win_num'];
 $total_trees=$_POST['total_allo'];
 $no_order   =$_POST['no_order'];
 $unallocated=$_POST['unallocated'];
 $log        =$_POST['log'];
date_default_timezone_set('Asia/Jakarta');
 $datetime   = date("Y-m-d H:i:s");
 $destination=$_POST['destination'];
 $buyer      =$_POST['buyer'];
 $win_owner  =$_POST['win_owner'];

$id_partisipan=$conn->query("SELECT id from t4t_participant where name='$id_part'")->fetch();
$date=date("Y-m-d");


//update current tree
for ($i=1; $i <= 1 ; $i++) {
     //no shipment
    $date=date("Y-m-d");

     $query_current_tree_update=$conn->query("update current_tree set used='1',bl='$bl',no_shipment='1111-11-11' where used='0' and hidup='1' and koordinat!='' and bl='' and no_shipment='' limit $total_trees");
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
        $start=$isi[0];
        if (!$isi[1]) {
            $end=$isi[0];
        }else {
            $end=$isi[1];
        }

        $hasil=trim($start);

        for ($i=$start; $i <= $end ; $i++) {
            //no - win - no_order - pesen? - used? - unused? - vc? - bl - id_part - no shipment - time - log user - type
            $query_wins=$conn->query("insert into t4t_wins (no,wins,no_order,pesen,used,unused,vc,bl,id_part,no_shipment,time,log_user,trans_type,relation,id_retailer)
            values ('','$hasil','$no_order','','','','','$bl','$id_partisipan[0]','$no_ship','$date','$log','2','$win_owner','$buyer')");

            $hasil++;
        }


    }

$a++;
}


$repeat_id = $conn->query("SELECT repeat_id FROM t4t_idrelation
 WHERE id_part='$id_partisipan[0]' AND related_part='$buyer'")->fetch();
//insert into t4t_shipment
$date=date("dmy");
$tanggal=date("Y-m-d");
$jml_ns=$conn->query("select no_sh from add_htc where bl like '%$date%' or no_shipment LIKE '%$date%' and id_part='$id_partisipan[0]' order by no desc limit 1 ")->fetch();
// no - no ship - id comp - bl - bl tgl - wins used - wins unused - wkt shipment - foto - acc - no order - kota tujuan - fee - diskon - tgl paid - acc paid - note - buyer - item qty
for ($i=1; $i <= 1 ; $i++) {
echo $jml_ns2=$jml_ns[0]+$i;
$no_ship_htc=$id_partisipan[0].''.$date.''.$jml_ns2;

    $query_shipment=$conn->query("INSERT into t4t_shipment
    (no,no_shipment,id_comp,bl,bl_tgl,wins_used,wins_unused,wkt_shipment,foto,acc,no_order,kota_tujuan,fee,diskon,tgl_paid,acc_paid,note,buyer,item_qty,relation)
    values ('','$no_ship_htc','$id_partisipan[0]','$bl','$tanggal','$win_num','','$datetime','','1','$no_order','$destination','$fee','0','$tanggal','1','$note','$repeat_id[0]','1','$win_owner')");
}




//insert into t4t_htc
$k=1;
while ($k <= 1 ) {

$data_lahan=$conn->query("select * from current_tree where bl='$bl' and no_shipment='1111-11-11' group by no_t4tlahan");

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
    $kd_mu          =$get_lahan['kd_mu'];
    $mu2            =$conn->query("select nama from t4t_mu where kd_mu='$kd_mu'")->fetch();

    $a=$conn->query("select count(*) from current_tree where bl='$bl' and no_shipment='1111-11-11' group by no_t4tlahan");
    $j=1;
    while ($jml_pohon=$a->fetch()) {
        $jml_pohon2[$j]=$jml_pohon[0];
    $j++;
    }


    //no - bl - tujuan - kd lahan - no lahan - geo - silvilkultur - luas - petani - desa - ta - mu - jml phn - geo 2 - no shipment - time
   $date=date("Y-m-d");
   $query_htc=$conn->query("insert into t4t_htc values ('','$bl','$destination','$kd_lahan2','$no_lahan2','$geo2','$silvilkultur2[0]','$luas2','$petani2[0]','$desa2[0]','$ta2[0]','$mu2[0]','$jml_pohon2[$i]','','$no_ship','$date')");

$i++;
}
  $k++;
}//end while

$date=date("Y-m-d");
//update current_tree kedua
$query_current_tree_update2=$conn->query("update current_tree set no_shipment='$no_ship' where bl='$bl' and no_shipment='1111-11-11'");

//header("location:../../admin.php?a1a839ee8e9795202c5ebbcbe25ee83662484a4b355c150b26c3c6c68cde7ef7");
header("location:ac_transaction.php");

?>
