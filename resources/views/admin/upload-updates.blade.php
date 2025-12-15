@extends('layouts.admin')

@section('title', 'Latest Updates')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/upload.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm mt-4">

            {{-- Header --}}
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-newspaper me-2"></i>Latest Updates</h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $posts->total() }} total</span>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addPostModal">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
            </div>


            <div class="card-body">

                {{-- Office Filter --}}
                <div class="d-flex mb-3 gap-2">
                    <select class="form-select ms-auto" id="admin-select" onchange="location = this.value;"
                        style="width:auto;">
                        @php
                            $offices = [
                                'all' => 'All Offices',
                                'EXTENSION' => 'Extension Office',
                                'RESEARCH' => 'Research Office',
                                'KMU' => 'KM Office',
                                'IPTBM' => 'IPTBM Office',
                                'TBI' => 'Sibul-TBI Office',
                            ];
                        @endphp
                        @foreach ($offices as $key => $label)
                            <option value="{{ route('admin.upload-updates', ['office' => $key]) }}"
                                @if ($selectedOffice == $key) selected @endif>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Posts Grid --}}
                @if ($posts->count() > 0)
                    <div class="posts-grid" id="posts-grid">
                        @foreach ($posts as $post)
                            @php
                                $mediaItems = $post->media;
                                $firstMedia = $mediaItems->first();
                                $tagIds = !empty($post->tags)
                                    ? (is_array($post->tags)
                                        ? $post->tags
                                        : explode(',', $post->tags))
                                    : [];
                            @endphp

                            <div class="post-card" data-admin="{{ strtoupper($post->admin->role ?? 'UNKNOWN') }}"
                                data-id="{{ $post->id }}">

                                {{-- Media Rendering --}}
                                @php $galleryId = 'post-' . $post->id; @endphp
                                @if ($mediaItems->count() > 0)
                                    @php $galleryId = 'post-' . $post->id; @endphp

                                    @foreach ($mediaItems as $index => $media)
                                        @php
                                            $isFirst = $index === 0;
                                            $isImage = $media->type === 'image';
                                            $isVideo = $media->type === 'video';
                                        @endphp

                                        @if ($isImage || $isVideo)
                                            <a href="{{ asset('storage/' . $media->url) }}"
                                                class="glightbox {{ $isFirst ? '' : 'd-none' }}"
                                                data-gallery="{{ $galleryId }}" data-title="{{ $post->title }}"
                                                @if ($isVideo) data-type="video" @endif>

                                                @if ($isFirst)
                                                    @if ($isImage)
                                                        <img src="{{ asset('storage/' . $media->url) }}"
                                                            class="post-media">
                                                    @else
                                                        <video src="{{ asset('storage/' . $media->url) }}"
                                                            class="post-media" muted loop controls></video>
                                                    @endif
                                                @endif
                                            </a>
                                        @elseif ($media->type === 'file' && $isFirst)
                                            <a href="{{ asset('storage/' . $media->url) }}" target="_blank">
                                                <img src="{{ asset('assets/img/media_thumbnail/fileicon.png') }}"
                                                    alt="file icon" class="post-media">
                                            </a>
                                        @endif
                                    @endforeach

                                    @if ($mediaItems->count() > 1)
                                        <span class="more-media text-muted small">
                                            +{{ $mediaItems->count() - 1 }} more
                                        </span>
                                    @endif
                                @endif


                                {{-- Link Button --}}
                                @if (!empty($post->link))
                                    <div class="mb-2">
                                        <a href="{{ $post->link }}" target="_blank" class=" post-link">
                                            <img src="{{ asset('assets/img/media_thumbnail/linkicon.png') }}"
                                                alt="link icon" class="post-media">
                                        </a>

                                    </div>
                                @endif


                                {{-- Post Content --}}
                                <div class="post-content">
                                    <h6>{{ $post->title }}</h6>
                                    <p>{{ $post->description }}</p>

                                    {{-- Footer: Posted by + SDG Indicators + Tags --}}
                                    <div class="post-footer">
                                        <div class="post-meta">
                                            <span>Posted by {{ strtoupper($post->admin->role ?? 'UNKNOWN') }} |
                                                {{ $post->created_at->diffForHumans() }}</span>

                                            {{-- SDG Target Indicators --}}
                                            @if (!empty($post->sdg_target_indicators))
                                                <div class="sdg-indicators mt-1">
                                                    <span>SDGs Target Indicators:</span>
                                                    @foreach ($post->sdg_target_indicators as $indicator)
                                                        <span>{{ $indicator }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        {{-- SDG Tags --}}
                                        <div class="tags">
                                            @foreach ($tagIds as $tagId)
                                                <img src="{{ asset("assets/img/sdgs/{$tagId}.png") }}" class="tag-icon"
                                                    alt="SDG {{ $tagId }}">
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- Action Buttons --}}
                                    <div class="action-buttons mt-2 d-flex gap-1">
                                        @if (!$post->is_approved)
                                            @if (session('admin_role') === 'KMU')
                                                <button class="btn btn-success btn-sm approve-btn"
                                                    data-id="{{ $post->id }}">Approve</button>
                                            @endif
                                        @else
                                            <button class="btn bg-light">Posted</button>
                                        @endif

                                        @if (session('admin_id') === $post->admin_id || session('admin_role') === 'KMU')
                                            <button type="button" class="btn btn-sm btn-primary edit-post-btn"
                                                data-id="{{ $post->id }}" title="Edit Post">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger delete-post-btn"
                                                title="Delete Post">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-content-card text-center py-5">
                        <div class="card-content m-auto">
                            <h4>No content available</h4>
                            <p>Please try selecting another office or upload a new one.</p>
                        </div>
                    </div>
                @endif


                {{-- Pagination --}}
                <div class="mt-4 d-flex justify-content-end">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

    {{-- modal add updates --}}


    <!-- Add Post Modal -->
    <div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="addPostLabel"><i class="bi bi-plus-lg"></i> Add New Post</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form id="update-form" action="{{ route('admin.updates.store') }}" method="POST"
                    enctype="multipart/form-data" data-show-loader>
                    @csrf
                    <div class="modal-body">

                        <div class="post-card p-3 border rounded shadow-sm">

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                            </div>
                            <!-- Link -->
                            <div class="mb-3">
                                <label for="link" class="form-label">Link (optional)</label>
                                <input type="url" name="link" id="link" class="form-control"
                                    placeholder="https://example.com">
                                <small class="text-muted">Add a URL if applicable.</small>

                                <!-- Preview Button -->
                                <div class="mt-2" id="add-link-preview" style="display:none;">
                                    <a href="#" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-box-arrow-up-right"></i> Open Link
                                    </a>
                                </div>
                            </div>


                            <!-- Drag & Drop Media -->
                            <div class="mb-3">
                                <label class="form-label">Media</label>
                                <div class="dropzone border dash p-3 text-center" id="media-dropzone">
                                    <i class="bi bi-upload" style="font-size: 2rem;"></i>
                                    <p>Drag & drop files here or click to upload</p>
                                    <input type="file" name="media[]" multiple class="form-control d-none">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="sdg_target_indicators" class="form-label">SDG Target Indicators</label>
                                <input type="text" name="sdg_target_indicators" id="sdg_target_indicators"
                                    class="form-control" placeholder="e.g., 1.2.2, 1.2.c, 2.3.a">
                                <small class="text-muted">Separate multiple indicators with commas.</small>
                            </div>


                            <!-- SDG Tags -->
                            <div class="mb-3">
                                <label class="form-label">SDG Tags</label>
                                <div class="sdg-tags d-flex flex-wrap gap-2">
                                    @for ($i = 1; $i <= 17; $i++)
                                        <div class="sdg-badge-wrapper">
                                            <input type="checkbox" name="tags[]" value="{{ $i }}"
                                                id="sdg-{{ $i }}" class="d-none sdg-checkbox">
                                            <label for="sdg-{{ $i }}" class="sdg-badge">
                                                <img src="{{ asset("assets/img/sdgs/{$i}.png") }}"
                                                    alt="SDG {{ $i }}">
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Post Modal -->
    <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form id="edit-post-form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit-post-id">

                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white" id="editPostLabel"><i class="bi bi-pencil"></i> Edit Post</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" id="edit-title" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea id="edit-description" name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <!-- Link -->
                        <div class="mb-3">
                            <label for="edit-link" class="form-label">Link (optional)</label>
                            <input type="url" id="edit-link" name="link" class="form-control"
                                placeholder="https://example.com">
                            <small class="text-muted">Add a URL if applicable.</small>

                            <!-- Preview Button -->
                            <div class="mt-2" id="edit-link-preview" style="display:none;">
                                <a href="#" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-box-arrow-up-right"></i> Open Link
                                </a>
                            </div>
                        </div>





                        <div class="mb-3">
                            <label>Upload New Media (optional)</label>
                            <div class="dropzone border dash p-3 text-center" id="edit-media-dropzone">
                                <i class="bi bi-upload" style="font-size: 2rem;"></i>
                                <p>Drag & drop files here or click to upload</p>
                                <input type="file" name="media[]" multiple class="form-control d-none">
                            </div>
                            <small class="text-muted">Uploading new media will replace existing media.</small>
                        </div>


                        <div class="mb-3">
                            <label>Existing Media</label>
                            <div id="edit-existing-media" class="d-flex gap-2 flex-wrap"></div>
                        </div>
                        <div class="mb-3">
                            <label>SDG Tags</label>
                            <div id="sdg-tags" class="d-flex flex-wrap gap-2">
                                @for ($i = 1; $i <= 17; $i++)
                                    <div class="sdg-badge-wrapper">
                                        <input type="checkbox" id="edit-sdg-{{ $i }}" name="tags[]"
                                            value="{{ $i }}" class="d-none sdg-checkbox">
                                        <label for="edit-sdg-{{ $i }}" class="sdg-badge">
                                            <img src="{{ asset("assets/img/sdgs/$i.png") }}"
                                                alt="SDG {{ $i }}">
                                        </label>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>SDG Target Indicators</label>
                            <input type="text" id="edit-sdg-target-indicators" name="sdg_target_indicators"
                                class="form-control" placeholder="e.g., 1.2.2, 2.3.a">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true
            });

            // ===== Dropzone Utility =====
            function initDropzone(dropzoneId) {
                const dropzone = document.getElementById(dropzoneId);
                if (!dropzone) return {
                    droppedFiles: []
                };

                const fileInput = dropzone.querySelector('input[type="file"]');
                let droppedFiles = [];
                let previewContainer = dropzone.querySelector('.preview-container');

                if (!previewContainer) {
                    previewContainer = document.createElement('div');
                    previewContainer.classList.add('preview-container');
                    dropzone.appendChild(previewContainer);
                }

                dropzone.addEventListener('click', e => {
                    if (e.target === dropzone) fileInput.click();
                });

                fileInput.addEventListener('change', e => handleFiles(e.target.files));

                dropzone.addEventListener('dragover', e => {
                    e.preventDefault();
                    dropzone.classList.add('bg-light');
                });

                dropzone.addEventListener('dragleave', e => {
                    e.preventDefault();
                    dropzone.classList.remove('bg-light');
                });

                dropzone.addEventListener('drop', e => {
                    e.preventDefault();
                    dropzone.classList.remove('bg-light');
                    handleFiles(e.dataTransfer.files);
                });

                function handleFiles(files) {
                    Array.from(files).forEach(file => {
                        if (!droppedFiles.some(f => f.name === file.name && f.size === file.size)) {
                            droppedFiles.push(file);
                            const p = document.createElement('p');
                            p.textContent = file.name;
                            previewContainer.appendChild(p);
                        }
                    });
                }

                return {
                    droppedFiles
                };
            }

            // ===== Initialize Dropzones =====
            const addDrop = initDropzone('media-dropzone');
            const editDrop = initDropzone('edit-media-dropzone');
            let editDroppedFiles = editDrop.droppedFiles;

            // ===== SDG Tag Toggle =====
            document.querySelectorAll('.sdg-badge-wrapper').forEach(wrapper => {
                wrapper.addEventListener('click', () => {
                    const checkbox = wrapper.querySelector('.sdg-checkbox');
                    checkbox.checked = !checkbox.checked;
                    wrapper.classList.toggle('selected', checkbox.checked);
                });
            });

            // ===== Add Post Form =====
            const addForm = document.getElementById('update-form');
            const addLinkInput = document.getElementById('link');
            const addLinkPreview = document.getElementById('add-link-preview');

            if (addForm) {
                addForm.addEventListener('submit', e => {
                    e.preventDefault();
                    const formData = new FormData(addForm);
                    formData.delete('media[]');
                    addDrop.droppedFiles.forEach(file => formData.append('media[]', file));
                    document.querySelectorAll('input[name="tags[]"]:checked').forEach(cb => {
                        formData.append('tags[]', cb.value);
                    });

                    axios.post(addForm.action, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(() => Swal.fire('Success', 'Post uploaded successfully', 'success').then(() =>
                            location.reload()))
                        .catch(err => Swal.fire('Error', err.response?.data?.message ||
                            'Something went wrong', 'error'));
                });

                if (addLinkInput && addLinkPreview) {
                    addLinkInput.addEventListener('input', () => {
                        if (addLinkInput.value.trim() !== '') {
                            addLinkPreview.style.display = 'block';
                            addLinkPreview.querySelector('a').href = addLinkInput.value;
                        } else {
                            addLinkPreview.style.display = 'none';
                        }
                    });
                }
            }

            // ===== Edit Post Modal & Submission =====
            const editForm = document.getElementById('edit-post-form');
            const editLinkInput = document.getElementById('edit-link');
            const editLinkPreview = document.getElementById('edit-link-preview');

            document.querySelectorAll('.edit-post-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const postId = btn.dataset.id;

                    axios.get(`/admin/updates/${postId}/edit`).then(res => {
                        const data = res.data;

                        // Populate fields
                        document.getElementById('edit-post-id').value = data.id;
                        document.getElementById('edit-title').value = data.title;
                        document.getElementById('edit-description').value = data
                            .description;

                        // Set form action dynamically
                        editForm.action = `/admin/updates/${postId}`;

                        // Populate link input & preview
                        if (data.link && data.link.trim() !== '') {
                            editLinkInput.value = '';
                            editLinkInput.placeholder = data.link;
                            editLinkPreview.style.display = 'block';
                            editLinkPreview.querySelector('a').href = data.link;
                        } else {
                            editLinkInput.value = '';
                            editLinkInput.placeholder = 'https://example.com';
                            editLinkPreview.style.display = 'none';
                        }

                        new bootstrap.Modal(document.getElementById('editPostModal'))
                            .show();
                    }).catch(() => Swal.fire('Error', 'Failed to load post data', 'error'));
                });
            });

            // Dynamic link preview while typing
            if (editLinkInput && editLinkPreview) {
                editLinkInput.addEventListener('input', () => {
                    if (editLinkInput.value.trim() !== '') {
                        editLinkPreview.style.display = 'block';
                        editLinkPreview.querySelector('a').href = editLinkInput.value;
                    } else {
                        editLinkPreview.querySelector('a').href = editLinkInput.placeholder || '#';
                        editLinkPreview.style.display = editLinkInput.placeholder ? 'block' : 'none';
                    }
                });
            }

            if (editForm) {
                editForm.addEventListener('submit', e => {
                    e.preventDefault();
                    const formData = new FormData(editForm);
                    formData.append('_method', 'PUT');
                    formData.delete('media[]');
                    editDroppedFiles.forEach(file => formData.append('media[]', file));

                    axios.post(editForm.action, formData, {
                            headers: {
                                "Content-Type": "multipart/form-data"
                            }
                        })
                        .then(() => Swal.fire('Success', 'Post updated successfully', 'success').then(() =>
                            location.reload()))
                        .catch(() => Swal.fire('Error', 'Update failed', 'error'));
                });
            }

            // ===== Delete Post =====
            const postsContainer = document.getElementById('posts-grid');
            if (postsContainer) {
                postsContainer.addEventListener('click', function(e) {
                    const button = e.target.closest('.delete-post-btn');
                    if (!button) return;
                    const postCard = button.closest('.post-card');
                    const postId = postCard.dataset.id;
                    if (!postId) return;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This post will be deleted permanently.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(result => {
                        if (result.isConfirmed) {
                            axios.delete(`/admin/updates/${postId}`)
                                .then(res => {
                                    if (res.data.success) {
                                        postCard.remove();
                                        Swal.fire('Deleted!', res.data.message, 'success');
                                    } else {
                                        Swal.fire('Error!', res.data.message, 'error');
                                    }
                                })
                                .catch(() => Swal.fire('Error!', 'Something went wrong.', 'error'));
                        }
                    });
                });
            }

        });
    </script>


    <script>
        document.addEventListener("click", function(e) {
            if (e.target.closest(".approve-btn")) {

                let btn = e.target.closest(".approve-btn");
                let id = btn.getAttribute("data-id");

                Swal.fire({
                    title: "Approve this post?",
                    text: "This will make the post visible to the public.",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Approve"
                }).then((r) => {
                    if (r.isConfirmed) {
                        axios.post(`/admin/posts/${id}/approve`)
                            .then(res => {
                                Swal.fire("Approved!", res.data.message, "success")
                                    .then(() => location.reload());
                            })
                            .catch(() => {
                                Swal.fire("Error", "Failed to approve.", "error");
                            });
                    }
                });
            }
        });
    </script>
@endpush
