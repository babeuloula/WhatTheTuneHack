# What the tune hack

How to win everytime at What the tune!

## Requirements

- PHP >= 5.1.2
- cURL extension for PHP

## Usage

- First, you need to create a free account on ACRCloud's website.
You can follow the documentation to have an access to the [ACRCloud's API](https://www.acrcloud.com/docs/acrcloud/tutorials/identify-music-by-sound/).

```bash
$ cp config.php.dist config.php
$ vi config.php
```

- Replace sample data by yours and upload the files on a webserver.
- Download [Tampermonkey](https://tampermonkey.net/) extension for you browser.
- Add the Tampermonkey's [script](https://github.com/babeuloula/WhatTheTune/blob/master/script.js) and set the variable `url`

On What the tune, you have now a new button `Get song information`. When you click on this, the song and the artist
will be copied to your clipboard. You can now paste it on the input and press enter.

Enjoy!