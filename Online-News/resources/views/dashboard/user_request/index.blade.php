@extends('layouts.dashboardmaster')

@section('title')
   User Request
@endsection

@section('content')

<x-breadcum onlineNews="User Request"></x-breadcum>

<div class="row my-4" style="background-color: rgba(240, 255, 255, 0.568);">
    @foreach ($requests as $request)
        <div class="col-lg-3 col-xl-3 my-3 mb-1">
            <!-- Simple card -->
            <div class="card">
                @if ($request->oneuser->image == 'user.png')
                <img style="height: 140px; width: 70%; margin: 10px 0 0 35px; object-fit: contain;" class="card-img-top img-fluid" src="{{ asset('upload/default') }}/{{ $request->oneuser->image }}" alt="Card image cap">
                @else
                <img style="height: 140px; width: 70%; margin: 10px 0 0 35px; object-fit: contain;" class="card-img-top img-fluid" src="{{ asset('upload/profile') }}/{{ $request->oneuser->image }}" alt="Card image cap">
                @endif
                <div class="card-body">
                    <h5 class="card-title"><strong>Message</strong></h5>
                    <p class="card-text">{{ $request->message }}</p>
                    <a href="{{ route('promotion.request.accept',$request->id) }};" class="btn btn-primary waves-effect waves-light" style="margin-left: 1.4rem">Accept</a>
                    <a href="{{ route('promotion.request.cancel',$request->id) }};" class="btn btn-danger waves-effect waves-light mx-3">Cancel</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

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
@endsection
