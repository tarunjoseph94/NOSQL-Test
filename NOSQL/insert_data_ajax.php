<?php

try {
     
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");  
    $query = new MongoDB\Driver\Query([]); 
    $rows = $mng->executeQuery("test.cur", $query);
        foreach ($rows as $row) {
		if(!isset($row->_id))
		{
			$id=1;
		}
		else
		{
			$id=$row->_id;
		}
    }
    $id++;
    $bulk = new MongoDB\Driver\BulkWrite;
    $doc = ['_id' => $id, 'currate' => $_POST['currate'],'curname' => $_POST['curname'] ];
    $bulk->insert($doc);
    $mng->executeBulkWrite('test.cur', $bulk);
    echo "Success"; 
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";    
}

?>