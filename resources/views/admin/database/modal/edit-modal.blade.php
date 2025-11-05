<!-- Edit Commodity Modal -->
<div class="modal fade" id="editCommodityModal" tabindex="-1" aria-labelledby="editCommodityModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header text-white">
        <h5 class="modal-title" id="editCommodityModalLabel">Edit Commodity Record</h5>
        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Form should only wrap body + footer -->
      <form id="editCommodityForm" method="POST">
        @csrf
        @method('PUT') <!-- Laravel expects PUT for update -->
        <input type="hidden" name="id" id="edit_id">

        <!-- Modal Body -->
        <div class="modal-body">
          <div class="container-fluid">

            <!-- Section: General Info -->
            <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">General Information</h6>
            <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label">Commodity</label>
              <select name="commodity" id="commodityEdit" class="form-select" required>
                  <option value="other">New Commodity</option>
                  <option value="For Checking">For Checking</option>

    @foreach($commodities as $c)
        <option value="{{ $c->commodity }}">
            {{ $c->commodity }} ({{ $c->total }})
        </option>
    @endforeach
              </select>
              
              <!-- Input shows only if "New Commodity" is selected -->
              <input type="text" name="commodity_other" id="edit_commodityOther" 
                    class="form-control mt-2" placeholder="Enter new commodity" 
                    style="display:none;">
            </div>

              <div class="col-md-6">
                <label class="form-label">Technology Generator</label>
                <textarea name="technology_generator" id="edit_technology_generator" class="form-control" rows="2"></textarea>
              </div>
            </div>
            <div class="row g-3 mb-4">
              <div class="col-md-4">
                <label class="form-label">Thesis Title</label>
                <input type="text" name="thesis_title" id="edit_thesis_title" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Technologies</label>
                <input type="text" name="technologies" id="edit_technologies" class="form-control">
              </div>
              <div class="col-md-4">
                <label class="form-label">Contact Info</label>
                <input type="text" name="contact_info" id="edit_contact_info" class="form-control">
              </div>
            </div>

            <!-- Section: Classification -->
            <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">Classification</h6>
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <label class="form-label">Type of Technology</label>
                <select name="type_of_technology" id="edit_type_of_technology" class="form-select">
                  <option value="Food">Food</option>
                  <option value="Non-Food">Non-Food</option>
                  <option value="N/A">N/A</option>
                  <optgroup label="Non-Food">
                    <option value="Non-Food (Chemical)">Non-Food (Chemical)</option>
                    <option value="Non-Food (Software)">Non-Food (Software)</option>
                    <option value="Non-Food (Equipment)">Non-Food (Equipment)</option>
                  </optgroup>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">IP Status</label>
                <select name="ip_status" id="edit_ip_status" class="form-select">
                  <option value="Non-IP Applied">Non-IP Applied</option>
                  <option value="IP Applied">IP Applied</option>
                  <option value="Registered">Registered</option>
                  <option value="N/A">N/A</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">TRL Level</label>
                <select name="trl_level" id="edit_trl_level" class="form-select">
                @for($i = 1; $i <= 9; $i++)
                    <option value="{{ (string) $i }}">{{ $i }}</option>
                @endfor

                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">SDGs</label>
                <textarea name="sdgs" id="edit_sdgs" class="form-control" rows="2"></textarea>
              </div>
            </div>

            <!-- Section: Status & Additional Info -->
            <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">Status, Recommendations & Additional Info</h6>
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <label class="form-label">Remarks</label>
                <select name="remarks" id="edit_remarks" class="form-select">
                  <option value="For Product Development">For Product Development</option>
                  <option value="For Incubation">For Incubation</option>
                  <option value="For Commercialization">For Commercialization</option>
                  <option value="For IP Application">For IP Application</option>
                  <option value="For Deployment">For Deployment</option>
                  <option value="For Extension">For Extension</option>
                  <option value="N/A">N/A</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label">Recommendations</label>
                <textarea name="recommendations" id="edit_recommendations" class="form-control" rows="2"></textarea>
              </div>
              <div class="col-md-3">
                <label class="form-label">Link</label>
                <textarea name="link" id="edit_link" class="form-control" rows="2"></textarea>
              </div>
              <div class="col-md-3">
                <label class="form-label">Priority Area</label>
                <select name="priority_area" id="edit_priority_area" class="form-select">
                  <option value="Agriculture">Agriculture</option>
                  <option value="Aquaculture">Aquaculture</option>
                  <option value="LiveStock">LiveStock</option>
                  <option value="Livelihood">Livelihood</option>
                  <option value="Biotechnology">Biotechnology</option>
                  <option value="Root Crops">Root Crops</option>
                  <option value="Internet Of Things">Internet Of Things</option>
                  <option value="Others">Others</option>
                  <option value="N/A">N/A</option>
                </select>
              </div>
            </div>

          </div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" id="updateCommodityBtn" class="btn btn-primary">Update Record</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Force to close the X button for edit (quick fix) -->
<script>
    document.addEventListener("hidden.bs.modal", function (event) {
    if (document.querySelectorAll('.modal.show').length === 0) {
        document.body.classList.remove('modal-open');
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    }
});
document.getElementById("commodityEdit").addEventListener("change", function () {
    const otherInput = document.getElementById("edit_commodityOther");
    otherInput.style.display = this.value === "other" ? "block" : "none";
});


</script>
