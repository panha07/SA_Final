@extends('frontend.layout.master')
@section('pg_about', 'active')
@section('content')
    <style>
        .support-company-area,
        .support-company-area * {
            font-family: "Poppins", Arial, sans-serif !important;
        }

        .section {
            padding: 50px 20px;
        }

        .icon-img {
            width: 80px;
            height: auto;
        }

        .small-img {
            width: 50px;
            height: auto;
        }
    </style>


    <div class="slider-area">
        {{-- <img src="assets/img/gallery/bg.jpg" alt=""> --}}
        {{-- <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>About us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <div class="support-company-area fix ">
            <div class="container">
                <hr class="pb-5">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="right-caption position-relative z-3">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle2">
                                <h4>
                                    <span>
                                        <h2>
                                            First Solutions Cambodia
                                        </h2>
                                        
                                        A Message From Our CEO & Founder
                                    </span>
                                </h4>


                            </div>
                            <div>
                                <p class="text-9xl">
                                    At First Solutions – Cambodia, we understand that people are the heart of any successful
                                    organization. Our mission is simple — to connect businesses with the right talent and
                                    empower individuals to find opportunities where they can thrive. In today’s
                                    ever-evolving global economy, having the right team in place is more crucial than ever,
                                    and it’s our privilege to be part of that journey for both our clients and candidates.
                                </p>
                                <p class="text-9xl">
                                    As an HR Recruitment Agency based in Cambodia, we pride ourselves on our deep
                                    understanding of the local market and the diverse industries that make up our dynamic
                                    economy. Whether it’s for a multinational corporation or a local startup, we work
                                    tirelessly to ensure that every candidate we place is the perfect fit, and every
                                    business we serve is equipped with the talent needed to achieve their goals.
                                </p>
                                <p class="text-9xl">
                                    Our team is driven by a shared vision to provide personalized, professional recruitment
                                    services that meet the unique needs of our clients and candidates. With years of
                                    experience, a strong network of talent, and a commitment to excellence, we’re here to
                                    make the hiring process as seamless, efficient, and rewarding as possible for everyone
                                    involved.
                                </p>
                                <p class="text-9xl">
                                    As we continue to grow and adapt to the changing needs of the workforce, we remain
                                    focused on our core values of integrity, trust, and innovation. We believe that
                                    successful recruitment goes beyond just matching qualifications — it’s about
                                    understanding the culture, values, and aspirations of both employers and candidates.
                                </p>
                                <p class="text-9xl">
                                    We are excited about the future and the opportunity to play a part in shaping the
                                    success of businesses and individuals throughout Cambodia. Whether you're looking for
                                    the perfect hire, or seeking new career opportunities, we are here to help you succeed.
                                </p>
                                <p class="text-9xl">
                                    Thank you for trusting us to be your recruitment partner.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="home-blog-single mb-30 col-xl-6 col-lg-5" style="box-shadow: none;">
                        <div class="blog-img-cap support-location-img  ">
                            <div class="blog-img position-relative z-1">
                                <img src= "{{ asset('assets/img/service/manager.PNG') }}" alt="" class="img-fluid">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="support-location-img">
                        {{-- <img src="{{ asset('assets/img/service/aboutus.png') }}" alt=""> --}}
                        <section class="section container text-center">
                            <div class="row home-blog-single shadow-none">
                                <div class="col-md-6 blog-img-cap">
                                    <div class="blog-img">

                                        <img src="{{ asset('assets/img/service/53.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="col-md-12 text-start mt-100">
                                        <h5 class="pt-50">Our Commitment</h5>
                                        <p>
                                            At FS our clients are the heart of our business and we listen and respond to
                                            their
                                            concerns. Acting responsibly is an intrinsic part of what we do and it makes
                                            good
                                            business sense. We want to be successful, but we also want to make difference.
                                        </p>
                                    </div>
                                    <div class="col-md-12 text-start ">
                                        <h5 class="pt-50">Our Experience</h5>
                                        <p>
                                            We roll up our sleeves and work collaboratively with our client partners to
                                            deliver
                                            the bet possible value for their investment and in doing so we build an
                                            inseparable
                                            relationship with our clients by understanding their needs and delivering
                                            solutions
                                            that they truly value.
                                        </p>
                                    </div>
                                </div>


                            </div>
                        </section>



                        <section class="section container text-center ">
                            <div class="row blog-img-cap ">
                                <div class="col-md-4 home-blog-single shadow-none">
                                    <div class="blog-img">

                                        <img src="{{ asset('assets/img/service/55.png') }}" alt="">
                                    </div>
                                    <h5>Trust & Integrity</h5>
                                    <p class="text-start">FS is the result of long experience with SMEs and large
                                        international groups, a deep
                                        commitment to values relating to working in business, friendship, performance, and
                                        citizenship. Since 2015, we have been advising and supporting companies during their
                                        development phase and put human and financial resource in place that reflect our
                                        ambitions.</p>
                                </div>
                                <div class="col-md-4 home-blog-single shadow-none ">
                                    <div class="blog-img">
                                        <img src="{{ asset('assets/img/service/56.png') }}" alt="">
                                    </div>
                                    <h5>Innovation</h5>
                                    <p>Our added value: a day-to-day challenge, strong bonds of trust, customized service
                                        and the latest recruitment tools for ever better recruitment process. We strongly
                                        stand behind each of our engagements. We are firmly committed to our clients’
                                        success
                                        we understand that our success will naturally follow.</p>
                                </div>
                                <div class="col-md-4 home-blog-single shadow-none">
                                    <div class="blog-img">
                                        <img src="{{ asset('assets/img/service/54.png') }}" alt="">
                                    </div>
                                    <h5>Collaboration</h5>
                                    <p class="text-end">Our focused qualitative approach means we enjoy a leading position
                                        in sectors such as
                                        retail distribution, hotel and catering, construction, industry, information
                                        technology, business services, and consultancy.
                                        FS is above all about expertise and a team spirit focusing on client satisfaction &
                                        career development for our candidates.</p>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
