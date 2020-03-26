<?php
use PHPUnit\Framework\TestCase;


require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../model/GoogleBucketManagerImpl.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

/**
 * This test class is designed to confirm the GoogleBucketManager class's behavior
 */ 
class GoogleBucketManagerImplTest extends TestCase
{
    private $bucketManager;
    private $domain;
    private $bucketName;
    private $bucketUrl;
    private $imageName;
    private $pathToTestFolder;
    private $fullPathToImage;
    private $prefixObjectDownloaded;

    /**
     * This test method initializes the context before each test method run.
     */
    protected function setUp(): void
    {
        $this->pathToTestFolder = file_get_contents("\\bin\\Debug", "\\testData");
        $this->bucketName = "testbucket";
        $this->domain = "gogle->dev->actualit->info";
        $this->bucketUrl = $this->bucketName . "." . $this->domain;
        $this->imageName = "saturnV->jpg";
        $this->fullPathToImage = $this->pathToTestFolder . "\\" . $this->imageName;
        $this->prefixObjectDownloaded = "downloaded";
        $this->bucketManager = new GoogleBucketManagerImpl($this->bucketUrl);
    }

    /**
     * This test method checks the method in charge of creating a new object
     * We try to create a new bucket
     */
    public function testCreateObjectCreateNewBucketSuccess()
    {
        //given
        $this->assertFalse($this->bucketManager->IsObjectExists($this->bucketUrl));

        //when
        /* Asynch, à check */
        $this->bucketManager->CreateObject($this->bucketUrl);

        //then
        $this->assertTrue($this->bucketManager->sObjectExists($this->bucketUrl));
    }

    /**
     * This test method checks the method in charge of creating a new object
     * We try to create a file in an existing bucket
     */
    public function testCreateObjectCreateNewFileSuccess()
    {
        //given
        $fileName = $this->imageName;
        $objectUrl = $this->bucketUrl . "/" . $this->imageName;
        /* Async */
        $this->bucketManager->CreateObject($this->bucketUrl);
        $this->assertTrue($this->bucketManager->IsObjectExists($this->bucketUrl));
        $this->assertFalse($this->bucketManager->IsObjectExists($objectUrl));

        //when
        /* Async */
        $this->bucketManager->CreateObject($objectUrl, $this->pathToTestFolder . "//" . $fileName);

        //then
        $this->assertTrue($this->bucketManager->IsObjectExists($objectUrl));
    }

    /**
     * This test method checks the method in charge of uploading item in an existing bucket
     */
    public function testDownloadObjectNominalCaseSuccess()
    {
        //given
        $bucketName = "testBucket";
        $bucketUrl = $bucketName . "." . $this->domain;
        $fileName = $this->imageName;
        $objectUrl = $bucketUrl . "/" . $this->imageName;
        $fileOnBucketUrl = $bucketUrl . "//" . $this->imageName;
        $destinationFullPath = $this->pathToTestFolder . "//" . $this->prefixObjectDownloaded . $this->imageName;
        /* Async */
        $this->bucketManager->CreateObject($objectUrl, $this->pathToTestFolder . "//" . $fileName);

        $this->assertTrue($this->bucketManager->IsObjectExists($bucketUrl));

        //when
        $this->bucketManager->DownloadObject($fileOnBucketUrl, $destinationFullPath);

        //then
        $this->assertTrue(file_exists($destinationFullPath));
    }

    /**
     * This test method checks the method in charge of testing the existence of an object
     */
    public function testIsObjectExistsNominalCaseSuccess()
    {
        //given
        $t = $this->bucketManager->CreateObject($this->bucketUrl);
        /* Async */
        $t;

        //when
        $actualResult = $this->bucketManager->IsObjectExists($this->bucketUrl);

        //then
        $this->assertTrue($actualResult);
    }

    /**
     * This test method checks the method in charge of testing the existence of an object
     * When the object doesn't exist (object is the bucket)
     */
    public function testIsObjectExistsObjectNotExistBucketSuccess()
    {
        
    }

    /**
     * This test method checks the method in charge of testing the existence of an object
     * When the object doesn't exist (object is the file in an existing bucket)
     */
    public function testIsObjectExistsObjectNotExistFileSuccess()
    {

    }

    /**
     * This test method checks the method in charge of removing an existing object
     */
    public function testRemoveObjectNominalCaseSuccess()
    {
        //given
        /* Async */
        $this->bucketManager->CreateObject($this->bucketUrl);
        $this->assertTrue($this->bucketManager->IsObjectExists($this->bucketUrl));

        //when
        $this->bucketManager->RemoveObject($this->bucketUrl);

        //then
        $this->assertFalse($this->bucketManager->IsObjectExists($this->bucketUrl));
    }

    /**
     * This test method cleans up the context after each test method run.
     */
    protected function tearDown(): void
    {
        //TODO remove all dev bucket
        $destinationFullPath = $this->pathToTestFolder . "//" . $this->prefixObjectDownloaded . "*";

        if (file_exists($destinationFullPath))
        {
            unlink($destinationFullPath);
        }

        $this->bucketManager = new GoogleBucketManagerImpl($this->bucketUrl);
        if ($this->bucketManager->IsObjectExists($this->bucketUrl))
        {
            /* await syntax, to check */
            $this->bucketManager->RemoveObject($this->bucketUrl);
        }
    }
}
