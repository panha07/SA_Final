  @extends('frontend.layout.master')
  @section('pg_home', 'active')
  @section('content')
      <!-- slider Area Start-->
      <div class="slider-area ">
          <!-- Mobile Menu -->
          <div class="slider-active">
              <div class="single-slider slider-height d-flex align-items-center"
                  data-background="{{ asset('assets/img/hero/h1_hero.png') }}">
                  {{-- <div class="container">
                      <div class="row">
                          <div class="col-xl-6 col-lg-9 col-md-10">
                              <div class="hero__caption">
                                  <h1>Cambodia <br><span class="mb-5"> HR & Carreer Agency </span> </h1>
                              </div>
                          </div>
                      </div> --}}
                  <!-- Search Box -->
                  {{-- <div class="row">
                          <div class="col-xl-8">
                              <!-- form -->
                              <form action="#" class="search-box">
                                  <div class="input-form">
                                      <input type="text" placeholder="Job Tittle or keyword">
                                  </div>
                                  <div class="select-form">
                                      <div class="select-itms">
                                          <select name="select" id="select1">
                                              <option value="">Location BD</option>

                                          </select>
                                      </div>
                                  </div>
                                  <div class="search-form">
                                      <a href="#">Find job</a>
                                  </div>
                              </form>
                          </div>
                      </div> --}}
                  {{-- </div> --}}
              </div>
          </div>
      </div>
      <!-- slider Area End-->
      <!-- Our Services Start -->
      <div class="our-services section-pad-t30 pt-0 pb-5">
          <div class="container">
              <!-- Section Tittle -->
              <div class="row">
                  <div class="col-lg-12">
                      <div class="section-tittle text-center">
                          <span>FEATURED TOURS Packages</span>
                          <h2>Browse Top Categories </h2>
                      </div>
                  </div>
              </div>

              <div class="row d-flex justify-contnet-center">
                  @if (!$noData)
                      @foreach ($jobCategories as $category)
                          <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6"
                              onclick="window.location.href='{{ route('frontend.job_list', ['category' => $category->id]) }}';"
                              style="cursor: pointer;">
                              <div class="single-services text-center mb-30">
                                  <div class="services-ion">
                                    
                                    <i class="{{ $category->icon ? $category->icon : 'fas fa-user-circle' }} pb-2"style="font-size: 2rem; font-weight: bold; color:#28395a"></i>
                                  </div>
                                  <div class="services-cap">
                                      <h5 class="pr-3 pl-3"><a href="{{ route('frontend.job_list',['category' => $category->id]) }}">{{ $category->name }}</a></h5>
                                      <span>({{ $category->jobs_count ?? '0' }})</span>
                                  </div>
                              </div>
                              </a>
                          </div>
                      @endforeach
                  @endif

              </div>
              <!-- More Btn -->
              <!-- Section Button -->
              <div class="row">
                  <div class="col-lg-12">
                      <div class="browse-btn2 text-center mt-50">
                          <a href="{{ route('frontend.job_list') }}" class="border-btn2">Browse All Sectors</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Our Services End -->
      <!-- Online CV Area Start -->
      {{-- <div class="online-cv cv-bg section-overly pt-90 pb-120" data-background="assets/img/gallery/cv_bg.jpg">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xl-10">
                      <div class="cv-caption text-center">
                          <p class="pera1">FEATURED TOURS Packages</p>
                          <p class="pera2"> Make a Difference with Your Online Resume!</p>
                          <a href="#" class="border-btn2 border-btn4">Upload your cv</a>
                      </div>
                  </div>
              </div>
          </div>
      </div> --}}
      <!-- Online CV Area End-->
      <!-- Featured_job_start -->
      <section class="featured-job-area feature-padding pt-0">
          <div class="container">
              <!-- Section Tittle -->
              <div class="row">
                  <div class="col-lg-12">
                      <div class="section-tittle text-center">
                          <span>Recent Job</span>
                          <h2>Featured Jobs</h2>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-xl-10">
                      <!-- single-job-content -->
                      @foreach ($jobs as $job)
                      <div class="single-job-items  pr-5 pl-4 " onclick="window.location.href='{{ route('frontend.job_details', $job->id) }}';" style="cursor: pointer;">
                        <div class="job-items">
                            <div class="job-tittle">
                                <a href="{{ route('frontend.job_details', $job->id) }}">
                                    <h6>{{ $job->title }}</h6>
                                </a>
                                <ul class="justify-between mb-0">

                                    @if ($job->experience == 0)
                                        <small>
                                           Experience: Not required
                                        </small>
                                    @else
                                        <small>
                                            Experience: {{ $job->experience }} Year(s)
                                        </small>
                                    @endif
                                    </small>
                                    <small>
                                    |{{ $job->salary->salary_rank }}
                                    | 
                                        @if ($job->jobLocations->isNotEmpty())
                                            {{ $job->jobLocations->first()->location->province->province }},
                                            {{ $job->jobLocations->first()->location->district->district ?? '' }}
                                            ({{ $job->jobLocations->first()->location->desc ?? '' }})
                                        @endif
                                    </small>
                                </ul>
                            </div>
                        </div>
                        <div class="items-link f-right">
                            <a class="mb-1"
                                href="{{ route('frontend.job_details', $job->id) }}">{{ $job->jobType->name }}</a>
                            <span
                                style="color:rgb(181, 181, 181)">{{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <hr class="pb-1 mr-4">
                      @endforeach

                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="browse-btn2 text-center mt-50">
                              <a href="{{ route('frontend.job_list') }}" class="border-btn2">Browse All Jobs</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Featured_job_end -->
      <!-- How  Apply Process Start-->
      {{-- <div class="apply-process-area apply-bg pt-150 pb-150" data-background="assets/img/gallery/how-applybg.png">
          <div class="container">
              <!-- Section Tittle -->
              <div class="row">
                  <div class="col-lg-12">
                      <div class="section-tittle white-text text-center">
                          <span>Apply process</span>
                          <h2> How it works</h2>
                      </div>
                  </div>
              </div>
              <!-- Apply Process Caption -->
              <div class="row">
                  <div class="col-lg-4 col-md-6">
                      <div class="single-process text-center mb-30">
                          <div class="process-ion">
                              <span class="flaticon-search"></span>
                          </div>
                          <div class="process-cap">
                              <h5>1. Search a job</h5>
                              <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.
                              </p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="single-process text-center mb-30">
                          <div class="process-ion">
                              <span class="flaticon-curriculum-vitae"></span>
                          </div>
                          <div class="process-cap">
                              <h5>2. Apply for job</h5>
                              <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.
                              </p>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                      <div class="single-process text-center mb-30">
                          <div class="process-ion">
                              <span class="flaticon-tour"></span>
                          </div>
                          <div class="process-cap">
                              <h5>3. Get your job</h5>
                              <p>Sorem spsum dolor sit amsectetur adipisclit, seddo eiusmod tempor incididunt ut laborea.
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div> --}}
      <!-- How  Apply Process End-->
  @endsection
