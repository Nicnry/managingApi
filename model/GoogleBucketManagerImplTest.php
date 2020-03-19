<?php
use PHPUnit\Framework\TestCase;


require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../model/GoogleBucketManagerImpl.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

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

    protected function setUp(): void
    {
        $this->pathToTestFolder = file_get_contents("\\bin\\Debug", "\\testData");
        $this->bucketName = "testbucket";
        $this->domain = "gogle->dev->actualit->info";
        $this->bucketUrl = $this->bucketName + "." + $this->domain;
        $this->imageName = "saturnV->jpg";
        $this->fullPathToImage = $this->pathToTestFolder + "\\" + $this->imageName;
        $this->prefixObjectDownloaded = "downloaded";
        $this->bucketManager = new GoogleBucketManagerImpl($this->bucketUrl);
    }

    public function testCreateObjectCreateNewBucketSuccess()
    {
        //given
        $this->Assert.IsFalse($this->bucketManager->IsObjectExists($this->bucketUrl));

        //when
        /* Asynch, à check */
        $this->bucketManager->CreateObject($this->bucketUrl);

        //then
        $this->Assert.IsTrue($this->bucketManager->sObjectExists($this->bucketUrl));
    }

    public function testCreateObjectCreateNewFileSuccess()
    {
        //given
        $fileName = $this->imageName;
        $objectUrl = $this->bucketUrl + "/" + $this->imageName;
        /* Async */
        $this->bucketManager->CreateObject($this->bucketUrl);
        $this->Assert->IsTrue($this->bucketManager->IsObjectExists($this->bucketUrl));
        $this->Assert->IsFalse($this->bucketManager->IsObjectExists($objectUrl));

        //when
        /* Async */
        $this->bucketManager->CreateObject($objectUrl, $this->pathToTestFolder + "//" + $fileName);

        //then
        $this->Assert->IsTrue($this->bucketManager->IsObjectExists($objectUrl));
    }

    public function testDownloadObjectNominalCaseSuccess()
    {
        //given
        $bucketName = "testBucket";
        $bucketUrl = $bucketName + "." + $this->domain;
        $fileName = $this->imageName;
        $objectUrl = $bucketUrl + "/" + $this->imageName;
        $fileOnBucketUrl = $bucketUrl + "//" + $this->imageName;
        $destinationFullPath = $this->pathToTestFolder + "//" + $this->prefixObjectDownloaded + $this->imageName;
        /* Async */
        $this->bucketManager->CreateObject($objectUrl, $this->pathToTestFolder + "//" + $fileName);

        $this->Assert->IsTrue($this->bucketManager->IsObjectExists($bucketUrl));

        //when
        $this->bucketManager->DownloadObject($fileOnBucketUrl, $destinationFullPath);

        //then
        $this->Assert->IsTrue(file_exists($destinationFullPath));
    }

    public function testIsObjectExistsNominalCaseSuccess()
    {
        //given
        $t = $this->bucketManager->CreateObject($this->bucketUrl);
        /* Async */
        $t;

        //when
        $actualResult = $this->bucketManager->IsObjectExists($this->bucketUrl);

        //then
        $this->Assert->IsTrue($actualResult);
    }

    public function testIsObjectExistsObjectNotExistBucketSuccess()
    {
        
    }

    public function testIsObjectExistsObjectNotExistFileSuccess()
    {

    }

    public function testRemoveObjectNominalCaseSuccess()
    {
        //given
        /* Async */
        $this->bucketManager->CreateObject($this->bucketUrl);
        $this->Assert.IsTrue($this->bucketManager->IsObjectExists($this->bucketUrl));

        //when
        $this->bucketManager->RemoveObject($this->bucketUrl);

        //then
        $this->Assert.IsFalse($this->bucketManager->IsObjectExists($this->bucketUrl));
    }

    protected function tearDown(): void
    {

    }
}