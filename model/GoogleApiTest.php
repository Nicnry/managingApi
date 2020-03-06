<?php
use PHPUnit\Framework\TestCase;

require __DIR__.'/../model/GoogleApi.php';
class GoogleApiTest extends TestCase
{
    public function testGetLabels()
    {
        $google = new GoogleApi();
    }
}