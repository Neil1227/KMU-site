<!-- Edit Episode Modal -->
<div class="modal fade" id="editEpisodeModal" tabindex="-1" aria-labelledby="editEpisodeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
<form id="editEpisodeForm" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit ICTV Episode</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit_id" name="id">

          <div class="mb-3">
            <label for="edit_title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="edit_title" required>
          </div>

          <div class="mb-3">
            <label for="edit_description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="edit_description" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label for="edit_link" class="form-label">Link</label>
            <input type="url" name="link" class="form-control" id="edit_link" required>
          </div>

          <div id="current_thumbnail" class=" mb-2"></div>

            <div class="row mb-3">
            <div class="col-md-6">
                <label for="edit_webp" class="form-label">WEBP Image (optional)</label>
                <div class="upload-box drop-area" data-type="webp">
                <i class="fa fa-upload upload-icon"></i>
                <p class="upload-text">Drag & drop WEBP or click</p>
                <input type="file" id="edit_webp" name="webp" accept="image/webp" class="file-input" hidden>
                </div>
            </div>
            <div class="col-md-6">
                <label for="edit_png" class="form-label">PNG Image (optional)</label>
                <div class="upload-box drop-area" data-type="png">
                <i class="fa fa-upload upload-icon"></i>
                <p class="upload-text">Drag & drop PNG or click</p>
                <input type="file" id="edit_png" name="png" accept="image/png" class="file-input" hidden>
                </div>
            </div>
            </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary w-100">Update Episode</button>
        </div>
      </div>
    </form>
  </div>
</div>
