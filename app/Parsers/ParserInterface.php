<?php

namespace App\Parsers;

/**
 * Interface ParserInterface
 * @package App\Parsers
 */
interface ParserInterface
{
    /**
     * ParserInterface constructor.
     * @param string $data
     * @param array $options
     */
    public function __construct(string $data, array $options);

    /**
     * @return array
     */
    public function parse(): array;
}