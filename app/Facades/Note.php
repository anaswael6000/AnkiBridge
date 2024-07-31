<?php

namespace App\Facades;

use App\Http\AnkiConnection;

require_once "vendor/autoload.php";

class Note
{
    public static function addBasicNote($deckName, $front, $back)
    {
        return AnkiConnection::setAction("addNote")
            ::setParams(["note" => ["deckName" => $deckName, "modelName" => "Basic", "fields" => ["Front" => $front, "Back" => $back]]])::execute();
    }

    public static function addClozeDeletionNote($deckName, $text)
    {
        return AnkiConnection::setAction("addNote")
            ::setParams(["note" => ["deckName" => $deckName, "modelName" => "cloze", "fields" => ["Text" => $text]]])::execute();
    }

    public static function deleteNotes(array $notesIds)
    {
        AnkiConnection::setAction("deleteNotes")::setParams(["notes" => $notesIds]);
        return AnkiConnection::execute();
    }

    public static function getNoteIdsFromCardIds(array $cardIds)
    {
        AnkiConnection::setAction("cardsToNotes")::setParams(["cards" => $cardIds]);
        return AnkiConnection::execute();
    }

    /* The fields is an array of two values like (Front, Back), Text and Back Extra*/
    public static function updateNoteFields(int $noteId, array $fields)
    {
        AnkiConnection::setAction("updateNoteFields")::setParams(["note" => ["id" => $noteId, "fields" => $fields]]);
        return AnkiConnection::execute();
    }
}
