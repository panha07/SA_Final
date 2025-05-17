<div class="row mb-3 skill-entry">
    <div class="col-md-4 mb-3">
        <label for="skills" class="form-label">Skills</label>
        <input type="text" class="form-control" id="skills" name="skills[]"
            placeholder="Example: Skill 1, Skill 2, Skill 3">
    </div>
    <div class="col-md-4 mb-3">
        <label for="languages" class="form-label">Level</label>
        <select name="level[]" id="" class="form-select">
            <option value="1">Beginner</option>
            <option value="2">Intermediate</option>
            <option value="3">Advanced</option>
            <option value="4">Expert</option>
            <option value="5">Mother Tongue</option>
        </select>
    </div>
    <div class="col-md-2 mt-4">
        <button type="button" class="btn btn-outline-danger btn-sm remove-entry mr-2"><i class="fas fa-trash"></i></button>
        <button type="button" class="btn btn-outline-primary btn-sm " id="add-skill"><i class="fas fa-plus"></i></button>
    </div>
</div>
