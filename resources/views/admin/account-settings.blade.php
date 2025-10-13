@extends('layouts.admin')

@section('title', 'Account Settings')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <!-- Create New Account -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <strong><i class="fa-solid fa-user-plus me-2"></i>Create New Account</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.account.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="user" 
                                   class="form-control @error('user') is-invalid @enderror" 
                                   placeholder="Enter username" 
                                   value="{{ old('user') }}" required>
                            @error('user')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Enter password" required>
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
                                <option value="KMU" {{ old('role') == 'KMU' ? 'selected' : '' }}>KMU (Super Admin)</option>
                                <option value="IPTBM" {{ old('role') == 'IPTBM' ? 'selected' : '' }}>IPTBM</option>
                                <option value="TBI" {{ old('role') == 'TBI' ? 'selected' : '' }}>TBI</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-user-check me-1"></i> Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Change Existing Account -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <strong><i class="fa-solid fa-user-gear me-2"></i>Change Account</strong>
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
                            <input type="text" name="user" class="form-control" value="{{ session('admin_user') }}" disabled>
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
    </div>
</div>

{{-- Toast Notifications --}}
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
