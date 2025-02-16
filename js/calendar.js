let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let today = new Date();
let selectedDate = "";
let events = {}; // This will store events from the database


// Function to fetch events from PHP
function fetchEvents() {
  fetch("php/getEvents.php")
    .then((response) => response.json())
    .then((data) => {
      events = {};
      data.forEach((event) => {
        if (!events[event.event_date]) {
          events[event.event_date] = [];
        }
        events[event.event_date].push(event);
      });
      generateCalendar(currentMonth, currentYear); // Re-generate calendar with events
    })
    .catch((error) => console.error("Error fetching events:", error));
}

// Function to generate calendar
function generateCalendar(month, year) {
  const calendarBody = document.getElementById("calendar-body");
  const monthYear = document.getElementById("month-year");
  calendarBody.innerHTML = "";
  monthYear.innerText = new Date(year, month).toLocaleString("default", {
    month: "long",
    year: "numeric",
  });

  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  for (let i = 0; i < firstDay; i++) {
    calendarBody.innerHTML += `<div class="empty"></div>`;
  }

  for (let day = 1; day <= daysInMonth; day++) {
    let dateKey = `${year}-${String(month + 1).padStart(2, "0")}-${String(
      day
    ).padStart(2, "0")}`;
    let isToday =
      day === today.getDate() &&
        month === today.getMonth() &&
        year === today.getFullYear()
        ? "current-day"
        : "";

    let eventHTML = events[dateKey]
      ? `<span class="event-dot"></span>`
      : ""; // Add a dot if event exists

    calendarBody.innerHTML += `<div class="day ${isToday}" onclick="openEventModal('${dateKey}')">${day} ${eventHTML}</div>`;
  }
}

// Open modal for event details
function openEventModal(date) {
  selectedDate = date;
  document.getElementById("selected-date").innerText = date;

  // Show existing events for the selected date
  const eventList = document.getElementById("event-list");
  eventList.innerHTML = events[date]
    ? events[date]
      .map(
        (event) =>
          `<div><strong>${event.title}</strong> - ${event.description}</div>`
      )
      .join("")
    : "<p>No events</p>";

  new bootstrap.Modal(document.getElementById("eventModal")).show();
}

// Open modal for adding event
function openAddEventModal() {
  document.getElementById("add-event-date").innerText = selectedDate;
  document.getElementById("event-date").value = selectedDate;
  new bootstrap.Modal(document.getElementById("addEventModal")).show();
}

// Submit event using AJAX
function addEvent() {
  let formData = new FormData(document.getElementById("event-form"));

  console.log("Form Data before submission:", Object.fromEntries(formData)); // Debugging form data

  $.ajax({
    url: "php/addEvents.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log("Raw Response:", response); // Debugging raw response
      try {
        let data = JSON.parse(response);
        console.log("Parsed JSON:", data);

        if (typeof data === "object" && data !== null) {
          if (data.status && data.message) {
            alert(`Status: ${data.status}\nMessage: ${data.message}`);
          } else {
            console.error("Unexpected JSON format:", data);
          }
        } else {
          console.error("Response is not a valid JSON object:", response);
        }
      } catch (error) {
        console.error("JSON Parse Error:", error, "\nInvalid JSON Response:", response);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error adding event:", error);
    },
  });
}

// Navigate months
function prevMonth() {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  fetchEvents();
}

function nextMonth() {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  fetchEvents();
}

// Load events on page load
window.onload = function () {
  fetchEvents();
};
