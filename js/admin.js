$(document).ready(function () {
  $("#main").load("accounts.php");
  $("#sidebar-tabs-account").addClass("active");
  $("#navbar-tabs-account").addClass("active");

  $("#sidebar-tabs-account").on("click", function () {
    $("#main").load("accounts.php");
    $("#sidebar-tabs-account").addClass("active");
    $("#sidebar-tabs-event").removeClass("active");
    $("#sidebar-tabs-calendar").removeClass("active");
    $("#navbar-tabs-account").addClass("active");
    $("#navbar-tabs-event").removeClass("active");
    $("#navbar-tabs-calendar").removeClass("active");
    $("#sidebar-tabs-manage").removeClass("active");
    $("#navbar-tabs-manage").removeClass("active");
  });
  $("#sidebar-tabs-event").on("click", function () {
    $("#main").load("events.php");
    $("#sidebar-tabs-account").removeClass("active");
    $("#sidebar-tabs-event").addClass("active");
    $("#sidebar-tabs-calendar").removeClass("active");
    $("#navbar-tabs-account").removeClass("active");
    $("#navbar-tabs-event").addClass("active");
    $("#navbar-tabs-calendar").removeClass("active");
    $("#sidebar-tabs-manage").removeClass("active");
    $("#navbar-tabs-manage").removeClass("active");
  });
  $("#sidebar-tabs-calendar").on("click", function () {
    $("#main").load("calendarupdated.php", function () {
      // Ensure the calendar initializes after the content is loaded
      if (typeof generateCalendar === "function") {
        generateCalendar(currentMonth, currentYear);
      }
    });
    $("#sidebar-tabs-account").removeClass("active");
    $("#sidebar-tabs-event").removeClass("active");
    $("#sidebar-tabs-calendar").addClass("active");
    $("#navbar-tabs-account").removeClass("active");
    $("#navbar-tabs-event").removeClass("active");
    $("#navbar-tabs-calendar").addClass("active");
    $("#sidebar-tabs-manage").removeClass("active");
    $("#navbar-tabs-manage").removeClass("active");
  });
  $("#sidebar-tabs-manage").on("click", function () {
    $("#main").load("manage_account.php");
    $("#navbar-tabs-account").removeClass("active");
    $("#navbar-tabs-event").removeClass("active");
    $("#navbar-tabs-calendar").removeClass("active");
    $("#navbar-tabs-manage").addClass("active");
    $("#sidebar-tabs-account").removeClass("active");
    $("#sidebar-tabs-event").removeClass("active");
    $("#sidebar-tabs-calendar").removeClass("active");
    $("#sidebar-tabs-manage").addClass("active");
  });

  $("#navbar-tabs-account").on("click", function () {
    $("#main").load("accounts.php");
    $("#navbar-tabs-account").addClass("active");
    $("#navbar-tabs-event").removeClass("active");
    $("#navbar-tabs-calendar").removeClass("active");
    $("#sidebar-tabs-account").addClass("active");
    $("#sidebar-tabs-event").removeClass("active");
    $("#sidebar-tabs-calendar").removeClass("active");
    $("#sidebar-tabs-manage").removeClass("active");
    $("#navbar-tabs-manage").removeClass("active");
  });
  $("#navbar-tabs-event").on("click", function () {
    $("#main").load("events.php");
    $("#navbar-tabs-account").removeClass("active");
    $("#navbar-tabs-event").addClass("active");
    $("#navbar-tabs-calendar").removeClass("active");
    $("#sidebar-tabs-account").removeClass("active");
    $("#sidebar-tabs-event").addClass("active");
    $("#sidebar-tabs-calendar").removeClass("active");
    $("#sidebar-tabs-manage").removeClass("active");
    $("#navbar-tabs-manage").removeClass("active");
  });
  $("#navbar-tabs-calendar").on("click", function () {
    $("#main").load("calendarupdated.php", function () {
      // Ensure the calendar initializes after the content is loaded
      if (typeof generateCalendar === "function") {
        generateCalendar(currentMonth, currentYear);
      }
    });
    $("#navbar-tabs-account").removeClass("active");
    $("#navbar-tabs-event").removeClass("active");
    $("#navbar-tabs-calendar").addClass("active");
    $("#sidebar-tabs-account").removeClass("active");
    $("#sidebar-tabs-event").removeClass("active");
    $("#sidebar-tabs-calendar").addClass("active");
    $("#sidebar-tabs-manage").removeClass("active");
    $("#navbar-tabs-manage").removeClass("active");
  });
  $("#navbar-tabs-manage").on("click", function () {
    $("#main").load("manage_account.php");
    $("#navbar-tabs-account").removeClass("active");
    $("#navbar-tabs-event").removeClass("active");
    $("#navbar-tabs-calendar").removeClass("active");
    $("#navbar-tabs-manage").addClass("active");
    $("#sidebar-tabs-account").removeClass("active");
    $("#sidebar-tabs-event").removeClass("active");
    $("#sidebar-tabs-calendar").removeClass("active");
    $("#sidebar-tabs-manage").addClass("active");
  });
});
