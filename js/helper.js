(function() {

    "use strict";
    window.addEventListener("load", initialize);

    /**
     * Contains all of the eventListeners for interactivity.
     */
    function initialize() {
        if (findID("random") !== null) {
            randomID();
        }
    }

    function randomID() {
        let rand = Math.floor(Math.random() * 11 + 1);
        console.log("current page = "+window.location.href.substring(32));
        if (window.location.href.substring(32) === rand) {
            randomID();
        } else {
            findID("random_link").href = "entry.html?id=" + rand;
        }
    }

    function findID(arg) {
        return document.getElementById(arg);
    }

}
)();
