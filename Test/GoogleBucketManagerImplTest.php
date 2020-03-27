<?php
namespace App\Test;

use App\Model\GoogleBucketManagerImpl;
use PHPUnit\Framework\TestCase;
use Dotenv;

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
    private $fullPathToImage;
    private $projectId;

    /**
     * This test method initializes the context before each test method run.
     */
    protected function setUp(): void
    {
        $this->projectId = getenv('PROJECT_ID');
        $this->bucketName = "bucket_ajd_nhy";
        $this->domain = "actualit.info";
        $this->bucketUrl = $this->bucketName . "." . $this->domain;
        $this->imageName = "picture_ajd_nhy.jpg";
        $this->fullPathToImage = realpath('./public/assets/') . $this->imageName;
        $this->prefixObjectDownloaded = "downloaded";
        $this->bucketManager = new GoogleBucketManagerImpl($this->projectId, $this->domain, $this->bucketName);
    }

    /**
     * This test method checks the method in charge of creating a new object
     * We try to create a new bucket
     */
    public function testCreateObjectCreateNewBucketSuccess()
    {
        //given
        $this->assertFalse($this->bucketManager->IsObjectExists($this->bucketName));

        //when
        $this->bucketManager->CreateObject($this->bucketName);

        //then
        $this->assertTrue($this->bucketManager->IsObjectExists($this->bucketName));
    }

    /**
     * This test method checks the method in charge of creating a new object
     * We try to create a file in an existing bucket
     */
    public function testCreateObjectCreateNewFileSuccess()
    {
        //given
        $fileName = $this->imageName;
        $objectUrl = $this->fullPathToImage;

        /* Async */
        $this->bucketManager->CreateObject($this->bucketName);
        $this->assertTrue($this->bucketManager->IsObjectExists($this->bucketName));
        $this->assertFalse($this->bucketManager->IsObjectExists($fileName));

        //when
        $this->bucketManager->CreateObject($fileName, $objectUrl);

        //then
        $this->assertTrue($this->bucketManager->IsObjectExists($fileName));
    }

    /**
     * This test method checks the method in charge of uploading item in an existing bucket
     */
    public function testDownloadObjectNominalCaseSuccess()
    {
        //given
        $fileName = $this->imageName;
        $objectUrl = $this->fullPathToImage;
        $destinationFullPath = realpath("./public/assets") . "/" . $this->imageName;
        $this->bucketManager->CreateObject($fileName, $objectUrl);
        $this->assertTrue($this->bucketManager->IsObjectExists($fileName));

        //when
        $this->bucketManager->DownloadObject($fileName, $destinationFullPath);

        //then
        $this->assertTrue(file_exists($destinationFullPath));
    }

    /**
     * This test method checks the method in charge of testing the existence of an object
     */
    public function testIsObjectExistsNominalCaseSuccess()
    {
        // given
        $fileName = $this->imageName;
        $objectUrl = $this->fullPathToImage;

        //when
        $this->bucketManager->CreateObject($fileName, $objectUrl);

        //then
        $this->assertTrue($this->bucketManager->IsObjectExists($fileName));
    }

    /**
     * This test method checks the method in charge of testing the existence of an object
     * When the object doesn't exist (object is the bucket)
     */
    public function testIsObjectExistsObjectNotExistBucketSuccess()
    {
         //given
         $notExistingBucket = "notExistingBucket";      

         //then
         $this->assertFalse($this->bucketManager->IsObjectExists($notExistingBucket));
    }

    /**
     * This test method checks the method in charge of testing the existence of an object
     * When the object doesn't exist (object is the file in an existing bucket)
     */
    public function testIsObjectExistsObjectNotExistFileSuccess()
    {
         //given
         $notExistingFile = "notExistingFile.jpg";

         //then
         $this->assertFalse($this->bucketManager->IsObjectExists($notExistingFile));
    }

    /**
     * This test method checks the method in charge of removing an existing object
     */
    public function testRemoveObjectNominalCaseSuccess()
    {
        //given

        /* Async */
        $this->bucketManager->CreateObject($this->bucketName);
        $this->assertTrue($this->bucketManager->IsObjectExists($this->bucketName));

        //when
        $this->bucketManager->RemoveObject($this->bucketName);

        //then
        $this->assertFalse($this->bucketManager->IsObjectExists($this->bucketName));
    }

    /**
     * This test method cleans up the context after each test method run.
     */
    protected function tearDown(): void
    {
        if($this->bucketManager->IsObjectExists($this->bucketName)){
            $this->bucketManager->RemoveObject($this->bucketName);
        }

        if($this->bucketManager->IsObjectExists($this->imageName)){
            $this->bucketManager->RemoveObject($this->imageName);
        }

        $imageFullPath = realpath("./public/assets") . "/" . $this->imageName;
        if(file_exists($imageFullPath))
        {
            unlink($imageFullPath);
        }
    }
}
