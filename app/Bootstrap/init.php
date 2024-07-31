<?php

namespace App\Bootstrap;

require_once "vendor/autoload.php";

ini_set("display_errors", 0);

use App\Http\AnkiConnection;

AnkiConnection::init();
