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
            echo $hasil; echo "<br>";
            //no - win - no_order - pesen? - used? - unused? - vc? - bl - id_part - no shipment - time - log user - type
            //$query_wins=$conn->query("insert into t4t_wins_copy (no,wins,no_order,pesen,used,unused,vc,bl,id_part,no_shipment,time,log_user,trans_type,relation,id_retailer) values ('','$hasil','$no_order','','','','','$bl','$id_partisipan[0]','$no_ship','$date','$log','1','$relation','$relation_part')");
            break;
            $hasil++;
        }


    }

$a++;
}




?>
