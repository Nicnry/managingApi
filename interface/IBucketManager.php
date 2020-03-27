<?php

interface IBucketManager
{

    /**
     * This function will Create an object in specific bucket or create the bucket
     *
     * @param String $objectUrl
     * @param String $filePath default : empty
     * @return Void
     */
    public function CreateObject($objectUrl, $filePath = "");

    /**
     * This function will check if the bucket exist
     *
     * @param String $objectUrl
     * @return Boolean
     */
    public function IsObjectExists($objectUrl);

    /**
     * This function will download specific object in specific path
     *
     * @param String $objectUrl
     * @param String $destinationUri
     * @return Void
     */
    public function DownloadObject($objectUrl, $destinationUri);

    /**
     * This function will remove object from a bucket
     *
     * @param String $objectUrl
     * @return Void
     */
    public function RemoveObject($objectUrl);
}