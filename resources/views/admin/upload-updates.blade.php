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

                                {{-- Media --}}
                                @if ($mediaItems->count() > 0)
                                    @php $galleryId = 'post-' . $post->id; @endphp
                                    @foreach ($mediaItems as $index => $media)
                                        @if ($media->type === 'image')
                                            @if ($index === 0)
                                                <a href="{{ asset('storage/' . $media->url) }}" class="glightbox"
                                                    data-glightbox="gallery: {{ $galleryId }}; title: {{ $post->title }}">
                                                    <img src="{{ asset('storage/' . $media->url) }}" class="post-media"
                                                        alt="{{ $post->title }}">
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/' . $media->url) }}" class="glightbox d-none"
                                                    data-glightbox="gallery: {{ $galleryId }}; title: {{ $post->title }}"></a>
                                            @endif
                                        @elseif ($media->type === 'video')
                                            @if ($index === 0)
                                                <a href="{{ asset('storage/' . $media->url) }}" class="glightbox"
                                                    data-glightbox="gallery: {{ $galleryId }}; type: video; title: {{ $post->title }}">
                                                    <video src="{{ asset('storage/' . $media->url) }}" class="post-media"
                                                        muted loop controls></video>
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/' . $media->url) }}" class="glightbox d-none"
                                                    data-glightbox="gallery: {{ $galleryId }}; type: video; title: {{ $post->title }}"></a>
                                            @endif
                                        @elseif ($post->type === 'file' || $post->type === 'link')
                                            @if ($index === 0)
                                                <a href="{{ asset('storage/' . $media->url) }}" target="_blank"
                                                    class="d-block mb-2 file-link">
                                                    <i
                                                        class="bi bi-file-earmark-text me-1"></i>{{ $media->filename ?? ($media->title ?? 'File/Link') }}
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach

                                    @if ($mediaItems->count() > 1)
                                        <span class="more-media text-muted small">+{{ $mediaItems->count() - 1 }}
                                            more</span>
                                    @endif
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
                                        <button type="button" class="btn btn-sm btn-primary btn-edit" title="Edit Post"><i
                                                class="bi bi-pencil"></i> Edit</button>
                                        <button type="button" class="btn btn-sm btn-danger delete-post-btn"
                                            title="Delete Post"><i class="bi bi-trash"></i> Delete</button>
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
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="editPostLabel">
                        <i class="bi bi-pencil"></i> Edit Post
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

<form id="edit-post-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.updates.update', ['post' => 0]) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <input type="hidden" name="post_id" id="edit-post-id">

                        <!-- TITLE -->
                        <div class="mb-3">
                            <label for="edit-title" class="form-label">Title</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="mb-3">
                            <label for="edit-description" clas s="form-label">Description</label>
                            <textarea name="description" id="edit-description" rows="3" class="form-control"></textarea>
                        </div>

                        <!-- EXISTING MEDIA -->
                        <div class="mb-3">
                            <label class="form-label">Existing Media</label>
                            <div id="existing-media" class="d-flex gap-2 flex-wrap"></div>
                        </div>

                        <!-- UPLOAD NEW MEDIA -->
                        <div class="mb-3">
                            <label class="form-label">Add New Media</label>
                            <input type="file" name="media[]" class="form-control" multiple>
                        </div>

                        <!-- SDG TARGET INDICATORS -->
                        <div class="mb-3">
                            <label for="edit-sdg-target-indicators" class="form-label">SDG Target Indicators</label>
                            <input type="text" name="sdg_target_indicators" id="edit-sdg-target-indicators"
                                class="form-control" placeholder="e.g., 1,2,3">
                            <small class="text-muted">Separate indicators with commas</small>
                        </div>

                        <!-- SDG ICON CHECKBOXES -->
                        <div class="mb-3">
                            <label class="form-label">SDG Tags</label>
                            <div class="sdg-tags d-flex flex-wrap gap-2">

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

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update Post</button>
                    </div>

                </form>
            </div>
        </div>
    </div>





