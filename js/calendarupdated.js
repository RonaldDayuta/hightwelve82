$(document).ready(function () {
  let currentMonth = new Date().getMonth();
  let currentYear = new Date().getFullYear();
  let today = new Date();
  let selectedDate = "";

  function generateCalendar(month, year) {
    let calendarBody = $("#calendar-body");
    let monthYear = $("#month-year");
    calendarBody.empty();
    monthYear.text(
      new Date(year, month).toLocaleString("default", {
        month: "long",
        year: "numeric",
      })
    );

    let firstDay = new Date(year, month, 1).getDay();
    let daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {
      calendarBody.append('<div class="empty"></div>');
    }

    for (let day = 1; day <= daysInMonth; day++) {
      let isToday =
        day === today.getDate() &&
        month === today.getMonth() &&
        year === today.getFullYear()
          ? "current-day"
          : "";
      calendarBody.append(
        `<div class="day ${isToday}" data-date="${year}-${
          month + 1
        }-${day}">${day}</div>`
      );
    }
  }

  $(document).on("click", ".day", function () {
    selectedDate = $(this).data("date");
    $("#selected-date").text(selectedDate);
    $.ajax({
      url: "php/fetchevents.php",
      type: "POST",
      data: { selectedDate: selectedDate },
      cache: false,
      success: function (data) {
        $("#table-events").html(data);
        $("#eventModal").modal("show");
      },
      error: function (xhr, status, error) {
        console.error("Error loading accounts:", error);
      },
    });
  });

  $("#add-event-btn").click(function () {
    $("#add-event-date").text(selectedDate);
    $("#event-date").val(selectedDate);
    $("#addEventModal").modal("show");
  });

  $("#prev-month").click(function () {
    currentMonth--;
    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
    generateCalendar(currentMonth, currentYear);
  });

  $("#next-month").click(function () {
    currentMonth++;
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
  });

  generateCalendar(currentMonth, currentYear);
});
