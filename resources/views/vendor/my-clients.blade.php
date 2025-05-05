@extends('layouts.app')
<title>@yield('title', 'My-clients')</title>
@section('content')
        <section class="form-sec">
            <div class="container">
                <div class="text-left">
                </div>
<div class="form-container">
    <div class="inner-wrapper">
        <div class="form-body">
            <div class="input-wrapper search-input">
                <label for="search">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                    </svg>
                </label>
                <input type="text" name="search" id="search" placeholder="Search" onkeyup="searchCompanies()">
            </div>
            
            @foreach ($companies as $company)
                <div class="table-container mt-5 company-row" 
                     data-name="{{ strtolower($company->name) }}"
                     data-phone="{{ $company->mobile_no }}"
                     data-email="{{ strtolower($company->email) }}">
                    <div class="custom-table">
                        <div class="t-row">
                            <div class="col-item">Company Name</div>
                            <div class="col-item name-text">{{ $company->name }}</div>
                        </div>
                        <div class="t-row">
                            <div class="col-item">Contact number</div>
                            <div class="col-item">{{ $company->mobile_no }}</div>
                        </div>
                        <div class="t-row">
                            <div class="col-item">Email Address</div>
                            <div class="col-item">{{ $company->email }}</div>
                        </div>
                        <div class="t-row">
                            <div class="col-item">Status</div>
                            @if($company->pivot->status == 1)
                            <div class="col-item">
                                <span class="status-badge success">Submited</span>
                            </div>
                            @elseif($company->pivot->status == 2)
                            <div class="col-item">
                                <span class="status-badge success">Approved</span>
                            </div>
                            @elseif($company->pivot->status == 3)
                            <div class="col-item">
                                <span class="status-badge danger">Rejected</span>
                            </div>
                            @elseif($company->pivot->status == 4)
                            <div class="col-item">
                                <span class="status-badge success">Submited</span>
                            </div>
                            @endif
                        </div>
                        <div class="t-row">
                            <div class="col-item">Action</div>
                            <div class="col-item">
                                <div class="action-btns-wrapper">
                                    <span class="action-btn trash-icon">
                                        <i class="fa-regular fa-trash"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach    
        </div>
    </div>
</div>

<script>
function searchCompanies() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    const companyRows = document.getElementsByClassName('company-row');

    for (let i = 0; i < companyRows.length; i++) {
        const name = companyRows[i].getAttribute('data-name');
        const phone = companyRows[i].getAttribute('data-phone');
        const email = companyRows[i].getAttribute('data-email');
        
        if (name.includes(filter) || phone.includes(filter) || email.includes(filter)) {
            companyRows[i].style.display = "";
        } else {
            companyRows[i].style.display = "none";
        }
    }
}
</script>

            </div>
        </section>

@endsection
