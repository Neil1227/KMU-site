@extends('layouts.admin')

@section('title', 'Account Settings')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">

@endpush

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">

        {{-- Show ONLY for KMU --}}
        @if (session('admin_role') === 'KMU')
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">User Accounts</h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $users->count() }} total</span>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createAccountModal">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="usersTable" class="display table table-bordered table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->user }}</td>
                            <td>
                                <span
                                    class="badge {{ $user->role === 'KMU' ? 'bg-orange' : ($user->role === 'IPTBM' ? 'bg-navy' : 'bg-success') }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d h:i A') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <button type="button" class="btn btn-sm btn-success edit-user-btn"
                                        data-bs-toggle="modal" data-bs-target="#editAccountModal"
                                        data-id="{{ $user->id }}" data-user="{{ $user->user }}"
                                        data-role="{{ $user->role }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ route('admin.account.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- Show ONLY for IPTBM and TBI --}}
        @if (session('admin_role') === 'IPTBM' || session('admin_role') === 'TBI')
        <!-- Change Existing Account -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <strong ><i class="fa-solid fa-user-gear me-2"></i>Change Account</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.account.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">What would you like to update?</label>
                            <select name="update_option" class="form-select @error('update_option') is-invalid @enderror" id="updateOption" required>
                                <option value="" disabled>Select an option</option>
                                <option value="username" {{ old('update_option') == 'username' ? 'selected' : '' }}>Username Only</option>
                                <option value="password" {{ old('update_option') == 'password' ? 'selected' : '' }}>Password Only</option>
                                <option value="both" {{ old('update_option') == 'both' ? 'selected' : '' }}>Username & Password</option>
                                @if(session('admin_role') === 'KMU')
                                <option value="role" {{ old('update_option') == 'role' ? 'selected' : '' }}>Role Only</option>
                                @endif
                            </select>
                            @error('update_option')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Username</label>

                            <input
                                type="text"
                                name="user"
                                class="form-control"
                                value="{{ session('admin_user') }}"
                                @if(session('admin_role') !=='KMU' ) disabled @endif>

                            <small class="text-secondary d-block">Currently logged in as: <strong>{{ session('admin_user') }}</strong></small>
                        </div>

                        <div class="mb-3 update-username d-none">
                            <label class="form-label">New Username</label>
                            <input type="text" name="new_user" class="form-control @error('new_user') is-invalid @enderror" placeholder="Enter new username" value="{{ old('new_user') }}">
                            @error('new_user')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 update-role d-none">
                            <label class="form-label">Select New Role</label>
                            <select name="new_role" class="form-select @error('new_role') is-invalid @enderror">
                                <option value="" disabled>Select role</option>
                                <option value="KMU" {{ old('new_role') == 'KMU' ? 'selected' : '' }}>KMU (Super Admin)</option>
                                <option value="IPTBM" {{ old('new_role') == 'IPTBM' ? 'selected' : '' }}>IPTBM</option>
                                <option value="TBI" {{ old('new_role') == 'TBI' ? 'selected' : '' }}>TBI</option>
                            </select>
                            @error('new_role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 update-password d-none">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 update-password d-none">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror">
                            @error('new_password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-user-gear me-1"></i> Update
                            </button>
                        </div>
                    </form>

                    {{-- Toggle Fields --}}
                    <script>
                        function toggleFields(option) {
                            const usernameFields = document.querySelectorAll('.update-username');
                            const passwordFields = document.querySelectorAll('.update-password');
                            const roleFields = document.querySelectorAll('.update-role');

                            usernameFields.forEach(el => el.classList.add('d-none'));
                            passwordFields.forEach(el => el.classList.add('d-none'));
                            roleFields.forEach(el => el.classList.add('d-none'));

                            if (option === 'username') usernameFields.forEach(el => el.classList.remove('d-none'));
                            else if (option === 'password') passwordFields.forEach(el => el.classList.remove('d-none'));
                            else if (option === 'both') {
                                usernameFields.forEach(el => el.classList.remove('d-none'));
                                passwordFields.forEach(el => el.classList.remove('d-none'));
                            } else if (option === 'role') roleFields.forEach(el => el.classList.remove('d-none'));
                        }

                        const updateSelect = document.getElementById('updateOption');
                        updateSelect.addEventListener('change', function() {
                            toggleFields(this.value);
                        });

                        // Auto-show section after validation errors
                        document.addEventListener('DOMContentLoaded', function() {
                            const selectedOption = updateSelect.value;
                            if (selectedOption) toggleFields(selectedOption);
                        });
                    </script>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
<!-- ----------------------------------------------------------------------------------------------------------------- -->

<!-- Create Account Modal -->
<div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="createAccountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="moda  text-whitel-title" id="createAccountModalLabel">
                    <i class="fa-solid fa-user-plus me-2"></i>Create New Account
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.account.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="user" class="form-control @error('user') is-invalid @enderror"
                            placeholder="Enter username" value="{{ old('user') }}" required>
                        @error('user')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Enter password"
                            required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Re-enter password" required>
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(session('admin_role') === 'KMU')
                    <div class="mb-3">
                        <label class="form-label">Assign Role</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="" disabled selected>Select role</option>
                            <option value="KMU">KMU (Super Admin)</option>
                            <option value="RESEARCH">Research</option>
                            <option value="IPTBM">IPTBM</option>
                            <option value="TBI">TBI</option>
                            <option value="EXTENSION">Extension</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-user-check me-1"></i> Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Account Modal -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-sm">

            <!-- Header -->
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title  text-white" id="editAccountModalLabel">
                    <i class="fa-solid fa-user-gear me-2"></i> Change Account
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form action="{{ route('admin.account.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Update Option --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">What would you like to update?</label>
                        <select name="update_option" id="updateOption"
                            class="form-select @error('update_option') is-invalid @enderror" required>
                            <option value="" disabled selected>Select an option</option>
                            <option value="username" {{ old('update_option') == 'username' ? 'selected' : '' }}>Username Only</option>
                            <option value="password" {{ old('update_option') == 'password' ? 'selected' : '' }}>Password Only</option>
                            <option value="both" {{ old('update_option') == 'both' ? 'selected' : '' }}>Username & Password</option>

                            {{-- Role update visible only to KMU --}}
                            @if(session('admin_role') === 'KMU')
                            <option value="role" {{ old('update_option') == 'role' ? 'selected' : '' }}>Role Only</option>
                            @endif
                        </select>
                        @error('update_option')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Current Username --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Username</label>
                        <input
                            type="text"
                            name="user"
                            class="form-control"
                            value="{{ session('admin_user') }}"
                            @if(session('admin_role') !=='KMU' ) disabled @endif>
                        <small class="text-secondary d-block mt-1">
                            Currently logged in as: <strong>{{ session('admin_user') }}</strong>
                        </small>
                    </div>

                    {{-- New Username (hidden until selected) --}}
                    <div class="mb-3 update-username d-none">
                        <label class="form-label fw-semibold">New Username</label>
                        <input
                            type="text"
                            name="new_user"
                            class="form-control @error('new_user') is-invalid @enderror"
                            placeholder="Enter new username"
                            value="{{ old('new_user') }}">
                        @error('new_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- New Role (KMU only) --}}
                    <div class="mb-3 update-role d-none">
                        <label class="form-label fw-semibold">Select New Role</label>
                        <select name="new_role" class="form-select @error('new_role') is-invalid @enderror">
                            <option value="" disabled selected>Select role</option>
                            <option value="KMU" {{ old('new_role') == 'KMU' ? 'selected' : '' }}>KMU (Super Admin)</option>
                            <option value="RESEARCH" {{ old('new_role') == 'RESEARCH' ? 'selected' : '' }}>Research</option>
                            <option value="IPTBM" {{ old('new_role') == 'IPTBM' ? 'selected' : '' }}>IPTBM</option>
                            <option value="TBI" {{ old('new_role') == 'TBI' ? 'selected' : '' }}>TBI</option>
                            <option value="EXTENSION" {{ old('new_role') == 'EXTENSION' ? 'selected' : '' }}>Extension</option>
                        </select>
                        @error('new_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Current Password --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Current Password</label>
                        <input
                            type="password"
                            name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            required>
                        @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- New Password + Confirm --}}
                    <div class="mb-3 update-password d-none">
                        <label class="form-label fw-semibold">New Password</label>
                        <input
                            type="password"
                            name="new_password"
                            class="form-control @error('new_password') is-invalid @enderror">
                        @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 update-password d-none">
                        <label class="form-label fw-semibold">Confirm New Password</label>
                        <input
                            type="password"
                            name="new_password_confirmation"
                            class="form-control @error('new_password_confirmation') is-invalid @enderror">
                        @error('new_password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa-solid fa-user-gear me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- {{-- Toast Notifications --}} -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    @if(session('success'))
    <div class="toast align-items-center text-bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @elseif(session('error'))
    <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">{{ session('error') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- {{-- Toggle Fields Script --}} -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateSelect = document.getElementById('updateOption');
        const usernameFields = document.querySelectorAll('.update-username');
        const passwordFields = document.querySelectorAll('.update-password');
        const roleFields = document.querySelectorAll('.update-role');

        function toggleFields(option) {
            usernameFields.forEach(el => el.classList.add('d-none'));
            passwordFields.forEach(el => el.classList.add('d-none'));
            roleFields.forEach(el => el.classList.add('d-none'));

            if (option === 'username') usernameFields.forEach(el => el.classList.remove('d-none'));
            else if (option === 'password') passwordFields.forEach(el => el.classList.remove('d-none'));
            else if (option === 'both') {
                usernameFields.forEach(el => el.classList.remove('d-none'));
                passwordFields.forEach(el => el.classList.remove('d-none'));
            } else if (option === 'role') roleFields.forEach(el => el.classList.remove('d-none'));
        }

        updateSelect.addEventListener('change', () => toggleFields(updateSelect.value));

        // Auto-show fields if validation failed and user returned
        if (updateSelect.value) toggleFields(updateSelect.value);
    });
</script>
<!-- table config -->
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthChange: true,
            lengthMenu: [5, 10, 20],
            autoWidth: false,
            order: [
                [0, 'asc']
            ]
        });
    });
</script>

<script>
    @if(session('success'))
    Swal.fire({
        toast: true,
        icon: 'success',
        title: "{{ session('success') }}",
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
    @elseif(session('error'))
    Swal.fire({
        toast: true,
        icon: 'error',
        title: "{{ session('error') }}",
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
    @endif
</script>
@endpush