@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    {{-- glight init --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Initialize GLightbox
            const lightbox = GLightbox({
                touchNavigation: true,
                loop: true,
            });

            // Delete Post
            document.querySelectorAll('.delete-post-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const postCard = this.closest('.post-card');
                    const postId = postCard.dataset.id;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This post will be deleted permanently.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.delete(`/admin/updates/${postId}`)
                                .then(res => {
                                    if (res.data.success) {
                                        postCard.remove();
                                        Swal.fire('Deleted!', res.data.message,
                                            'success');
                                    } else {
                                        Swal.fire('Error!', res.data.message, 'error');
                                    }
                                })
                                .catch(err => {
                                    Swal.fire('Error!', 'Something went wrong.',
                                        'error');
                                });
                        }
                    });
                });
            });

        });
    </script>

    {{-- adding drop zone --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // ===== Dropzone =====
            const dropzone = document.getElementById('media-dropzone');
            const fileInput = dropzone.querySelector('input[type="file"]');
            let droppedFiles = [];

            // Open file selector on click
            dropzone.addEventListener('click', () => fileInput.click());

            // Handle files selected from input
            fileInput.addEventListener('change', e => handleFiles(e.target.files));

            // Handle drag & drop
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

            // Add files without duplicates
            function handleFiles(files) {
                Array.from(files).forEach(file => {
                    // Prevent duplicates
                    if (!droppedFiles.some(f => f.name === file.name && f.size === file.size)) {
                        droppedFiles.push(file);
                        const p = document.createElement('p');
                        p.textContent = file.name;
                        dropzone.appendChild(p);
                    }
                });
            }

            // ===== SDG Tags Toggle =====
            document.querySelectorAll('.sdg-badge-wrapper').forEach(wrapper => {
                wrapper.addEventListener('click', function() {
                    const checkbox = this.querySelector('.sdg-checkbox');
                    checkbox.checked = !checkbox.checked;
                    this.classList.toggle('selected', checkbox.checked);
                });
            });

            // ===== Form Submission =====
            const form = document.querySelector('#update-form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);

                // Remove the original file input entries (so we don't send duplicates)
                formData.delete('media[]');

                // Append only droppedFiles
                droppedFiles.forEach(file => formData.append('media[]', file));

                // Append selected SDG tags manually (optional, if not already in formData)
                document.querySelectorAll('input[name="tags[]"]:checked').forEach(cb => {
                    formData.append('tags[]', cb.value);
                });

                axios.post(form.action, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(res => {
                        Swal.fire('Success', 'Post uploaded successfully', 'success').then(() => {
                            location.reload();
                        });

                        // Reset
                        droppedFiles = [];
                        dropzone.querySelectorAll('p').forEach(p => p.remove());
                        form.reset();
                    })
                    .catch(err => {
                        let message = err.response?.data?.message || 'Something went wrong';
                        Swal.fire('Error', message, 'error');
                    });
            });

        });
    </script>

{{-- Edit Post Population --}}

