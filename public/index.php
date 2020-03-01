<?php

require __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

function auth_cloud_implicit($projectId)
{
    $config = [
        'projectId' => $projectId,
    ];
    $storage = new StorageClient($config);
}

auth_cloud_implicit(getenv('PROJECT_ID'));

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