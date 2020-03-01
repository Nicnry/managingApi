<?php 

namespace App;

class AwsLabelDetectorImpl extends LabelDetector 
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
                    return "Unknow method";
                    break;
            }
        }

        if($name == 'ApiRequest') {
            switch(count($arguments)) {
                case 1 : 
                    return call_user_func_array(array($this, 'ApiRequestTwoArgs'), $arguments);
                    break;
                case 2 : 
                    return call_user_func_array(array($this, 'ApiRequestThreeArgs'), $arguments);
                    break;
                default:
                    return "Unknow method $name with $arguments arguments";
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

    private function ApiRequestThreeArgs($bucketName, $dataObjectName, $maxLabels) {
        return null;
    }

    private function GetImageAsByteArray($imageFilePath) {
        return null;
    }
}