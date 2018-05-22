<?php

namespace App\Features\Main;

use App\Features\Feature;
use App\Jobs\Main\GetFeedsJob;

/**
 * Class HomePageFeature
 * @package App\Features\Main
 */
class HomePageFeature extends Feature
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handle()
    {
        $feeds = $this->dispatch(new GetFeedsJob());

        return view('main.index', [
            'feeds' => $feeds
        ]);
    }
}