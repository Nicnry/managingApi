<?php

interface ILabelDetector
{

    /**
     * This function will get the labels and return to json array
     *
     * @param String $imageUri
     * @param Int $maxLabels
     * @param Int $minConfidence
     * @return Void
     */
    public function MakeAnalysisRequest($imageUri, $maxLabels = 1, $minConfidence = 80);

    /**
     * @return String
     */
    public function ToString();
    
    // public function auth_cloud_implicit($projectId);

    // /**
    //  * This function will get the labels and return to json array
    //  *
    //  * @param String $path
    //  * @return Json
    //  */
    // public function get_all_labels($path);

    // public function upload_object($bucketName, $objectName, $source);
}