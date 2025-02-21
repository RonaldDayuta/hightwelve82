$(document).ready(function () {
  function loadEvents() {
    $.ajax({
      url: "../php/fetcheventsformainpage.php", // PHP script to fetch events
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
      url: "../php/fetchnewsformainpage.php", // PHP script to fetch events
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
      url: "../php/fetchmeetformainpage.php", // PHP script to fetch events
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
});
