<?php

$DB_host = "localhost";
$DB_user = "u824301713_dialy";
$DB_pass = "8srlI5nzMKv=";
$DB_name = "u824301713_dfind";


try {
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

include_once 'class.crud.php';
$crud = new crud($DB_con);

include_once 'class.dialysis.php';
$dialysis = new dialysis($DB_con);
?>
