<!-- Edit Promotional Activity Modal -->
<div class="modal fade" id="editPromoModal" tabindex="-1" aria-labelledby="editPromoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editPromoForm" method="POST" enctype="multipart/form-data" data-show-loader>
      @csrf
      @method('PUT')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Promotional Activity</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="promo_edit_id" name="id">

          <div class="mb-3">
            <label for="promo_edit_title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="promo_edit_title" required>
          </div>

          <div class="mb-3">
            <label for="promo_edit_description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="promo_edit_description" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label for="promo_edit_link" class="form-label">Link</label>
            <input type="url" name="link" class="form-control" id="promo_edit_link">
          </div>

          <div id="promo_current_thumbnail" class="mb-2"></div>

          <div class="mb-3">
            <label for="promo_edit_png" class="form-label">PNG Image (optional)</label>
            <div class="upload-box drop-area" data-type="png">
              <i class="fa fa-upload upload-icon"></i>
              <p class="upload-text">Drag & drop PNG or click</p>
              <input type="file" id="promo_edit_png" name="png" accept="image/png" class="file-input" hidden>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success w-100">Update Promotional Activity</button>
        </div>
      </div>
    </form>
  </div>
</div>
