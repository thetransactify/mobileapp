@extends('auth.header')
<title>@yield('title', 'Email Verification')</title>
@section('content')
<section class="successMessageSec">
    <div class="containr">
        <div class="text-center">
            <h2 class="form-title">Registration Successfully</h2>
        </div>

        <div class="inner-wrapper">
            <div class="done-img">
                <img src="./assets/images/icon-done.png" alt="">
            </div>

            <a href="./login.html" class="btn btn-primary">Go to login</a>

            <p>We have sent a verification link to your email box.</p>

            <a href="#" class="email-verify-link">Please verify</a>
        </div>
    </div>
</section>
@endsection