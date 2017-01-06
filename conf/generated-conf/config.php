<?php
$env = getenv("env");
if($env == false){
    $env = "preprod";
}
$configFile = __DIR__ .'/'.$env.'/config.php';
require_once $configFile;