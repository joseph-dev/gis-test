<?php

namespace App\Features\Main\Tests;

use App\Features\Main\HomePageFeature;
use Tests\TestCase;

class HomePageFeatureTest extends TestCase
{
    public function testFeatureMustReturnViewWithDataForHomePage()
    {
        $response = dispatch_now(new HomePageFeature());

        $this->assertInstanceOf(\Illuminate\View\View::class, $response);
        $this->assertEquals('main.index', $response->getName());
        $this->assertEquals([
            1 => 'JSON Feed',
            2 => 'MRSS Feed'
        ], $response->getData()['feeds']);
    }
}