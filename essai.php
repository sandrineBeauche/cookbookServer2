<?php

// setup the autoloading
require __DIR__ . '/vendor/autoload.php';

// setup Propel
require_once __DIR__ .'/conf/generated-conf/config.php';

$q = new cookbook\cookbook\UsersQuery();
$user = $q->findById(1);

echo $user->toJSON();



?>