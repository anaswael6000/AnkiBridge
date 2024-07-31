# Introduction

Anki handler is a php-based library for bringing our coding superpowers into our studying.

It provides a handful of easy and straightforward methods to do things that is extremely time consuming to do in the GUI.

# Technology

The project is based on the Anki connect add on.

The main AnkiWeb page can be found [here](https://ankiweb.net/shared/info/2055492159) and its documentation can be found [here](https://foosoft.net/projects/anki-connect/).

However the library provides a set of facades that abstract away many of the low level details of the API calls and the request and response structure, it also provides a set of other powerful utilities that is not present in the API, things like incorporating some cards into your system based on specific criteria (useful for seamlessly using shared decks), cleaning up notes and decks from some redundant HTML elements and so on.

# Installation guide

To get up and running with the project you will need to have php, curl, anki and the AnkiConnect addon installed
