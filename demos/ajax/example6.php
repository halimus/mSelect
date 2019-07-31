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
    
    // get the selected rows ids
    $selectedIds = isset($_GET['my_id']) && !empty($_GET['my_id']) ? $_GET['my_id'] : []; 
    $whereResult = !empty($selectedIds) ? "id IN($selectedIds)" : null;
    
    echo json_encode(
       Datatables::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult, $whereAll = null)
    );
?>



