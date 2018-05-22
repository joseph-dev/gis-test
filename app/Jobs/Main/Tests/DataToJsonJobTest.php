<?php

namespace App\Jobs\Main\Tests;

use App\Jobs\Main\DataToJsonJob;
use Tests\TestCase;

class DataToJsonJobTest extends TestCase
{
    public function testJobMustMakeJsonFromPassedData()
    {
        $data = ['data' => 'test_data'];

        $result = dispatch_now(new DataToJsonJob($data));

        $actualJson = json_encode([
            'movies' => $data
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $this->assertJsonStringEqualsJsonString($result, $actualJson);
    }
}