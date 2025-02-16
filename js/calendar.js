let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let today = new Date();
let selectedDate = "";
let events = {};

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
    let isToday =
      day === today.getDate() &&
      month === today.getMonth() &&
      year === today.getFullYear()
        ? "current-day"
        : "";
    calendarBody.innerHTML += `<div class="day ${isToday}" onclick="openEventModal('${year}-${
      month + 1
    }-${day}')">${day}</div>`;
  }
}

function openEventModal(date) {
  selectedDate = date;
  document.getElementById("selected-date").innerText = date;
  new bootstrap.Modal(document.getElementById("eventModal")).show();
}

function openAddEventModal() {
  document.getElementById("add-event-date").innerText = selectedDate;
  document.getElementById("event-date").value = selectedDate;
  new bootstrap.Modal(document.getElementById("addEventModal")).show();
}

function prevMonth() {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  generateCalendar(currentMonth, currentYear);
}
function nextMonth() {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  generateCalendar(currentMonth, currentYear);
}

window.onload = function () {
  generateCalendar(currentMonth, currentYear);
};
