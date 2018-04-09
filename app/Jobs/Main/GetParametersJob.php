<?php

namespace App\Jobs\Main;

use App\Http\Requests\Main\GetDataRequest;
use App\Jobs\Job;

/**
 * Class GetParametersJob
 * @package App\Jobs\Main
 */
class GetParametersJob extends Job
{
    /**
     * @var GetDataRequest
     */
    protected $request;

    /**
     * GetParametersJob constructor.
     * @param GetDataRequest $request
     */
    public function __construct(GetDataRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function handle()
    {
        return [
            'method'     => $this->getMethod(),
            'url'        => $this->getUrl(),
            'parameters' => $this->getParameters()
        ];
    }

    /**
     * @return mixed
     */
    protected function getMethod()
    {
        $methods = [
            1 => 'GET',
            2 => 'GET'
        ];

        return array_get($methods, $this->request->feed_id);
    }

    /**
     * @return mixed
     */
    protected function getUrl()
    {
        $urls = [
            1 => 'https://api.themoviedb.org/3/movie/popular',
            2 => 'http://link.brightcove.com/services/mrss/player835199013001/835233035001/new'
        ];

        return array_get($urls, $this->request->feed_id);
    }

    /**
     * @return array
     */
    protected function getParameters()
    {
        $params = array_filter([
            1 => array_merge([
                'api_key' => env('API_KEY')
            ], $this->request->only('language', 'page', 'region')),

            2 => []
        ]);

        return array_get($params, $this->request->feed_id, []);
    }
}