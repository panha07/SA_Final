@extends('backend.layout.master')


@section('backend_content')
    <div class="container bg-white mb-4 p-4 rounded shadow-sm">
        @include('components.component')
        <h4 class="fw-bold text-primary mb-4">Post a Job</h4>

        <form id ="jobForm" action="{{ route('store_job') }}" method="POST">
            @csrf

            <!-- Job Details -->
            <div class="mb-3 row bg-red p-2 rounded">
                <p class="mb-4 text-white font-bold bg-primary p-2">Job Description</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="job_title" class="form-label">Job Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="job_title" name="job_title"
                        value="{{ old('job_title') }}">
                    @error('job_title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="publishDate" class="form-label">Publish Date <span style="color: red;">*</span></label>
                    <input type="date" class="form-control" id="publishDate" name="posted_at"
                        value="{{ old('posted_at', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
                    @error('posted_at')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-8 mt-4">
                <label for="positionNature" class="form-label">Position Nature: <span style="color: red;">*</span></label>
                <div class="d-flex flex-wrap">
                    @foreach ($jobType as $type)
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="job_type" id="{{ $type }}"
                                value="{{ $type->id }}" {{ old('job_type', 1) == $type->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $type }}">{{ ucfirst($type->name) }}</label>
                        </div>
                    @endforeach
                </div>
                @error('job_type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Job Categories & Work Place -->

            {{-- <div class="col-md-4 mt-4">
                <label for="jobCategory" class="form-label">Job Categories: <span style="color: red;">*</span></label>
                <select class="form-select" id="jobCategory" name="job_categories">

                    @foreach ($jobCategory as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="col-md-4 mt-4">
                <label for="jobCategory" class="form-label">Job Categories: <span style="color: red;">*</span></label>
                <select class="form-select" id="jobCategory" name="job_categories" multiple style="width:75%;">
                    @foreach ($jobCategory as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>



            <div id="workPlaceContainer" class="mb-3 row mt-4">
                {{-- <div class="col-md-3">
                    <label for="province" class="form-label">Province:<span style="color: red;">*</span></label>
                    <select class="form-select" id="province-dropdown" name="province[]">
                        <option value="">Please select</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" 
                                {{ old('province') == $province->id ? 'selected' : '' }}>
                                {{ $province->province }}
                            </option>
                        @endforeach
                    </select>
                    @error('province')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

                {{-- <div class="col-md-3">
                    <label for="district" class="form-label">District:<span style="color: red;">*</span></label>
                    <select class="form-select" id="district-dropdown" name="district[]">
                        <option value="">Please select</option>
                    </select>
                    @error('district')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}
                {{-- <div class="col-md-3">
                    <label for="detail" class="form-label">Detail:</label>
                    <input type="text" class="form-control" id="detail" name="details" value="{{ old('details') }}">
                    @error('detail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

            </div>
            <div class="mb-3 row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-outline-secondary" onclick="addWorkPlace()">Add Work
                        Place</button>
                </div>
            </div>
            <!-- Hiring Quantity -->
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="hiring_num" class="form-label">Number of Hires <span style="color: red;">*</span></label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="decrement('hiring_num')">-</button>
                        <input type="number" class="form-control text-center" id="hiring_num" name="hiring_num"
                            value="{{ old('hiring_num', 1) }}">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="increment('hiring_num')">+</button>
                    </div>
                    @error('hiring_num')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-6 mb-3">
                <label for="salary_range" class="form-label">Monthly Salary: <span style="color: red;">*</span></label>
                <select class="form-select" id="salary_range" name="salary_range">

                    @foreach ($salary as $salary)
                        <option value="{{ $salary->id }}" {{ old('salary_range') == $salary->id ? 'selected' : '' }}>
                            {{ $salary->id == 7 ? 'Negotiable' : $salary->salary_rank }}
                        </option>
                    @endforeach
                </select>
                @error('salary_range')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Job Description -->
            <div class="mb-3 mt-5">
                <label for="jobDescription" class="form-label">Job Description:</label>
                <textarea class="form-control" id="jobDescription" rows="5" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3 row bg-red p-2 rounded">
                <p class="mb-4 text-white font-bold bg-primary p-2">Job Requirement</p>
            </div>
            <!-- Job Requirements -->

            <div class="col-md-3 mt-4">
                <label for="level" class="form-label">Level:<span style="color: red;">*</span></label>
                <select class="form-select" id="level" name="level">
                    <option value="">Please select</option>
                    @foreach ($level as $item)
                        <option value="{{ $item->id }}" {{ old('level') == $item->id ? 'selected' : '' }}>
                            {{ $item->level }}</option>
                    @endforeach
                </select>
                @error('level')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 row mt-4">
                <div class="col-md-4 ">
                    <label for="educationRequirements" class="form-label">Education Requirements:</span></label>
                    <select class="form-select" id="educationRequirements" name="education">

                        @foreach ($educations as $item)
                            <option value="{{ $item->id }}">{{ $item->education }}</option>
                        @endforeach
                    </select>
                    @error('education')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="fieldOfStudy" class="form-label">Field of Study:</label>
                    <input type="text" class="form-control" id="fieldOfStudy" placeholder="Enter your field of study"
                        name="studyfield">
                    @error('studyfield')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2 mb-3">
                <label for="yearOfExperience" class="form-label">Years of Experience <span
                        style="color: red;">*</span></label>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="decrement('yearOfExperience')">-</button>
                    <input type="number" class="form-control text-center" id="yearOfExperience" name="experience"
                        value="{{ old('experience', 0) }}">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="increment('yearOfExperience')">+</button>
                </div>
                @error('experience')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div id="languageSkillContainer">
                <div class="mb-3 row mt-4">
                    <div class="col-md-4">
                        <label for="language" class="form-label">Language:</label>
                        <select class="form-select" id="language" name="lang[]">

                            @foreach ($language as $item)
                                <option value="{{ $item->id }}">{{ $item->lang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="skillLevel" class="form-label">Skill Level: <span
                                style="color: red;">*</span></label>
                        <select class="form-select" id="skillLevel" name="Lang_skill[]">

                            @foreach ($language_skill as $item)
                                <option value="{{ $item->id }}">{{ $item->skill }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-secondary" onclick="addLanguageSkill()">+</button>
                    </div>
                </div>
            </div>

            <!-- Gender, Age, and Marital Status -->
            <div class="mb-3 row mt-4">
                <div class="col-md-4">
                    <label for="gender" class="form-label">Gender:<span style="color: red;">*</span></label>
                    <select class="form-select" id="gender" name="gender">
                        @foreach ($gender as $item)
                            <option value="{{ $item->id }}" {{ old('gender') == $item->id ? 'selected' : '' }}>
                                {{ $item->gender }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="startAge" class="form-label">Start Age:<span style="color: red;">*</span></label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="decrement('startAge')">-</button>
                        <input type="number" class="form-control text-center" id="startAge" name="startAge"
                            value="{{ old('startAge', 18) }}">
                        <button type="button" class="btn btn-outline-secondary"
                            onclick="increment('startAge')">+</button>
                    </div>
                    @error('startAge')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-2">
                    <label for="endAge" class="form-label">End Age:<span style="color: red;">*</span></label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" onclick="decrement('endAge')">-</button>
                        <input type="number" class="form-control text-center" id="endAge" name="endAge"
                            value="{{ old('endAge', 40) }}">
                        <button type="button" class="btn btn-outline-secondary" onclick="increment('endAge')">+</button>
                    </div>
                    @error('endAge')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Job Requirements Description -->
            <div class="mb-3 mt-5">
                <label for="jobRequirementsDescription" class="form-label">Job Requirements:</label>
                <textarea class="form-control" id="jobRequirementsDescription" rows="5" name="requirements">{{ old('requirements') }}
                </textarea>
            </div>

            <hr>
            <div class="mb-3 row mt-4">
                <div class="col-md-4">
                    <label for="employer" class="form-label">Contact Person:<span style="color: red;">*</span></label>
                    <select class="form-select" id="employer" name="employer" onchange="updateContactInfo()">
                        <option value="">Please select</option>
                        @foreach ($employers as $employer)
                            <option value="{{ $employer->employer_id }}" data-phone="{{ $employer->phone }}"
                                data-email="{{ $employer->email }}">{{ $employer->user_name }}</option>
                        @endforeach
                    </select>
                    @error('employer')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" readonly>
                </div>

                <div class="col-md-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" readonly>
                </div>
                <div class="col-md-2 mt-4">
                    <button type="button" class="btn btn-secondary text-white"
                        onclick="window.location='{{ route('contactPerson') }}'">Edit</button>
                </div>
            </div>


            <!-- Address and Submission -->
            <div class="mb-3">
                <label for="address" class="form-label">Website</label>
                <input type="text" class="form-control" id="address" value="{{ $employer->company_webiste }}"
                    disabled>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" id="address" value="{{ $employer->company_address }}"
                    disabled>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('job') }}" class="btn btn-secondary text-white">Back</a>
                <div class="d-flex justify-content-end ">
                    {{-- <button type="submit" class="btn btn-outline me-2 ">Save Draft</button>
                    <button type="submit" class="btn btn-primary me-2 ">Job Preview</button> --}}
                    <button type="submit" class="btn btn-secondary" onclick="document.getElementById('status').value = 'draft';">
                        Save Draft
                    </button>
                    <button type="submit" class="btn btn-primary ">Post Job</button>
                </div>
            </div>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        function increment(fieldId) {
            var input = document.getElementById(fieldId);
            input.value = parseInt(input.value) + 1;
        }

        function decrement(fieldId) {
            var input = document.getElementById(fieldId);
            if (input.value > 0) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function addLanguageSkill() {
            var container = document.getElementById('languageSkillContainer');
            var newInputGroup = document.createElement('div');
            newInputGroup.className = 'row mb-3';
            newInputGroup.innerHTML = `
            <div class="col-md-4">
                <label for="language" class="form-label">Language:</label>
                <select class="form-select" name="lang[]">
                    <option value="">Please select</option>
                    @foreach ($language as $item)
                        <option value="{{ $item->id }}">{{ $item->lang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="skillLevel" class="form-label">Skill Level: <span style="color: red;">*</span></label>
                <select class="form-select" name="Lang_skill[]">
                    <option value="">Please select</option>
                    @foreach ($language_skill as $item)
                        <option value="{{ $item->id }}">{{ $item->skill }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-outline-secondary" onclick="removeLanguageSkill(this)">-</button>
                <button type="button" class="btn btn-outline-secondary" onclick="addLanguageSkill(this)">+</button>
            </div>
        `;
            container.appendChild(newInputGroup);
        }

        function removeLanguageSkill(button) {
            var container = document.getElementById('languageSkillContainer');
            container.removeChild(button.parentElement.parentElement);
        }

        function updateContactInfo() {
            var employerSelect = document.getElementById('employer');
            var selectedOption = employerSelect.options[employerSelect.selectedIndex];
            var phone = selectedOption.getAttribute('data-phone');
            var email = selectedOption.getAttribute('data-email');

            document.getElementById('phone').value = phone;
            document.getElementById('email').value = email;
        }
    </script>
    {{-- <scrip>
        function addWorkPlace() {
            var workPlaceContainer = $('#workPlaceContainer');
            var newWorkPlace = `
            <div class="work-place-group mb-3 row mt-4">
                <div class="col-md-3">
                    <label for="province" class="form-label">Province:<span style="color: red;">*</span></label>
                    <select class="form-select" id="province" name="province[]">
                        <option value="">Please select</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->province }}</option>
                        @endforeach
                    </select>
                    @error('province')
                        <div class="text-danger">{{ $message }}</div>   
                    @enderror
                </div>
    
                <div class="col-md-3">
                    <label for="district" class="form-label">District:<span style="color: red;">*</span></label>
                    <select class="form-select" id="district" name="district[]">
                        <option value="">Please select</option>
                    </select>
                    @error('district')
                        <div class="text-danger">{{ $message }}</div>   
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="detail" class="form-label">Detail:</label>
                    <input type="text" class="form-control" id="detail" name="detail" value="{{ old('detail') }}">
                    @error('detail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 mt-4">
                    <button type="button" class="btn btn-outline-danger" onclick="removeWorkPlace(this)"><i class="fas fa-trash"></i></i></button>
                </div>
            </div>
        `;
            workPlaceContainer.append(newWorkPlace);
            $(this).remove();
        }

        function removeWorkPlace(button) {
            $(button).closest('.work-place-group').remove();
        }
        $(document).ready(function() {
            $('#province').on('change', function() {
                var provinceId = $(this).val();
                if (provinceId) {
                    var url = '{{ url('/admin/api/districts/') }}/' + provinceId;

                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(districts) {
                            console.log('Districts fetched:', districts); // Log the response
                            $('#district').empty().append(
                                '<option value="">Select District</option>');
                            $.each(districts, function(key, value) {
                                $('#district').append('<option value="' + value.id +
                                    '">' + value.district + '</option>');
                            });
                        },
                        error: function() {
                            alert('Error loading districts.');
                        }
                    });
                } else {
                    $('#district').empty().append('<option value="">Select District</option>');
                }
            });
        });



       
    </script> --}}
<script>
    function addWorkPlace() {
    var workPlaceContainer = $('#workPlaceContainer');
    var newWorkPlace = `
        <div class="work-place-group mb-3 row mt-4">
            <div class="col-md-3">
                <label for="province" class="form-label">Province:<span style="color: red;">*</span></label>
                <select class="form-select province-dropdown" name="province[]">
                    <option value="">Please select</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}">{{ $province->province }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="district" class="form-label">District:<span style="color: red;">*</span></label>
                <select class="form-select district-dropdown" name="district[]">
                    <option value="">Please select</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="detail" class="form-label">Detail:</label>
                <input type="text" class="form-control" name="detail[]" value="">
            </div>

            <div class="col-md-3 mt-4">
                <button type="button" class="btn btn-outline-danger" onclick="removeWorkPlace(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;
    workPlaceContainer.append(newWorkPlace);
}

function removeWorkPlace(button) {
    $(button).closest('.work-place-group').remove();
}

$(document).ready(function () {
    // Use event delegation for dynamically added elements
    $('#workPlaceContainer').on('change', '.province-dropdown', function () {
        var provinceId = $(this).val();
        var districtDropdown = $(this).closest('.work-place-group').find('.district-dropdown');

        if (provinceId) {
            var url = '{{ url('/admin/api/districts/') }}/' + provinceId;
            $.ajax({
                url: url,
                type: 'GET',
                success: function (districts) {
                    console.log('Districts fetched:', districts); // Log the response
                    districtDropdown.empty().append('<option value="">Select District</option>');
                    $.each(districts, function (key, value) {
                        districtDropdown.append('<option value="' + value.id + '">' + value.district + '</option>');
                    });
                },
                error: function () {
                    alert('Error loading districts.');
                }
            });
        } else {
            districtDropdown.empty().append('<option value="">Select District</option>');
        }
    });
});
</script>
@endsection
