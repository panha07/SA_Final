@extends('frontend.layout.master')
@if ($blog->status == 0)
    @section('pg_csr', 'active')
@endif
@if ($blog->status == 1)
    @section('pg_activities', 'active')
@endif

@section('content')
    <style>
        .small-image {
            width: 150px;
            height: auto;
        }
    </style>
    
    <section class="blog_area single-post-area section-padding pt-0">
      
        <div class="container">
         <hr class="pb-4">
            <div class="mb-4">
                <button class="btn btn-primary btn-lg d-inline-flex align-items-center gap-2"
                    onclick="window.location.href='{{ $blog->status == 0 ? route('frontend.csr') : ($blog->status == 1 ? route('frontend.companyActivities') : '#') }}';">
                    <i class="fas fa-caret-left font-bold mr-3"></i>
                    {{ $blog->status == 0 ? 'Back to CSR' : ($blog->status == 1 ? 'Back to Company Activities' : 'Unknown Status') }}
                </button>
            </div>
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{ asset('assets/img/blog/' . $blog->img) }}"
                                alt="{{ $blog->blog_title }}">
                        </div>
                        <div class="blog_details">
                            <h2>
                                {{ $blog->blog_title }}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="fa fa-user"></i> {{ $blog->user->first_name }}</a></li>
                            </ul>
                            <p class="excert">
                                {{ $blog->description }}
                            </p>
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="d-sm-flex justify-content-between text-center">

                            <div class="col-sm-4 text-center my-2 my-sm-0">
                            </div>
                            {{-- <ul class="social-icons">
                      <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                      <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                      <li><a href="#"><i class="fab fa-behance"></i></a></li>
                   </ul> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>
                            {{-- @foreach ($blogs as $item)
                                <div class="media post_item"
                                    onclick="window.location.href='{{ route('frontend.blog_detail', ['id' => $blog->id, 'status' => $blog->status]) }}';"
                                    style="cursor: pointer;">
                                    <img class="img-fluid small-image" src="{{ asset('assets/img/blog/' . $item->img) }}"
                                        alt="{{ $item->blog_title }}">
                                    <div class="media-body">
                                        <a
                                            href="{{ route('frontend.blog_detail', ['id' => $blog->id, 'status' => $blog->status]) }}">
                                            <h3>{{ $item->blog_title }}</h3>
                                            <p>{{ Str::limit($item->description, 100, ' [Read More]') }}...</p>
                                        </a>
                                        <span>{{ $blog->updated_at->format('l, d - M - Y') }}</span>
                                    </div>
                                </div>
                            @endforeach --}}
                            @foreach ($blogs as $item)
    <div class="media post_item" onclick="window.location.href='{{ route('frontend.blog_detail', ['id' => $item->id, 'status' => $item->status]) }}';" style="cursor: pointer;">
        <!-- Blog Image -->
        <img 
            class="img-fluid small-image" 
            src="{{ asset('assets/img/blog/' . ($item->img ?? 'default.jpg')) }}" 
            alt="{{ $item->blog_title }}"
        >
        <div class="media-body">
            <!-- Blog Title and Description -->
            <a href="{{ route('frontend.blog_detail', ['id' => $item->id, 'status' => $item->status]) }}">
                <h3>{{ $item->blog_title }}</h3>
                <p>{{ Str::limit($item->description, 30, '...') }}</p>
            </a>
            <!-- Updated Date -->
            <small>{{ $item->updated_at->format('d - M - Y') }}</small>
        </div>
    </div>
@endforeach
                            <div class="pagination-area pb-115 text-center">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="single-wrap d-flex justify-content-end">
                                                <nav aria-label="Page navigation example">
                                                    {{ $blogs->appends([
                                                            'search' => request('search'),
                                                        ])->links('vendor.pagination.bootstrap-4') }}
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
