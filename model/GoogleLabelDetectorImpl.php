<?php
require __DIR__.'/../interface/ILabelDetector.php';
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleLabelDetectorImpl implements ILabelDetector
{
    private $labels; 
    public function __construct(){

    }

    /**
     * This function will get the labels and return to json array
     *
     * @param String $imageUri
     * @return Json
     */
    public function MakeAnalysisRequest($imageUri, $maxLabels = 1, $minConfidence = 80) {
        $imageAnnotator = new ImageAnnotatorClient();
        $image = file_get_contents($imageUri);
        $response = $imageAnnotator->labelDetection($image);
        $labels = $response->getLabelAnnotations();
        
        if ($labels) {
            foreach ($labels as $label) {
                $labelJson[] = $label->serializeToJsonString();
            }
        } else {
            print('No label found' . PHP_EOL);
            return false;
        }
        $this->labels = $labelJson;
        $imageAnnotator->close();
    }

    public function ToString() {
        $final = json_encode($this->labels);
        return $final;
    }

    // public function auth_cloud_implicit($projectId) {
    //     $config = [
    //         'projectId' => $projectId,
    //     ];
    //     $storage = new StorageClient($config);
    //     return $storage;
    // }

    // /**
    //  * This function will get the labels and return to json array
    //  *
    //  * @param String $path
    //  * @return Json
    //  */
    // public function get_all_labels($path) {
    //     $imageAnnotator = new ImageAnnotatorClient();
    //     $image = file_get_contents($path);
    //     $response = $imageAnnotator->labelDetection($image);
    //     $labels = $response->getLabelAnnotations();
        
    //     if ($labels) {
    //         foreach ($labels as $label) {
    //             $labelJson[] = $label->serializeToJsonString();
    //         }
    //     } else {
    //         print('No label found' . PHP_EOL);
    //         return false;
    //     }
    //     $final = json_encode($labelJson);

    //     $imageAnnotator->close();

    //     return $final;
    // }

    // function upload_object($bucketName, $objectName, $source) {
    //     $storage = new StorageClient();
    //     $file = fopen($source, 'r');
    //     $bucket = $storage->bucket($bucketName);
    //     $object = $bucket->upload($file, [
    //         'name' => $objectName
    //     ]);
    //     printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
    // }
}