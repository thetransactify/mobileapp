@php
    $path = request()->path();

    $titles = [
        'vendor-dashboard' => 'Dashboard',
        'manage-profile' => 'Manage Profile',
        'my-clients' => 'My Clients',
        'contact-info' => 'Settings',
    ];

    $pageTitle = $titles[$path] ?? 'Dashboard';
@endphp
<header class="main-header theme-light">
        <div class="row justify-content-end align-items-center header-top">
            <!-- <div class="col-auto main-logo">
                <a href="#">
                    <img src="./assets/images/logo-final.png" alt="">
                </a>
            </div> -->
            <div class="buttons-wrapper">
                <button class="user-notification-tab">
                    <svg width="20" height="20" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_0_2329)">
                            <path
                                d="M11.8076 25.3792C9.6546 25.3792 7.90137 23.6271 7.90137 21.4729C7.90137 21.0416 8.25137 20.6917 8.68262 20.6917C9.11387 20.6917 9.46387 21.0416 9.46387 21.4729C9.46387 22.7657 10.516 23.8167 11.8076 23.8167C13.0993 23.8167 14.1514 22.7657 14.1514 21.4729C14.1514 21.0416 14.5014 20.6917 14.9326 20.6917C15.3639 20.6917 15.7139 21.0416 15.7139 21.4729C15.7139 23.6271 13.9608 25.3792 11.8076 25.3792Z"
                                fill="#FE5C73"></path>
                            <path
                                d="M20.401 22.2542H3.21348C2.20831 22.2542 1.39062 21.4365 1.39062 20.4313C1.39062 19.8978 1.62294 19.3927 2.02806 19.0458C2.05419 19.0229 2.08223 19.0021 2.11141 18.9832C3.64053 17.6489 4.51562 15.7291 4.51562 13.702V10.7958C4.51562 6.77506 7.78749 3.50415 11.8072 3.50415C11.9739 3.50415 12.1542 3.5072 12.3209 3.53543C12.7468 3.60619 13.0344 4.00941 12.9635 4.43436C12.8927 4.85932 12.4822 5.14695 12.0645 5.076C11.9812 5.06245 11.8896 5.06665 11.8072 5.06665C8.64904 5.06665 6.07812 7.63642 6.07812 10.7958V13.702C6.07812 16.2187 4.97491 18.6001 3.05421 20.2343C3.03857 20.2469 3.02503 20.2583 3.00825 20.2697C2.98021 20.3052 2.95312 20.3594 2.95312 20.4313C2.95312 20.5728 3.07195 20.6917 3.21348 20.6917H20.401C20.5427 20.6917 20.6615 20.5728 20.6615 20.4313C20.6615 20.3582 20.6344 20.3052 20.6053 20.2697C20.5896 20.2583 20.5761 20.2469 20.5604 20.2343C18.6386 18.5989 17.5365 16.2187 17.5365 13.702V12.5667C17.5365 12.1355 17.8865 11.7855 18.3178 11.7855C18.749 11.7855 19.099 12.1355 19.099 12.5667V13.702C19.099 15.7303 19.9751 17.651 21.5063 18.9865C21.5343 19.0052 21.5614 19.025 21.5864 19.0469C21.9917 19.3927 22.224 19.8978 22.224 20.4313C22.224 21.4365 21.4063 22.2542 20.401 22.2542Z"
                                fill="#FE5C73"></path>
                            <path
                                d="M19.099 10.7958C16.2271 10.7958 13.8906 8.45944 13.8906 5.58755C13.8906 2.71565 16.2271 0.37915 19.099 0.37915C21.9709 0.37915 24.3072 2.71565 24.3072 5.58755C24.3072 8.45944 21.9709 10.7958 19.099 10.7958ZM19.099 1.94165C17.0885 1.94165 15.4531 3.57701 15.4531 5.58755C15.4531 7.59789 17.0885 9.23325 19.099 9.23325C21.1094 9.23325 22.7447 7.59789 22.7447 5.58755C22.7447 3.57701 21.1094 1.94165 19.099 1.94165Z"
                                fill="#FE5C73"></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_0_2329">
                                <rect width="25" height="25" fill="white" transform="translate(0.365234 0.37915)">
                                </rect>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
                <button class="user-tab" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>{{ Str::substr(auth()->user()->name, 0, 1) }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li class="dropdown-item-text">
                        {{ auth()->user()->email }}
                    </li>
                    <li>
                        <a href="{{ url('contact-info') }}" class="dropdown-item">
                            Contact Info
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-between align-items-center header-bottom">
            <div class="col-auto">
               <h2 class="title-text">{{ $pageTitle }}</h2>    
            </div>

            <div class="select-wrapper col-auto">
                <select class="custom-select style-two" id="switchCompany">
                    <option data-display="Switch Mode" value=""></option>
                    <option value="vendor-mode">Vendor Mode</option>
                    <option value="user-mode">User Mode</option>
                </select>
            </div>
        </div>
    </header>