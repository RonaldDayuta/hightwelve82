<div class="insidefolder">
    <div id="backbuttoninside" class="names">
        <span class="material-icons-outlined">arrow_back_ios</span>
        <h2 id="insidefoldername">Foldername</h2>
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
                    <div class="mb-3">
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