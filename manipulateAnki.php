<?php

require_once __DIR__ . '/app/Bootstrap/init.php';

use App\Facades\Card;
use App\Facades\Note;

$cardsInfo = Card::getCardsInfoOfBrowserSearch('deck:"Backend-development::PHP::Core language::PHP - Top 100 functions"');

foreach ($cardsInfo as $cardInfo) {
    $front = $cardInfo["fields"]["Front"]['value'];
    $back = $cardInfo["fields"]["Back"]['value'];

    $back = str_replace('</br>;', " ", $back);
    Note::updateNoteFields($cardInfo["note"], ["Front" => $front, "Back" => $back]);
}
