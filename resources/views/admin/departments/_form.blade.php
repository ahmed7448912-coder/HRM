<div class="card-body">
    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Department Name') }}</label>
        <input type="text" name="name" id="name"
            value="{{ old('name', $department->name ?? '') }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="{{ __('Enter department name') }}">

        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="code" class="form-label">{{ __('Department Code') }}</label>
        <input type="text" name="code" id="code"
            value="{{ old('code', $department->code ?? '') }}"
            class="form-control @error('code') is-invalid @enderror"
            placeholder="{{ __('e.g. HR, ENG, MKT') }}">

        @error('code')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">{{ __('Description') }}</label>
        <textarea name="description" id="description" rows="3"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="{{ __('Brief description of the department') }}">{{ old('description', $department->description ?? '') }}</textarea>

        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>