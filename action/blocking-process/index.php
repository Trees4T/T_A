<?php

ob_start();

include '../../koneksi/koneksi.php';

//for encription

include "../../assets/lib-encript/function.php";

// --------------

//POST from FORM

$id_part    =$_POST['partisipan'];
$bl         =$_POST['bl'];
$no_ship    =$_POST['no_ship'];
$tot_wins   =$_POST['tot_wins'];
$total_allo =$_POST['total_allo'];
// -$nama_mu    =$_POST['mu']; //mu name
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
$buyer      =$_POST['buyer'];
$win_owner  =$_POST['win_owner'];
$jml_ns     =$_POST['jml_ns'];

$tree_owner  =$_POST['tree_owner'];

$id_partisipan=$conn->query("SELECT id from t4t_participant where name='$id_part'")->fetch();

date_default_timezone_set('Asia/Jakarta');

$time=date("Y-m-d");
$time_second=date("Y-m-d h:i:s");

//no shipment

$date=date("dmy");


//update current tree
if ($tree_owner==1) {
  $select_current_tree=$conn->query("select count(*) as jml_pohon,kd_mu from current_tree where used=0 and bl='' and no_shipment='$id_partisipan[0]' and koordinat!='' and used=0 and hidup=1 group by kd_mu");
}else{
  $select_current_tree=$conn->query("select count(*) as jml_pohon,kd_mu from add_jmlpohon_lahan where used=0 and bl='' and no_shipment='' and koordinat!='' and used=0 and hidup=1 group by kd_mu");
}


$z=1;

while ( $load=$select_current_tree->fetch()) {

   $kdman_unit   =$_POST['kdman_unit'.$z];
   $alokasi_pohon=$_POST['alokasi_pohon'.$z];
   $ns=$conn->query("select no_sh from add_current_tree where tgl='$date' and id_part='$id_partisipan[0]' order by no_sh desc limit 1")->fetch();
   $wins_alo=$alokasi_pohon/$treeperwins;
   for ($i=1; $i <= $wins_alo ; $i++) {

   //no shipment
   $date=date("dmy");
   $ns2=$ns[0]+$i;

   if ($tree_owner==1) {
     $query_current_tree_update=$conn->query("UPDATE current_tree set used='1',bl='1111-11-11',no_shipment='$id_partisipan[0]$date$ns2' where used='0' and hidup='1' and kd_mu='$kdman_unit' and koordinat!='' and no_shipment='$id_partisipan[0]' limit $treeperwins");
   }else{
     $query_current_tree_update=$conn->query("update current_tree set used='1',bl='1111-11-11',no_shipment='$id_partisipan[0]$date$ns2' where used='0' and hidup='1' and kd_mu='$kdman_unit' and koordinat!='' limit $treeperwins");
   }


   }

$z++;

}


//insert into t4t_wins

$date=date("dmy");

$ns_win=$conn->query("select no_sh from add_wins where id_part='$id_partisipan[0]' and bl like '%$date%' order by no desc limit 1 ")->fetch();
for ($i=1; $i <= $tot_wins ; $i++) {

    //ambil start wins
    $wins=$start_w-1;
    $win=$wins+$i;
    $ns_win2=$ns_win[0]+$i;
    $ns_win2;

    //no - win - no_order - pesen? - used? - unused? - vc? - bl - id_part - no shipment - time - log user - type
    $query_wins=$conn->query("insert into t4t_wins (wins,no_order,vc,bl,id_part,no_shipment,time,log_user,trans_type,relation,id_retailer) values ('$win','$no_order','','$bl','$id_partisipan[0]','$id_partisipan[0]$date$ns_win2','$time','$log','3','$win_owner','$buyer')");

}


