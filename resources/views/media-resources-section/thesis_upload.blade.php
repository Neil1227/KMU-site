@extends('layouts.app')

@section('title', 'KMU | Thesis Upload')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/upload_thesis.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

    @include('layouts.components.header')
    @include('layouts.components.navbar')

    <div class="container-page-services my-4">
        <h2 class="section-title text-center ">Upload Your Thesis</h2>
        <p class="text-center text-muted"><em>For bona fide PSAU Students submitting their Research Thesis</em></p>

        <form action="{{ route('thesis.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="upload-container">
                <!-- COLUMN 2: Thesis Details -->
                <div class="panel mb-3">
                    <h5 class="title-heading">1. Upload PDF</h5>
                    <label for="thesis_file" class="upload-area mb-3">
                        <p>Drag & Drop or click to select PDF</p>
                        <input type="file" name="thesis_file" id="thesis_file" accept="application/pdf" required>
                    </label>

                    <div class="file-preview mb-2" style="display:none;">
                        <p><strong>Selected File:</strong> <span id="fileName"></span></p>
                        <button type="button" class="btn btn-secondary btn-sm" id="previewBtn">Preview PDF</button>
                    </div>

                    <h5 class="title-heading">2. Thesis Details</h5>
                    <div class="row g-2">
                        <div class="col-12">
                            <textarea name="thesis_title" class="form-control" placeholder="Thesis Title" rows="2" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <textarea name="adviser" class="form-control" placeholder="Adviser" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <textarea name="groupmates" class="form-control" placeholder="Groupmates" rows="3"></textarea>
                        </div>
                        <!-- Program -->
                        <div class="col-md-6">
                            <select name="program" class="form-control select2" required>
                                <option value="">Select Program</option>
                                <option value="BSA - Animal Science">BSA - Animal Science</option>
                                <option value="BSA - Crop Science">BSA - Crop Science</option>
                                <option value="BSAF - Agroforestry">BSAF - Agroforestry</option>
                                <option value="BSFo - Forestry">BSFo - Forestry</option>
                                <option value="BSAB - Agricultural Business">BSAB - Agricultural Business</option>
                                <option value="BSAE - Agricultural Economics">BSAE - Agricultural Economics</option>
                                <option value="BS Entrepreneurship">BS Entrepreneurship</option>
                                <option value="BS Fisheries">BS Fisheries</option>
                                <option value="BS Development Communication">BS Development Communication</option>
                                <option value="BA English Language Studies">BA English Language Studies</option>
                                <option value="BS Biology">BS Biology</option>
                                <option value="BS Mathematics">BS Mathematics</option>
                                <option value="BTLEd - Home Economics">BTLEd - Home Economics</option>
                                <option value="BTLEd - Industrial Arts">BTLEd - Industrial Arts</option>
                                <option value="BSEd - Science">BSEd - Science</option>
                                <option value="BSEd - Mathematics">BSEd - Mathematics</option>
                                <option value="BSEd - English">BSEd - English</option>
                                <option value="BSEd - Elementary">BSEd - Elementary</option>
                                <option value="BPE - School Physical Education">BPE - School Physical Education</option>
                                <option value="BS Food Technology">BS Food Technology</option>
                                <option value="BS Hospitality Management">BS Hospitality Management</option>
                                <option value="BS Agricultural & Biosystems Engineering">BS Agricultural & Biosystems
                                    Engineering</option>
                                <option value="BS Geodetic Engineering">BS Geodetic Engineering</option>
                                <option value="BS Civil Engineering">BS Civil Engineering</option>
                                <option value="BS Information Technology">BS Information Technology</option>
                                <option value="Doctor of Veterinary Medicine">Doctor of Veterinary Medicine</option>
                                <option value="BS Computer Engineering">BS Computer Engineering</option>
                            </select>
                        </div>

                        <!-- College -->
                        <div class="col-md-6">
                            <select name="college" class="form-control select2" required>
                                <option value="">Select College</option>
                                <option value="CAS - College of Arts and Sciences">CAS - College of Arts and Sciences
                                </option>
                                <option value="CASTech - College of Agriculture Systems and Technology">CASTech - College of
                                    Agriculture Systems and Technology</option>
                                <option value="CBEE - College of Business, Economics and Entrepreneurship">CBEE - College of
                                    Business, Economics and Entrepreneurship</option>
                                <option value="CFAF - College of Forestry and Agroforestry">CFAF - College of Forestry and
                                    Agroforestry</option>
                                <option value="COECS - College of Engineering and Computer Studies">COECS - College of
                                    Engineering and Computer Studies</option>
                                <option value="COED - College of Education">COED - College of Education</option>
                                <option value="CVM - College of Veterinary Medicine">CVM - College of Veterinary Medicine
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- COLUMN 3: Student Info -->
                <div class="panel mb-3">
                    <h5 class="title-heading">3. Student Information</h5>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="psau_id" class="form-control" placeholder="PSAU ID" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="contact_number" class="form-control"
                                placeholder="Contact Number" required>
                        </div>
                        <div class="col-md-4">
                            <select name="graduate_student" class="form-select" required>
                                <option value="">Master’s Student?</option>

                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="graduation_month" id="graduation_month" class="form-select" required>
                                <option value="">Graduation Month</option>
                                @foreach ([
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ] as $num => $month)
                                    <option value="{{ $num }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="graduation_year" class="form-control"
                                placeholder="Graduation Year" min="2010" max="2100">
                        </div>
                        <div class="col-md-12">
                            <input type="url" name="googledrive_link" class="form-control"
                                placeholder="Google Drive Link">
                        </div>
                    </div>

                    <!-- Compact Instructions -->
                    <small class="text-muted d-block mt-1" style="font-size:0.8rem;">
                        Include thesis paper, approval sheet, e-signatures (PDF).<br>
                        File naming: <strong>[Year]_[College]_[Thesis Title]_[Given Name]</strong><br>
                        E-signature: <strong>[Surname], [Given Name], [M.I.]</strong>
                    </small>
                    <div class="my-5">

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="data_privacy_consent"
                                id="data_privacy_consent" value="1" required>
                            <label class="form-check-label text-muted" style="font-size: .8rem"
                                for="data_privacy_consent">
                                <em>I hereby authorize the PSAU Knowledge Management Center to collect, store, and manage
                                    the data indicated herein in accordance with RA 10173 (Data Privacy Act of 2012).</em>
                            </label>
                        </div>

                        @error('data_privacy_consent')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror

                    </div>

                    <button class="btn btn-primary w-100 mt-2">Save Information</button>
                </div>

            </div>
        </form>

        <!-- ================= MODAL PREVIEW ================= -->
        <div id="previewModal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <iframe id="pdfFrame" style="width:100%;height:500px;"></iframe>
            </div>
        </div>

    </div>
    @include('layouts.components.footer')
