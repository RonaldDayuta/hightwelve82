<style>
  .calendar-container {
    max-width: 900px;
    margin: 20px auto;
  }
<<<<<<< HEAD

=======
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
  .calendar {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
  }
<<<<<<< HEAD

=======
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
  .day {
    padding: 15px;
    text-align: center;
    cursor: pointer;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    min-height: 50px;
  }
<<<<<<< HEAD

=======
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
  .day:hover {
    background-color: #007bff;
    color: white;
  }
<<<<<<< HEAD

=======
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
  .header {
    font-weight: bold;
    text-align: center;
    margin-bottom: 10px;
  }
<<<<<<< HEAD

  .empty {
    visibility: hidden;
  }

=======
  .empty {
    visibility: hidden;
  }
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
  .current-day {
    background-color: #007bff !important;
    color: white !important;
    font-weight: bold;
  }
</style>
<div class="table-name">
  <h2>Calendar</h2>
</div>
<div class="tables">
  <div class="calendar-container">
    <h2 class="text-center" id="month-year"></h2>
    <div class="calendar-header d-flex justify-content-between">
      <button class="btn btn-secondary" onclick="prevMonth()">
        &#9665; Prev
      </button>
      <button class="btn btn-secondary" onclick="nextMonth()">
        Next &#9655;
      </button>
    </div>
    <div class="calendar mt-3">
      <div class="header">Sun</div>
      <div class="header">Mon</div>
      <div class="header">Tue</div>
      <div class="header">Wed</div>
      <div class="header">Thu</div>
      <div class="header">Fri</div>
      <div class="header">Sat</div>
    </div>
    <div class="calendar" id="calendar-body"></div>
  </div>
  <div
    class="modal fade"
    id="eventModal"
    tabindex="-1"
<<<<<<< HEAD
    aria-labelledby="eventModalLabel">
=======
    aria-labelledby="eventModalLabel"
  >
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">
            Events on <span id="selected-date"></span>
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
<<<<<<< HEAD
            aria-label="Close"></button>
=======
            aria-label="Close"
          ></button>
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
        </div>
        <div class="modal-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Event</th>
                <th scope="col">Description</th>
              </tr>
            </thead>
            <tbody id="event-list">
              <tr>
                <td colspan="2" class="text-center">No events</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" onclick="openAddEventModal()">
            Add Event
          </button>
          <button
            type="button"
            class="btn btn-secondary"
<<<<<<< HEAD
            data-bs-dismiss="modal">
=======
            data-bs-dismiss="modal"
          >
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
            Close
          </button>
        </div>
      </div>
    </div>
  </div>

  <div
    class="modal fade"
    id="addEventModal"
    tabindex="-1"
<<<<<<< HEAD
    aria-labelledby="addEventModalLabel">
=======
    aria-labelledby="addEventModalLabel"
  >
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Add Event on <span id="add-event-date"></span>
          </h5>
          <button
            type="button"
            class="btn-close"
<<<<<<< HEAD
            data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="event-title" class="form-label">Date</label>
            <input
              type="text"
              id="event-date"
              class="form-control"
              placeholder="Enter event title"
              disabled />
          </div>
          <div class="mb-3">
=======
            data-bs-dismiss="modal"
          ></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
            <label for="event-title" class="form-label">Event Title</label>
            <input
              type="text"
              id="event-title"
              class="form-control"
<<<<<<< HEAD
              placeholder="Enter event title" />
          </div>
          <div class="mb-3">
            <label for="event-description" class="form-label">Event Description</label>
=======
              placeholder="Enter event title"
            />
          </div>
          <div class="mb-3">
            <label for="event-description" class="form-label"
              >Event Description</label
            >
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
            <textarea
              id="event-description"
              class="form-control"
              rows="3"
<<<<<<< HEAD
              placeholder="Enter event description"></textarea>
          </div>
          <div class="mb-3">
            <label for="event-category" class="form-label">Event Category</label>
=======
              placeholder="Enter event description"
            ></textarea>
          </div>
          <div class="mb-3">
            <label for="event-category" class="form-label"
              >Event Category</label
            >
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
            <select id="event-category" class="form-control">
              <option value="news-today">News Today</option>
              <option value="events">Events</option>
              <option value="meeting">Meeting</option>
              <option value="activities">Activities</option>
            </select>
          </div>
          <div class="mb-3">
<<<<<<< HEAD
            <label for="event-image" class="form-label">Upload Image FOR:(Event, Activities, News) (Optional)</label>
=======
            <label for="event-image" class="form-label"
              >Upload Image FOR:(Event, Activities, News) (Optional)</label
            >
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
            <input
              type="file"
              id="event-image"
              class="form-control"
<<<<<<< HEAD
              accept="image/*" />
=======
              accept="image/*"
            />
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" onclick="addEvent()">
            Save Event
          </button>
          <button
            type="button"
            class="btn btn-secondary"
<<<<<<< HEAD
            data-bs-dismiss="modal">
=======
            data-bs-dismiss="modal"
          >
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<<<<<<< HEAD
<script src="js/calendar.js"></script>
=======
<script src="js/calendar.js"></script>
>>>>>>> dc126cc1015aed93d974631a7de1c6d8c319b9e4
