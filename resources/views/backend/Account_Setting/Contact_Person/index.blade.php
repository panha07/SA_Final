@extends('backend.layout.master')

@section('backend_content')
    @include('components.component')

    <div class="container mb-4 p-4 rounded ">
       
            <div class="form-container shadow-sm p-4 bg-light rounded">
                <!-- Search Bar -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form action="{{ route('contactPerson') }}" method="GET" class="input-group w-50">
                        <input type="text" class="form-control" name="search" placeholder="Please enter your name"
                            aria-label="Search" value="{{ request()->input('search') }}">
                        <button class="btn btn-danger" type="submit">Search</button>
                    </form>
                    <a href="{{ route('create_person') }}">
                        <button class="btn btn-danger"><i class="fas fa-user-plus"></i></button>
                    </a>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Operate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = ($contactPerson->currentPage() - 1) * $contactPerson->perPage() + 1; @endphp
                            @foreach ($contactPerson as $person)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $person->name }}</td>
                                    <td>{{ $person->department }}</td>
                                    <td>{{ $person->position }}</td>
                                    <td>{{ $person->phone }}</td>
                                    <td>{{ $person->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('edit_person', ['id' => $person->id]) }}"
                                            class="btn btn-sm btn-outline-secondary"><i class="fas fa-user-edit"></i></a>
                                        <form action="{{ route('delete_person', ['id' => $person->id]) }}" method="POST"
                                            style="display:inline;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-button">
                                                <i class="fas fa-user-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center">
                    <p>Total {{ $contactPerson->total() }}</p>
                    {{ $contactPerson->appends(['search' => request()->input('search')])->links('vendor.pagination.custom-pagination') }}
                </div>
            </div>
      
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
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
        });
    </script>
@endsection
