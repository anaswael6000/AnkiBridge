<?php

namespace App\Facades;

use App\Http\AnkiConnection;

require_once "vendor/autoload.php";

class Card
{
    /**
     * Returns an array of card Ids for a given query
     * The params array is as follows ["query" => "somePattern"]
     */
    public static function findCards(string $query)
    {
        AnkiConnection::setAction("findCards")::setParams(["query" => $query]);
        return AnkiConnection::execute();
    }

    public static function getCardsInfo(array $cardsIds)
    {
        AnkiConnection::setAction("cardsInfo")::setParams(["cards" => $cardsIds]);
        return AnkiConnection::execute();
    }

    public static function getCardsInfoOfBrowserSearch(string $query): array
    {
        $cardsIds = self::findCards($query);
        return self::getCardsInfo($cardsIds);
    }
}
