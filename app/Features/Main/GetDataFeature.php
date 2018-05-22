<?php

namespace App\Features\Main;

use App\Features\Feature;
use App\Http\Requests\Main\GetDataRequest;
use App\Jobs\Main\DataToJsonJob;
use App\Jobs\Main\GetFeedsJob;
use App\Jobs\Main\GetParametersJob;
use App\Jobs\Main\MakeRequestJob;
use App\Jobs\Main\ParseResponseJob;

/**
 * Class GetDataFeature
 * @package App\Features\Main
 */
class GetDataFeature extends Feature
{
    /**
     * @param GetDataRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handle(GetDataRequest $request)
    {
        $parameters = $this->dispatch(new GetParametersJob($request));

        $response = $this->dispatch(new MakeRequestJob($parameters));

        $data = $this->dispatch(new ParseResponseJob($response, $request));

        $json = $this->dispatch(new DataToJsonJob($data));

        $feeds = $this->dispatch(new GetFeedsJob());

        return view('main.index', [
            'feeds' => $feeds,
            'data'  => $json
        ]);
    }
}