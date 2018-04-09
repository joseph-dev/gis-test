<?php

namespace App\Parsers;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Parser;

/**
 * Class JsonParser
 * @package App\Parsers
 */
class JsonParser implements ParserInterface
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
     * @var array
     */
    protected $genres;

    /**
     * JsonParser constructor.
     * @param string $data
     * @param array $options
     */
    public function __construct(string $data, array $options)
    {
        $this->data = $data;
        $this->options = $options;
        $this->genres = $this->getGenres();
    }

    /**
     * @return array
     */
    public function parse(): array
    {
        $data = Parser::json($this->data);

        $items = [];

        foreach ($data['results'] as $item) {

            /**
             * Get images
             */
            $images = [
                $item['poster_path'],
                $item['backdrop_path']
            ];

            /**
             * Get genres
             */
            $genres = [];
            foreach ($item['genre_ids'] as $id) {
                $genres[] = array_get($this->genres, $id);
            }
            $genres = array_filter($genres);

            /**
             * Get release date
             */
            $releaseDate = Carbon::createFromFormat('Y-m-d', $item['release_date'])->timestamp;

            /**
             * Populate data
             */
            $items[] = [
                'title'       => $item['title'],
                'description' => $item['overview'],
                'images'      => $images,
                'genres'      => $genres,
                'releaseDate' => $releaseDate
            ];
        }

        return $items;
    }

    /**
     * @return array
     * @throws \Exception
     */
    protected function getGenres()
    {
        $client = new Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list', [
            'query' => array_get($this->options, 'query', [])
        ]);

        if ($response->getStatusCode() != 200) {
            throw new \Exception("Can't get genres!");
        }

        $data = Parser::json($response->getBody());

        $genres = [];

        foreach ($data['genres'] as $genre) {
            $genres[$genre['id']] = $genre['name'];
        }

        return $genres;
    }
}