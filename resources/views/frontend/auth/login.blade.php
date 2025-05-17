<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
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
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{route('frontend.home')}}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <h1> Job Posting </h1>
                                </a>
                                @include('components.component')
                                <form method="post" action="{{ route('frontend.do-login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="Email1" class="form-label">Email</label>
                                        <input type="email" class="form-control  @error('email') 
                                              is-invalid
                                              @enderror" 
                                        id="Email1"
                                            name="email" value="{{ old('email') }}" aria-describedby="emailHelp"
                                            placeholder="Email">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="Password1" class="form-label  @error('password') 
                                              is-invalid
                                              @enderror">Password</label>
                                        <input type="password" class="form-control" id="Password1"
                                            placeholder="Password" name="password" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value="1"
                                                id="flexCheckChecked" name="rememberMe"
                                                {{ old('rememberMe') ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remember this Device
                                            </label>
                                        </div>

                                        <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Sign In</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Don't have Account</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('frontend.register') }}">Create an
                                            account</a>
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
