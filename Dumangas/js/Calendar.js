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

  // Fetch events (for refreshing after adding or changing months)
  function fetchEvents() {
    $.ajax({
      url: "../php/fetchevents.php",
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

  // Open Add Event Modal
  function openAddEventModal() {
    document.getElementById("add-event-date").innerText = selectedDate;
    document.getElementById("event-date").value = selectedDate;
    new bootstrap.Modal(document.getElementById("addEventModal")).show();
  }

  // Event handler when a day is clicked
  $(document).on("click", ".day", function () {
    selectedDate = $(this).data("date");
    $("#selected-date").text(selectedDate);
    fetchEvents();
  });

  // Open Add Event Modal on button click
  $("#add-event-btn").click(function () {
    openAddEventModal();
    $("#eventModal").modal("hide");
  });

  // Navigate to previous month
  $("#prev-months").click(function () {
    currentMonth--;
    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
    generateCalendar(currentMonth, currentYear);
  });

  // Navigate to next month
  $("#next-months").click(function () {
    currentMonth++;
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
  });

  // Initial calendar generation
  generateCalendar(currentMonth, currentYear);

  $(document).on("click", "#add-events-btn", function () {
    // Disable the button and show the spinner
    let addButton = $("#add-events-btn");
    let spinner = $("#spinner");
    let buttonText = $("#button-text");

    // Show the spinner and change the button text
    spinner.show();
    buttonText.text("Adding..."); // Change text to "Adding..."
    addButton.prop("disabled", true); // Disable the button

    let formData = new FormData(document.getElementById("event-form"));

    console.log("Form Data before submission:", Object.fromEntries(formData));

    $.ajax({
      url: "../php/addEvents.php", // Correct URL to your add event PHP script
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        console.log("Raw Response:", response);

        // If the response is already an object, no need to parse it again
        if (response.status && response.message) {
          // Show SweetAlert2 success message
          Swal.fire({
            title: "Success!",
            text: response.message,
            icon: "success",
            confirmButtonText: "OK",
          }).then(() => {
            // Clear the form inputs after successful submission
            document.getElementById("event-form").reset();

            // Hide the modal after successful submission
            $("#addEventModal").modal("hide");
            $("#eventModal").modal("show");

            // Refresh events to show the newly added event
            fetchEvents(); // Refresh calendar or events list

            // Re-enable the button, hide the spinner, and reset text
            spinner.hide();
            buttonText.text("Save Event");
            addButton.prop("disabled", false);
          });
        } else {
          console.error("Unexpected response format:", response);
          // Re-enable the button and reset text on error
          spinner.hide();
          buttonText.text("Save Event");
          addButton.prop("disabled", false);
        }
      },
      error: function (xhr, status, error) {
        console.error("Error adding event:", error);
        // Re-enable the button and reset text on error
        spinner.hide();
        buttonText.text("Save Event");
        addButton.prop("disabled", false);
      },
    });
  });

  $(document).on("click", "#delete-events", function () {
    let calendarid = $(this).data("id");

    Swal.fire({
      title: "Are you sure?",
      text: "This event will be permanently deleted!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        // Show loading state
        Swal.fire({
          title: "Deleting...",
          text: "Please wait while we process the request.",
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading();
          },
        });

        $.ajax({
          url: "../php/Deleteevents.php", // Make sure this PHP file exists
          type: "POST",
          data: { id: calendarid },
          success: function (response) {
            let result = JSON.parse(response);
            if (result.success) {
              Swal.fire("Deleted!", "The event has been deleted.", "success");
              fetchEvents();
            } else {
              Swal.fire("Error!", result.message, "error");
            }
          },
          error: function () {
            Swal.fire("Error!", "Server error. Please try again.", "error");
          },
        });
      }
    });
  });
});
