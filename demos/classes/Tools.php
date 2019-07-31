<?php

/**
 * Description of Tools
 *
 * @author Halim
 */
class Tools {
    
    private $db = null;
    
    public function __construct($db = null) {
        $this->db = $db;
    }
    
    
    public function data_dropdown($table, $fields = null, $where = null, $orderBy = null, $order = 'ASC', $limit = null){    
        
        $fields = !empty($fields) ? $fields : ['id', 'name'];
        
        $sql = "SELECT * FROM $table WHERE 1=1";
        
        $sql.= !empty($where)   ? ' AND '.$where : '';
        $sql.= !empty($orderBy) ? ' ORDER BY '.$orderBy.' '.$order : ' ORDER BY name '.$order;
        $sql.= !empty($limit)   ? ' LIMIT '.$limit : '';
        
        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $data = array();
        foreach ($rows as $row) {
            $id   = $fields[0];
            $name = $fields[1];
            $data[$row[$id]] = $row[$name];
        }
        return $data;
    }
    
    
    public function dbg($data, $stop = ''){
        if(is_array($data)){
            echo '<pre>';
            print_r($data);
            echo '<pre>';
        }
        else{
            echo $data;
        }
        if(!empty($stop)){
            die("<br>Stop debugging...");
        }
    }
    
}
