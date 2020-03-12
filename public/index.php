<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../model/GoogleLabelDetectorImpl.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

$google = new GoogleLabelDetectorImpl('ok', 'ok');
$google->MakeAnalysisRequest('./assets/saturnV.jpg');
echo $google->ToString();
