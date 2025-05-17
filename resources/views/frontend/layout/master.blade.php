<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>First Solutions Cambodia</title>
       
        <meta name="description" content="Find the best job opportunities in Cambodia with First Solutions. We connect businesses with top talent.">
        <meta name="keywords" content="jobs, job search, recruitment, Cambodia, First Solutions, job vacancy, job opening, hiring now, immediate hiring, full-time job, part-time job, remote job, work from home, internship, accounting jobs, sales representative, customer service jobs, marketing jobs, HR jobs, IT support, receptionist, business development, graphic designer, project manager, logistics jobs, engineer jobs, high salary, competitive salary, fresh graduate jobs, no experience needed, jobs near me, urgent hiring, career opportunities, best jobs in Cambodia, Phnom Penh jobs, Siem Reap jobs, Battambang jobs">
        <meta name="author" content="First Solutions Cambodia">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo/logo.png') }}">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
        <!-- CSS here -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/price_rangs.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link
            href="https://fonts.googleapis.com/css2?family=Noto+Serif+Khmer:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">

        <style>
           
            .logo-img {
                max-height: 60px;
                max-width: 100%;
            }

            body {
                font-family: 'Poppins', sans-serif;
            }

            .khmer-text {
                font-family: 'Noto Serif Khmer', serif;
            }

            #navigation li a.active {
                border: 2px solid;
                padding: 9px 10px;
                border-radius: 20px;
                font-weight: bold;
                color: rgb(241, 156, 157);
            }

            #navigation li a:hover {
                text-decoration: none;
            }

            .small-text {
                font-size: 0.9rem;
                line-height: 1.2;
            }

            .items-link a {
                font-size: 0.9rem;
                text-decoration: none;
            }

            .items-link span {
                font-size: 0.6rem;

            }

            .single-job-items {
                margin-bottom: 0.3rem;
                padding: 0.3rem;
            }

            .single-job-items:hover {
                box-shadow: none;
                background: rgba(245, 245, 245, 0.521);
                padding: 30px;
            }
        </style>
    </head>

    <body>
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="{{ asset('logo/fs_log.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <header>
            @include('frontend.layout.header')

        </header>
        <main>

            @yield('content')

        </main>
        <footer class="mb-0 pb-0">
            @include('frontend.layout.footer')
        </footer>

        <!-- All JS Custom Plugins Link Here here -->
        <script src="{{ asset('./assets/js/vendor/modernizr-3.5.0.min.js') }}"></script> 
        <script src = "{{ asset('./assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('./assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('./assets/js/bootstrap.min.js') }}"></script>
        <!-- Jquery Mobile Menu -->
        <script src="{{ asset('./assets/js/jquery.slicknav.min.js') }}"></script>

        <!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{ asset('./assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('./assets/js/slick.min.js') }}"></script>
        <script src="{{ asset('./assets/js/price_rangs.js') }}"></script>

        <!-- One Page, Animated-HeadLin -->
        <script src="{{ asset('./assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('./assets/js/animated.headline.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.magnific-popup.js') }}"></script>

        <!-- Scrollup, nice-select, sticky -->
        <script src="{{ asset('./assets/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.sticky.js') }}"></script>

        <!-- contact js -->
        <script src="{{ asset('./assets/js/contact.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.form.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('./assets/js/mail-script.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.ajaxchimp.min.js') }}"></script>

        <!-- Jquery Plugins, main Jquery -->
        <script src="{{ asset('./assets/js/plugins.js') }}"></script>
        <script src="{{ asset('./assets/js/main.js') }}"></script>
    
    </body>

</html>
