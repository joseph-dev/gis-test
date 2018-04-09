<?php

namespace App\Jobs\Main;

use App\Http\Requests\Main\GetDataRequest;
use App\Jobs\Job;
use App\Parsers\JsonParser;
use App\Parsers\MrssParser;
use GuzzleHttp\Psr7\Response;

/**
 * Class ParseResponseJob
 * @package App\Jobs\Main
 */
class ParseResponseJob extends Job
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * @var GetDataRequest
     */
    protected $request;

    /**
     * ProcessResponseJob constructor.
     * @param Response $response
     * @param GetDataRequest $request
     */
    public function __construct(Response $response, GetDataRequest $request)
    {
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function handle()
    {
        $statusCode = $this->response->getStatusCode();

        /**
         * Check status code
         */
        if ($statusCode !== 200) {
            return [
                'statusCode' => $statusCode,
                'message'    => 'Something went wrong!',
            ];
        }

        $parser = $this->getParserClass();
        $data = $this->response->getBody();
        $options = $this->getOptions();

        /**
         * Parse data
         */
        return (new $parser($data, $options))->parse();
    }

    /**
     * @return mixed
     */
    protected function getParserClass()
    {
        /**
         * Available parsers
         */
        $parsers = [
            1 => JsonParser::class,
            2 => MrssParser::class,
        ];

        /**
         * Get appropriate parser
         */
        return array_get($parsers, $this->request->feed_id);
    }

    /**
     * @return mixed
     */
    protected function getOptions()
    {
        $options = array_filter([
            1 => [
                'query' => [
                    'api_key'  => env('API_KEY'),
                    'language' => array_get($this->request->all(), 'language')
                ]
            ],
            2 => []
        ]);

        return array_get($options, $this->request->feed_id, []);
    }
}