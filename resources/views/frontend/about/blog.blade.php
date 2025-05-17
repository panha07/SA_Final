<style>
    .small-image {
        width: 20px; /* Set the desired width */
        height: auto; /* Maintain aspect ratio */
    }
    </style>
<div class="container">
    <!-- Section Tittle -->
    <div class="row">
        <div class="col-lg-12">
            <div class="section-tittle text-center">
                <span>Our latest blog</span>
                <h2>Company Activities  </h2>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- {{dd('$blogs')}} --}}
        @foreach ($com_ac as $blog)
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="home-blog-single mb-30">
                <div class="blog-img-cap">
                    <div class="blog-img">
                        <img class="small-image" src="{{ asset('assets/img/blog/' . $blog->img) }}" alt="{{ $blog->title }}">
                        <!-- Blog date -->
                        <div class="blog-date text-center">
                            <span>{{$blog->updated_at->format('l, d - M - Y')}}</span>
                        </div>
                    </div>
                    <div class="blog-cap">
                        <p>| <i class="fas fa-user-circle ml-3 mr-2"></i>{{$blog->user->first_name}}</p>
                        <h3><a href="single-blog.html">{{$blog->blog_title}}</a></h3>
                        <h6><a href="{{route('frontend.blog_detail',$blog->id)}}">{{ Str::limit($blog->description, 150, ' [Read More]') }}...</a></h6>
                        <a href="#" class="more-btn">Read more »</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
       
    </div>
</div>