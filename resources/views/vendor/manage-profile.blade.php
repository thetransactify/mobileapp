@extends('layouts.app')
<title>@yield('title', 'Manage-profile')</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
 <section class="form-sec">
            <div class="container">
                <div class="text-left">
      
                </div>

                <div class="form-container">
                    <div class="form-navigation">
                        <nav>
                            <li class="tab-item">
                                <a href="{{url('manage-profile')}}" class="tab-active">Overview</a>
                            </li>
                            <li class="tab-item">
                                <a href="{{url('manage-compliance')}}">Compliance Status</a>
                            </li>
                            <!-- <li class="tab-item">
                                <a href="./gst-status.html">GST Compliance</a>
                            </li> -->
                            <li class="tab-item">
                                <a href="{{url('document-Attached')}}">Document Attached</a>
                            </li>
                        </nav>
                    </div>

                    <div class="inner-wrapper">
                        <div class="form-body">
                            <form action="#" id="profileForm" method="POST">
                            	@csrf
                                <div class="input-wrapper field-custom">
                                    <label for="name">Name:</label>
                                    <span class="current-value">Aditya Shah</span>
                                    <input type="text" name="vendor-name" id="name">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>

                                <div class="input-wrapper field-custom">
                                    <label for="email">Email:</label>
                                    <span class="current-value">aditya@abc.com</span>
                                    <input type="text" name="email" id="email">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>
                                
                                <div class="input-wrapper field-custom">
                                    <label for="mobile">Mobile No:</label>
                                    <span class="current-value">1234567890</span>
                                    <input type="text" name="mobile" id="mobile">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>
                                
                                <div class="input-wrapper field-custom">
                                    <label for="address1">Address line 1:</label>
                                    <span class="current-value">123, Marine Drive</span>
                                    <input type="text" name="address1" id="address1">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>
                                
                                <div class="input-wrapper field-custom">
                                    <label for="address2">Address line 2:</label>
                                    <span class="current-value">Colaba</span>
                                    <input type="text" name="address2" id="address2">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>

                               <!--  <div class="input-wrapper field-custom">
                                    <label for="constitution">Type of Constitution:</label>
                                    <span class="current-value">Proprietorship</span>
							         <select id="constitution" name="constitution" class="form-control">
								        <option value="1" selected>Proprietorship</option>
								        <option value="2">Partnership</option>
								        <option value="3">LLP</option>
								        <option value="4">Private Limited</option>
								        <option value="5">Public Limited</option>
								        <option value="6">Other</option>
								      </select>
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div> -->
                                
                                <div class="input-wrapper field-custom">
                                    <label for="city">City:</label>
                                    <span class="current-value">Mumbai</span>
                                    <input type="text" name="city" id="city">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>

                                <div class="input-wrapper field-custom">
                                    <label for="bank">PAN:</label>
                                    <span class="current-value">PAN</span>
                                    <input type="text" name="pan_number" id="pan_number">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>

                                <div class="input-wrapper field-custom">
                                    <label for="bank">Bank Name:</label>
                                    <span class="current-value">PAN</span>
                                    <input type="text" name="bank" id="bank">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>
                                
                                <div class="input-wrapper field-custom">
                                    <label for="state">State:</label>
                                    <span class="current-value">Maharashtra</span>
                                    <input type="text" name="state" id="state">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>
                                
                                <div class="input-wrapper field-custom">
                                    <label for="country">Country:</label>
                                    <span class="current-value">India</span>
                                    <input type="text" name="country" id="country">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>
                                
                                <div class="input-wrapper field-custom">
                                    <label for="pincode">Pincode:</label>
                                    <span class="current-value">400001</span>
                                    <input type="text" name="pincode" id="pincode">
                                    <div class="btns-wrapper">
                                        <button class="edit-btn" type="button"></button>
                                        <button class="close-btn" type="button"></button>
                                        <button class="save-btn" type="button"></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="toast" style="position: fixed; top: 20px; right: 20px; min-width: 200px; padding: 12px 20px; border-radius: 8px; color: #fff; display: none; z-index: 9999;"></div>



                </div>
            </div>
        </section>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    fetchUserData();
    initEditFunctionality();
});
		function fetchUserData() {
		fetch("{{ route('profile.data') }}", {
		    method: 'GET',
		    headers: {
		        'Accept': 'application/json',
		        'X-Requested-With': 'XMLHttpRequest'
		    }
		})
		.then(response => {
		    if (!response.ok) {
		        throw new Error('Network response was not ok');
		    }
		    return response.json();
		})
		.then(data => {
			//alert("hii2");
		    if (data.success) {
		        populateForm(data.user);
		    } else {
		        console.error('Error fetching user data:', data.message);
		        alert('Failed to load profile data');
		    }
		})
		.catch(error => {
		    console.error('Error:', error);
		    alert('Error loading profile data');
		});
   }

