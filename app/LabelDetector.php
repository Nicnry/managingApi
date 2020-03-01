<?php 

namespace App;

interface LabelDetector
{
    public function __call($name, $arguments); //Php doesn't allow method overloading, so we need to use a __call method
    public function MakeAnalysisRequestOneArg($imageFilePath);   //Ends by 1 to be used with the number of args 
    public function MakeAnalysisRequestTwoArgs($bucketName, $dataObjectName); //Ends by 2 to be used with the number of args 
    public function ToString();
}