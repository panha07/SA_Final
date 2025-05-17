@extends('frontend.layout.master')
@section('pg_job', 'active')
@section('content')

    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- job single -->

                    <div class="single-job-items mb-30">
                        <div class="job-items">

                            <div class="job-tittle">
                                <a href="{{ route('frontend.job_details', $job->id) }}">
                                    <h4>{{ $job->title }}</h4>
                                </a>
                                <ul class="justify-between">
                                    @if ($job->experience == 0)
                                        <li>Experience: Not required</li>
                                    @else
                                        <li>Experience: {{ $job->experience }} Year(s)</li>
                                    @endif
                                    | {{ $job->salary->salary_rank }}


                                </ul>
                                <small><i class="fas fa-map-marker-alt"></i>
                                    @if ($job->jobLocations->isNotEmpty())
                                        {{ $job->jobLocations->first()->location->province->province }},
                                        {{ $job->jobLocations->first()->location->district->district ?? '' }}
                                        ({{ $job->jobLocations->first()->location->desc ?? '' }})
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="items-link f-right">
                            <a href="{{ route('frontend.job_details', $job->id) }}">{{ $job->jobType->name }}</a>
                            <span>{{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- job single End -->

                    <div class="job-post-details">
                        <div class="post-details1 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Description</h4>
                            </div>
                            <p> {{ $job->description }}</p>
                        </div>
                        <div class="post-details2  mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Requirement</h4>
                            </div>
                            <p>{{ $job->requirements }}</p>
                        </div>

                    </div>

                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3  mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h4>Job Overview</h4>
                        </div>
                        <ul>
                            <li>Posted date : <span>{{ $job->created_at->format('D, d - m - Y') }}</span></li>
                            <li>Location :
                                <span>
                                    @if ($job->jobLocations->isNotEmpty())
                                        {{ $job->jobLocations->first()->location->district->district ?? '' }},
                                        {{ $job->jobLocations->first()->location->province->province }}
                                    @endif
                                </span>
                            </li>
                            <li>Vacancy : <span>{{ $job->hiring_num }} Post</span></li>
                            <li>Language : <span>{{$lang->lang}}</span></li>
                            <li>Skill : <span>{{ $skill->skill}}</span></li>
                           
                            <li>Job nature : <span>{{ $job->jobType->name }}</span></li>
                            <li>Salary : <span>{{ $job->salary->salary_rank }}</span></li>
                            <li>Application date :
                                 <span>
                                    {{ $job->created_at->addDays(30)->format('D, d - m - Y') }}
                                </span>
                            </li>
                        </ul>
                        <div class="apply-btn2">
                            <a href="#" class="btn">Apply Now</a>
                        </div>
                    </div>
                    <div class="post-details4  mb-50">
                        <!-- Small Section Tittle -->
                        <div class="small-section-tittle">
                            <h2>HOW TO APPLY</h2>
                        </div>
                        <ul>
                            <li>Name :<span>{{$employer->name}}({{$employer->position}})</span></li>
                            <li>Email: <span>{{$employer->email}}</span></li>
                            <li>Telegram :<span>{{$employer->phone}}</span></li>
                            <li>Phone :<span>{{$employer->phone}} </span></li>
                            <li><a href="https://t.me/fistsolutionshr" target="_"> Join Our Telegram Channel</a></li>
                
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
