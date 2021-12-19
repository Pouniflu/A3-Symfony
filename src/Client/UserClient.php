<?php

namespace App\Client;

class UserClient
{
    private const api_url = 'https://superheroapi.com/api/662944964874931/';

    public static function superHeroes(int $superHeroesId): array
    {
        $superhero = json_decode(file_get_contents(self::api_url . $superHeroesId), true);

        return $superhero;
    }
}