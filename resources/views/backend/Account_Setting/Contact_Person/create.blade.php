@extends('backend.layout.master')

@section('backend_content')
    @include('components.component')
    <div class="container mt-4">
    <a href="{{ route('contactPerson') }}" class="btn btn-secondary mb-3">
        <i class="fas fa-chevron-circle-left"></i> Back
    </a>
    <h2>Add Contact Person</h2>
    <form action="{{ route('store_person') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="department" name="department" value="{{old('department')}}" >
            @error('department')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control" id="position" name="position" value="{{old('position')}}" >
            @error('position')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" >
            @error('phone')
                <div class="text-danger">{{ $message }}</div>   
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" >
            @error('email')
                <div class="text-danger">{{ $message }}</div>  
            @enderror
        </div>
        <button type="submit" class="btn btn-danger">Add</button>
    </form>
</div>
@endsection
