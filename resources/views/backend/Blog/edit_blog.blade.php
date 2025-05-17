@extends('backend.layout.master')
@section('backend_content')
    <hr />
    <br>
    <div class="container bg-white mb-4 p-4 rounded shadow-sm">
        @include('components.component')
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold">Edit Blog</h5>
            <a href="{{ route('blog') }}" class="btn btn-outline-secondary ">
                <i class="bi bi-arrow-left"></i> Back to Blog List
            </a>
        </div>

        <!-- Edit Blog Form -->
        <form action="{{ route('update_blog', ['id' => $blog->id]) }}" method="POST" enctype="multipart/form-data"
            class="row g-3">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" placeholder="Enter blog title" value="{{ old('title', $blog->blog_title) }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3 ">
                    <label for="status" class="form-label fw-bold">Post As :<span style="color: red;">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="">Please select</option>
                        <option value="1" {{ old('status', $blog->status) == '1' ? 'selected' : '' }}>Company Activities</option>
                        <option value="0" {{ old('status', $blog->status) == '0' ? 'selected' : '' }}>CSR</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mt-3">
                <!-- Current Image -->
                <div class="col-md-3">
                    <label class="form-label fw-bold">Current Image</label>
                    <div class="mb-3">
                        <!-- Clickable Image -->
                        <img src="{{ asset('assets/img/blog/' . $blog->img) }}" alt="{{ $blog->title }}"
                            class="img-fluid rounded cursor-pointer" style="max-width: 200px;" id="currentImage">
                    </div>
                </div>

                <!-- Hidden File Input -->
                <div class="col-md-4 d-none">
                    <label for="image" class="form-label fw-bold visually-hidden">Upload New Image (Optional)</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image" accept="image/*" onchange="previewImage(event)">
                    <small class="text-muted">Leave blank if you don't want to change the image.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Preview for New Image -->
                <div class="col-md-3 mt-3" id="newImagePreview" style="display: none;">
                    <label class="form-label fw-bold">New Image Preview</label>
                    <div class="mb-3">
                        <img id="preview" src="#" alt="New Image Preview" class="img-fluid rounded"
                            style="max-width: 200px;">
                    </div>
                </div>

            </div>
            <!-- Description -->
            <div class="col-md-11">
                <label for="description" class="form-label fw-bold">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="5" placeholder="Write your blog content here...">{{ old('description', $blog->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Submit Button -->
            <div class="col-2">
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="bi bi-save me-2"></i> Update Blog
                </button>
            </div>
        </form>
    </div>
    <script>
        // Trigger file input when the current image is clicked
        document.getElementById('currentImage').addEventListener('click', function() {
            document.getElementById('image').click(); // Programmatically trigger the file input
        });

        // Preview the selected image
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const newImagePreview = document.getElementById('newImagePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result; // Set the preview image source
                    newImagePreview.style.display = 'block'; // Show the preview section
                };

                reader.readAsDataURL(input.files[0]); // Read the selected file
            }
        }
    </script>
@endsection
