<?php

namespace App\Jobs\Main;

/**
 * Class DataToJsonJob
 * @package App\Jobs\Main
 */
class DataToJsonJob
{
    /**
     * @var array
     */
    protected $data;

    /**
     * DataToJsonJob constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function handle()
    {
        return json_encode([
            'movies' => $this->data
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}