@extends('layouts.FrontendMaster')

@section('content')

    <!--section-heading-->
   <div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>{{ $category->title }}</h1>
                         <p class="links"><a href="index.html">Home <i class="las la-angle-right"></i></a> Blog</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>


 <!-- Blog Layout-2-->
 <section class="blog-layout-2">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <!--post-->
                 @forelse ($blogs as $blog)
                    <div class="post-list post-list-style2">
                        <div class="post-list-image">
                            <a href="post-single.html">
                                <img src="{{ asset('upload/blog') }}/{{ $blog->thumbnail }}" alt="" style="width: 20rem; height:18rem; background: none;">
                            </a>
                        </div>
                        <div class="post-list-content" style="text-align: center">
                            <h3 class="entry-title">
                                <a href="post-single.html">{{ $blog->title }}</a>
                            </h3>
                            <ul class="entry-meta">
                                @if ($blog->one_user->image == 'user.png')
                                    <li class="post-author-img"><img src="{{Avatar::create($blog->one_user->name)->toBase64()}}" alt=""></li>
                                @else
                                    <li class="post-author-img"><img src="{{ asset('upload/profile') }}/{{ auth()->user()->image }}" alt=""></li>
                                @endif
                                <li class="post-author"> <a href="author.html">{{ $blog->one_user->name }}</a></li>
                                <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span> {{ $blog->one_user->role }}</a></li>
                                <li class="post-date"> <span class="line"></span> {{ Carbon\Carbon::parse($blog->created_at)->format('d F- D ,Y') }}</li>
                            </ul>
                            <div class="post-exerpt">
                                <p>{!! $blog->short_description !!}</p>
                            </div>
                            <div class="post-btn">
                                <a href="{{ route('frontend.blog.single', $blog->slug) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                 @empty
                 <div class="post-list post-list-style2">
                    <div class="post-list-image">
                        <a href="post-single.html">
                            <img src="{{Avatar::create('ND')->toBase64();}}" alt="" style="height: 20rem; width: 25rem; padding-left: 20%; padding-top: 5%; padding-bottom: 5%;">
                        </a>
                    </div>
                    <div class="post-list-content">
                        <h3 class="text-danger text-center">
                            There Have No Data.! </h3>
                        <p style="color: blueviolet"><i>This Blog page is Empty</i></p>
                    </div>
                </div>
                 @endforelse
             </div>
         </div>
     </div>
 </section>
 <hr>


<!--pagination-->
<div class="pagination mt-3 mb-3">
     <div class="container-fluid">
         {{ $blogs->links() }}
     </div>
 </div>

@endsection
