@extends('backend.layout.master')
@section('backend_content')
    <div class="container bg-white mb-4 p-4 rounded shadow-sm">
        @include('components.component')

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold">Manage Posts</h5>
            <a href="{{ route('create_job') }}" class="btn btn-outline-primary">
                <i class="bi bi-hand-thumbs-up"></i> Post a Job
            </a>
        </div>

        {{-- <form class="d-flex col-lg-4 mb-3">
            <input class="form-control me-2" type="search" placeholder="Enter job title" aria-label="Search">
        </form> --}}
        <form action="{{ route('job') }}" method="GET" class=" d-flex col-lg-4 mb-3">
            <input type="text" class="form-control  me-2" name="search" placeholder="Please enter the job title"
                aria-label="Search" value="{{ request()->input('search') }}">
            <input type="hidden" name="status" id="statusInput" value="{{ request('status', 'offline') }}">
            <button class="btn btn-danger" type="submit" hidden>Search</button>
        </form>



        <ul class="nav nav-tabs mb-4" id="postTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="online-posts-tab" data-bs-toggle="tab" data-bs-target="#online-posts"
                    name="online" type="button" role="tab">Online Posts ({{ $allOnlineJobs->count() }})</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="offline-posts-tab" data-bs-toggle="tab" data-bs-target="#offline-posts"
                    name="offline" type="button" role="tab">Offline Posts ({{ $allOfflineJobs->count() }})</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="draft-posts-tab" data-bs-toggle="tab" data-bs-target="#draft-posts"
                    type="button" role="tab">Draft Posts</button>
            </li>
        </ul>

        <div class="tab-content" id="postTabsContent">
            <div class="tab-pane fade {{ request('status', 'online') == 'online' ? 'show active' : '' }}" id="online-posts"
                role="tabpanel">
                {{-- <div class="tab-pane fade show active" id="online-posts" role="tabpanel"> --}}
                {{-- @if ($onlineJobs)
                <form action="{{ route('job') }}" method="GET" class=" d-flex col-lg-4 mb-3">
                    <input type="text" class="form-control  me-2" name="search" placeholder="Please enter your name" aria-label="Search" value="{{ request()->input('search') }}">
                    <button class="btn btn-danger" type="submit" hidden>Search</button>
                </form>
            @endif --}}
                <div class="row g-3">
                    @foreach ($onlineJobs as $job)
                        <div class="col-lg-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>

                                            <h6 class="fw-bold mb-1">{{ $job->title }}</h6>
                                            {{-- <p class="mb-1 text-muted">{{$job->location}} | ${{$job->salary_rank}} per month</p> --}}
                                            <p class="mb-1 text-muted">
                                                {{ $job->jobLocations->first()->location->province->province ?? '' }} |
                                                {{ $job->jobLocations->first()->location->district->district ?? '' }} |
                                                ({{ $job->salary->salary_rank ?? 'Negotiable' }})
                                                per month
                                            </p>
                                            <small
                                                class="text-muted">{{ $job->experience == 0 ? 'Experience not required' : $job->experience . ' years experience' }}
                                            | {{ $job->levels->level }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="row text-center border rounded py-2 me-3">
                                                <div class="col border-end">
                                                    <h6 class="mb-1">0</h6>
                                                    <small>Candidates</small>
                                                </div>
                                                <div class="col border-end">
                                                    <h6 class="mb-1">0</h6>
                                                    <small>Waiting for Review</small>
                                                </div>
                                                <div class="col">
                                                    <h6 class="mb-1">0</h6>
                                                    <small>Can Chat</small>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-1 fw-bold">{{ $job->jobType->name ?? 'N/A' }} </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>

                                        <div class="d-flex justify-content-start">
                                            <small class="text-muted text-red">Application Deadline:
                                                {{ \Carbon\Carbon::parse($job->application_deadline)->format('d F Y') }}
                                            </small>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <!-- Close Button with Tooltip -->
                                            {{-- <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Close">
                                        <i class="bi bi-door-closed">Close</i>
                                    </button> --}}
                                            <button class="btn btn-outline-danger me-3"
                                                onclick="closeJob({{ $job->id }})"><i
                                                    class="far fa-trash-alt"></i><span class="ms-2">Close Job</span>
                                            </button>
                                            <button class="btn btn-outline-secondary me-3" onclick="switchToOffline()"><i
                                                    class="fas fa-redo"></i><span class="ms-2">Refresh</span> </button>

                                            <a href="{{ route('edit_job', $job->id) }}"
                                                class="btn btn-outline-primary me-3">
                                                <i class="fas fa-edit"></i><span class="ms-2">Edit</span>
                                            </a>


                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- <div class=" pagination d-flex justify-content-end mt-4">
                    {{ $onlineJobs->appends(['activeTab' => 'online-posts'])->links('vendor.pagination.bootstrap-4') }}

                </div> --}}
                <div class="pagination d-flex justify-content-end mt-4">
                    {{ $onlineJobs->appends(['status' => 'online', 'search' => request('search')])->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            <div class="tab-pane fade" id="pending-posts" role="tabpanel">

            </div>

            <div class="tab-pane fade {{ request('status') == 'offline' ? 'show active' : '' }}" id="offline-posts"
                role="tabpanel">

                <div class="row g-3">
                    @foreach ($offlineJobs as $job)
                        <div class="col-lg-12">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>

                                            <h6 class="fw-bold mb-1">{{ $job->title }}</h6>
                                            {{-- <p class="mb-1 text-muted">{{$job->location}} | ${{$job->salary_rank}} per month</p> --}}
                                            <p class="mb-1 text-muted">
                                                {{ $job->jobLocations->first()->location->province->province ?? '' }} |
                                                {{ $job->jobLocations->first()->location->district->district ?? '' }} |
                                                ({{ $job->salary->salary_rank ?? 'Negotiable' }})
                                                per month
                                            </p>
                                            <small
                                                class="text-muted">{{ $job->experience == 0 ? 'Experience not required' : $job->experience . ' years experience' }}
                                                | {{ $job->levels->level }}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="row text-center border rounded py-2 me-3">
                                                <div class="col border-end">
                                                    <h6 class="mb-1">0</h6>
                                                    <small>Candidates</small>
                                                </div>
                                                <div class="col border-end">
                                                    <h6 class="mb-1">0</h6>
                                                    <small>Waiting for Review</small>
                                                </div>
                                                <div class="col">
                                                    <h6 class="mb-1">0</h6>
                                                    <small>Can Chat</small>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-1 fw-bold">{{ $job->jobType->name ?? 'N/A' }} </p>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="d-flex justify-content-start">
                                            <small class="text-muted text-red">Application Deadline:
                                                {{ \Carbon\Carbon::parse($job->application_deadline)->format('d F Y') }}
                                            </small>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <!-- Close Button with Tooltip -->
                                            {{-- <button class="btn btn-outline-primary btn-sm me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Close">
                                        <i class="bi bi-door-closed">Close</i>
                                    </button> --}}

                                            <button class="btn btn-outline-secondary me-3"
                                                onclick="renewJob({{ $job->id }})"><i
                                                    class="fas fa-redo"></i></i><span class="ms-2">Renew</span>
                                            </button>
                                            <form action="{{ route('jobs.copy', $job->id) }}" method="POST"
                                                id="copy-form-{{ $job->id }}">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-primary me-3">
                                                    <i class="fas fa-edit"></i><span class="ms-2">Copy Job</span>
                                                </button>
                                            </form>
                                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
                                                id="delete-form-{{ $job->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger me-3"
                                                    onclick="confirmDelete({{ $job->id }})">
                                                    <i class="far fa-trash-alt"></i><span class="ms-2">Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination d-flex justify-content-end mt-4">
                    {{ $offlineJobs->appends(['status' => 'offline', 'search' => request('search')])->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>

            <div class="tab-pane fade" id="draft-posts" role="tabpanel">
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(jobId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + jobId).submit();
                }
            })
        }

        function switchToOffline() {
            var offlineTab = new bootstrap.Tab(document.getElementById('offline-posts-tab'));
            offlineTab.show();
        }

        function closeJob(jobId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to Offline this job!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Offline it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('jobs.close', ':jobId') }}'.replace(':jobId', jobId),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                localStorage.setItem('activeTab', '#offline-posts');
                                location.reload();
                            } else {
                                alert('Failed to close the job.');
                            }
                        },
                        error: function() {
                            alert('Failed to close the job.');
                        }
                    });
                }
            });
        }


        function renewJob(jobId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to renew this job!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, renew it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('jobs.renew', ':jobId') }}'.replace(':jobId', jobId),
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                localStorage.setItem('activeTab', '#online-posts');
                                location.reload();

                            } else {
                                Swal.fire('Failed to renew the job.');
                            }
                        },
                        error: function() {
                            Swal.fire('Failed to renew the job.');
                        }
                    });
                }
            });

        }
        document.addEventListener('DOMContentLoaded', function() {
            var activeTab = localStorage.getItem('activeTab') ||
                '{{ request()->get('activeTab', '#online-posts') }}';
            if (activeTab) {
                var tab = new bootstrap.Tab(document.querySelector(activeTab + '-tab'));
                tab.show();
                localStorage.removeItem('activeTab');
            }


        });

        function setStatusAndSubmit(status) {
            document.getElementById('statusInput').value = status;
            document.getElementById('searchForm').submit();
        }
    </script>
@endsection
