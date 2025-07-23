<!-- Edit Module Modal -->
<div class="modal fade" id="editModuleModal" tabindex="-1" aria-labelledby="editModuleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editModuleForm" method="POST" enctype="multipart/form-data">
      @csrf
    
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Module</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="edit-id" name="id">

          <div class="mb-3">
            <label for="edit_module_title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="edit_module_title" required>
          </div>

          <!-- Existing Files Preview -->
          <div class="mb-3" id="current_module_thumbnail"></div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="edit-pdf" class="form-label">Module PDF (optional)</label>
              <div class="upload-box drop-area" data-type="file">
                <i class="fa fa-upload upload-icon"></i>
                <p class="upload-text">Drag & drop PDF</p>
                <input type="file" name="pdf" id="edit-pdf" class="file-input" accept="application/pdf" hidden>
              </div>
            </div>
            <div class="col-md-6">
              <label for="edit-png" class="form-label">Thumbnail PNG (optional)</label>
              <div class="upload-box drop-area" data-type="png">
                <i class="fa fa-upload upload-icon"></i>
                <p class="upload-text">Drag & drop PNG</p>
                <input type="file" name="png" id="edit-png" class="file-input" accept="image/png" hidden>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" id="saveEditBtn" class="btn btn-success w-100">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
</div>
