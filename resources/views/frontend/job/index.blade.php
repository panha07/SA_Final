@extends('frontend.layout.master')
@section('pg_job', 'active')
@section('content')
    <div class="job-listing-area pt-10 ">
        <div class="container">
            <hr class="pb-5">
            <form action="{{ route('frontend.job_list') }}" method="GET" id="filterForm">
                <div class="row">
                    <!-- Left content -->
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="small-section-tittle2 mb-45">
                                    <h4> Filter Jobs</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Job Category Listing start -->
                        <div class="job-category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                                <div class="small-section-tittle2">
                                    <h4>Job Category</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="category" class="form-control"
                                        onchange="document.getElementById('filterForm').submit();">
                                        <option value="">All Category</option>
                                        @foreach ($job_categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--  Select job items End-->
                                <!-- select-Categories start -->
                                <div class="select-Categories pt-80 pb-50">
                                    <div class="small-section-tittle2">
                                        <h4>Job Type</h4>
                                    </div>
                                    @foreach ($job_types as $job)
                                        <label class="container">
                                            {{ $job->name }}
                                            <input type="checkbox" name="job_types[]" value="{{ $job->id }}"
                                                {{ is_array(request('job_types')) && in_array($job->id, request('job_types')) ? 'checked' : '' }}
                                                onchange="document.getElementById('filterForm').submit();">
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                </div>
                                <!-- select-Categories End -->
                            </div>
                            <!-- single two -->
                            <div class="single-listing">
                                <div class="small-section-tittle2">
                                    <h4>Job Location</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="province" class="form-control"
                                        onchange="document.getElementById('filterForm').submit();">
                                        <option value="">All Provinces</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}"
                                                {{ request('province') == $province->id ? 'selected' : '' }}>
                                                {{ $province->province }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!--  Select job items End-->
                                <!-- select-Categories start -->
                                <div class="select-Categories pt-80 pb-50">
                                    <div class="small-section-tittle2">
                                        <h4>Experience</h4>
                                    </div>
                                    <div class="select-job-items2">
                                        <select name="experience" class="form-control"
                                            onchange="document.getElementById('filterForm').submit();">
                                            <option value="">All Experience Levels</option>
                                            <option value="0" {{ request('experience') == '0' ? 'selected' : '' }}>No
                                                Experience</option>
                                            <option value="1" {{ request('experience') == '1' ? 'selected' : '' }}>1+
                                                Years</option>
                                            <option value="2" {{ request('experience') == '2' ? 'selected' : '' }}>2+
                                                Years</option>
                                            <option value="3" {{ request('experience') == '3' ? 'selected' : '' }}>3+
                                                Years</option>
                                            <option value="5" {{ request('experience') == '5' ? 'selected' : '' }}>5+
                                                Years</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- select-Categories End -->
                            </div>
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!-- Right content -->
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                <!-- Count of Job list Start -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="count-job mb-35">
                                            <div class="d-flex col-lg-4 mb-3">
                                                <input type="text" class="form-control  me-2" name="search"
                                                    placeholder="Please enter your name" aria-label="Search"
                                                    value="{{ request()->input('search') }}">
                                                <input type="hidden" name="status" id="statusInput"
                                                    value="{{ request('status', 'offline') }}">
                                                <button class="btn btn-danger" type="submit" hidden>Search</button>
                                            </div>
                                            <span>Total : {{ $totalJobs }} Jobs</span>
                                            <!-- Select job items start -->
                                            <div class="select-job-items">
                                                <span>Sort by</span>
                                                <select name="sort_by"
                                                    onchange="document.getElementById('filterForm').submit();">
                                                    <option value="">None</option>
                                                    <option value="title"
                                                        {{ request('sort_by') == 'title' ? 'selected' : '' }}>Job Title
                                                    </option>
                                                    <option value="category"
                                                        {{ request('sort_by') == 'category' ? 'selected' : '' }}>Categories
                                                    </option>
                                                    <option value="experience"
                                                        {{ request('sort_by') == 'experience' ? 'selected' : '' }}>
                                                        experience</option>
                                                </select>
                                            </div>
                                            <!--  Select job items End-->
                                        </div>
                                    </div>
                                </div>
                                <!-- Count of Job list End -->
                                <!-- single-job-content -->

                                <!-- single-job-content -->
                                @foreach ($jobs as $job)
                                    <div class="single-job-items  pr-5 pl-4 "
                                        onclick="window.location.href='{{ route('frontend.job_details', $job->id) }}';"
                                        style="cursor: pointer;">
                                        <div class="job-items">
                                            <div class="job-tittle">
                                                <a href="{{ route('frontend.job_details', $job->id) }}">
                                                    <h6>{{ $job->title }}</h6>
                                                </a>
                                                <ul class="justify-between mb-0">

                                                    @if ($job->experience == 0)
                                                        <small>
                                                            Experience: Not required
                                                        </small>
                                                    @else
                                                        <small>
                                                            Experience: {{ $job->experience }} Year(s)
                                                        </small>
                                                    @endif
                                                    </small>
                                                    <small>
                                                        | {{ $job->salary->salary_rank }}
                                                        |
                                                        @if ($job->jobLocations->isNotEmpty())
                                                            {{ $job->jobLocations->first()->location->province->province }},
                                                            {{ $job->jobLocations->first()->location->district->district ?? '' }},
                                                            {{ strlen($job->jobLocations->first()->location->desc ?? '') > 40
                                                                ? substr($job->jobLocations->first()->location->desc ?? '', 0, 40) . '...'
                                                                : $job->jobLocations->first()->location->desc ?? '' }}
                                                        @endif
                                                    </small>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="items-link f-right">
                                            <a class="mb-1"
                                                href="{{ route('frontend.job_details', $job->id) }}">{{ $job->jobType->name }}</a>
                                            <span
                                                style="color:rgb(181, 181, 181)">{{ $job->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <hr class="pb-1 mr-4">
                                @endforeach
                                {{-- <div class="job-list-container">
                                    @foreach ($jobs as $job)
                                        <div class="single-job-item mb-2">
                                            <div class="job-content small-text">
                                                <a href="{{ route('frontend.job_details', $job->id) }}" class="job-title">
                                                    {{ Str::limit($job->title, 40) }}
                                                </a>
                                                <ul class="job-details">
                                                    <li>Exp: {{ $job->experience ? $job->experience . ' Yr(s)' : 'Not required' }}</li>
                                                    <li>{{ $job->salary->salary_rank }}</li>
                                                </ul>
                                                <small class="job-location">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    @if ($job->jobLocations->isNotEmpty())
                                                        {{ $job->jobLocations->first()->location->province->province }},
                                                        {{ $job->jobLocations->first()->location->district->district ?? '' }}
                                                    @endif
                                                </small>
                                            </div>
                                            <div class="job-meta small-text">
                                                <span class="job-type">{{ $job->jobType->name }}</span>
                                                <span class="job-date">{{ $job->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                
                                    @if ($jobs->isEmpty())
                                        <p class="text-center">No jobs available.</p>
                                    @endif
                                </div> --}}

                            </div>
                        </section>
                        <div class="pagination-area pb-115 text-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="single-wrap d-flex justify-content-end">
                                            <nav aria-label="Page navigation example">
                                                {{ $jobs->appends([
                                                        'search' => request('search'),
                                                        'category' => request('category'),
                                                        'job_types' => request('job_types'),
                                                        'province' => request('province'),
                                                        'experience' => request('experience'),
                                                        'sort_by' => request('sort_by'),
                                                    ])->links('vendor.pagination.bootstrap-4') }}
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
