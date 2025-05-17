<!-- experience_entry.blade.php -->
<div class="row mb-3 experience-entry">
    <div class="col-md-2">
        <label class="form-label">From Year</label>
        <select class="form-select" name="exp_from_year[]" required>
            @foreach(range(date('Y'), 1900) as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label">To Year</label>
        <select class="form-select" name="exp_to_year[]" required>
            @foreach(range(date('Y'), 1900) as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Company</label>
        <input type="text" class="form-control" name="exp_company[]" placeholder="Company Name" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Position</label>
        <input type="text" class="form-control" name="exp_position[]" placeholder="Position Title" required>
    </div>
    <div class="col-md-2 mt-4">
        <button type="button" class="btn btn-outline-danger btn-sm remove-entry mr-2 "><i class="fas fa-trash"></i></button>
        <button type="button" class="btn btn-outline-primary btn-sm " id="add-experience"><i class="fas fa-plus"></i></button>
    </div>

</div>
