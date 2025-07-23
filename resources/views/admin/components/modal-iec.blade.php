<!-- Edit IEC Material Modal -->
<div class="modal fade" id="editIECModal" tabindex="-1" aria-labelledby="editIECModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editIECForm" method="POST" enctype="multipart/form-data">
      @csrf
      
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit IEC Material</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="edit_iec_id" name="id">

          <div class="mb-3">
            <label for="edit_iec_title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="edit_iec_title" required>
          </div>

          <div class="mb-3">
            <label for="edit_iec_description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="edit_iec_description" rows="3" required></textarea>
          </div>

            <div id="current_thumbnail" class="mb-2"></div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="edit_iec_file" class="form-label">Brochure File PDF (optional)</label>
              <div class="upload-box drop-area" data-type="file">
                <i class="fa fa-upload upload-icon"></i>
                <p class="upload-text">Drag & drop PDF</p>
                <input type="file" name="file" id="edit_iec_file" class="file-input" accept=".pdf,.doc,.docx" hidden>
              </div>
            </div>
            <div class="col-md-6">
              <label for="edit_iec_png" class="form-label">Thumbnail PNG (optional)</label>
              <div class="upload-box drop-area" data-type="png">
                <i class="fa fa-upload upload-icon"></i>
                <p class="upload-text">Drag & drop PNG</p>
                <input type="file" name="png" id="edit_iec_png" class="file-input" accept="image/png" hidden>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" id="saveEditBtn" class="btn btn-primary w-100">Update Material</button>
        </div>
      </div>
    </form>
  </div>
</div>
