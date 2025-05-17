@foreach ($jobs as $job)
    <div class="single-job-items mb-30 " onclick ="window.location.href='{{ route('frontend.job_details', $job->id) }}';"
        style="cursor: pointer;">
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
@endforeach
