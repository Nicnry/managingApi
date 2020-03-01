<?php 

# Imports the Google Cloud client library
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

namespace App;

class GoogleLabelDetectorImpl extends LabelDetector 
{
    private $client;
    private $labels;

    public function __construct() {
        return null;
    }
    
    public function __call($name, $arguments) {
        if($name == 'MakeAnalysisRequest') {
            switch(count($arguments)) {
                case 1 : 
                    return call_user_func_array(array($this, 'MakeAnalysisRequestOneArg'), $arguments);
                    break;
                case 2 : 
                    return call_user_func_array(array($this, 'MakeAnalysisRequestTwoArgs'), $arguments);
                    break;
                default:
                    return "No method $name with $arguments arguments";
                    break;
            }
        }
    }

    public function MakeAnalysisRequestOneArg($imageFilePath) {
        return null;
    } 

    public function MakeAnalysisRequestTwoArgs($bucketName, $dataObjectName) {
        return null;
    }

    public function ToString() {
        return null;
    }

    private function ApiRequestTwoArgs($image, $maxLabels) {
        return null;
    }

    private function GetImageAsByteArray($imageFilePath) {
        return null;
    }
}