<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../model/GoogleApi.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

$google = new GoogleApi();
echo $google->get_all_labels('./assets/saturnV.jpg');
