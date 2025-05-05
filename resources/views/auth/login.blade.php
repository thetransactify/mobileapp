 @extends('auth.header')
 <title>@yield('title', 'Login')</title>
 @section('content')
<section class="form-sec" >
    <div class="container">
        <div class="text-center">
            <h2 class="form-title">Sign in to your account</h2>
        </div>
        <div class="form-container">
            <div class="inner-wrapper">

               
                    	<form action="{{ route('loginss') }}" method="post">
                    		 <div class="form-body">
                    	 @csrf
                        <div class="input-wrapper">
                            <input type="email" class="form-control" id="loginEmail" name="loginEmail"
                                placeholder="Email Address" required>
                            <div class="invalid-feedback">Please enter valid email address</div>
                        </div>

                        <div class="input-wrapper">
                            <div class="password-input-wrapper">
                                <span class="toggle-password"></span>
                                <input type="password" class="form-control" id="loginPassword" name="loginPassword"
                                    placeholder="Password" required>
                            </div>
                            <span class="forgot-password-btn">Forgot password?</span>

                            <div class="invalid-feedback">Please enter a valid password</div>
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                         </div>
                    </form>

                    <p class="form-footer-text">
                        New to Track Vendors? <a href="{{url('register')}}">Register</a>
                    </p>
            </div>
        </div>
	        @if(session('toast'))
			    <div class="toast-container position-fixed bottom-0 end-0 p-3">
			        <div class="toast show align-items-center text-white bg-{{ session('toast.type') === 'error' ? 'danger' : session('toast.type') }} border-0" role="alert">
			            <div class="d-flex">
			                <div class="toast-body">
			                    {{ session('toast.message') }}
			                </div>
			                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
			            </div>
			        </div>
			    </div>
			@endif
    </div>
</section>
@endsection