<?php

include_once 'app/tripsdb.php';


$trips = new tripsdb();

$records = $trips->gettrips();

$json_data = json_encode($records);
header('content-type:application/json');

echo $json_data;
