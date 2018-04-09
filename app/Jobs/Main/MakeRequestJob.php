<?php

namespace App\Jobs\Main;

use App\Jobs\Job;
use GuzzleHttp\Client;

/**
 * Class MakeRequestJob
 * @package App\Jobs\Main
 */
class MakeRequestJob extends Job
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * MakeRequestJob constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param Client $client
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function handle(Client $client)
    {
        return $client->request(
            $this->parameters['method'],
            $this->parameters['url'],
            [
                'query' => $this->parameters['parameters']
            ]
        );
    }
}