$repeat_id = $conn->query("SELECT repeat_id FROM t4t_idrelation
 WHERE id_part='$id_partisipan[0]' AND related_part='$buyer'")->fetch();
//insert into t4t_shipment

$jml_ns=$conn->query("select no_sh from add_htc where id_part='$id_partisipan[0]' and bl like '%$date%' order by no desc limit 1 ")->fetch();

// no - no ship - id comp - bl - bl tgl - wins used - wins unused - wkt shipment - foto - acc - no order - kota tujuan - fee - diskon - tgl paid - acc paid - note - buyer - item qty

for ($i=1; $i <= $tot_wins ; $i++) {

$jml_ns2=$jml_ns[0]+$i;
$no_ship_htc=$id_partisipan[0].''.$date.''.$jml_ns2;

//Ambil wins

$wins=$start_w-1;
   $win=$wins+$i;

    $query_shipment=$conn->query("insert into t4t_shipment (no_shipment,id_comp,bl,bl_tgl,wins_used,wins_unused,wkt_shipment,foto,acc,no_order,kota_tujuan,fee,diskon,tgl_paid,acc_paid,note,buyer,item_qty,relation)
    values ('$no_ship_htc','$id_partisipan[0]','$bl','$time','$win','','$time_second','','1','$no_order','$destination','$fee','0','$time','1','$note','$repeat_id[0]','1','$win_owner')");

}





//insert into t4t_htc
if ($tree_owner==1) {
  $select_htc=$conn->query("SELECT COUNT(*) AS jml_pohon,kd_mu FROM current_tree WHERE used=1 AND bl='1111-11-11' AND koordinat!='' AND hidup=1 GROUP BY kd_mu");
}else{
  $select_htc=$conn->query("SELECT count(*) as jml_pohon,kd_mu from add_jmlpohon_lahan where used=0 and bl='' and no_shipment='' and koordinat!='' and used=0 and hidup=1 group by kd_mu");
}


$htc=1;
 while ( $load=$select_htc->fetch()) {
   $kdman_unit   =$_POST['kdman_unit'.$htc];
   $alokasi_pohon=$_POST['alokasi_pohon'.$htc];

   $wins_alo=$alokasi_pohon/$treeperwins;

$k=1;

while ($k <= $wins_alo ) {
$jml_ns=$conn->query("select no_sh from add_current_tree where bl like '%$date%' and id_part='$id_partisipan[0]' order by no_sh desc limit 1 ")->fetch();
$jml_ns2=$jml_ns[0]+1;
$no_ship_htc=$id_partisipan[0].''.$date.''.$jml_ns2;
$data_lahan=$conn->query("select * from current_tree where bl='1111-11-11' and no_shipment='$no_ship_htc' group by no_t4tlahan");

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

    $a=$conn->query("select count(*) from current_tree where bl='1111-11-11' and no_shipment='$no_ship_htc' group by no_t4tlahan");

    $j=1;
    while ($jml_pohon=$a->fetch()) {

        $jml_pohon2[$j]=$jml_pohon[0];

    $j++;

    }





    //no - bl - tujuan - kd lahan - no lahan - geo - silvilkultur - luas - petani - desa - ta - mu - jml phn - geo 2 - no shipment - time
    $query_htc=$conn->query("INSERT into t4t_htc (bl,tujuan,kd_lahan,no_lahan,geo,silvilkultur,luas,petani,desa,ta,mu,jml_phn,no_shipment,time) values ('$bl','$destination','$kd_lahan2','$no_lahan2','$geo2','$silvilkultur2[0]','$luas2','$petani2[0]','$desa2[0]','$ta2[0]','$mu2[0]','$jml_pohon2[$i]','$no_ship_htc','$time')");

    $query_current_tree_update2=$conn->query("update current_tree set bl='$bl' where bl='1111-11-11' and no_shipment='$no_ship_htc'");



$i++;
}
  $k++;
}//end while
 $htc++;
 }



//header("location:../../admin.php?c3b00eb86cd337880f1639111f2af716061ba997b556a75c89e9bad84f0eb324");
header("location:ac_transaction.php");

?>
