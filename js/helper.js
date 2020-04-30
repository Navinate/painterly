(function() {

    "use strict";
    window.addEventListener("load", initialize);

    /**
     * Contains all of the eventListeners for interactivity.
     */
    function initialize() {  
        if(findID("random") !== null) {
            randomID();
        } 
    }

    function randomID() {
        let rand = Math.floor(Math.random()*5 + 1);
        console.log("substring: "+window.location.href.substring(32))
        if(window.location.href.substring(1) == window.location.href.substring(1)) {
        findID("random_link").href = "entry.html?id="+rand;
        } else {
            randomID();
        }
    }

    function findID(arg) {
        return document.getElementById(arg);
    }

})();