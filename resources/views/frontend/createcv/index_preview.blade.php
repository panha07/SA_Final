
<div class="container py-5">
    <div class="bg-light p-4 rounded shadow-sm">
        <h1 class="fw-bold text-center">Curriculum Vitae</h1>
      {{dd($data)}}
        <!-- Personal Information -->
            <div class="mb-4">
                <h5 class="text-primary">Personal Information</h5>
            <div class="row">
                <div class="col-md-3">
                    @if (isset($data['photo']))
                        <img src="{{ asset('uploads/' . $data['photo']) }}" alt="Photo" class="img-fluid rounded-circle">
                    @else
                        <p>No Photo Uploaded</p>
                    @endif
                </div>
                <div class="col-md-9">
                    <p><strong>Name:</strong> {{ $data['name'] ?? 'N/A' }}</p>
                    <p><strong>Title/Profession:</strong> {{ $data['title'] ?? 'N/A' }}</p>
                    <p><strong>Phone:</strong> {{ $data['phone'] ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $data['email'] ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Education -->
        <div class="mb-4">
            <h5 class="text-primary">Education</h5>
            @if (!empty($data['edu_school']))
                <ul>
                    @foreach ($data['edu_school'] as $key => $school)
                        <li>
                            <strong>{{ $school }}</strong> 
                            ({{ $data['edu_from_year'][$key] ?? 'N/A' }} - {{ $data['edu_to_year'][$key] ?? 'N/A' }}) 
                            - Degree: {{ $data['edu_degree'][$key] ?? 'N/A' }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No Education Details Provided</p>
            @endif
        </div>

        <!-- Experience -->
        <div class="mb-4">
            <h5 class="text-primary">Experience</h5>
            @if (!empty($data['exp_company']))
                <ul>
                    @foreach ($data['exp_company'] as $key => $company)
                        <li>
                            <strong>{{ $company }}</strong> 
                            ({{ $data['exp_from_year'][$key] ?? 'N/A' }} - {{ $data['exp_to_year'][$key] ?? 'N/A' }}) 
                            - Position: {{ $data['exp_position'][$key] ?? 'N/A' }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No Experience Details Provided</p>
            @endif
        </div>

        <!-- Skills -->
        <!-- Skills Section in Preview -->
<div class="mb-4">
    <h5 class="text-primary">Skills</h5>
    @if (!empty($data['skills']))
        <ul>
            @foreach ($data['skills'] as $key => $skill)
                <li>
                    <strong>{{ $skill }}</strong>
                    @if (!empty($data['level'][$key]))
                        - Level: 
                        @switch($data['level'][$key])
                            @case(1)
                                Beginner
                                @break
                            @case(2)
                                Intermediate
                                @break
                            @case(3)
                                Advanced
                                @break
                            @case(4)
                                Expert
                                @break
                            @case(5)
                                Mother Tongue
                                @break
                            @default
                                N/A
                        @endswitch
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p>No Skills Provided</p>
    @endif
</div>


        <!-- References -->
        <div class="mb-4">
            <h5 class="text-primary">References</h5>
            <p><strong>Name:</strong> {{ $data['ref_name'] ?? 'N/A' }}</p>
            <p><strong>Position:</strong> {{ $data['ref_position'] ?? 'N/A' }}</p>
            <p><strong>Phone:</strong> {{ $data['ref_phone'] ?? 'N/A' }}</p>
        </div>

        <div class="text-center">
            <a href="{{ route('frontend.create_CV') }}" class="btn btn-primary px-4">Back to Edit</a>
        </div>
    </div>
</div>

