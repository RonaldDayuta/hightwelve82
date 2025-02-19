<style>
    .calendar-container {
        max-width: 900px;
        margin: 20px auto;
    }

    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .day {
        padding: 15px;
        text-align: center;
        cursor: pointer;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        min-height: 50px;
    }

    .day:hover {
        background-color: #007bff;
        color: white;
    }

    .header {
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
    }

    .empty {
        visibility: hidden;
    }

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
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">
                        Events on <span id="selected-date"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Category</th>
                            </tr>
                        </thead>
                        <tbody id="table-events">
                            <tr>
                                <td colspan="2" class="text-center">No events</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="add-event-btn">
                        Add Event
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Event on <span id="add-event-date"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="event-form"> <!-- Dito na inilagay ang form -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="text" id="event-date" name="event-date" class="form-control" readonly />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Title</label>
                            <input type="text" id="event-title" name="event-title" class="form-control"
                                placeholder="Enter event title" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Description</label>
                            <textarea id="event-description" name="event-description" class="form-control" rows="3"
                                placeholder="Enter event description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Event Category</label>
                            <select id="event-category" name="event-category" class="form-control">
                                <option value="" selected>Select Category</option>
                                <option value="news-today">News Today</option>
                                <option value="events">Events</option>
                                <option value="meeting">Meeting</option>
                                <option value="activities">Activities</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Image (Optional)</label>
                            <input type="file" id="event-image" name="event-image" class="form-control"
                                accept="image/*" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="add-event-btn" type="button" class="btn btn-success" onclick="addEvent()">
                            <span id="button-text">Save Event</span>
                            <div id="spinner" class="spinner-border spinner-border-sm" role="status" style="display: none;">
                                <span class="sr-only"></span>
                            </div>
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form> <!-- Dito natapos ang form -->
            </div>
        </div>
    </div>
</div>
<!-- Include SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

<!-- Include SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<script src="js/calendarupdated.js"></script>