@endsection


@push('scripts')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2').select2({
                placeholder: "Select Program",
                width: '100%'
            });
        });
    </script>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                let errors = @json($errors->all());
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: errors.join('<br>'),
                    confirmButtonColor: '#d33'
                });
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#3085d6'
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fileInput = document.getElementById("thesis_file");
            const filePreview = document.querySelector(".file-preview");
            const fileNameSpan = document.getElementById("fileName");
            const previewBtn = document.getElementById("previewBtn");
            const previewModal = document.getElementById("previewModal");
            const pdfFrame = document.getElementById("pdfFrame");
            const closeModal = document.querySelector(".close-modal");

            // Show file name
            fileInput.addEventListener("change", () => {
                if (fileInput.files.length > 0) {
                    fileNameSpan.textContent = fileInput.files[0].name;
                    filePreview.style.display = "block";
                }
            });

            // Open PDF preview
            previewBtn.addEventListener("click", () => {
                if (fileInput.files.length > 0) {
                    const fileURL = URL.createObjectURL(fileInput.files[0]);
                    pdfFrame.src = fileURL;
                    previewModal.style.display = "block";
                }
            });

            // Close modal
            closeModal.addEventListener("click", () => {
                previewModal.style.display = "none";
                pdfFrame.src = "";
            });

            window.addEventListener("click", (e) => {
                if (e.target === previewModal) {
                    previewModal.style.display = "none";
                    pdfFrame.src = "";
                }
            });
        });
    </script>
@endpush
