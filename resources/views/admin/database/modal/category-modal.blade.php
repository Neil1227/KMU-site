<!-- Change Classification Modal -->
<div class="modal fade" id="changeClassificationModal" tabindex="-1" aria-labelledby="changeClassificationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title text-white" id="changeClassificationModalLabel">Change Classification</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="classificationForm">
        <div class="modal-body">
          
          <!-- Existing Category Dropdown -->
          <div class="mb-3">
            <label for="existingCategory" class="form-label fw-semibold">Select Existing Category</label>
            <select class="form-select" id="existingCategory" name="existing_category">
              <option value="">-- Choose Existing Category --</option>
              <option value="Agriculture">Agriculture</option>
              <option value="Livestock">Livestock</option>
              <option value="Industrial">Industrial</option>
            </select>
          </div>

          <div class="text-center fw-bold text-muted mb-2">— OR —</div>

          <!-- New Category Input -->
          <div class="mb-3">
            <label for="newCategory" class="form-label fw-semibold">Add New Category</label>
            <input type="text" class="form-control" id="newCategory" name="new_category" placeholder="Enter new category name">
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const modalEl = document.getElementById('changeClassificationModal');
  if (!modalEl) return;

  const existingSelect = modalEl.querySelector('#existingCategory');
  const newCategoryInput = modalEl.querySelector('#newCategory');
  const form = modalEl.querySelector('#classificationForm');

  // Reset everything when modal is shown
  modalEl.addEventListener('show.bs.modal', function () {
    form.reset();
    existingSelect.disabled = false;
    newCategoryInput.disabled = false;
  });

  // When selecting an existing category
  existingSelect.addEventListener('change', function () {
    if (this.value.trim() !== '') {
      newCategoryInput.value = '';
      newCategoryInput.disabled = true;       // 🔒 Lock input immediately
      newCategoryInput.placeholder = "Disabled while existing category is selected";
    } else {
      newCategoryInput.disabled = false;      // 🔓 Re-enable input
      newCategoryInput.placeholder = "Enter new category name";
    }
  });

  // When typing a new category
  newCategoryInput.addEventListener('input', function () {
    const typed = this.value.trim();
    if (typed !== '') {
      existingSelect.value = '';              // Clear dropdown
      existingSelect.disabled = true;         // 🔒 Lock dropdown immediately
    } else {
      existingSelect.disabled = false;        // 🔓 Re-enable dropdown
    }
  });

  // Handle form submission
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const existing = existingSelect.value.trim();
    const newCat = newCategoryInput.value.trim();

    // Validate mutually exclusive input
    if (existing && newCat) {
      alert('Please choose either an existing category OR add a new one — not both.');
      return;
    }

    if (!existing && !newCat) {
      alert('Please select or enter a category.');
      return;
    }

    const selected = newCat || existing;
    console.log('Selected category:', selected);

    // Close modal
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    modalInstance.hide();

    // TODO: Ajax / Axios call here
  });
});
</script>
@endpush
