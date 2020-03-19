<?php
use PHPUnit\Framework\TestCase;


require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../model/GoogleLabelDetectorImpl.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

/**
 * This test class is designed to confirm the LabelDetector class's behavior
 */
class GoogleLabelDetectorUnitTest extends TestCase
{
    private $labelDetector;
    private $fullPathToImage;
    private $fullPathToExpectedJson;
    private $imageUri;
    private $bucketUrl;
    private $imageName;

    /**
     * This test method initializes the context before each test method run.
     *
     * @return void
     */
    protected function setUp(): void
    {
        //TODO: Use expected.json instead of our_expected.json, when the format will be fixed
        $this->labelDetector = new GoogleLabelDetectorImpl();
        $this->fullPathToImage = realpath('./public/assets/saturnV.jpg');
        $this->fullPathToExpectedJson = realpath('./public/assets/our_expected.json');
    }

    /**
     * This test method checks the MakeAnalysis'answer when we try to analyze a local file
     *
     * @return void
     */
    public function testMakeAnalysisLocalFileSuccess()
    {
        //given
        $actualJson = "";
        $expectedJsonWithInvisibles = file_get_contents($this->fullPathToExpectedJson);
        $expectedJson = preg_replace('/\p{C}+/u', "", $expectedJsonWithInvisibles); // Remove invisible characters, they're given by file_get_contents 
        $this->imageUri = $this->fullPathToImage; // Used only to be more understandable

        //when
        $this->labelDetector->MakeAnalysisRequest($this->imageUri);
        
        //then
        //compare expected json with result json
        $actualJson = $this->labelDetector->ToString();
        $this->assertEquals($expectedJson, $actualJson);
    }

    /**
     * This test method checks the MakeAnalysis'answer when we try to analyze a data object presents on a bucket
     *
     * @return void
     */
    public function testMakeAnalysisBucketObjectSuccess()
    {
        //given
        $actualJson = "";
        $expectedJsonWithInvisibles = file_get_contents($this->fullPathToExpectedJson);
        $expectedJson = preg_replace('/\p{C}+/u', "", $expectedJsonWithInvisibles); // Remove invisible characters, they're given by file_get_contents 
        $this->imageUri = $this->bucketUrl + "/" + $this->imageName;
        
        //when
        $this->labelDetector->MakeAnalysisRequest($this->imageUri);
        
        //then
        //compare expected json with result json
        $actualJson = $this->labelDetector->ToString();
        $this->assertEquals($expectedJson, $actualJson);
    }

    /**
     * This test method cleanups the context after each test method run.
     *
     * @return void
     */
    protected function tearDown(): void
    {

    }
}