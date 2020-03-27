<?php
namespace App\Model;

require __DIR__.'/../interface/IBucketManager.php';
use Google\Cloud\Storage\StorageClient;
use App\Inteface\IBucketManager;

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
     * @param String $projectId
     * @param String $domain Url pointing on a bucket
     * @param String $bucketName name.info
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

    /**
     * This function will Create an object in specific bucket or create the bucket
     *
     * @param String $objectUrl
     * @param String $filePath default : empty
     * @return Void
     */
    public function CreateObject($objectUrl, $filePath = "") {
        $isBucketExists = $this->IsObjectExists($this->bucketUrl);
        if(!$isBucketExists)
        {
            $bucket = $this->client->bucket($this->bucketUrl);
        }
        else // Select the bucket if already exists
        {
            $bucket = $this->GetBucket();
        }

        if($objectUrl != $this->bucketUrl)
        {
            $bucket->upload($filePath, [
                'name' => $objectUrl
            ]);
        }
    }

    /**
     * This function will check if the bucket exist
     *
     * @param String $objectUrl
     * @return Boolean
     */
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

    /**
     * This function will download specific object in specific path
     *
     * @param String $objectUrl
     * @param String $destinationUri
     * @return Void
     */
    public function DownloadObject($objectUrl, $destinationUri) {
        $object = $this->GetBucket()->object($objectUrl);
        $object->DownloadToFile($destinationUri);
    }

    /**
     * This function will remove object from a bucket
     *
     * @param String $objectUrl
     * @return Void
     */
    public function RemoveObject($objectUrl) {
        $object = $this->GetBucket()->object($objectUrl);
        $object->delete();
    }

    /**
     * Returns the initialized bucket
     *
     * @return Bucket
     */
    private function GetBucket() {
        foreach($this->client->buckets([$this->projectId]) as $bucket) {
            if($bucket->name() == $this->bucketUrl) {
                return $bucket;
            }
        }
    }
}