@extends('backend.layout.master')
@section('backend_content')
    <hr />
    <br>
    <div class="container bg-white mb-4 p-4 rounded shadow-sm">
        @include('components.component')
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold">Add New Blog</h5>
            <a href="{{ route('blog') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back to Blog List
            </a>
        </div>

        <!-- Add Blog Form -->
        <form action="{{ route('store_add_blog') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            {{-- <div class="col-md-6">
                <label for="title" class="form-label fw-bold">Generate</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter blog title" value="{{ $generate_id }}" readonly >
            </div> --}}
            <!-- Title -->
            <div class="col-md-6">
                <label for="title" class="form-label fw-bold">Title:<span style="color: red;">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter blog title" value="{{ old('title') }}" >
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3 ">
                <label for="status" class="form-label fw-bold">Post As :<span style="color: red;">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" >
                    <option value="">Please select</option>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Company Activities</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>CSR</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            

            <!-- Image Upload -->
            <div class="col-md-3">
                <label for="image" class="form-label fw-bold">Upload Image<span style="color: red;">*</span></label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" >
                <small class="text-muted">Recommended size: 800x400 pixels</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="col-md-12">
                <label for="description" class="form-label fw-bold">Description<span style="color: red;">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Write your blog content here..." >{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            

            <!-- Submit Button -->
            <div class="col-2 justify-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-plus-circle me-2"></i> Add Blog
                </button>
            </div>
        </form>
    </div>
@endsection