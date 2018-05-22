<?php

namespace App\Jobs\Main\Tests;

use App\Jobs\Main\GetFeedsJob;
use Tests\TestCase;

class GetFeedsJobTest extends TestCase
{
    public function testJobMustMakeJsonFromPassedData()
    {
        $result = dispatch_now(new GetFeedsJob());

        $this->assertEquals([
            1 => 'JSON Feed',
            2 => 'MRSS Feed'
        ], $result);
    }
}