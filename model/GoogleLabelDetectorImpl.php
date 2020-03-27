<?php
require __DIR__.'/../interface/ILabelDetector.php';
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

/**
 * This class is designed to manage an instance of GoogleLabelDetector
 */
class GoogleLabelDetectorImpl implements ILabelDetector
{
    private $labels; 

    /**
     * This constructor returns a new GoogleLabelDector's instance
     */
    public function __construct(){}

    /**
     * This function will get the labels and return to json array
     *
     * @param String $imageUri
     * @param Int $maxLabels
     * @param Int $minConfidence
     * @return Void
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

        $this->labels = implode($labelJson);

        $imageAnnotator->close();
    }

    /**
     * @return String
     */
    public function ToString() {
        return json_encode($this->labels);
    }
    
}