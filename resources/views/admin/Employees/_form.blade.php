<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">{{ __('Profile Image') }} <small class="text-muted">(Optional)</small></label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
            <small class="form-text text-muted">Allowed formats: JPG, JPEG, PNG. Max size: 2MB.</small>
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @if(isset($employee) && $employee->image)
                <div class="mt-2">
                    <label class="form-label d-block text-muted" style="font-size: 0.8rem;">Current Image</label>
                    <img src="{{ asset('storage/' . $employee->image) }}" class="img-thumbnail rounded shadow-sm" width="80" height="80" style="object-fit: cover;" alt="Current Image">
                </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name"
                value="{{ old('name', $employee->name ?? '') }}"
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">{{ __('Email') }}</label>
            <input type="email" name="email"
                value="{{ old('email', $employee->email ?? '') }}"
                class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">{{ __('Phone') }}</label>
            <input type="text" name="phone"
                value="{{ old('phone', $employee->phone ?? '') }}"
                class="form-control @error('phone') is-invalid @enderror">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">{{ __('Department') }}</label>
            <select name="department_id" class="form-select @error('department_id') is-invalid @enderror">
                <option value="">{{ __('Select Department') }}</option>
                @foreach($departments as $id => $name)
                    <option value="{{ $id }}"
                        {{ old('department_id', $employee->department_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">{{ __('Salary') }}</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" step="0.01" name="salary"
                    value="{{ old('salary', $employee->salary ?? '') }}"
                    class="form-control @error('salary') is-invalid @enderror">
                @error('salary')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">{{ __('Joining Date') }}</label>
            <input type="date" name="joining_date"
                value="{{ old('joining_date', $employee->joining_date ?? '') }}"
                class="form-control @error('joining_date') is-invalid @enderror">
            @error('joining_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Address') }}</label>
    <textarea name="address" rows="3"
        class="form-control @error('address') is-invalid @enderror">{{ old('address', $employee->address ?? '') }}</textarea>
    @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>