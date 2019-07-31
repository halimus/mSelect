<?php
    require('../config/config.php');
    require('../classes/Datatables.php' );

    // DB table to use
    $table = 'states';

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
    $selectedIds = isset($_GET['ids']) && !empty($_GET['ids']) ? $_GET['ids'] : []; 
    $whereResult = !empty($selectedIds) ? "id IN($selectedIds)" : null;
    
    // get the country_id passed via ajax data
    $whereAll = null; 
    if(isset($_GET['country_id']) && !empty($_GET['country_id'])){
        $whereAll = "country_id = ".$_GET['country_id']; // make sure to secure the data passed here
    }
    
    echo json_encode(
        Datatables::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult, $whereAll)
    );
?>
