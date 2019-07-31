<?php
    require('../config/config.php');
    require('../classes/Datatables.php' );

    // DB table to use
    $table = 'countries';

    // Table's primary key
    $primaryKey = 'id';

    // Array of table columns
    $columns = array(
        array('db' => 'id', 'dt' => 0),
        array('db' => 'name', 'dt' => 1)
    );

    // SQL server connection information
    $sql_details = array(
        'user' => $db_user,
        'pass' => $db_pass,
        'db'   => $db_name,
        'host' => $db_host,
    );

    echo json_encode(
       Datatables::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
?>
