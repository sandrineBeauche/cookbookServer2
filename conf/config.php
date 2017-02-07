<?php
$env = getenv("cookbook_env");
if($env == false){
    //$env = "preprod";
    $env = "dev";
}
$configFile = __DIR__ .'/generated-conf/'.$env.'/config.php';
require_once $configFile;