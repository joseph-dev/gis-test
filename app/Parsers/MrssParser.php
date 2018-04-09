<?php

namespace App\Parsers;

use Illuminate\Support\Carbon;
use Parser;

/**
 * Class MrssParser
 * @package App\Parsers
 */
class MrssParser implements ParserInterface
{
    /**
     * @var string
     */
    protected $data;

    /**
     * @var
     */
    protected $options;

    /**
     * MrssParser constructor.
     * @param string $data
     * @param array $options
     */
    public function __construct(string $data, array $options)
    {
        $this->data = $data;
        $this->options = $options;
    }

    /**
     * @return array
     */
    public function parse(): array
    {
        $data = Parser::xml($this->data);

        $items = [];

        foreach ($data['channel']['item'] as $item) {

            /**
             * Get images
             */
            $images = [];
            $thumbnails = array_get($item, 'media:thumbnail', []);

            if ($thumbnails && array_get($thumbnails, '@url')) {

                $images[] = array_get($thumbnails, '@url');

            } elseif ($thumbnails) {

                foreach ($thumbnails as $thumbnail) {
                    $images[] = array_get($thumbnail, '@url', []);
                }

            }

            /**
             * Get genres
             */
            $genres = ucwords($item['media:keywords'], ',');
            $genres = explode(',', $genres);

            /**
             * Get release date
             */
            $releaseDate = Carbon::createFromFormat(Carbon::RFC2822, $item['pubDate'])->timestamp;

            /**
             * Populate data
             */
            $items[] = [
                'title'       => $item['title'],
                'description' => $item['description'],
                'images'      => $images,
                'genres'      => $genres,
                'releaseDate' => $releaseDate
            ];
        }

        return $items;
    }
}