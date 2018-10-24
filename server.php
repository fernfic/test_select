<?php
require_once "lib/nusoap.php";

$us = "urn:air_data";

$server = new soap_server();
$server->configureWSDL('PowerData', $us);
$server->wsdl->schemaTargetNamespace->$us;
$server->soap_defencoding = 'utf-8';
$server->register("getInfoPower",array("day"=>"xsd:string"),
				 				array("return"=>"xsd:string"), $us
                  );

if(!isset($HTTP_RAW_POST_DATA)){
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}

function getInfoPower($day){
    $dbcon =  mysqli_connect('localhost', 'wolfbit', '', 'air_data') or die('not connect database'.mysqli_connect_error());
	mysqli_set_charset($dbcon, 'utf8');
    $query = "SELECT * FROM data_table WHERE day='$day'";

    // $keep_data = [];
    $result = mysqli_query($dbcon, $query);

    
    if($result != null){
        $xml .= "<air_data>";
        if($result){
		    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		        $xml .="<air>";
    			$xml .= "<day>".$row['day']."</day>";
    			$xml .= "<temp>".$row['temp']."</temp>";
    			$xml .= "<humadity>".$row['humadity']."</humadity>";
    			$xml .="</air>";
		    }
        }else{
            $xml .= "<error>No Data</error>";
        }
        $xml .="</air_data>";
    }else{
        $xml .="<error>Error".mysqli_error()."</error>";
    }
    $response = new soapval('return', 'xsd:string', $xml);
    mysqli_close($dbcon);
    return $response;
}


$server->service($HTTP_RAW_POST_DATA);