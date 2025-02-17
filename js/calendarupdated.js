$(document).ready(function () {
  let currentMonth = new Date().getMonth();
  let currentYear = new Date().getFullYear();
  let today = new Date();
  let selectedDate = "";

  // Function to generate the calendar
  function generateCalendar(month, year) {
    let calendarBody = $("#calendar-body");
    let monthYear = $("#month-year");
    calendarBody.empty();

    // Set month and year header
    monthYear.text(
      new Date(year, month).toLocaleString("default", {
        month: "long",
        year: "numeric",
      })
    );

    // Get the first day and the number of days in the month
    let firstDay = new Date(year, month, 1).getDay();
    let daysInMonth = new Date(year, month + 1, 0).getDate();

    // Generate empty divs for the days before the first day of the month
    for (let i = 0; i < firstDay; i++) {
      calendarBody.append('<div class="empty"></div>');
    }

    // Generate the calendar days
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

  // Open Add Event Modal
  function openAddEventModal() {
    document.getElementById("add-event-date").innerText = selectedDate;
    document.getElementById("event-date").value = selectedDate;
    new bootstrap.Modal(document.getElementById("addEventModal")).show();
  }

  // Submit event using AJAX


  // Fetch events (for refreshing after adding or changing months)
  function fetchEvents() {
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
        console.error("Error loading events:", error);
      },
    });
  }

  // Event handler when a day is clicked
  $(document).on("click", ".day", function () {
    selectedDate = $(this).data("date");
    $("#selected-date").text(selectedDate);
    fetchEvents(); // Refresh events for the selected date
  });

  // Open Add Event Modal on button click
  $("#add-event-btn").click(function () {
    openAddEventModal();
  });

  // Navigate to previous month
  $("#prev-month").click(function () {
    currentMonth--;
    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
    generateCalendar(currentMonth, currentYear);
    fetchEvents(); // Refresh events when changing months
  });

  // Navigate to next month
  $("#next-month").click(function () {
    currentMonth++;
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
    fetchEvents(); // Refresh events when changing months
  });

  // Initial calendar generation
  generateCalendar(currentMonth, currentYear);
});

function addEvent() {
  let formData = new FormData(document.getElementById("event-form"));

  console.log("Form Data before submission:", Object.fromEntries(formData));

  $.ajax({
    url: "php/addEvents.php", // Correct URL to your add event PHP script
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log("Raw Response:", response);

      // If the response is already an object, no need to parse it again
      if (response.status && response.message) {
        alert(`Status: ${response.status}\nMessage: ${response.message}`);
        fetchEvents(); // Refresh calendar after adding event
      } else {
        console.error("Unexpected response format:", response);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error adding event:", error);
    },
  });
}
