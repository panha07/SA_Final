@extends('backend.layout.master')

@section('backend_content')
    <div class="container bg-white mb-4 p-4 rounded shadow-sm">
        @include("components.component")
        <h4 class="fw-bold text-primary mb-4">Edit Job</h4>

        <form id ="jobForm" action="{{ route('update_job', $job->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Job Details -->
            <div class="mb-3 row bg-red p-2 rounded">
                <p class="mb-4 text-white font-bold bg-primary p-2">Job Description</p>
            </div>
            {{-- {{dd($job)}} --}}
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="title" class="form-label">Job Title <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $job->title) }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="posted_at" class="form-label">Publish Date <span style="color: red;">*</span></label>
                    <input type="date" class="form-control" id="posted_at" name=""
                        value="{{ old('posted_at', \Carbon\Carbon::parse($job->posted_at)->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}"  readonly>
                    @error('posted_at')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-8 mt-4">
                <label for="job_type_id" class="form-label">Position Nature: <span style="color: red;">*</span></label>
                <div class="d-flex flex-wrap">
                    @foreach ($jobType as $type)
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="job_type_id" id="{{ $type->id }}"
                                value="{{ $type->id }}" {{ old('job_type_id', $job->job_type_id) == $type->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $type->id }}">{{ ucfirst($type->name) }}</label>
                        </div>
                    @endforeach
                </div>
                @error('job_type_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <!-- Job Categories & Work Place -->
            {{-- {{dd($job->job_categories_id)}} --}}
            {{-- {{dd($jobCategory)}}
             --}}
            <div class="col-md-4 mt-4">
                <label for="jobCategory" class="form-label">Job Categories: <span style="color: red;">*</span></label>
                <select class="form-select" id="jobCategory" name="job_categories"  multiple>

                    @foreach ($jobCategories as $category)
                    <option value="{{ $category->id }}" {{ old('job_categories_id', $job->job_categories_id) == $category->id ? 'selected' : '' }}>
                        {{ ($category->name) }}
                    </option>
                @endforeach
                </select>
            </div>
            <div  id="workPlaceContainer" class="mb-3 row mt-4">
                <div class="col-md-3">
                    <label for="province" class="form-label">Province:<span style="color: red;">*</span></label>
                    <select class="form-select" id="province" name="province[]" >
                        <option value="">Please select</option>
                        @foreach ($provinces as $province)
                        <option value="{{ $province->id }}" {{ old('province', $job->jobLocations->first()->location->province->id ?? '') == $province->id ? 'selected' : '' }}>
                            {{ $province->province }}
                        </option>
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
                        @foreach ($job->jobLocations as $location)
                        <option value="{{ $location->location->district->id }}" {{ old('district', $location->location->district->id) == $location->location->district->id ? 'selected' : '' }}>
                            {{ $location->location->district->district }}
                        </option>
                    @endforeach
                    </select>
                    @error('district')
                        <div class="text-danger">{{ $message }}</div>   
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="detail" class="form-label">Detail:</label>
                    <input type="text" class="form-control" id="detail" name="detail" value="{{ old('detail', $job->jobLocations->first()->location->desc ?? '') }}">
                    @error('detail')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               
            </div>
            <div class="mb-3 row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-outline-secondary" onclick="addWorkPlace()">Add Work Place</button>
                </div>
            </div>
            <!-- Hiring Quantity -->
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="hiring_num" class="form-label">Number of Hires <span style="color: red;">*</span></label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" onclick="decrement('hiring_num')">-</button>
                        <input type="number" class="form-control text-center" id="hiring_num" name="hiring_num"
                        value="{{ old('hiring_num', $job->hiring_num) }}" min="1">
                        <button type="button" class="btn btn-outline-secondary" onclick="increment('hiring_num')">+</button>
                    </div>
                    @error('hiring_num')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-6 mb-3">
                <label for="salary_range" class="form-label">Monthly Salary: <span style="color: red;">*</span></label>
                <select class="form-select" id="salary_range" name="salary_range">
    
                    @foreach ($salaries as $salary)
                        <option value="{{ $salary->id }}" {{ old('salary_id', $job->salary_id) == $salary->id ? 'selected' : '' }}>
                            {{ ucfirst($salary->salary_rank) }}
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
                <textarea class="form-control" id="jobDescription" rows="5" name="description"
                    placeholder="Please do not include company email, contact number, salary negotiable, or gender discrimination."> {{ old('description', $job->description) }}</textarea>
            </div>
            <div class="mb-3 row bg-red p-2 rounded">
                <p class="mb-4 text-white font-bold bg-primary p-2">Job Requirement</p>
            </div>
            <!-- Job Requirements -->

            <div class="col-md-3 mt-4">
                <label for="level" class="form-label">Level:<span style="color: red;">*</span></label>
                <select class="form-select" id="level" name="level">
                    <option value="">Please select</option>
                    @foreach ($levels as $item)
                    <option value="{{ $item->id }}" {{ old('level_id', $job->level_id) == $item->id ? 'selected' : '' }}>
                        {{ $item->level }}
                    </option>
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
                        
                        @foreach ($educations as $education)
                        <option value="{{ $education->id }}" {{ $educations_detail->first()->education_id == $education->id ? 'selected' : '' }}>
                            {{ ucfirst($education->education) }}
                        </option>
                    @endforeach 
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fieldOfStudy" class="form-label">Field of Study:</label>
                    <input type="text" class="form-control" id="studyfield" placeholder="Enter your field of study"
                    name="studyfield" value="{{ old('studyfield', $educations_detail->first()->field_of_study ?? '') }}">
                @error('studyfield')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>

            <div class="col-md-2 mb-3">
                <label for="yearOfExperience" class="form-label">Years of Experience <span style="color: red;">*</span></label>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary" onclick="decrement('experience')">-</button>
                    <input type="number" class="form-control text-center" id="experience" name="experience" value="{{ old('experience', $job->experience) }}" min="0">
                    <button type="button" class="btn btn-outline-secondary" onclick="increment('experience')">+</button>
                </div>
                @error('experience')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

           {{-- {{dd($langDetails)}} --}}
            <div id="languageSkillContainer">
                <div class="mb-3 row mt-4">
                    <div class="col-md-4">
                        <label for="language" class="form-label">Language:</label>
                        <select class="form-select" name="languages[]">
                         @foreach ($languages as $item)
                        <option value="{{ $item->id }}" {{ old('languages', $langDetails->lang_id) == $item->id ? 'selected' : ''}}>{{ $item->lang }}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="skillLevel" class="form-label">Skill Level: <span
                                style="color: red;">*</span></label>
                        <select class="form-select" id="skillLevel" name="Lang_skill[]">
                            <option value="">Please select</option>
                            @foreach ($language_skill as $skill)
                            <option value="{{ $skill->id }}" {{ old('Lang_skill', $langDetails->skill_id) == $skill->id ? 'selected' : ''}} >{{ $skill->skill }}</option>
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
                        <option value="">Please select</option>
                        @foreach ($genders as $item)
                            <option value="{{ $item->id }}" {{ old('gender', $job->gender_id) == $item->id ? 'selected' : '' }}>{{ $item->gender }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <div class="text-danger">{{ $message }}</div>   
                    @enderror
                </div>
    
                <div class="col-md-2">
                    <label for="startAge" class="form-label">Start Age:<span style="color: red;">*</span></label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" onclick="decrement('startAge')">-</button>
                        <input type="number" class="form-control text-center" id="startAge" name="startAge"  value="{{ old('startAge',$job->start_age) }}">
                        <button type="button" class="btn btn-outline-secondary" onclick="increment('startAge')">+</button>
                    </div>
                    @error('startAge')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
    
                <div class="col-md-2">
                    <label for="endAge" class="form-label">End Age:<span style="color: red;">*</span></label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" onclick="decrement('endAge')">-</button>
                        <input type="number" class="form-control text-center" id="endAge" name="endAge" value="{{ old('endAge',$job->end_age) }}">
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
                <textarea class="form-control" id="jobRequirementsDescription" rows="5" name="requirements"
                    placeholder="Please do not include company email, contact number, salary negotiable, or gender discrimination."> {{ old('requirements', $job->requirements) }}</textarea>
            </div>

            <hr>
            <div class="mb-3 row mt-4">
                <div class="col-md-4">
                    <label for="employer" class="form-label">Contact Person:<span style="color: red;">*</span></label>
                    <select class="form-select" id="employer" name="employer" onchange="updateContactInfo()">
                       
                        @foreach ($employers as $employer)
                            <option value="{{ $employer->employer_id }} {{ old('employer', $job->employer_id) == $employer->id ? 'selected' : '' }}" data-phone="{{ $employer->phone }}" data-email="{{ $employer->email }}">{{ $employer->user_name }}</option>
                        @endforeach
                    </select>
                    @error('employer')
                        <div class="text-danger">{{ $message }}</div>   
                    @enderror
                </div>
    
                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{$employer->phone}}" readonly>
                </div>
    
                <div class="col-md-4">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{$employer->email}}" readonly>
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
                <a href="{{ route('add_job') }}" class="btn btn-secondary text-white">Back</a>
                <div class="d-flex justify-content-end ">
                    {{-- <button type="submit" class="btn btn-outline me-2 ">Save Draft</button>
                    <button type="submit" class="btn btn-primary me-2 ">Job Preview</button> --}}
                    <button type="submit" class="btn btn-primary ">Update Job</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
                <select class="form-select" name="languages[]">
                    <option value="">Please select</option>
                    @foreach ($languages as $item)
                        <option value="{{ $item->id }}">{{ $item->lang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="skillLevel" class="form-label">Skill Level: <span style="color: red;">*</span></label>
                <select class="form-select" name="language_skills[]">
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
   <script>
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
                        $('#district').empty().append('<option value="">Select District</option>');
                        $.each(districts, function(key, value) {
                            $('#district').append('<option value="' + value.id + '">' + value.district + '</option>');
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
    }

    function removeWorkPlace(button) {
        $(button).closest('.work-place-group').remove();
    }
</script>
@endsection
