## AnkiConnect

- AnkiBridge is simply an abstraction layer over AnkiConnect written in php

- The addon starts an http server on port 8765.

- Anki must be kept running in the background in order for other applications to be able to use Anki-Connect.

## Directory structure

- The app/Http/AnkiConnection.php file relies on the HttpClient.php file to send and receive API requests to the HTTP server started by anki connect.

- The file methods are chainable unlike the facades

- The app/Http/HttpClient.php file uses curl via the cURL php library.

- The main file you will be running is the manipulateAnki.php file.

- The file is used to execute functionalities defined in different facades in the app/Http/Facades directory

- The facades are static interfaces that abstract away the API low level details.

- Facades methods are not chainable.

- The Bootstrap directory includes one file which is init.php that requires the autoloader, initializes the connection and sets the error display to none to avoid duplicate error messages when running the script from the command line.
