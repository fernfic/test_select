<?php
require_once('lib/nusoap.php');
// Create the client instance
$client = new nusoap_client("https://testselect-wolfbit.c9users.io/server.php?wsdl");

$data = array('room' => '01', 'time' => '12-09-2016 05:00', 'temp' => 22.5, 'humidity' => 10.12);
$result = $client->call("get_data", array("room" => '02'));
print_r($result);
?>