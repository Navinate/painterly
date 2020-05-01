(function() {

  "use strict";
  window.addEventListener("load", initialize);
  /**
   * Contains all of the eventListeners for interactivity.
   */
  function initialize() {
      getQueryVariable("id");
  }

  function getQueryVariable(variable) {
      var query = window.location.search.substring(1);
      var vars = query.split("&");
      for (var i = 0; i < vars.length; i++) {
          var pair = vars[i].split("=");
          if (pair[0] == variable) {
              console.log("Loading data: " + pair[1]);
              fillInfo(pair[1]);
              return 1;
          }
      }
      console.log("Failed to load data.");
      return -1;
  }

  function fillInfo(id) {
      findID("art").src = "art/paint" + id + ".png";
      $.get("../art/" + id + ".json", function(data, status) {
          console.log("Retrivial status: " + status);
          findID("title").innerHTML = data.title;
          findID("artist").innerHTML = data.artist;
          findID("upload_date").innerHTML = data.date;
          findID("width").innerHTML = data.width;
          findID("height").innerHTML = data.height;
          findID("description").innerHTML = data.description;
          findID("art").alt = data.description;
      })
  }

  function findID(arg) {
      return document.getElementById(arg);
  }

}
)();