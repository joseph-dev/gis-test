<?php

namespace App\Features\Main\Tests;

use App\Features\Main\GetDataFeature;
use App\Http\Requests\Main\GetDataRequest;
use Tests\TestCase;

class GetDataFeatureTest extends TestCase
{
    public function testFeatureMustReturnViewWithParsedDataForFeedEquals2()
    {
        $request = new GetDataRequest();
        $request->replace([
           'feed_id' =>  2
        ]);

        $response = (new GetDataFeature())->handle($request);

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('main.index', $response->getName());
        $this->assertEquals([
            1 => 'JSON Feed',
            2 => 'MRSS Feed'
        ], $response->getData()['feeds']);

        json_decode($response->getData()['data']);

        $this->assertEquals(JSON_ERROR_NONE, json_last_error());
    }

    public function testFeatureMustReturnViewWithParsedDataForFeedEquals1()
    {
        $request = new GetDataRequest();
        $request->replace([
            'feed_id' =>  1,
            'language' => 'en',
            'page'     => '1',
            'region'   => 'en'
        ]);

        $response = (new GetDataFeature())->handle($request);

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('main.index', $response->getName());
        $this->assertEquals([
            1 => 'JSON Feed',
            2 => 'MRSS Feed'
        ], $response->getData()['feeds']);

        json_decode($response->getData()['data']);

        $this->assertEquals(JSON_ERROR_NONE, json_last_error());
    }
}