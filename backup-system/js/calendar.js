let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let today = new Date();
let selectedDate = "";
let events = {}; // Global object to store events

// Function to fetch events and store them in the global events object
function fetchEvents() {
  console.log("Fetching events..."); // Log to indicate the start of the AJAX request

  $.ajax({
    url: "php/getEvents.php", // Correct URL to your PHP script
    type: "GET",
    dataType: "json", // Ensure we're expecting a JSON response
    success: function (data) {
      console.log("Fetched Events Response:", data); // Log the raw response

      if (!Array.isArray(data)) {
        console.error("Invalid data format, expected an array.");
        return;
      }

      events = {}; // Reset events object
      console.log("Resetting events object...");

      // Loop through the fetched data and organize events by date
      data.forEach((event, index) => {
        let dateKey = event.event_date.trim(); // Remove extra spaces from the date
        console.log(`Event ${index}: Date Key: ${dateKey}`); // Log each event's date key

        if (!events[dateKey]) {
          events[dateKey] = []; // Initialize the array for that date if not already set
        }
        events[dateKey].push(event); // Add the event to the array for that date
      });

      console.log("Processed Events Object:", events); // Log the final processed events object

      generateCalendar(currentMonth, currentYear); // Regenerate the calendar after fetching events
    },
    error: function (xhr, status, error) {
      console.error("Error fetching events:", error); // Log errors if any
    },
  });
}

// Function to generate the calendar
function generateCalendar(month, year) {
  const calendarBody = document.getElementById("calendar-body");
  const monthYear = document.getElementById("month-year");
  calendarBody.innerHTML = ""; // Clear existing calendar
  monthYear.innerText = new Date(year, month).toLocaleString("default", {
    month: "long",
    year: "numeric",
  });

  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Generate empty divs for days before the first day of the month
  for (let i = 0; i < firstDay; i++) {
    calendarBody.innerHTML += `<div class="empty"></div>`;
  }

  // Generate the days in the calendar
  for (let day = 1; day <= daysInMonth; day++) {
    let dateKey = `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
    let isToday = (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) ? "current-day" : "";

    // Display events dot if events exist for that date
    let eventHTML = events[dateKey] && events[dateKey].length > 0 ? `<span class="event-dot"></span>` : "";

    // Add day to the calendar grid
    calendarBody.innerHTML += `<div class="day ${isToday}" data-date="${dateKey}" onclick="openEventModal('${dateKey}')">${day} ${eventHTML}</div>`;
  }
}

// Function to open event details modal
function openEventModal(date) {
  selectedDate = date;
  document.getElementById("selected-date").innerText = date; // Display the selected date in the modal

  const eventList = document.getElementById("event-list");
  eventList.innerHTML = events[date]
    ? events[date]
        .map(
          (event) =>
            `<tr>
               <td>${event.event_date}</td>
               <td>${event.title}</td>
               <td>${event.description}</td>
               <td>${event.category}</td>
               <td>${event.image ? `<img src="${event.image}" alt="Event Image" style="max-width: 50px; max-height: 50px;" />` : 'No Image'}</td>
             </tr>`
        )
        .join("") // Join the array of event rows into one HTML string
    : "<tr><td colspan='5' class='text-center'>No events</td></tr>"; // Show a "No events" message if there are no events

  // Show the modal using Bootstrap
  new bootstrap.Modal(document.getElementById("eventModal")).show();
}

// Function to open modal for adding event
function openAddEventModal() {
  document.getElementById("add-event-date").innerText = selectedDate;
  document.getElementById("event-date").value = selectedDate;
  new bootstrap.Modal(document.getElementById("addEventModal")).show();
}

// Function to submit event using AJAX
function addEvent() {
  let formData = new FormData(document.getElementById("event-form"));

  console.log("Form Data before submission:", Object.fromEntries(formData)); // Debugging form data

  $.ajax({
    url: "php/addEvents.php", // Correct URL to your add event PHP script
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log("Raw Response:", response);

      try {
        let data = JSON.parse(response);
        console.log("Parsed JSON:", data);

        if (data.status && data.message) {
          alert(`Status: ${data.status}\nMessage: ${data.message}`);
          fetchEvents(); // Refresh calendar after adding event
        } else {
          console.error("Unexpected JSON format:", data);
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

// Functions to navigate months
function prevMonth() {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  fetchEvents(); // Refresh events when changing months
}

function nextMonth() {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  fetchEvents(); // Refresh events when changing months
}

// Function to log events from PHP on page load
function logEventsInCalendar() {
  console.log("Fetching and logging events from getEvents.php...");

  $.ajax({
    url: "php/getEvents.php", // Correct URL to your PHP script
    type: "GET",
    dataType: "json", // Ensure we're expecting a JSON response
    success: function (data) {
      console.log("Fetched Events Response:", data); // Log the raw response

      if (!Array.isArray(data)) {
        console.error("Invalid data format, expected an array.");
        return;
      }

      // Log the events directly in the console
      data.forEach((event, index) => {
        console.log(`Event ${index + 1}:`);
        console.log(`Date: ${event.event_date}`);
        console.log(`Title: ${event.title}`);
        console.log(`Description: ${event.description}`);
        console.log(`Category: ${event.category}`);
        console.log(`Image: ${event.image}`);
        console.log("-------------------------------");
      });
    },
    error: function (xhr, status, error) {
      console.error("Error fetching events:", error); // Log errors if any
    }
  });
}

// Load events on page load
window.onload = function () {
  fetchEvents(); // Fetch events when the page is loaded
  logEventsInCalendar(); // Log events in the console on page load
};
