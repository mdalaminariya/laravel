@extends('layouts.FrontendMaster')

@section('content')

 <section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="d-flex justify-content-between" style="font-size: 1.5rem">
                    <a href="/auth/google/redirect" class="btn-light text-success" style="border: 1px solid #ffffff; border-radius: 50%; border-width: 1.5rem; padding: 15px 25px; text-align: center; text-decoration-color: green;"><i class="fa-brands fa-google"></i></a>
                    <a href="/auth/facebook/redirect" class="btn-primary" style="border: 1px solid #ffffff; border-radius: 50%; border-width: 1.5rem; padding: 15px 25px; text-align: center;"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <div class="login-content">
                    <h4>Sign up</h4>
                    <!--form-->
                    <form  class="sign-form widget-form" action="{{ route('auth.singup') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Username*" name="name" value="">
                        @error('name')
                        <p class="text-center text-danger">{{ $message }}</p>
                        @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address*" name="email" value="">
                        @error('email')
                        <p class="text-center text-danger">{{ $message }}</p>
                        @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password*" name="password" value="">
                        @error('password')
                        <p class="text-center text-danger">{{ $message }}</p>
                        @enderror
                        </div>

                         <div class="form-group mb-2">
                                {!! NoCaptcha::display() !!}
                            </div>

                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center">Already have an account? <a href="{{ route('auth.login') }}" class="btn-link">Login</a> </p>
                    </form>
                       <!--/-->
                </div>
            </div>
         </div>
    </div>
</section>

@endsection
