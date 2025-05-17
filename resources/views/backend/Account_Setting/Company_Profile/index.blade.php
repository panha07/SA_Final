@extends('backend.layout.master')

@section('backend_content')
<div class="container ">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h2 id="company-name" class='text-white'>Company Name</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('update_company_profile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 text-center">
                            {{-- <img id="company-logo" src="path-to-logo.jpg" alt="Company Logo" class="img-fluid rounded mb-3" style="max-height: 200px;">
                            <input type="file" name="logo" class="form-control"> --}}
                            <div class="col-md-4 text-center">
                                @if($companyProfile->logo)
                                    <img id="company-logo" src="{{ asset('storage/' . $companyProfile->logo) }}" alt="Company Logo" class="img-fluid rounded mb-3" style="max-height: 400px; max-width: 100%;">
                                @else
                                    <img id="company-logo" src="{{asset('asset/images/profile/noimg.jpg')}}" alt="Company Logo" class="img-fluid rounded mb-3" style="max-height: 400px; max-width: 100%;">
                                @endif
                                <input type="file" name="logo" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $companyProfile->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $companyProfile->address) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="industry" class="form-label">Industry</label>
                                <input type="text" class="form-control" id="industry" name="industry" value="{{ old('industry', $companyProfile->industry) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $companyProfile->website) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $companyProfile->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center text-muted">
                <small>Profile last updated: <span id="last-updated">{{ $companyProfile->updated_at }}</span></small>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection