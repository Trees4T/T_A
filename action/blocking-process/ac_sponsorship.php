<?php
ob_start();
include '../../koneksi/koneksi.php';
//for encription
include "../../assets/lib-encript/function.php";
// --------------
//POST from FORM
$id_part    =$_POST['partisipan'];
$no_ship    =$_POST['no_ship'];
$bl         =$_POST['bl'];
$tot_wins   =$_POST['tot_wins'];
$total_allo =$_POST['total_allo'];
$nama_mu    =$_POST['mu']; //mu name
$total_trees=$_POST['total_trees'];
$no_order   =$_POST['no_order'];
$unallocated=$_POST['unallocated'];
$start_w    =$_POST['start_w'];
$destination=$_POST['destination'];
$treeperwins=$_POST['treeperwins'];
$tpw_fix    =$_POST['tpw_fix'];
$fee        =$_POST['fee'];
$note       =$_POST['note'];
$log        =$_POST['log'];
$kd_targetarea =$_POST['kd_targetarea'];
$buyer      =$_POST['buyer'];
$win_owner  =$_POST['win_owner'];

$mu=$conn->query("select kd_mu from t4t_mu where nama='$nama_mu'")->fetch();
// $tujuan=$conn->query("select kota_tujuan from t4t_shipment where no_shipment='$no_ship'")->fetch(); //tujuan [0]
// -$no_t4tlahan=$conn->query("select no_t4tlahan,koordinat from current_tree where used='0' and hidup='1' and kd_mu='$mu[0]' and koordinat!='' limit $total_trees")->fetch();
// -$no=$no_t4tlahan[0];
// -$lahan=$conn->query("select * from t4t_lahan where no='$no'")->fetch();
// -$kd_lahan=$lahan['kd_lahan']; //kd_lahan
// -$no_lahan=$lahan['no_lahan']; //no_lahan
// -$luas=$lahan['luas_lahan']; //luas
// -$kd_petani=$lahan['kd_petani'];
// -$kd_desa=$lahan['id_desa'];
// -$desa=$conn->query("select desa from t4t_desa where id_desa='$kd_desa'")->fetch(); //desa [0]
// -$petani=$conn->query("select nm_petani from t4t_petani where kd_petani='$kd_petani' and id_desa='$kd_desa'")->fetch(); //petani [0]
// -$kd_ta=$lahan['kd_ta'];
// -$ta=$conn->query("select nama from t4t_tamaster where kd_ta='$kd_ta'")->fetch(); //ta [0]
// -$id_lahan=$lahan['id_lahan'];
// -$silvilkultur=$conn->query("select jenis_lahan from t4t_typelahan where id_lahan='$id_lahan'")->fetch(); //silvilkultur [0]
// -$geo=$no_t4tlahan['koordinat'];
$id_partisipan=$conn->query("SELECT id from t4t_participant where name='$id_part'")->fetch();
//echo $id_partisipan[0];
date_default_timezone_set('Asia/Jakarta');
$time=date("Y-m-d");
$time_second=date("Y-m-d h:i:s");
//no shipment
$date=date("dmy");
//-$wins_bagi=$total_trees/$treeperwins; //total pohon/tpw

//update current tree
$z=1;
$select_current_tree=$conn->query("select count(*) as jml_pohon,no,kd_petani,id_desa from add_jmlpohon_lahan where kd_mu='$mu[0]' and used=0 and bl='' and no_shipment='' and koordinat!='' and used=0 and hidup=1 and kd_ta='$kd_targetarea' group by no_t4tlahan ");

while ( $load=$select_current_tree->fetch()) {

   $land_pohon   =$_POST['land_pohon'.$z];
   $alokasi_pohon=$_POST['alokasi_pohon'.$z];


   $query_current_tree_update=$conn->query("update current_tree set used='1',bl='1111-11-11',no_shipment='$no_ship' where used='0' and hidup='1' and kd_mu='$mu[0]' and koordinat!='' and no_t4tlahan='$land_pohon' limit $alokasi_pohon");

$z++;
}




//insert into t4t_wins
$date=date("dmy");
$ns_win=$conn->query("select no_sh from add_wins where bl like '%$date%' and id_part='$id_partisipan[0]' order by no desc limit 1 ")->fetch();
for ($i=1; $i <= $tot_wins ; $i++) {
    //ambil start wins
    $wins=$start_w-1;
    $win=$wins+$i;

    $ns_win2=$ns_win[0]+$i;
    $ns_win2;
    //no - win - no_order - pesen? - used? - unused? - vc? - bl - id_part - no shipment - time - log user - type

    $query_wins=$conn->query("insert into t4t_wins (wins,no_order,pesen,used,unused,vc,bl,id_part,no_shipment,time,log_user,trans_type,relation,id_retailer) values ('$win','$no_order','','','','','$bl','$id_partisipan[0]','$id_partisipan[0]$date$ns_win2','$time','$log','4','$win_owner','$buyer')");
}

$repeat_id = $conn->query("SELECT repeat_id FROM t4t_idrelation
 WHERE id_part='$id_partisipan[0]' AND related_part='$buyer'")->fetch();
//insert into t4t_shipment
$jml_ns=$conn->query("select no_sh from add_htc where bl like '%$date%' and id_part='$id_partisipan[0]' order by no desc limit 1 ")->fetch();
// no - no ship - id comp - bl - bl tgl - wins used - wins unused - wkt shipment - foto - acc - no order - kota tujuan - fee - diskon - tgl paid - acc paid - note - buyer - item qty
for ($i=1; $i <= $tot_wins ; $i++) {
 $jml_ns2=$jml_ns[0]+$i;
$no_ship_htc=$id_partisipan[0].''.$date.''.$jml_ns2;

//Ambil wins
$wins=$start_w-1;
   $win=$wins+$i;

    $query_shipment=$conn->query("insert into t4t_shipment (no_shipment,id_comp,bl,bl_tgl,wins_used,wins_unused,wkt_shipment,foto,acc,no_order,kota_tujuan,fee,diskon,tgl_paid,acc_paid,note,buyer,item_qty,relation) values ('$no_ship','$id_partisipan[0]','$bl','$time','$win','','$time_second','','1','$no_order','$destination','$fee','0','$time','1','$note','$repeat_id[0]','1','$win_owner')");
}



//insert into t4t_htc
$k=1;
while ($k <= 1 ) {
$jml_ns=$conn->query("select no_sh from add_htc where bl like '%$date%' and id_part='$id_partisipan[0]' order by no desc limit 1 ")->fetch();
$jml_ns2=$jml_ns[0]+1;
$no_ship_htc=$id_partisipan[0].''.$date.''.$jml_ns2;
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
    $kd_mu          =$get_lahan['kd_mu'];
    $mu2            =$conn->query("select nama from t4t_mu where kd_mu='$kd_mu'")->fetch();

    $a=$conn->query("select count(*) from current_tree where bl='1111-11-11' and no_shipment='$no_ship' group by no_t4tlahan");
    $j=1;
    while ($jml_pohon=$a->fetch()) {
        $jml_pohon2[$j]=$jml_pohon[0];
    $j++;
    }


    //no - bl - tujuan - kd lahan - no lahan - geo - silvilkultur - luas - petani - desa - ta - mu - jml phn - geo 2 - no shipment - time
    $query_htc=$conn->query("INSERT into t4t_htc (bl,tujuan,kd_lahan,no_lahan,geo,silvilkultur,luas,petani,desa,ta,mu,jml_phn,no_shipment,time) values ('$bl','$destination','$kd_lahan2','$no_lahan2','$geo2','$silvilkultur2[0]','$luas2','$petani2[0]','$desa2[0]','$ta2[0]','$mu2[0]','$jml_pohon2[$i]','$no_ship','$time')");

$i++;
}
  $k++;
}//end while

   $date=date("Y-m-d");

    //update current_tree kedua
    $query_current_tree_update2=$conn->query("update current_tree set bl='$bl' where bl='1111-11-11'");

//header("location:../../admin.php?a46082f9f5d6e76572879db4b9985b5b4b7497d6f82e256c83ca11d154eeb94a");
header("location:ac_transaction.php");
?>
