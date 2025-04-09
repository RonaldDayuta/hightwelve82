<div class="repository">
    <div class="createbutton">
        <button id="newfolder" class="newfolder" data-bs-toggle="modal" data-bs-target="#addFolderModal">New Folder</button>
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

            <input class="input" id="search-folder" type="text" placeholder="Search..." name="searchbar" />
        </div>
    </div>
    <div id="folders" class="folders">
        <button>
            <span class="material-icons-outlined">source</span>
            Folder Name
        </button>
    </div>

    <div class="modal fade" id="addFolderModal" tabindex="-1" aria-labelledby="addFolderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addFolderModalLabel">Add New Folder</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="folderForm">
                        <div class="mb-3" style="display:none;">
                            <label for="folderId" class="form-label">Folder ID</label>
                            <input type="text" class="form-control" id="folderId" name="folderId" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="folderName" class="form-label">Folder Name</label>
                            <input type="text" class="form-control" id="folderName" name="folderName" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Folder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/Repo.js"></script>