<?php

namespace App\Facades;

use App\Http\AnkiConnection;

require_once "vendor/autoload.php";

class Misc
{
    // Cleans up a deck from div, span and p tags without removing their content
    public static function cleanUpDeckFromRedundantHtml(string $deckName)
    {
        $cardsIds = Card::findCards("deck:$deckName");

        $cardsInfo = Card::getCardsInfo($cardsIds);

        // Remove opening and closing <div>, <span>, and <p> tags
        $nonSemantic = array(
            '/<div[^>]*>/i', // Opening <div> tags
            '/<\/div>/i', // Closing </div> tags
            '/<span[^>]*>/i', // Opening <span> tags
            '/<\/span>/i', // Closing </span> tags
            '/<p[^>]*>/i', // Opening <p> tags
            '/<\/p>/i', // Closing </p> tags
            '/&nbsp(;)?/',
        );

        $emphasis = array(
            '/<strong>/i', // Opening <strong> tags
            '/<\/strong>/i', // Closing </strong> tags
        );

        $reference = array(
            '/<a[^>]*>/i', // Opening <a> tags
            '/<\/a>/i', // Closing </a> tags
        );

        $code = array(
            '/<code[^>]*>/i', // Opening <code> tags
            '/<\/code>/i', // Closing </code> tags
        );

        $frontPatterns = array_merge($emphasis, []);
        $backPatterns = array_merge($emphasis, []);

        foreach ($cardsInfo as $cardInfo) {
            if ($cardInfo['modelName'] == "Cloze") {
                continue;
            }
            // Replace the strong HTML element with the b HTML element
            // $back = preg_replace($emphasis[0], '<b>', $cardInfo["fields"]["Back"]["value"]);
            // $back = preg_replace($emphasis[1], '</b>', $cardInfo["fields"]["Back"]["value"]);

            $front = preg_replace($frontPatterns, '', $cardInfo["fields"]["Front"]["value"]);
            $back = preg_replace($backPatterns, '', $cardInfo["fields"]["Back"]["value"]);

            Note::updateNoteFields($cardInfo["note"], array("Front" => $front,
                "Back" => $back)
            );
        }
    }

    // To do
    public static function cleanUpDeckFromRedundantWhitespacesAndNewLines(string $deckName)
    {
        // Cannot use an array of patterns because the replacements are different
        $field = preg_replace('/(\s)+/', ' ', $field); // Replace multiple whitespaces with a single whitespace
        $field = preg_replace('/^(\s)*<br>|<br>(\s)*$/', '', $field); // Remove leading and trailing <br> tags.
        $field = preg_replace('/<br>(\s)+/', '<br>', $field); // Remove line leading whitespace
        $field = preg_replace('/(<br>(\s)*){2,}/', '<br>', $field); // Multiple <br> tags in a row regardless of whitespace between them.
    }

    public static function sync()
    {
        AnkiConnection::setAction("sync");
        return AnkiConnection::execute();
    }
}
