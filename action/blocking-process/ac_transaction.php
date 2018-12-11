<?php
//Memulai session
ob_start();
 session_start();

include '../../koneksi/koneksi.php';


date_default_timezone_set('Asia/Jakarta');
$tanggal 	= date("Y-m-d");
$log_user	= $_SESSION['ids'];
$waktu		= date("d/m/Y - h:i:sa");

$bl=$conn->query("select bl from t4t_wins where time='$tanggal' and log_user='$log_user' order by no desc limit 1")->fetch();
$user=$conn->query("select uname from otenuser where id='$log_user'")->fetch();
$data=$conn->query("select trans_type,id_part,no_order from t4t_wins where bl='$bl[0]' and time='$tanggal' and log_user='$log_user' order by no desc limit 1")->fetch();
$id_part=$data['id_part'];
$partisipan=$conn->query("SELECT name from t4t_participant where id='$id_part'")->fetch();
$no_ship=$conn->query("select no_shipment from t4t_wins where bl='$bl[0]' and time='$tanggal' and log_user='$log_user' order by no_shipment asc limit 1")->fetch();
$htc=$conn->query("select no from t4t_htc where bl='$bl[0]' and time='$tanggal' order by no asc limit 1")->fetch();

$wins=$conn->query("select count(*) from t4t_wins where bl='$bl[0]' and time='$tanggal' and log_user='$log_user'")->fetch();
$wins_pertama=$conn->query("select wins from t4t_wins where bl='$bl[0]' and time='$tanggal' and log_user='$log_user' order by wins asc limit 1")->fetch();
$wins_terakhir=$conn->query("select wins from t4t_wins where bl='$bl[0]' and time='$tanggal' and log_user='$log_user' order by wins desc limit 1")->fetch();

if ($data['trans_type']==1) {
	$data['trans_type']="Container";
}elseif ($data['trans_type']==2) {
	$data['trans_type']="Donation";
}elseif ($data['trans_type']==3) {
	$data['trans_type']="Merchant";
}elseif ($data['trans_type']==4) {
	$data['trans_type']="Sponsorship";
}
if ($data['trans_type']=="Merchant") {
	$tree=$conn->query("select count(*) from current_tree where bl='$bl[0]'")->fetch();
}else{
   $tree=$conn->query("select count(*) from current_tree where bl='$bl[0]' and no_shipment='$no_ship[0]'")->fetch();
}

$jumlah_sesi=$_SESSION['jml_sesi']+1;

$_SESSION['users'.$jumlah_sesi.'']			=$user[0];
$_SESSION['waktu'.$jumlah_sesi.'']			=$waktu;

$_SESSION['type_transaksi'.$jumlah_sesi.'']	=$data['trans_type'];
$_SESSION['nama_partisipan'.$jumlah_sesi.'']=$partisipan[0];
$_SESSION['no_order'.$jumlah_sesi.'']		=$data['no_order'];
$_SESSION['no_shipment'.$jumlah_sesi.'']	=$no_ship[0];
$_SESSION['htc_id'.$jumlah_sesi.'']			=$htc[0];
$_SESSION['bl'.$jumlah_sesi.'']				=$bl[0];
$_SESSION['qty_trees'.$jumlah_sesi.'']		=$tree[0];
$_SESSION['qty_wins'.$jumlah_sesi.'']		=$wins[0];
$_SESSION['first_wins'.$jumlah_sesi.'']		=$wins_pertama[0];
$_SESSION['last_wins'.$jumlah_sesi.'']		=$wins_terakhir[0];



$_SESSION['jml_sesi']=$jumlah_sesi;




header("location:../../admin.php?42de454bbfd728cccac78b8cd02dd7a8dad073cd0507d21247b4f3fe00d74be9");

 ?>
