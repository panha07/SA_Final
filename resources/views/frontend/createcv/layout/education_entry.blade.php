<!-- education_entry.blade.php -->
<div class="row mb-3 education-entry">
    <div class="col-md-2">
        <label class="form-label">From Year</label>
        <select class="form-select" name="edu_from_year[]" >
            @foreach(range(date('Y'), 1900) as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <label class="form-label">To Year</label>
        <select class="form-select" name="edu_to_year[]" >
            @foreach(range(date('Y'), 1900) as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">School</label>
        <input type="text" class="form-control @error('edu_school.*') is-invalid @enderror" name="edu_school[]" placeholder="School Name" required>
        @error('edu_school.*')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="col-md-3">
        <label class="form-label">Degree</label>
        <input type="text" class="form-control  @error('edu_degree.*') is-invalid @enderror" name="edu_degree[]" placeholder="Degree Name" required>
        @error('edu_degree.*')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="col-md-2 mt-4">
        <button type="button" class="btn btn-outline-danger btn-sm remove-entry mr-2"><i class="fas fa-trash"></i></button>
        <button type="button" class="btn btn-outline-primary btn-sm " id="add-education"><i class="fas fa-plus"></i></button>
    </div>
   
</div>
