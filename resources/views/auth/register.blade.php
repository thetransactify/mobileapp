@extends('auth.header')
<title>@yield('title', 'Login')</title>
@section('content')
<style>
.form-body.step {
    display: none;
}
.form-body.step.active {
    display: block;
}
</style>
<section class="form-sec" id="createAccountSec">
    <div class="container">
        <div class="text-center">
            <h2 class="form-title">Create your Account</h2>
        </div>

        <div class="form-steps-container">
            <div class="steps-list">
                <div class="step-progress"></div>
                <div class="step-item active">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="step-label">Personal Details</span>
                </div>
                <div class="step-item">
                    <span class="icon"><i class="fa-solid fa-phone"></i></span>
                    <span class="step-label">Contact Information</span>
                </div>
                <div class="step-item">
                    <span class="icon"><i class="fa-solid fa-lock"></i></span>
                    <span class="step-label">Set-Up Password</span>
                </div>
            </div>
        </div>

        <div class="form-container">
            <div class="inner-wrapper">
                <form class="needs-validation" method="post" action="{{url('/register-submit')}}"  id="multiStepForm" novalidate>
                    @csrf
                    <!-- Step 1 -->
                    <div class="form-body step step-1 active">
                        <div class="input-wrapper">
                            <input type="text" class="form-control" placeholder="Enter your entity name" name="entityName" required />
                            <div class="invalid-feedback">Please provide your entity name</div>
                        </div>
                        <div class="input-wrapper">
                            <input type="text" class="form-control" placeholder="Name" name="fullName" required />
                            <div class="invalid-feedback">Please provide your full name</div>
                        </div>
                        <button type="button" class="btn btn-primary form-next-btn">Next</button>
                    </div>

                    <!-- Step 2 -->
                    <div class="form-body step step-2">
                        <button type="button" class="btn btn-primary btn-back form-prev-btn">
                            <i class="bi bi-arrow-left-short"></i> Back
                        </button>
                        <div class="input-wrapper">
                            <input type="email" class="form-control" name="email" placeholder="Enter your email Id" required />
                            <div class="invalid-feedback">Please provide a valid email Id</div>
                        </div>
                        <div class="input-wrapper">
                            <input type="tel" class="form-control" name="phoneNumber" placeholder="Enter your contact number" minlength="10" maxlength="10" required />
                            <div class="invalid-feedback">Please provide a valid phone number</div>
                        </div>
                        <button type="button" class="btn btn-primary form-next-btn">Next</button>
                    </div>

                    <!-- Step 3 -->
                    <div class="form-body step step-3">
                        <button type="button" class="btn btn-primary btn-back form-prev-btn">
                            <i class="bi bi-arrow-left-short"></i> Back
                        </button>
                        <div class="input-wrapper">
                            <input type="password" class="form-control" name="setPassword" placeholder="Set your password" required />
                            <div class="invalid-feedback">Please create a strong password</div>
                        </div>
                        <div class="input-wrapper">
                            <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm your password" required />
                            <div class="invalid-feedback">Please confirm your password</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </div>

                    <p class="form-footer-text text-center mt-3">
                        Already have an account? <a href="{{url('/login')}}">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentStep = 0;
        const steps = document.querySelectorAll('.form-body.step');
        const nextBtns = document.querySelectorAll('.form-next-btn');
        const prevBtns = document.querySelectorAll('.form-prev-btn');

        function showStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle('active', i === index);
            });
            currentStep = index;
        }

        nextBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (currentStep < steps.length - 1) {
                    showStep(currentStep + 1);
                }
            });
        });

        prevBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (currentStep > 0) {
                    showStep(currentStep - 1);
                }
            });
        });

        // Optional: prevent form submit for demo
        // document.getElementById('multiStepForm').addEventListener('submit', function (e) {
        //     e.preventDefault();
        //     alert('Form submitted!');
        // });
    });
</script>


@endsection
