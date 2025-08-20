<!-- Edit Technology Modal -->
<div class="modal fade" id="editTechnologyModal" tabindex="-1" aria-labelledby="editTechnologyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="editTechnologyForm" method="POST" enctype="multipart/form-data" data-show-loader>
      @csrf
      @method('PUT')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTechnologyModalLabel">Edit Technology</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="edit_tech_id" name="id">

          <div class="mb-3">
            <label for="edit_product" class="form-label">Product Name *</label>
            <input type="text" class="form-control" id="edit_product" name="product" required>
          </div>

          <div class="mb-3">
            <label for="edit_desc" class="form-label">Description *</label>
            <textarea class="form-control" id="edit_desc" name="desc" rows="3" required></textarea>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="edit_net" class="form-label">Net Value *</label>
              <input type="number" class="form-control" id="edit_net" name="net" step="0.01" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="edit_profit" class="form-label">Profit Value *</label>
              <input type="number" class="form-control" id="edit_profit" name="profit" step="0.01" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="edit_inventors" class="form-label">Inventors (comma separated)</label>
            <input type="text" class="form-control" id="edit_inventors" name="inventors">
          </div>

          <div class="mb-3">
            <label for="edit_ip_status" class="form-label">IP Status *</label>
            <input type="text" class="form-control" id="edit_ip_status" name="ip_status" required>
          </div>

          <div class="mb-3">
            <label for="edit_proposition" class="form-label">Value Proposition (comma separated)</label>
            <input type="text" class="form-control" id="edit_proposition" name="proposition">
          </div>

          <div class="mb-3">
            <label for="edit_benefits" class="form-label">Benefits (comma separated)</label>
            <input type="text" class="form-control" id="edit_benefits" name="benefits">
          </div>

          <div id="current_tech_images" class="mb-3"></div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="edit_image" class="form-label">Technology Image *</label>
              <div class="upload-box drop-area" data-type="image">
                <i class="fa fa-upload upload-icon"></i>
                <p class="upload-text">Drag & drop Image or click</p>
                <input type="file" id="edit_image" name="image" accept="image/*" class="file-input" hidden>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="edit_poster" class="form-label">Technology Poster *</label>
              <div class="upload-box drop-area" data-type="image">
                <i class="fa fa-upload upload-icon"></i>
                <p class="upload-text">Drag & drop Poster or click</p>
                <input type="file" id="edit_poster" name="poster" accept="image/*" class="file-input" hidden>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success w-100">
            <i class="fa fa-upload"></i> Update Technology
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
