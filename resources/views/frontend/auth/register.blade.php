<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    @include('backend.layout.css')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-4"> 
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <h1> Job Posting </h1>
                                </a>
                                <p class="text-center">Free to Registering</p>
                                <form method="post" action="{{ route('frontend.registration') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text"
                                            class="form-control
                                             @error('first_name') 
                                              is-invalid
                                              @enderror"
                                            id="first_name" name="first_name" placeholder="First Name"
                                            value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name"
                                            class="form-label 
                                        @error('last_name') 
                                              is-invalid
                                              @enderror">Last
                                            Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            placeholder="Last Name" value="{{ old('last_name') }}">
                                            @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="email"
                                            class="form-label 
                                        @error('email') 
                                              is-invalid
                                              @enderror">Email
                                            Address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="example@gmail.com" value="{{ old('email') }}">
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password"
                                            class="form-label
                                        @error('password') 
                                              is-invalid
                                              @enderror">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" value="{{old('password')}}">
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="confirm_password"
                                            class="form-label 
                                        @error('confirm_password') 
                                              is-invalid
                                              @enderror">Confirm
                                            Password</label>
                                        <input type="password" class="form-control" id="confirm_password"
                                            name="confirm_password" placeholder="Password Again">
                                            @error('confirm_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Sign Up</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('frontend.login') }}">Sign In</a>
                                        
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Create a Company Account?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('frontend.company-register') }}">Sign Up</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.layout.js')
</body>

</html>
