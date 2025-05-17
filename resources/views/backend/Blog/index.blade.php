@extends('backend.layout.master')
@section('backend_content')
    <div class="container bg-white mb-4 p-4 rounded shadow-sm">
        @include('components.component')

        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold">Manage Blogs</h5>
            <a href="{{ route('add_blog') }}" class="btn btn-outline-primary">
                <i class="bi bi-hand-thumbs-up"></i> Post a Blog
            </a>
        </div>

        <!-- Search Form -->
        <form id="search-form" action="{{ route('blog') }}" method="GET" class="d-flex col-lg-3 mb-4">
            <input type="text" class="form-control me-2" name="search" placeholder="Please enter the title"
                aria-label="Search" value="{{ request()->input('search') }}">
            <input type="hidden" name="status" id="search-status" value="{{ request()->input('status', 1) }}"> <!-- Default to 1 (Company Activities) -->
            <button class="btn btn-danger"  hidden type="submit">Search</button>
        </form>

        <!-- Tabs -->
        <ul class="nav nav-tabs" id="blogTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request()->input('status', 1) == 1 ? 'active' : '' }}" id="company-tab"
                    data-bs-toggle="tab" data-bs-target="#company" type="button" role="tab" aria-controls="company"
                    aria-selected="true" data-status="1">
                    Company Activities
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ request()->input('status') == 0 ? 'active' : '' }}" id="csr-tab"
                    data-bs-toggle="tab" data-bs-target="#csr" type="button" role="tab" aria-controls="csr"
                    aria-selected="false" data-status="0">
                    CSR
                </button>
            </li>
        </ul>
        <!-- Tab Content -->
        <div class="tab-content mt-3" id="blogTabsContent">
            <div class="tab-pane fade show active" id="company" role="tabpanel" aria-labelledby="company-tab">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($blogs as $blog)
                        @if ($blog->status == request()->input('status', 1)) <!-- Filter by status -->
                            <div class="col">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <!-- Left Section: Title, Description, etc. -->
                                            <div class="flex-grow-1 me-3">
                                                <h5 class="card-title fw-bold">{{ $blog->blog_title }}</h5>
                                                <p class="card-text text-muted">{{ Str::limit($blog->description, 70, '...') }}</p>
                                            </div>
                                            <!-- Right Section: Image -->
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('assets/img/blog/' . $blog->img) }}" alt="{{ $blog->blog_title }}"
                                                    class="rounded" style="width: 120px; height: 120px; object-fit: cover;">
                                            </div>
                                        </div>
                                        <!-- Actions -->
                                        <div class="d-flex justify-content-between  align-items-center gap-2 form-control mt-3">
                                            <div>
                                                <small class="text-muted">Posted by: {{ $blog->user->first_name }}</small> <br>
                                                <small class="text-muted">Date : {{ $blog->updated_at->format('d-m-y') }}</small>
                                            </div>
                                            <div>
                                                <a href="{{ route('edit_blog', ['id' => $blog->id]) }}" class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('delete_blog', ['id' => $blog->id]) }}" method="POST"
                                                    style="display:inline;" class="delete-form">
                                                    @csrf
                                                    {{-- @method('DELETE') --}}
                                                    <button type="button" class="btn  delete-button  btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if ($blogs->where('status', request()->input('status', 1))->isEmpty())
                        <p>No blogs available for this category.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-4">
            <p>Total {{ $blogs->total() }}</p>
            {{ $blogs->appends(['search' => request()->input('search'), 'status' => request()->input('status')])->links('vendor.pagination.custom-pagination') }}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Automatically submit the form when switching tabs
            const tabs = document.querySelectorAll('.nav-link');
            const statusInput = document.getElementById('search-status');
            const searchForm = document.getElementById('search-form');

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    const status = this.getAttribute('data-status'); // Get the status from the clicked tab
                    statusInput.value = status; // Update the hidden input field
                    searchForm.submit(); // Submit the form automatically
                });
            });
        });
    </script>
@endsection