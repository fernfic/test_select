<?php 
require_once "lib/nusoap.php";
$client = new nusoap_client("https://testselect-wolfbit.c9users.io/server.php?wsdl");
    
$data = $client->call("getInfoPower",array('day'=>"MON"));
    
$xml=simplexml_load_string($data);
print_r($data);
?>