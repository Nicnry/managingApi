<?php

require __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

# Imports the Google Cloud client library
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

function auth_cloud_implicit($projectId)
{
    $config = [
        'projectId' => $projectId,
    ];
    $storage = new StorageClient($config);
}

auth_cloud_implicit(getenv('PROJECT_ID'));

/* function upload_object($bucketName, $objectName, $source)
{
    $storage = new StorageClient();
    $file = fopen($source, 'r');
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->upload($file, [
        'name' => $objectName
    ]);
    printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
}

upload_object(getenv('BUCKET_NAME'), 'name', 'path'); */

// $path = 'path/to/your/image.jpg'

function detect_label($path)
{
    $imageAnnotator = new ImageAnnotatorClient();

    # annotate the image
    $image = file_get_contents($path);
    $response = $imageAnnotator->labelDetection($image);
    $labels = $response->getLabelAnnotations();

    if ($labels) {
        print("Labels:" . PHP_EOL);
        foreach ($labels as $label) {
            print($label->getDescription() . PHP_EOL);
        }
    } else {
        print('No label found' . PHP_EOL);
    }

    $imageAnnotator->close();
}


detect_label('./assets/saturnV.jpg');