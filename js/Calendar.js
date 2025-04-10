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

    // Get first day and number of days in the month
    let firstDay = new Date(year, month, 1).getDay();
    let daysInMonth = new Date(year, month + 1, 0).getDate();

    // Create empty spaces for alignment
    for (let i = 0; i < firstDay; i++) {
      calendarBody.append('<div class="empty"></div>');
    }

    // Generate calendar days
    for (let day = 1; day <= daysInMonth; day++) {
      let isToday =
        day === today.getDate() &&
        month === today.getMonth() &&
        year === today.getFullYear()
          ? "current-day"
          : "";

      calendarBody.append(
        `<div class="day ${isToday}" data-date="${year}-${(month + 1)
          .toString()
          .padStart(2, "0")}-${day.toString().padStart(2, "0")}">${day}</div>`
      );
    }

    // Fetch event dates and highlight them
    fetchEventDates(month, year);
  }

  // Function to fetch event dates and highlight them
  function fetchEventDates(month, year) {
    $.ajax({
      url: "../php/fetchEventDates.php",
      type: "POST",
      data: { month: month + 1, year: year }, // PHP expects 1-based month index
      dataType: "json",
      success: function (eventDates) {
        $(".day").each(function () {
          let date = $(this).data("date");
          if (eventDates.includes(date)) {
            $(this).addClass("event-day"); // Apply yellow background
          }
        });
      },
      error: function (xhr, status, error) {
        console.error("Error fetching event dates:", error);
      },
    });
  }

  // Fetch events (for displaying events when a date is clicked)
  function fetchEvents() {
    $.ajax({
      url: "../php/fetchevents.php",
      type: "POST",
      data: { selectedDate: selectedDate },
      cache: false,
      success: function (data) {
        $("#table-events").html(data);
        var modal = bootstrap.Modal.getOrCreateInstance(
          document.getElementById("eventModal")
        );
        modal.show();
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

    let selectedDateObj = new Date(selectedDate);
    let today = new Date();
    today.setHours(0, 0, 0, 0); // I-reset ang oras para tama ang paghahambing

    if (selectedDateObj < today) {
      $("#add-event-btn").prop("disabled", true); // Disable kung nakalipas na petsa
    } else {
      $("#add-event-btn").prop("disabled", false); // Enable kung kasalukuyan o hinaharap
    }
    fetchEvents();
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

  function openAddEventModal() {
    document.getElementById("add-event-date").innerText = selectedDate;
    document.getElementById("event-date").value = selectedDate;
    var modal = bootstrap.Modal.getOrCreateInstance(
      document.getElementById("addEventModal")
    );
    modal.show();
  }

  $("#add-event-btn").click(function () {
    openAddEventModal();
  });

  $("#event-form").submit(function (event) {
    event.preventDefault();
    // Disable the button and show the spinner
    let addButton = $("#add-events-btn");
    let spinner = $("#spinner");
    let buttonText = $("#button-text");

    // Show the spinner and change the button text
    spinner.show();
    buttonText.text("Adding..."); // Change text to "Adding..."
    addButton.prop("disabled", true); // Disable the button

    let formData = new FormData(this);

    console.log("Form Data before submission:", Object.fromEntries(formData));

    $.ajax({
      url: "../php/AddEvents.php", // Correct URL to your add event PHP script
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
            $("#event-form")[0].reset();

            // Hide the modal after successful submission
            var modalEl = document.getElementById("addEventModal");
            var modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) {
              modalInstance.hide();
            }
            var modal = bootstrap.Modal.getOrCreateInstance(
              document.getElementById("eventModal")
            );
            modal.show();

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

  $(document).on("click", "#edit-event-btn", function () {
    let eventId = $(this).data("id");

    $.ajax({
      url: "../php/GetEventDetails.php", // PHP script to fetch event details
      type: "POST",
      data: { event_id: eventId },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          $("#update-event-id").val(response.data.id);
          $("#update-event-date").val(response.data.event_date);
          $("#update-event-title").val(response.data.title);
          $("#update-event-description").val(response.data.description);
          $("#update-event-category").val(response.data.category);
          $("#update-post-category").val(response.data.post_category);

          // Clear file input (User can upload a new image)
          $("#update-event-image").val("");

          var modal = bootstrap.Modal.getOrCreateInstance(
            document.getElementById("updateEventModal")
          );
          modal.show();
        } else {
          Swal.fire("Error", response.message, "error");
        }
      },
      error: function () {
        Swal.fire("Error", "Failed to fetch event details", "error");
      },
    });
  });

  $("#update-event-form").submit(function (event) {
    event.preventDefault();

    let updateButton = $("#update-event-btn");
    let spinner = $("#update-spinner");
    let buttonText = $("#update-button-text");

    // Show the spinner and disable the button
    spinner.show();
    buttonText.text("Updating...");
    updateButton.prop("disabled", true);

    let formData = new FormData(this);

    $.ajax({
      url: "../php/UpdateEvent.php", // Your PHP update script
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            title: "Success!",
            text: response.message,
            icon: "success",
            confirmButtonText: "OK",
          }).then(() => {
            var modalEl = document.getElementById("updateEventModal");
            var modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) {
              modalInstance.hide();
            }
            fetchEvents(); // Refresh the event list

            // Reset button state
            spinner.hide();
            buttonText.text("Update Event");
            updateButton.prop("disabled", false);
          });
        } else {
          Swal.fire("Error", response.message, "error");
          spinner.hide();
          buttonText.text("Update Event");
          updateButton.prop("disabled", false);
        }
      },
      error: function () {
        Swal.fire("Error", "Failed to update event", "error");
        spinner.hide();
        buttonText.text("Update Event");
        updateButton.prop("disabled", false);
      },
    });
  });
});
