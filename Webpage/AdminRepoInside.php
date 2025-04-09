<div class="insidefolder">
    <div id="backbuttoninside" class="names">
        <span class="material-icons-outlined">arrow_back_ios</span>
        <h2 id="insidefoldername">Foldername</h2>
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

            <input class="input" id="search-file" type="text" placeholder="Search..." name="searchbar" />
        </div>
    </div>
    <button id="openupload" class="upload" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload File</button>
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="uploadFormPDF">
                <div class="modal-body">
                    <div class="mb-3" style="display: none;">
                        <input id="folderid" name="folderid" type="text" />
                        <input id="fileid" name="fileid" type="text" />
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Choose file</label>
                        <input class="form-control" type="file" id="formFile" name="file" accept=".pdf" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Upload</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <table class="table">
        <tbody id="tfiles">
        </tbody>
    </table>

    <div id="previewModal" class="preview-modal" style="display:none;">
        <div class="modal-content">
            <span id="close-btn-preview" class="close-btn">&times;</span>
            <iframe id="previewFrame" src="" width="100%" height="800px"></iframe>
        </div>
    </div>


<script src="../js/Repo.js"></script>