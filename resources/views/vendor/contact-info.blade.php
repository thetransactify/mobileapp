@extends('layouts.app')
<title>@yield('title', 'My-clients')</title>
@section('content')
<section class="form-sec">
    <div class="container">
        <div class="text-left">
        </div>

        <div class="form-container">
            <div class="form-navigation">
                <nav>
                    <li class="tab-item">
                        <a href="{{url('contact-info')}}" class="tab-active">Contact Information</a>
                    </li>
                    <li class="tab-item">
                        <a href="{{url('change-password')}}">Change password</a>
                    </li>
                </nav>
            </div>
            <div class="inner-wrapper">
                <div class="form-body">
                    <form action="#">
                        <div class="input-wrapper">
                            <label for="accountName" class="input-title light">Account name</label>
                            <input type="text" name="account-name" id="accountName" class="form-control" value="{{$user->name}}" readonly>
                        </div>
                        <div class="input-wrapper">
                            <label for="registeredNo" class="input-title light">Registered number</label>
                            <input type="tel" name="registered-no" id="registeredNo" class="form-control" value="{{$user->mobile}}" readonly>
                        </div>
                        <div class="input-wrapper">
                            <label for="contactEmail" class="input-title light">Email address</label>
                            <input type="tel" name="contact-email" id="contactEmail" class="form-control" value="{{$user->email}}" readonly>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
