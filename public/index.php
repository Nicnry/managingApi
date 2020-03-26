<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../model/GoogleLabelDetectorImpl.php';
require __DIR__.'/../model/GoogleBucketManagerImpl.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

// Detect labels for saternV.jpg
$google = new GoogleLabelDetectorImpl();
$google->MakeAnalysisRequest('./assets/saturnV.jpg');
echo $google->ToString();


// Connect to the bucket
$projectId = getenv('PROJECT_ID');
$domain = 'pictures';
$bucketName = 'bucket_ajd_nhy';

$bucket = new GoogleBucketManagerImpl($projectId, $domain, $bucketName);
echo $bucket->IsObjectExists("bucket_ajd_nhy");
// echo $bucket->CreateObject("abc");
