<div class="mb-3">
    <label class="form-label">{{ __('Employee') }}</label>
    <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror">
        <option value="">{{ __('Select Employee') }}</option>
        @foreach($employees as $id => $name)
            <option value="{{ $id }}"
                {{ old('employee_id', $attendance->employee_id ?? '') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
    @error('employee_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">{{ __('Date') }}</label>
    <input type="date" name="date"
        value="{{ old('date', $attendance->date ?? date('Y-m-d')) }}"
        class="form-control @error('date') is-invalid @enderror">
    @error('date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">{{ __('Check In') }}</label>
            <input type="time" name="check_in"
                value="{{ old('check_in', $attendance->check_in ?? '') }}"
                class="form-control @error('check_in') is-invalid @enderror">
            @error('check_in')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">{{ __('Check Out') }}</label>
            <input type="time" name="check_out"
                value="{{ old('check_out', $attendance->check_out ?? '') }}"
                class="form-control @error('check_out') is-invalid @enderror">
            @error('check_out')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
