$(document).ready(function () {
  function loadEvents() {
    $.ajax({
      url: "../php/fetchteventforadmincontent.php", // PHP script to fetch events
      type: "GET",
      success: function (response) {
        $("#view-all-events").html(response);
      },
      error: function () {
        $("#view-all-events").html("<p>Error loading events.</p>");
      },
    });
  }
  loadEvents();
  function loadNews() {
    $.ajax({
      url: "../php/fetchnewsforadmincontent.php", // PHP script to fetch events
      type: "GET",
      success: function (response) {
        $("#view-all-news").html(response);
      },
      error: function () {
        $("#view-all-news").html("<p>Error loading events.</p>");
      },
    });
  }
  loadNews();
  function loadMeet() {
    $.ajax({
      url: "../php/fetchmeetforadmincontent.php", // PHP script to fetch events
      type: "GET",
      success: function (response) {
        $("#view-all-meet").html(response);
      },
      error: function () {
        $("#view-all-meet").html("<p>Error loading events.</p>");
      },
    });
  }
  loadMeet();
  function loadAct() {
    $.ajax({
      url: "../php/fetchactforadmincontent.php", // PHP script to fetch events
      type: "GET",
      success: function (response) {
        $("#view-all-act").html(response);
      },
      error: function () {
        $("#view-all-act").html("<p>Error loading events.</p>");
      },
    });
  }
  loadAct();
});
