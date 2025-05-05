<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard')</title>
        <!-- Favicons -->
    <link rel="shortcut icon" href="{{asset('assets/favicons/favicon.png')}}" />
    <link rel="apple-touch-icon" href="{{asset('assets/favicons/apple-touch-icon.png')}}" />
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/favicons/apple-touch-icon-72x72.png')}}" />
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/favicons/apple-touch-icon-114x114.png')}}" />
    <!-- Windows tiles -->
    <meta name="application-name" content="Track Vendors" />
    <meta name="msapplication-TileColor" content="#FFF" />
    <meta name="msapplication-square70x70logo" content="{{asset('assets/favicons/msapplication-tiny.png')}}"  />
    <meta name="msapplication-square150x150logo" content=" {{asset('assets/favicons/msapplication-square.png')}}" />

    <link rel="stylesheet" href=" {{ asset('assets/fonts/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/vendors/bootstrap.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/vendors/bootstrap-icons.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/vendors/nice-select.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/vendors/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/daterange.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
</head>
<body>
     <header class="main-header">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-auto main-logo">
                    <a href="#">
                        <img src="{{ asset('assets/images/logo-final.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </header>
        <main>
        @yield('content')
    </main>
@include('auth.footer')