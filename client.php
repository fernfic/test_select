<?php 
require_once "lib/nusoap.php";
$client = new nusoap_client("https://testselect-wolfbit.c9users.io/server.php?wsdl");
    
$data = $client->call("getInfoPower",array('day'=>"MON"));
    
$xml=simplexml_load_string($data);

?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Air Data</title>
  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
  
</head>

<body>

<div class="container">
    
  <h2>Air</h2>
<form action="client.php" method="post">
  <div class="row">
   <div class="col-sm-6"> 
  <div class="col-sm-6 input">
     <label for="party-time">From :</label>
        <input type="text" id="day"
               name="day" value="<?php echo $today1 ?>"
               />
    </div>
    </div>
    
    <div class="button login" id="submit">
     <button type="submit"><span>GO</span> <i class="fa fa-check"></i></button>
    </div>
</div>
</form>
  <table class="table table-striped" id="myTable">
    <thead>
      <tr>
        <th>Day</th>
        <th>Temp</th>
        <th>Humadity</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    
    if($xml){
    foreach($xml->children() as $power) {
    ?>
      <tr>
        <td><?php echo $power->day; ?></td>
        <td><?php echo $power->temp; ?></td>
        <td><?php echo $power->humadity; ?></td>
      </tr>
    <?php }}?>
    </tbody>
  </table>
</div>

</body>
</html>