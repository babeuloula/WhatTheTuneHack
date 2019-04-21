// ==UserScript==
// @name         What the tune Hack
// @namespace    https://www.babeuloula.fr/
// @version      0.1
// @description
// @author       You
// @match        https://whatthetune.com/play
// @grant        GM_setClipboard
// @require      http://code.jquery.com/jquery-3.3.1.min.js
// ==/UserScript==

(function() {
    'use strict';

    setTimeout(function() {
        var url = "http://yourdomain.com/acrcloud.php";

        var defaultText = "Get song information";

        var $button = $("<span/>")
            .text(defaultText)
            .css({
                'line-height': '1em',
                'background-color': '#452E7D',
                'color': 'white',
                'font-size': '1.2em',
                'font-weight': 'bold',
                'cursor': 'pointer',
                'padding': '3px 5px',
                'border-radius': '0.25em'
            });

        $button.click(function() {
            $.ajax({
                url: url,
                type: "get",
                success: function(response) {
                    if (null !== response.song && null !== response.artist) {
                        GM_setClipboard(response.song + " " + response.artist);

                        $button.text("Copied!");
                        setTimeout(function() {
                            $button.text(defaultText);
                        }, 1500);
                    }
                },
                error: function() {
                    $button.text("Unable to get song information");
                    setTimeout(function() {
                        $button.text(defaultText);
                    }, 1500);
                }
            });
        });

        $(document).find(".guess-form").find(".clock").append($button);
    }, 1000);
})();