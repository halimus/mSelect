<?php
    require('../config/config.php');
    require('../classes/Datatables.php' );

    // DB table to use
    $table = 'view_states';

    // Table's primary key
    $primaryKey = 'id';

    // Array of table columns
    $columns = array(
        array('db' => 'id', 'dt' => 0),
        array('db' => 'name', 'dt' => 1),
        array('db' => 'country_name', 'dt' => 2),
        array('db' => 'country_phone', 'dt' => 3)
    );
    

    // SQL server connection information
    $sql_details = array(
        'user' => $db_user,
        'pass' => $db_pass,
        'db'   => $db_name,
        'host' => $db_host,
    );
    
    // get the selected rows ids
    $selectedIds = isset($_GET['ids']) && !empty($_GET['ids']) ? $_GET['ids'] : []; 
    $whereResult = !empty($selectedIds) ? "id IN($selectedIds)" : null;
    
    echo json_encode(
       Datatables::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult, $whereAll = null)
    );
?>



