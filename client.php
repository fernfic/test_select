<?php
// Pull in the NuSOAP code
require_once('lib/nusoap.php');
// Create the client instance
$client = new nusoap_client("https://testselect-wolfbit.c9users.io/server.php?wsdl");

$data = array('room' => '03', 'time' => '12-09-2016 05:00', 'temp' => 22.5, 'humadity' => 10.12);
// print_r($person);
$result = $client->call("get_data", array("room" => '03'));
print_r($result);
?>