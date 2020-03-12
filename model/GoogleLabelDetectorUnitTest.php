<?php
use PHPUnit\Framework\TestCase;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../model/GoogleLabelDetectorImpl.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class GoogleLabelDetectorUnitTest extends TestCase
{
    public function test_MakeAnalysis_Success()
    {
        //TODO: Use expected.json instead of our_expected.json, when the format will be fixed
        $expectedJson = file_get_contents("./public/assets/our_expected.json");

        $google = new GoogleLabelDetectorImpl();
        $google->MakeAnalysisRequest('./public/assets/saturnV.jpg');
        $actualJson = $google->ToString();
        
        $this->assertEquals($expectedJson, $actualJson);
    }
}