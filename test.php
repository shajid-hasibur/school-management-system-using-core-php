<?php
include('database.php');

$obj = new Database();

// $obj->insert('years',['name'=>'2028']);
// $obj->update('years',['name'=>'2029'],'id="12"');
$obj->delete('years','id="12"');
echo "delete result is : ";
print_r($obj->getResult());

?>