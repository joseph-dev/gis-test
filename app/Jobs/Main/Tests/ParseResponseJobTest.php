<?php

namespace App\Jobs\Main\Tests;

use App\Http\Requests\Main\GetDataRequest;
use App\Jobs\Main\ParseResponseJob;
use Tests\TestCase;

class ParseResponseJobTest extends TestCase
{
    public function testJobMustParsePassedResponse()
    {
        $this->expectException(\Nathanmac\Utilities\Parser\Exceptions\ParserException::class);

        $response = $this->createMock(\GuzzleHttp\Psr7\Response::class);
        $response->expects($this->any())->method('getStatusCode')->willReturn(200);
        $response->expects($this->any())->method('getBody')->willReturn('body');

        $request = $this->createMock(GetDataRequest::class);
        $request->expects($this->any())->method('only')->willReturn([]);
        $request->feed_id = 2;

        $result = dispatch_now(new ParseResponseJob($response, $request));
    }
}