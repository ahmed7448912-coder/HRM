<div class="mb-3">
    <label>Employee</label>
    <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
        @foreach($employees as $id => $name)
        <option value="{{ $id }}"
            {{ old('employee_id', $leave->employee_id ?? '') == $id ? 'selected' : '' }}>
            {{ $name }}
        </option>
        @endforeach
    </select>
    @error('employee_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Type</label>
    <input type="text" name="type"
        value="{{ old('type', $leave->type ?? '') }}"
        class="form-control @error('type') is-invalid @enderror">
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>From Date</label>
    <input type="date" name="from_date"
        value="{{ old('from_date', $leave->from_date ?? '') }}"
        class="form-control @error('from_date') is-invalid @enderror">
    @error('from_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>To Date</label>
    <input type="date" name="to_date"
        value="{{ old('to_date', $leave->to_date ?? '') }}"
        class="form-control @error('to_date') is-invalid @enderror">
    @error('to_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Reason</label>
    <textarea name="reason" class="form-control @error('reason') is-invalid @enderror">{{ old('reason', $leave->reason ?? '') }}</textarea>
    @error('reason')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>