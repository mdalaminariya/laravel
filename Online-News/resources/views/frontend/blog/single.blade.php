@extends('layouts.FrontendMaster')

@section('content')
    <!--post-single-->
    <section class="post-single">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-lg-12">
                    <!--post-single-image-->
                        <div class="post-single-image d-flex justify-content-center">
                            <img src="{{ asset('upload/blog') }}/{{ $blog->thumbnail }}" alt="">
                        </div>

                        <div class="post-single-body">
                            <!--post-single-title-->
                            <div class="post-single-title">
                                <h2> {{ $blog->title }}</h2>
                                <ul class="entry-meta">
                                   @if ($blog->one_user->image == 'user.png')
                                     <li class="post-author-img"><img src="{{ Avatar::create($blog->one_user->name)->toBase64();}}" alt=""></li>
                                   @else
                                   <li class="post-author-img"><img src="{{ asset('upload/profile') }}/{{ auth()->user()->image }}" alt=""></li>
                                   @endif
                                    <li class="post-author"> <a href="author.html">{{ $blog->one_user->name }}</a></li>
                                    <li class="entry-cat"> <a href="blog-layout-1.html" class="category-style-1 "> <span class="line"></span>{{ $blog->one_user->role }}</a></li>
                                    <li class="post-date"> <span class="line"></span>{{ Carbon\Carbon::parse($blog->created_at)->format('d M-D,Y') }}</li>
                                </ul>

                            </div>

                            <!--post-single-content-->
                            <div class="post-single-content">
                                <h2>Short Description</h2>
                                <p>
                                    {!! $blog->short_description !!}
                                </p>
                                <h4>Full Description</h4>
                                <p>
                                    {!! $blog->description !!}
                                </p>
                            </div>

                            <!--post-single-bottom-->
                            <div class="post-single-bottom">
                                <div class="tags">
                                    <p>Tags:</p>
                                    <ul class="list-inline">
                                        <li >
                                            <a href="blog-layout-2.html">brading</a>
                                        </li>
                                        <li >
                                            <a href="blog-layout-2.html">marketing</a>
                                        </li>
                                        <li >
                                            <a href="blog-layout-3.html">tips</a>
                                        </li>
                                        <li >
                                            <a href="blog-layout-4.html">design</a>
                                        </li>
                                        <li >
                                            <a href="blog-layout-5.html">business
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="social-media">
                                    <p>Share on :</p>
                                    <ul class="list-inline">
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" >
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" >
                                                <i class="fab fa-pinterest"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!--post-single-author-->
                            <div class="post-single-author">
                                <div class="authors-info d-flex justify-content-center">
                                    <div class="image">
                                        <a href="author.html" class="image">
                                            <img src="{{Avatar::create($blog->one_user->name)->toBase64()}}" alt="">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h4>{{ $blog->one_user->name }}</h4>
                                        <p> {{$blog->one_user->email}}
                                        </p>
                                        {{-- <div class="social-media">
                                            <ul class="list-inline">
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" >
                                                        <i class="fab fa-youtube"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" >
                                                        <i class="fab fa-pinterest"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>


                            <!--post-single-comments-->
                            @auth
                                <div class="post-single-comments">
                                    <!--Comments-->
                                    <h4 >{{ $comments->count() }} Comments</h4>
                                    <ul class="comments">
                                        <!--comment1-->
                                        @foreach ($comments as $comment)
                                            <li class="comment-item pt-0">
                                                @if ($comment->oneUser->image == 'user.png')
                                                    <img src="{{ Avatar::create($comment->oneUser->name)->toBase64() }}" alt="">
                                                @else
                                                    <img src="{{ asset('upload/profile') }}/{{ $comment->oneUser->image }}" alt="">
                                                @endif
                                                <div class="content">
                                                    <div class="meta">
                                                        <ul class="list-inline">
                                                            <li><a href="#">{{ $comment->name }}</a> </li>
                                                            <li class="slash"></li>
                                                            <li>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</li>
                                                        </ul>
                                                    </div>
                                                    <p>{{ $comment->comment }}</p>
                                                    <a href="#commentReply" onclick="myFun({{ $comment->id }})" class="btn-reply OnlineNews"><i style="margin-top: -.5px" class="las la-reply mb-3"></i> Reply</a>
                                                </div>
                                            </li>

                                            @foreach ($comment->replies as $reply)
                                            <li class="comment-item pl-5">
                                                @if ($reply->oneUser->image == 'user.png')
                                                    <img src="{{ Avatar::create($reply->oneUser->name)->toBase64() }}" alt="">
                                                @else
                                                    <img src="{{ asset('upload/profile') }}/{{ $reply->oneUser->image }}" alt="">
                                                @endif
                                                <div class="content">
                                                    <div class="meta">
                                                        <ul class="list-inline">
                                                            <li><a href="#">{{ $reply->name }}</a> </li>
                                                            <li class="slash"></li>
                                                            <li>{{ Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</li>
                                                        </ul>
                                                    </div>
                                                    <p>{{ $reply->comment }}</p>
                                                    <a href="#commentReply" onclick="myFun({{ $reply->id }})" class="btn-reply OnlineNews"><i style="margin-top: -.5px" class="las la-reply mb-3"></i> Reply</a>
                                                </div>
                                            </li>
                                            @endforeach

                                            @foreach ($reply->replies as $replies)
                                            <li class="comment-item pl-5">
                                                @if ($replies->oneUser->image == 'user.png')
                                                    <img src="{{ Avatar::create($replies->oneUser->name)->toBase64() }}" alt="">
                                                @else
                                                    <img src="{{ asset('upload/profile') }}/{{ $replies->oneUser->image }}" alt="">
                                                @endif
                                                <div class="content">
                                                    <div class="meta">
                                                        <ul class="list-inline">
                                                            <li><a href="#">{{ $replies->name }}</a> </li>
                                                            <li class="slash"></li>
                                                            <li>{{ Carbon\Carbon::parse($replies->created_at)->diffForHumans() }}</li>
                                                        </ul>
                                                    </div>
                                                    <p>{{ $replies->comment }}</p>
                                                </div>
                                            </li>
                                            @endforeach

                                        @endforeach
                                    </ul>
                                        <!--pagination-->
                                            <div class="pagination mt-3 mb-3">
                                                <div class="container-fluid">
                                                {{ $comments->links() }}
                                                </div>
                                            </div>

                                    <!--Leave-comments-->
                                    <div class="comments-form" id="commentReply">
                                        <h4 >Leave a Reply</h4>
                                        <!--form-->
                                        <form class="form " action="{{ route('frontend.blog.comment',$blog->id) }}" method="POST" id="main_contact_form">
                                            @csrf
                                            <p>Your email adress will not be published ,Requied fileds are marked*.</p>
                                            <div class="alert alert-success contact_msg" style="display: none" role="alert">
                                                Your message was sent successfully.
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name*">
                                                        <input type="text" name="parent_id" id="OnlineNews" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email*">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="comment" id="message" cols="30" rows="5" class="form-control" placeholder="Message*"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">

                                                    <button type="submit" name="submit" class="btn-custom">
                                                        Send Comment
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!--/-->
                                    </div>
                                </div>
                            @endauth
                        </div>
                </div>
            </div>
        </div>
    </section>
<script>

    let OnlineNews = document.querySelector('#OnlineNews');

  function myFun(id){
    OnlineNews.value = id;

  }

</script>
@endsection

@section('script')
@if (session('success'))
    <script>
        Toastify({
    text: "{{ session('success') }}",
    duration: 3000,
    newWindow: true,
    close: true,
    gravity: "top", // `top` or `bottom`
    position: "center", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
    background: "linear-gradient(to right, #00C9FF, #92FE9D)",
    },
    onClick: function(){} // Callback after click
    }).showToast();
    </script>
@endif
@endsectio
