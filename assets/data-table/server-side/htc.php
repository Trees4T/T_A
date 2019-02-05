<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' )) {

    require 'ssp.class.php';
    require '../../../koneksi/koneksi.php';
    // nama table
    $table = 't4t_htc';

    // Table's primary key
    $primaryKey = 'no';

    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case simple
    // indexes

    $columns = array(
        array('db' => 'no', 'dt' => 'no'),
        array('db' => 'no_shipment', 'dt' => 'no_shipment'),
        array('db' => 'bl', 'dt' => 'bl'),
        array('db' => 'tujuan', 'dt' => 'tujuan'),
        array('db' => 'geo', 'dt' => 'geo'),
        array('db' => 'silvilkultur', 'dt' => 'silvilkultur'),
        array('db' => 'luas', 'dt' => 'luas'),
        array('db' => 'petani', 'dt' => 'petani'),
        array('db' => 'desa', 'dt' => 'desa'),
        array('db' => 'ta', 'dt' => 'ta'),
        array('db' => 'mu', 'dt' => 'mu'),
        array('db' => 'jml_phn', 'dt' => 'jml_phn')
    );

    // SQL server connection information
    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db' => $database,
        'host' => $host,
        'port' => $port
    );

    //     $sql_details = array(
    //     'user' => 'root',
    //     'pass' => '',
    //     'db' => 't4t_t4t',
    //     'host' => 'localhost'
    // );


    echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
} else {
    echo '<script>window.location="404.html"</script>';
}
?>
