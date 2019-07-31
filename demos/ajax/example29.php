<?php

require_once('../config/config.php');
require_once('../classes/Datatables.php' );

$response = [];
$q = isset($_GET['q']) ? $_GET['q'] : '';

// SQL server connection information
$sql_details = array(
    'user' => $db_user,
    'pass' => $db_pass,
    'db'   => $db_name,
    'host' => $db_host,
);

/*------------------------------------------------------------------------------
 * 
----------------------------------------------------------------------------- */

if($q == 'countries'){
    $table = 'countries';
    $primaryKey = 'id';
   
    // Array of database columns 
    $columns = array(     
        array('db' => 'id',   'dt' => 0),
        array('db' => 'name', 'dt' => 1)
    );
    
    $selectedIds = isset($_GET['ids']) && !empty($_GET['ids']) ? $_GET['ids'] : []; 
    $whereResult = !empty($selectedIds) ? "id IN($selectedIds)" : null;
    
    $response = Datatables::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult, $whereAll = null);
}

/*------------------------------------------------------------------------------
 * 
----------------------------------------------------------------------------- */

elseif($q == 'states'){
    $table = 'states';
    $primaryKey = 'id';
    
    // Array of database columns 
    $columns = array(     
        array('db' => 'id',   'dt' => 0),
        array('db' => 'name', 'dt' => 1)
    );

    $selectedIds = isset($_GET['ids']) && !empty($_GET['ids']) ? $_GET['ids'] : []; 
    $whereResult = !empty($selectedIds) ? "id IN($selectedIds)" : null;
    
    // get the country_id passed via ajax data
    $whereAll = null; 
    if(isset($_GET['country_id']) && !empty($_GET['country_id'])){
        $whereAll = "country_id = ".$_GET['country_id']; // make sure to secure the data passed here
    }
    
    $response = Datatables::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult, $whereAll);
}

/*------------------------------------------------------------------------------
 * 
----------------------------------------------------------------------------- */

elseif($q == 'cities'){
    $table = 'cities';
    $primaryKey = 'id';
    
    // Array of database columns 
    $columns = array(     
        array('db' => 'id',   'dt' => 0),
        array('db' => 'name', 'dt' => 1)
    );

    $selectedIds = isset($_GET['ids']) && !empty($_GET['ids']) ? $_GET['ids'] : []; 
    $whereResult = !empty($selectedIds) ? "id IN($selectedIds)" : null;
    
    // get the country_id passed via ajax data
    $whereAll = null; 
    if(isset($_GET['state_ids']) && !empty($_GET['state_ids'])){
        $state_ids = implode(',', $_GET['state_ids']);
        $whereAll = "state_id IN ($state_ids)";  // make sure to secure the data passed here
    }

    $response = Datatables::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult, $whereAll);
}


/*------------------------------------------------------------------------------
 * submit the form
----------------------------------------------------------------------------- */

elseif($q == 'submit'){
    
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    
}

/*------------------------------------------------------------------------------
 * Bad request
----------------------------------------------------------------------------- */

else{
    $response = ['type' => 'error', 'message' => '400 Bad Request'];
}

/*------------------------------------------------------------------------------
 * 
----------------------------------------------------------------------------- */

echo json_encode($response);


