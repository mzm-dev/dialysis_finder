<?php include_once '../lib/dbconfig.php'; ?>
<?php

header("Access-Control-Allow-Origin: *");
$query = "SELECT * FROM dialisis";
$data = $api->getDialysis($query);
echo json_encode($data);