<script>
document.addEventListener('DOMContentLoaded', () => {
    const editModalEl = document.getElementById('editPostModal');
    const editModal = new bootstrap.Modal(editModalEl);

    const mediaContainer = document.getElementById('existing-media');
    const mediaInput = document.getElementById('edit-media-input'); // <input type="file" multiple>

    // -------------------------------
    // Clear media previews
    // -------------------------------
    const clearMediaPreviews = () => mediaContainer.innerHTML = '';

    // -------------------------------
    // Show previews from existing media (from backend)
    // -------------------------------
    const showExistingMedia = (mediaArray) => {
        clearMediaPreviews();
        if (!Array.isArray(mediaArray)) return;

        mediaArray.forEach(file => {
            let previewHtml = '';
            const fileUrl = file.file_path.startsWith('http') ? file.file_path : `/storage/${file.file_path}`;

            if (file.file_type === 'image') {
                previewHtml = `<img src="${fileUrl}" class="rounded border me-2 mb-2" style="width:80px;height:80px;object-fit:cover;">`;
            } else if (file.file_type === 'video') {
                previewHtml = `<video width="100" height="80" class="rounded border me-2 mb-2" controls>
                                    <source src="${fileUrl}">
                               </video>`;
            } else {
                previewHtml = `<a href="${fileUrl}" target="_blank" class="btn btn-sm btn-outline-primary me-2 mb-2">${file.file_name}</a>`;
            }

            mediaContainer.innerHTML += previewHtml;
        });
    };

    // -------------------------------
    // Show previews for newly selected files
    // -------------------------------
    if (mediaInput) {
        mediaInput.addEventListener('change', () => {
            const files = Array.from(mediaInput.files);
            clearMediaPreviews();

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.classList.add('rounded', 'border', 'me-2', 'mb-2');
                    preview.style.width = '80px';
                    preview.style.height = '80px';
                    preview.style.objectFit = 'cover';
                    mediaContainer.appendChild(preview);
                };
                reader.readAsDataURL(file);
            });
        });
    }

    // -------------------------------
    // Populate edit modal
    // -------------------------------
    const populateModal = async (postId) => {
        try {
            const response = await fetch(`/admin/updates/${postId}/json`);
            const contentType = response.headers.get('content-type');

            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Server did not return JSON');
            }

            const post = await response.json();

            // Basic fields
            document.getElementById('edit-post-id').value = post.id;
            document.getElementById('edit-title').value = post.title;
            document.getElementById('edit-description').value = post.description ?? '';

            // SDG Target Indicators
            document.getElementById('edit-sdg-target-indicators').value = 
                Array.isArray(post.sdg_target_indicators) ? post.sdg_target_indicators.join(',') : '';

            // SDG Tags
            document.querySelectorAll('.sdg-checkbox').forEach(cb => cb.checked = false);
            if (Array.isArray(post.tags)) {
                post.tags.forEach(tag => {
                    const cb = document.getElementById(`edit-sdg-${tag}`);
                    if (cb) cb.checked = true;
                });
            }

            // Existing media
            showExistingMedia(post.media);

            // Clear file input on open (so selecting new files will replace previews)
            if (mediaInput) mediaInput.value = '';

            // Show modal
            editModal.show();

        } catch (err) {
            console.error('Failed to fetch post data:', err);
            Swal.fire({
                icon: 'error',
                title: 'Unable to Load Post',
                text: 'There was an error loading the post data.',
                confirmButtonColor: '#3085d6'
            });
        }
    };

    // -------------------------------
    // Bind edit buttons
    // -------------------------------
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', () => {
            const postId = btn.closest('.post-card').dataset.id;
            populateModal(postId);
        });
    });
});
</script>




    {{-- delete media --}}
    <script>
        document.addEventListener('click', async function(e) {
            if (e.target.classList.contains('delete-media-btn')) {

                const mediaId = e.target.dataset.mediaId;

                const confirm = await Swal.fire({
                    icon: 'warning',
                    title: "Delete media?",
                    text: "This file will be permanently removed.",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                });

                if (!confirm.isConfirmed) return;

                const response = await fetch(`/admin/media/${mediaId}/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    e.target.parentElement.remove(); // Remove preview from modal
                } else {
                    Swal.fire("Error", "Failed to delete media.", "error");
                }
            }
        });
    </script>

    {{-- swal for delete media --}}
    <script>
        document.addEventListener('click', async function(e) {
            if (e.target.classList.contains('delete-media-btn')) {
                const mediaId = e.target.dataset.mediaId;

                const confirm = await Swal.fire({
                    icon: 'warning',
                    title: "Delete media?",
                    text: "This file will be permanently removed.",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                });

                if (!confirm.isConfirmed) return;

                const response = await fetch(`/admin/media/${mediaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (response.ok) {
                    e.target.parentElement.remove(); // Remove preview from modal
                    Swal.fire("Deleted!", "Media has been removed.", "success");
                } else {
                    Swal.fire("Error", "Failed to delete media.", "error");
                }
            }
        });
    </script>
@endpush
