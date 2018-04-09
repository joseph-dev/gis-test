<?php

namespace App\Jobs\Main;

use App\Jobs\Job;

/**
 * Class GetFeedsJob
 * @package App\Jobs\Main
 */
class GetFeedsJob extends Job
{
    /**
     * Execute job
     *
     * @return array
     */
    public function handle()
    {
        return [
            1 => 'JSON Feed',
            2 => 'MRSS Feed'
        ];
    }
}