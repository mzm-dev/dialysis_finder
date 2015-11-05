<?php

include_once '../lib/dbconfig.php';

//print_r($_POST);
if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['delete_id'];
    $dialysis->deleteDialysis($id);
    header("Location: index.php");
} else {
    header("Location: index.php");
}
