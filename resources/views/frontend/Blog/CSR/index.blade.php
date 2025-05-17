@extends('frontend.layout.master')
@section('pg_csr', 'active')
@section('content')
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif !important;
        }

        .small-image {
            width: 20px;
            /* Set the desired width */
            height: auto;
            /* Maintain aspect ratio */
        }
    </style>
    <div class="home-blog-area blog-h-padding pt-1">

        <div class="container">
            <hr class="pb-5">
            
            <div class="row">

                @foreach ($csr as $blog)
                    <div class="col-xl-6 col-lg-6 col-md-6" onclick="window.location.href='{{  route('frontend.blog_detail', ['id' => $blog->id, 'status' => $blog->status])}}';" style="cursor: pointer;">
                        <div class="home-blog-single mb-30">
                            <div class="blog-img-cap">
                                <div class="blog-img">
                                    <img class="small-image" src="{{ asset('assets/img/blog/' . $blog->img) }}"
                                        alt="{{ $blog->title }}">
                                </div>
                                <div class="blog-cap">
                                    <p class="d-flex justify-content-between align-items-center">
                                        <span>
                                            <i class="fas fa-user-circle  mr-2"></i>{{ $blog->user->first_name }}
                                        </span>
                                        <span>
                                            <i
                                                class="fas fa-calendar ml-5 mr-2"></i>{{ $blog->updated_at->format('l, d - M - Y') }}
                                        </span>
                                    </p>
                                    <h3><a
                                            href="{{ route('frontend.blog_detail', ['id' => $blog->id, 'status' => $blog->status]) }}">{{ $blog->blog_title }}</a>
                                    </h3>
                                    <p>
                                        {{ Str::limit($blog->description, 150) }}
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
