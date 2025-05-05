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
                        <a href="{{url('contact-info')}}">Contact Information</a>
                    </li>
                    <li class="tab-item">
                        <a href="{{url('change-password')}}" class="tab-active">Change password</a>
                    </li>
                </nav>
                    </div>
                    <div class="inner-wrapper">
                        <div class="form-body">
                            <form action="{{url('update-password')}}" method="post" class="inner-form" id="passwordUpdateForm" onsubmit="return validateForm()">
                                @csrf

                                <div class="input-wrapper">
                                    <label for="currentPassword" class="input-title light">Current password</label>
                                    <div class="password-input-wrapper">
                                        <span class="toggle-password" data-state="hidden"></span>
                                        <input type="password" class="form-control" name="currentPassword" id="currentPassword" required>
                                    </div>
                                    <div class="invalid-feedback">Please enter a valid password</div>
                                </div>


                                <div class="input-wrapper">
                                    <label for="newPassword" class="input-title light">New password</label>
                                    <div class="password-input-wrapper">
                                        <span class="toggle-password" data-state="hidden"></span>
                                        <input type="password" class="form-control" name="newPassword" id="newPassword" required>
                                    </div>
                                    <div class="invalid-feedback">Please enter a valid password</div>
                                </div>


                                <div class="input-wrapper">
                                    <label for="confirmPassword" class="input-title light">Confirm password</label>
                                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                                </div>

                                 <button type="submit" class="btn btn-primary">Save Password</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>      

        <script type="text/javascript">
            document.getElementById('passwordUpdateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form data
    const formData = new FormData(this);
    
    // Validate passwords match
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    if (newPassword !== confirmPassword) {
        alert('Passwords do not match!');
        return;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = 'Processing...';
    
    // AJAX request
    fetch("{{ url('update-password') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Password updated successfully!');
        } else {
            if (data.errors) {
                for (const [field, message] of Object.entries(data.errors)) {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.nextElementSibling.textContent = message[0];
                        input.classList.add('is-invalid');
                    }
                }
            } else {
                alert(data.message || 'An error occurred');
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Save Password';
    });
});
</script> 
@endsection
