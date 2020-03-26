<?php
require __DIR__.'/../interface/IBucketManager.php';
use Google\Cloud\Storage\StorageClient;

/**
 * This class is designed to manage an instance of GoogleBucketManager
 */
class GoogleBucketManagerImpl implements IBucketManager
{
    private $client;
    private $bucketUrl;

    /**
     * This constructor returns a new instance of GoogleBucketManagerImpl class
     */
    public function __construct($bucketUrl){
        $this->bucketUrl = $bucketUrl;
        $config = ['projectId' => getenv('PROJECT_ID')];
        $this->client = new StorageClient($config);
    }

    /* function upload_object($bucketName, $objectName, $source)
    {
        $storage = new StorageClient();
        $file = fopen($source, 'r');
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->upload($file, [
            'name' => $objectName
        ]);
        printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
    }*/

    public function CreateObject($objectUrl) {
        $bucket = $this->client->bucket("abc-bucket");
        $file = 'public/assets/saturnV.jpg';
        $object = $bucket->upload($file, [
            'name' => "abc-file"
        ]);
    }

    public function IsObjectExists($objectUrl) {

    }

    public function DownloadObject($objectUrl, $destinationUri) {

    }

    public function RemoveObject($objectUrl) {
        
    }

    private function CreateBucket($bucketName) {
        
    }
}