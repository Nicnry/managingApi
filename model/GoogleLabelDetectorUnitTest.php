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

    protected function setUp(): void
    {
        $this->labelDetector = new GoogleLabelDetectorImpl();
        $this->pathToTestFolder = dirname(__DIR__, 1)."/public/assets/";
        $this->imageName = "saturnV.jpg";
        $this->jsonName = "our_expected.json";
        $this->fullPathToImage = $this->pathToTestFolder.$this->imageName;
        $this->fullPathToExpectedJson = $this->pathToTestFolder.$this->jsonName;
        $this->maxLabels = 1;
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

    protected function tearDown(): void
    {

    }
}