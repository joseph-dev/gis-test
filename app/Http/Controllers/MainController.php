<?php

namespace App\Http\Controllers;

use App\Features\Main\GetDataFeature;
use App\Features\Main\HomePageFeature;
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
        return $this->dispatch(new HomePageFeature());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getData()
    {
        return $this->dispatch(new GetDataFeature());
    }
}