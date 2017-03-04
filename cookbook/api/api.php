<?php
// @codeCoverageIgnoreStart
require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ .'/../../conf/config.php';

use cookbook\api\CookbookApp;

$app = new CookbookApp;
$app->run();
// @codeCoverageIgnoreStart
