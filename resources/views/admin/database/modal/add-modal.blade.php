<!-- Add New Commodity Modal -->
<div class="modal fade" id="addCommodityModal" tabindex="-1" aria-labelledby="addCommodityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Larger Modal -->
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header text-white">
                <h5 class="modal-title" id="addCommodityModalLabel">Add New Commodity Record</h5>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form id="commodityForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">

                        <!-- Section: General Info -->
                        <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">General Information</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label">Commodity</label>
                                <select name="commodity" id="commoditySelect" class="form-select">
                                    <option value="" disabled selected>-- Select Commodity --</option>
                                    <!-- Allow new entry -->
                                    <option value="other">New Commodity</option>
                                    <!-- Fixed option -->
                                    <option value="For Checking">For Checking</option>

                                    <!-- Dynamic commodities -->
                                    @foreach ($commodities as $c)
                                        <option value="{{ $c->commodity }}">{{ $c->commodity }} ({{ $c->total }})
                                        </option>
                                    @endforeach


                                </select>

                                <!-- Input shows only if "Other" is selected -->
                                <input type="text" name="commodity_other" id="commodityOther"
                                    class="form-control mt-2" placeholder="Enter new commodity" style="display:none;">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">College</label>
                                <select name="college" id="collegeSelect" class="form-select">
                                    <option value="">Select College</option>
                                    <option value="CAS - College of Arts and Sciences">CAS - College of Arts and
                                        Sciences</option>
                                    <option value="CASTech - College of Agriculture Systems and Technology">CASTech -
                                        College of Agriculture Systems and Technology</option>
                                    <option value="CBEE - College of Business, Economics and Entrepreneurship">CBEE -
                                        College of Business, Economics and Entrepreneurship</option>
                                    <option value="CFAF - College of Forestry and Agroforestry">CFAF - College of
                                        Forestry and Agroforestry</option>
                                    <option value="COECS - College of Engineering and Computer Studies">COECS - College
                                        of Engineering and Computer Studies</option>
                                    <option value="COED - College of Education">COED - College of Education</option>
                                    <option value="CVM - College of Veterinary Medicine">CVM - College of Veterinary
                                        Medicine</option>
                                </select>


                            </div>


                            <div class="col-md-6">
                                <label class="form-label">Technology Generator</label>
                                <textarea name="technology_generator" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Thesis Title</label>
                                <input type="text" name="thesis_title" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Technologies</label>
                                <input type="text" name="technologies" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Contact Info</label>
                                <input type="text" name="contact_info" class="form-control">
                            </div>
                        </div>

                        <!-- Section: Classification -->
                        <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">Classification</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label">Type of Technology</label>
                                <select name="type_of_technology" class="form-select">
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
                                <select name="ip_status" class="form-select">
                                    <option value="Non-IP Applied">Non-IP Applied</option>
                                    <option value="IP Applied">IP Applied</option>
                                    <option value="Registered">Registered</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">TRL Level</label>
                                <select name="trl_level" class="form-select">
                                    @for ($i = 1; $i <= 9; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">SDGs</label>
                                <textarea name="sdgs" class="form-control" rows="2"></textarea>
                            </div>
                        </div>

                        <!-- Section: Status & Additional Information -->
                        <h6 class="fw-bold text-secondary border-bottom pb-2 mb-3">Status, Recommendations & Additional
                            Info</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label">Remarks</label>
                                <select name="remarks" class="form-select">
                                    <option value="For Product Development">For Product Development</option>
                                    <option value="For Incubation">For Incubation</option>
                                    <option value="For Commercialization">For Commercialization</option>
                                    <option value="For IP Application">For IP Application</option>
                                    <option value="For Deployment">For Deployment</option>
                                    <option value="For Extention">For Extention</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Recommendations</label>
                                <textarea name="recommendations" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Link</label>
                                <textarea name="link" class="form-control" rows="2"></textarea>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Priority Area</label>
                                <select name="priority_area" class="form-select">
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
                    <button type="button" id="saveCommodityBtn" class="btn btn-primary">Save Record</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    document.getElementById("commoditySelect").addEventListener("change", function() {
        const otherInput = document.getElementById("commodityOther");

        if (this.value === "other") {
            otherInput.style.display = "block";
            otherInput.required = true; // force user to type a new commodity
        } else {
            otherInput.style.display = "none";
            otherInput.required = false;
            otherInput.value = ""; // reset if hidden
        }
    });
</script>
