$(document).ready(function () {
  function loadEvents() {
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
  }
  loadEvents();
  function loadNews() {
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
  }
  loadNews();
  function loadMeet() {
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
  }
  loadMeet();
  function loadAct() {
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
  }
  loadAct();

  $("#search-date-event").on("keyup", function () {
    let searchText = $(this).val().trim(); // Get the input value and trim spaces

    if (searchText !== "") {
      $.ajax({
        url: "../php/SearchEventsuser.php",
        type: "POST",
        data: { search: searchText }, // Use "search" to handle both date & title
        beforeSend: function () {
          $("#view-all-events").html("<p>Loading...</p>"); // Show loading text
        },
        success: function (response) {
          $("#view-all-events").html(response);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: " + error);
          $("#view-all-events").html("<p>Error fetching activities.</p>");
        },
      });
    } else {
      loadEvents(); // Reload all events when input is cleared
    }
  });
  $("#search-date-news").on("keyup", function () {
    let searchText = $(this).val().trim(); // Get the input value and trim spaces

    if (searchText !== "") {
      $.ajax({
        url: "../php/SearchNewsuser.php",
        type: "POST",
        data: { search: searchText }, // Use "search" to handle both date & title
        beforeSend: function () {
          $("#view-all-news").html("<p>Loading...</p>"); // Show loading text
        },
        success: function (response) {
          $("#view-all-news").html(response);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: " + error);
          $("#view-all-news").html("<p>Error fetching activities.</p>");
        },
      });
    } else {
      loadNews(); // Reload all events when input is cleared
    }
  });
  $("#search-date-meet").on("keyup", function () {
    let searchText = $(this).val().trim(); // Get the input value and trim spaces

    if (searchText !== "") {
      $.ajax({
        url: "../php/SearchMeetuser.php",
        type: "POST",
        data: { search: searchText }, // Use "search" to handle both date & title
        beforeSend: function () {
          $("#view-all-meet").html("<p>Loading...</p>"); // Show loading text
        },
        success: function (response) {
          $("#view-all-meet").html(response);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: " + error);
          $("#view-all-meet").html("<p>Error fetching activities.</p>");
        },
      });
    } else {
      loadMeet(); // Reload all events when input is cleared
    }
  });
  $("#search-date-act").on("keyup", function () {
    let searchText = $(this).val().trim(); // Get the input value and trim spaces

    if (searchText !== "") {
      $.ajax({
        url: "../php/SearchActuser.php",
        type: "POST",
        data: { search: searchText }, // Use "search" to handle both date & title
        beforeSend: function () {
          $("#view-all-act").html("<p>Loading...</p>"); // Show loading text
        },
        success: function (response) {
          $("#view-all-act").html(response);
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error: " + error);
          $("#view-all-act").html("<p>Error fetching activities.</p>");
        },
      });
    } else {
      loadAct(); // Reload all events when input is cleared
    }
  });
});
