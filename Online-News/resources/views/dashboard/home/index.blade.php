@extends('layouts.dashboardmaster')

@section('title')
    Home
@endsection

@section('content')
<x-breadcum onlineNews="Home Page"></x-breadcum>

<div class="row text-center">
   <h4><strong>Welcome {{auth()->user()->name}}</strong></h4>
</div>
{{-- user request --}}
    @if (Auth::user()->role == 'user')
            @if (!$request)
                <div class="row">
                    <div class="col-lg-12">
                        <p class="mb-2">
                            <button style="margin-left: 25%" class="btn btn-primary col-lg-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="true" aria-controls="collapseWidthExample">
                                Do you want Promotion?
                            </button>
                        </p>
                        <div style="min-height: 120px; margin-left: 25%;">
                            <div class="collapse-horizontal collapse" id="collapseWidthExample">
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title mb-3">Bloger Request form</h4>

                                            <form role="form" action="{{ route('promotion.request',Auth::user()->id) }}" method="POST">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Message</label>
                                                    <div class="col-sm-9">
                                                        <textarea type="text" class="form-control" id="inputEmail3" name="message" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="justify-content-end row">
                                                    <div class="col-sm-9">
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Send Request</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                    </div>
                </div>
            @endif
    @endif



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
