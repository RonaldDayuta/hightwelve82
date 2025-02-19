$(document).ready(function () {
  $("#main").load("Home.php");
  $("#Home").addClass("active");

  $("#Home").click(function () {
    $("#main").load("Home.php");
    $("#Home").addClass("active");
    $("#Accounts").removeClass("active");
    $("#Calendar").removeClass("active");
  });

  $("#Accounts").click(function () {
    $("#main").load("accounts.php");
    $("#Accounts").addClass("active");
    $("#Home").removeClass("active");
    $("#Calendar").removeClass("active");
  });

  $("#Calendar").click(function () {
    $("#main").load("calendar.php", function () {
      // Ensure the calendar initializes after the content is loaded
      if (typeof generateCalendar === "function") {
        generateCalendar(currentMonth, currentYear);
      }
    });
    $("#Calendar").addClass("active");
    $("#Accounts").removeClass("active");
    $("#Home").removeClass("active");
  });
});
