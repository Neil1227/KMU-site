<!-- Edit Podcast Modal -->
<div class="modal fade" id="editPodcastModal" tabindex="-1" aria-labelledby="editPodcastModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editPodcastForm" method="POST" enctype="multipart/form-data" data-upload-loader>
      @csrf
      @method('PUT')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Podcast</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="podcast_edit_id" name="id">

          <div class="mb-3">
            <label for="podcast_edit_title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="podcast_edit_title" required>
          </div>

          <div class="mb-3">
            <label for="podcast_edit_description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="podcast_edit_description" rows="3" required></textarea>
          </div>

          <div class="mb-3">
              <label for="podcast_edit_link" class="form-label">Embed Code</label>
              <textarea name="link" class="form-control" id="podcast_edit_link" rows="3"
                        placeholder="Paste the iframe embed code here"></textarea>
          </div>

          <div id="podcast_current_thumbnail" class="mb-3"></div>

          <div class="mb-3">
            <label for="podcast_edit_png" class="form-label">PNG Image (optional)</label>
            <div class="upload-box drop-area" data-type="png">
              <i class="fa fa-upload upload-icon mb-2"></i>
              <p class="upload-text">Drag & drop PNG or click</p>
              <input type="file" id="podcast_edit_png" name="png" accept="image/png" class="file-input" hidden>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success w-100"id="saveEditPodcastBtn">Update Podcast</button>
        </div>
      </div>
    </form>
  </div>
</div>
