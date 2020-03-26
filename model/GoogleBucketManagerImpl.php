<?php
require __DIR__.'/../interface/IBucketManager.php';
use Google\Cloud\Storage\StorageClient;

/**
 * This class is designed to manage an instance of GoogleBucketManager
 */
class GoogleBucketManagerImpl implements IBucketManager
{
    private $client;
    private $projectId;
    private $domain;
    private $bucketName;
    private $bucketUrl;

    /**
     * This constructor returns a new instance of GoogleBucketManagerImpl class
     *
     * @param [String] $bucketName Url pointing on a bucket
     */
    public function __construct($projectId, $domain, $bucketName){

        $credentialsPath = realpath(getenv('GOOGLE_APPLICATION_CREDENTIALS')); // Gives the real path to the credentials file stored in .env
        $credentials = [file_get_contents($credentialsPath)];
        $this->projectId = $projectId;
        $this->domain = $domain;
        $this->bucketName = $bucketName;
        $this->bucketUrl = $this->bucketName . "." . $this->domain;
        $this->client = new StorageClient($credentials);
    }

    public function CreateObject($objectUrl) {
        $bucket = $this->client->bucket($this->projectId);
        $file = 'public/assets/saturnV.jpg';
        $object = $bucket->upload($file, [
            'name' => "abc-file"
        ]);
    }

    public function IsObjectExists($objectUrl) {
        $buckets = $this->client->buckets([$this->projectId]);
        foreach($buckets as $bucket) {
            if($bucket->name() == $this->bucketUrl) {
                if($bucket->name() != $objectUrl) {
                    foreach($bucket->objects() as $storageObject) {
                        if($storageObject->name() == $objectUrl) {
                            return true;
                        }
                    }
                }
                else 
                {
                    return true;
                }
            }
        }
        return false;
    }

    public function DownloadObject($objectUrl, $destinationUri) {

    }

    public function RemoveObject($objectUrl) {
        
    }

    private function CreateBucket($bucketName) {
        
    }
}