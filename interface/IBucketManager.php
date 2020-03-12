<?php

interface IBucketManager
{

    public function CreateObject($objectUrl);

    public function IsObjectExists($objectUrl);

    public function DownloadObject($objectUrl, $destinationUri);

    public function RemoveObject($objectUrl);
}