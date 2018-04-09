<?php

namespace App\Http\Controllers;

use App\Http\Requests\Main\GetDataRequest;
use App\Jobs\Main\DataToJsonJob;
use App\Jobs\Main\GetFeedsJob;
use App\Jobs\Main\GetParametersJob;
use App\Jobs\Main\MakeRequestJob;
use App\Jobs\Main\ParseResponseJob;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    use DispatchesJobs;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $feeds = $this->dispatch(new GetFeedsJob());

        return view('main.index', [
            'feeds' => $feeds
        ]);
    }

    /**
     * @param GetDataRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getData(GetDataRequest $request)
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