function populateForm(user) {
    document.getElementById('name').value = user.name || '';
    document.querySelector('#name').previousElementSibling.textContent = user.name || '';

    document.getElementById('email').value = user.email || '';
    document.querySelector('#email').previousElementSibling.textContent = user.email || '';

    document.getElementById('mobile').value = user.mobile || '';
    document.querySelector('#mobile').previousElementSibling.textContent = user.mobile || '';

    document.getElementById('address1').value = user.address1 || '';
    document.querySelector('#address1').previousElementSibling.textContent = user.address1 || '';

    document.getElementById('address2').value = user.address2 || '';
    document.querySelector('#address2').previousElementSibling.textContent = user.address2 || '';

    document.getElementById('city').value = user.city || '';
    document.querySelector('#city').previousElementSibling.textContent = user.city || '';

    document.getElementById('state').value = user.state || '';
    document.querySelector('#state').previousElementSibling.textContent = user.state || '';

    document.getElementById('country').value = user.country || '';
    document.querySelector('#country').previousElementSibling.textContent = user.country || '';

    document.getElementById('pincode').value = user.pincode || '';
    document.querySelector('#pincode').previousElementSibling.textContent = user.pincode || '';

    document.getElementById('bank').value = user.bank_name || '';
    document.querySelector('#bank').previousElementSibling.textContent = user.bank_name || '';

    document.getElementById('pan_number').value = user.pan_number || '';
    document.querySelector('#pan_number').previousElementSibling.textContent = user.pan_number || '';

    // document.getElementById('constitution').value = user.constitution || '';
    // document.querySelector('#constitution').previousElementSibling.textContent = user.constitution || '';

}   

  const updateProfileUrl = @json(route('profile.datass'));
  function Editmanageprofile() {
            const formData = {
                'vendor-name': document.getElementById('name').value,
                'email': document.getElementById('email').value,
                'mobile': document.getElementById('mobile').value,
                'address1': document.getElementById('address1').value,
                'address2': document.getElementById('address2').value,
                'city': document.getElementById('city').value,
                'state': document.getElementById('state').value,
                'country': document.getElementById('country').value,
                'pincode': document.getElementById('pincode').value
            };

            fetch(updateProfileUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
               if (data.success) {
				    showToast('Profile updated successfully!', 'success');
				    document.querySelectorAll('.current-value').forEach(span => {
				        const inputId = span.nextElementSibling.id;
				        span.textContent = document.getElementById(inputId).value;
				    });
				} else {
				    showToast(data.message || 'Update failed', 'error');
				}

            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating.');
            });
        }

// Add event listeners to all save buttons
document.querySelectorAll('.save-btn').forEach(button => {
    button.addEventListener('click', Editmanageprofile);
});
</script>
<script>
// Add edit functionality
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        const wrapper = this.closest('.input-wrapper');
        const currentValue = wrapper.querySelector('.current-value');
        const inputField = wrapper.querySelector('.edit-field');
        
        currentValue.style.display = 'none';
        inputField.style.display = 'block';
        inputField.value = currentValue.textContent;
    });
});

// Add close/cancel functionality
document.querySelectorAll('.close-btn').forEach(button => {
    button.addEventListener('click', function() {
        const wrapper = this.closest('.input-wrapper');
        const currentValue = wrapper.querySelector('.current-value');
        const inputField = wrapper.querySelector('.edit-field');
        
        currentValue.style.display = 'inline';
        inputField.style.display = 'none';
    });
});
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.style.display = 'block';
    toast.style.backgroundColor = type === 'success' ? '#28a745' : '#dc3545';

    setTimeout(() => {
        toast.style.display = 'none';
    }, 3000);
}
</script>
@endsection