@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
            <h4 class="mb-0 text-muted">Edit Role</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-2 text-md-start">
                        <label class="form-label text-muted mb-0">Name</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control" placeholder="Enter role name">
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Guard Name Field -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-2 text-md-start">
                        <label class="form-label text-muted mb-0">Guard Name</label>
                    </div>
                    <div class="col-md-10">
                        <select name="guard_name" class="form-select">
                            <option value="web" {{ old('guard_name', $role->guard_name) == 'web' ? 'selected' : '' }}>web</option>
                            <option value="api" {{ old('guard_name', $role->guard_name) == 'api' ? 'selected' : '' }}>api</option>
                        </select>
                        @error('guard_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Permissions Section -->
                <div class="row mb-4">
                    <div class="col-md-2 text-md-start pt-2">
                        <label class="form-label text-muted mb-0">Permissions</label>
                    </div>
                    <div class="col-md-10">
                        <!-- Select Buttons -->
                        <div class="mb-4">
                            <button type="button" class="btn btn-light border btn-sm px-3 py-2 me-2" id="selectAll">
                                <strong>Select all</strong>
                            </button>
                            <button type="button" class="btn btn-light border btn-sm px-3 py-2" id="deselectAll">
                                <strong>Do not select any</strong>
                            </button>
                        </div>

                        <!-- Permissions Grid -->
                        <div class="row">
                            @foreach($permissions as $groupName => $groupPermissions)
                                <div class="col-md-4 mb-4">
                                    <h6 class="fw-bold text-dark text-capitalize mb-3">{{ $groupName }}</h6>
                                    @foreach($groupPermissions as $permission)
                                        <div class="form-check mb-2">
                                            <input type="checkbox"
                                                name="permissions[]"
                                                value="{{ $permission->name }}"
                                                class="form-check-input permission-checkbox shadow-sm"
                                                id="perm_{{ str_replace('.', '_', $permission->name) }}"
                                                {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                            <label class="form-check-label text-secondary" for="perm_{{ str_replace('.', '_', $permission->name) }}">
                                                {{ explode('.', $permission->name)[1] ?? $permission->name }} {{ $groupName }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllBtn = document.getElementById('selectAll');
        const deselectAllBtn = document.getElementById('deselectAll');
        const checkboxes = document.querySelectorAll('.permission-checkbox');

        if (selectAllBtn) {
            selectAllBtn.addEventListener('click', function () {
                checkboxes.forEach(cb => cb.checked = true);
            });
        }

        if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', function () {
                checkboxes.forEach(cb => cb.checked = false);
            });
        }
    });
</script>
@endpush
@endsection