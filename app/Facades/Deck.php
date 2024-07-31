<?php

namespace App\Facades;

use App\Http\AnkiConnection;

require_once "vendor/autoload.php";

class Deck
{
    public static function createDeck($deckName)
    {
        AnkiConnection::setAction('createDeck')::setParams(["deck" => $deckName]);
        return AnkiConnection::execute();
    }

    public static function changeDeck(array $cardIds, $deckName)
    {
        AnkiConnection::setAction('changeDeck')::setParams(["cards" => $cardIds, "deck" => $deckName]);
        return AnkiConnection::execute();
    }

    public static function exportPackage($deckName, $pathToStoreTheDeckInIt, $includeSchedulingData)
    {
        AnkiConnection::setAction("exportPackage")
            ::setParams(["deck" => $deckName, "path" => $pathToStoreTheDeckInIt, "includeSched" => $includeSchedulingData]);
        return AnkiConnection::execute();
    }
}
