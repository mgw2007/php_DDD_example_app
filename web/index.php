<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
function pre($r){
    echo "<pre>";
    print_r($r);
    echo "</pre>";
}
//
include "../vendor/autoload.php";
//
//
include "../src/Item/Infrastructure/Api/bootstrap.php";
