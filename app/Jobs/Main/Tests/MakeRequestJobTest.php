<?php

namespace App\Jobs\Main\Tests;

use App\Jobs\Main\MakeRequestJob;
use Tests\TestCase;

class MakeRequestJobTest extends TestCase
{
    public function testJobMustMakeRequest()
    {
        $job = new MakeRequestJob([
            'method'     => 'test',
            'url'        => 'http://test.test',
            'parameters' => []
        ]);

        $httpClient = $this->createMock(\GuzzleHttp\Client::class);
        $response = 'response';
        $httpClient->expects($this->any())->method('request')->willReturn($response);

        $result = $job->handle($httpClient);

        $this->assertEquals($result, $response);
    }
}