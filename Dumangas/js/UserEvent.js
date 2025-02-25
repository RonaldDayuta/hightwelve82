$(document).ready(function () {
  $.ajax({
    url: "../php/fetchteventforusercontent.php", // PHP script to fetch events
    type: "GET",
    success: function (response) {
      $("#view-all-events").html(response);
    },
    error: function () {
      $("#view-all-events").html("<p>Error loading events.</p>");
    },
  });

  $.ajax({
    url: "../php/fetchnewsforusercontent.php",
    type: "GET",
    success: function (response) {
      $("#view-all-news").html(response);
    },
    error: function () {
      $("#view-all-news").html("<p>Error loading events.</p>");
    },
  });

  $.ajax({
    url: "../php/fetchmeetforusercontent.php", // PHP script to fetch events
    type: "GET",
    success: function (response) {
      $("#view-all-meet").html(response);
    },
    error: function () {
      $("#view-all-meet").html("<p>Error loading events.</p>");
    },
  });

  $.ajax({
    url: "../php/fetchactforusercontent.php", // PHP script to fetch events
    type: "GET",
    success: function (response) {
      $("#view-all-act").html(response);
    },
    error: function () {
      $("#view-all-act").html("<p>Error loading events.</p>");
    },
  });
});
