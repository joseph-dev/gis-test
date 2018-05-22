<?php

namespace App\Jobs\Main\Tests;

use App\Http\Requests\Main\GetDataRequest;
use App\Jobs\Main\GetParametersJob;
use Tests\TestCase;

class GetParametersJobTest extends TestCase
{
    public function testJobMustReturnParametersForFeedIdEquals1()
    {
        $request = $this->createMock(GetDataRequest::class);
        $request->expects($this->any())->method('only')->willReturn([]);
        $request->feed_id = 2;

        $result = dispatch_now(new GetParametersJob($request));

        $this->assertEquals([
            'method'     => 'GET',
            'url'        => 'http://link.brightcove.com/services/mrss/player835199013001/835233035001/new',
            'parameters' => []
        ], $result);
    }

    public function testJobMustReturnParametersForFeedIdEquals2()
    {
        $request = $this->createMock(GetDataRequest::class);
        $request->expects($this->any())->method('only')->willReturn([
            'language' => 'test',
            'page'     => '1',
            'region'   => 'EN_en'
        ]);
        $request->feed_id = 1;

        $result = dispatch_now(new GetParametersJob($request));

        $this->assertEquals([
            'method'     => 'GET',
            'url'        => 'https://api.themoviedb.org/3/movie/popular',
            'parameters' => [
                'api_key'  => env('API_KEY'),
                'language' => 'test',
                'page'     => '1',
                'region'   => 'EN_en'
            ]
        ], $result);
    }
}