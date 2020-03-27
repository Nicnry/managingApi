<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../model/GoogleLabelDetectorImpl.php';
require __DIR__.'/../model/GoogleBucketManagerImpl.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();
echo "Silence is Golden</br>";

echo '<a href="./assets/docs/phpdox/html/html/index.xhtml">Documentation de classe</a>';

// Detect labels for saternV.jpg
$google = new GoogleLabelDetectorImpl();

// Labels
// $google->MakeAnalysisRequest('./assets/saturnV.jpg');
// echo $google->ToString();


// Connect to the bucket
$projectId = getenv('PROJECT_ID');
$domain = 'actualit.info';
$bucketName = 'bucket_ajd_nhy';
$objectUrl = "Loutre.jpg";
$filePath = realpath("./assets/saturnV.jpg");
$destinationUri = realpath("./assets") . "/" . "uploadedfile.jpg";

$bucket = new GoogleBucketManagerImpl($projectId, $domain, $bucketName);

// Bucket
// echo $bucket->CreateObject($bucketName);
// var_dump($bucket->IsObjectExists("picture_ajd_nhy.jpg"));
// $bucket->RemoveObject($bucketName);


// File
// echo $bucket->CreateObject($objectUrl, $filePath);
// var_dump($bucket->IsObjectExists($objectUrl));
// $bucket->DownloadObject($objectUrl, $destinationUri);
// $bucket->RemoveObject($objectUrl);

?>

