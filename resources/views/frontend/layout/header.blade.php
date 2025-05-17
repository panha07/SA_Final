 
 <!-- Header Start -->
 <div class="header-area header-transparrent">
     <div class="headder-top header-sticky">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-lg-3 col-md-2">
                     <!-- Logo -->
                     <div class="logo">
                        <a href="{{ route('frontend.home') }}">
                            <img src="{{ asset('logo/fs_log.png') }}" alt="Company Logo" class="logo-img">
                        </a>
                    </div>
                 </div>
                 <div class="col-lg-9 col-md-10 ">
                     <div class="menu-wrapper">
                         <!-- Main-menu -->
                         <div class="main-menu">
                            <nav class="d-none d-lg-block">
                                <ul id="navigation">
                                    <li><a href="{{ route('frontend.home') }}" class="@yield('pg_home') ">Home</a></li>
                                    <li><a href="{{ route('frontend.about') }}" class="@yield('pg_about')">About Us</a></li>
                                    <li><a href="{{ route('frontend.companyActivities') }}" class="@yield('pg_activities')">Company Activities</a></li>
                                    <li><a href="{{ route('frontend.job_list') }}" class="@yield('pg_job')">Find Jobs</a></li>
                                    <li><a href="{{ route('frontend.csr') }}" class="@yield('pg_csr')">CSR</a></li>
                                    <li><a href="{{ route('frontend.contact') }}" class="@yield('pg_contact')">Contact Us</a></li>
                                    {{-- <li><a href="{{ route('frontend.create_CV') }}" class="@yield('pg_create_cv')">Create CV</a></li> --}}
                                </ul>
                            </nav>
                        </div>
                         <!-- Header-btn -->
                         <div class="header-btn d-none f-right d-lg-block">
                             @auth
                                 {{-- @include("backend.layout.css")
                                 @include('backend.layout.profile')
                                 @include("backend.layout.js") --}}
                                 <a href="{{ route('frontend.logout') }}" class="btn head-btn2">Logout</a>
                             @else
                                 {{-- <a href="{{ route('frontend.register') }}" class="btn btn-primary ">R</a> --}}
                                 {{-- <a href="{{ route('frontend.login') }}" class="btn btn-primary p-2 pt-4 pb-4">Login | Register</a> --}}
                            @endauth
                         </div>
                     </div>
                 </div>
                 <!-- Mobile Menu -->
                 <div class="col-12">
                     <div class="mobile_menu d-block d-lg-none"></div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Header End -->
