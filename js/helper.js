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
        let rand = Math.random()*5 + 1;
        findID("random_link").href = "entry.html?id="+rand;

    }

    function findID(arg) {
        return document.getElementById(arg);
    }

})();