<?php
use PHPUnit\Framework\TestCase;


require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../model/GoogleLabelDetectorImpl.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class GoogleLabelDetectorUnitTest extends TestCase
{
    private $labelDetector;
    private $pathToTestFolder;
    private $imageName;
    private $jsonName;
    private $fullPathToImage;
    private $fullPathToExpectedJson;
    private $maxLabels;
    private $imageUri;
    private $bucketUrl;

    protected function setUp(): void
    {
        //TODO: Use expected.json instead of our_expected.json, when the format will be fixed
        $expectedJson = file_get_contents("./public/assets/our_expected.json");
    }

    public function testMakeAnalysisLocalFileSuccess()
    {
        //given
        $actualJson = "";
        $expectedJson = file_get_contents($this->fullPathToExpectedJson);
        
        //when
        $this->labelDetector->MakeAnalysisRequest($this->fullPathToImage, $this->maxLabels);
        
        //then
        //compare expected json with result json
        $actualJson = $this->labelDetector->ToString();
        $this->assertEqualsIgnoringCase($expectedJson, $actualJson);
    }

    public function testMakeAnalysisBucketObjectSuccess()
    {
        //given
        $actualJson = "";
        $expectedJson = file_get_contents($this->fullPathToExpectedJson);
        $this->imageUri = $this->bucketUrl + "/" + $this->imageName;
        
        //when
        $this->labelDetector->MakeAnalysisRequest($this->imageUri);
        
        //then
        //compare expected json with result json
        $actualJson = $this->labelDetector->ToString();
        $this->assertEqualsIgnoringCase($expectedJson, $actualJson);
    }

    protected function tearDown(): void
    {

    }
}