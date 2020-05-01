(function() {

    "use strict";
    window.addEventListener("load", initialize);

    /**
     * Contains all of the eventListeners for interactivity.
     */
    function initialize() {  
        insertArt(12);
    }

    function insertArt(num) {
        let main = document.querySelector("main");
        for (let i = 1; i <= num; i++) {
            let resp = document.createElement("div");
            resp.classList.add("responsive");
            let gallery = document.createElement("div");
            gallery.classList.add("gallery");
            let link = document.createElement("a");
            link.href = "entry.html?id="+i;
            let image = document.createElement("img");
            image.src = "art/paint"+i+".png";
            link.appendChild(image);
            let info = document.createElement("div");
            info.classList.add("info");
            $.get("../art/" + i + ".json", function(data, status) {
                console.log("Retrivial status: " + status);
                info.innerHTML = "<h2>Title: "+data.title+"</h2><p>By: "+data.artist+"</p>"
            })
            gallery.appendChild(link);
            gallery.appendChild(info);
            resp.appendChild(gallery);
            main.appendChild(resp);
        }
    }

    
})();

