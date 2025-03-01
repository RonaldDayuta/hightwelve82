<div class="officers">
    <div class="name">
        <h3>Officers Table</h3>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addOfficerModal">
            <span class="material-icons-outlined"> person_add </span>
            Add Officers
        </button>
    </div>
    <div class="search">
        <div class="group">
            <svg viewBox="0 0 24 24" aria-hidden="true" class="search-icon">
                <g>
                    <path
                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                    </path>
                </g>
            </svg>

            <input id="search-officer" class="input" type="text" placeholder="Search..." name="searchbar" />
        </div>
    </div>

    <div class="tables">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Postion</th>
                    <th scope="col">Position Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="table-Officers"></tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addOfficerModal" tabindex="-1" aria-labelledby="addOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficerModalLabel">Add Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addOfficerForm">
                    <div class="mb-3">
                        <label for="officerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="officerName" name="officerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="officerPosition" class="form-label">Position</label>
                        <input type="text" class="form-control" id="officerPosition" name="officerPosition" required>
                    </div>
                    <div class="mb-3">
                        <label for="positionDescription" class="form-label">Position Description</label>
                        <textarea class="form-control" id="positionDescription" name="positionDescription" rows="3"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="officerimage" class="form-label">Officer Profile</label>
                        <input type="file" id="officerimage" name="officerimage" class="form-control" accept="image/*"
                            required />
                        <small class="text-muted">Recomended: No Backgroud IMG</small>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-officers" type="submit" class="btn btn-primary">
                            <span id="button-text">Add Officer</span>
                            <div id="spinner" class="spinner-border spinner-border-sm" role="status"
                                style="display: none;">
                                <span class="sr-only"></span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editOfficerModal" tabindex="-1" aria-labelledby="editOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOfficerModalLabel">Edit Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editOfficerForm" enctype="multipart/form-data">
                    <input type="hidden" id="editOfficerID" name="officerID"> <!-- Hidden ID Field -->

                    <div class="mb-3">
                        <label for="editOfficerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editOfficerName" name="officerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editOfficerPosition" class="form-label">Position</label>
                        <input type="text" class="form-control" id="editOfficerPosition" name="officerPosition"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="editPositionDescription" class="form-label">Position Description</label>
                        <textarea class="form-control" id="editPositionDescription" name="positionDescription" rows="3"
                            required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editOfficerImage" class="form-label">Change Officer Image</label>
                        <input type="file" accept=".jpeg, .png, .gif, .jpg" id="editOfficerImage" name="officerImage"
                            class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank to keep the current image.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <span id="edit-button-text">Update Officer</span>
                            <div id="edit-spinner" class="spinner-border spinner-border-sm" role="status"
                                style="display: none;"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/Officers.js"></script>