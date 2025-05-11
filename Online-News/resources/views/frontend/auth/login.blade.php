@extends('layouts.FrontendMaster')

@section('content')

<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Login</h4>
                    <!--form-->
                    <form  class="sign-form widget-form" action="{{ route('auth.login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="E-mail*" name="email" value="">
                            @error('email')
                            <p class="text-center text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password*" name="password" value="">
                            @error('password')
                            <p class="text-center text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember Me</label>
                            </div>
                            <a href="#" class="btn-link ">Forgot Password?</a>
                            </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Login</button>
                        </div>
                        <p class="form-group text-center">Don't Have account? <a href="{{ route('auth.singup') }}" class="btn-link">sing up</a> </p>
                    </form>
                       <!--/-->
                </div>
            </div>
         </div>
    </div>
</section>

@endsection

@section('script')
@if (session('success'))
    <script>
        Toastify({
    text: "{{ session('success') }}",
    duration: 1000,
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
