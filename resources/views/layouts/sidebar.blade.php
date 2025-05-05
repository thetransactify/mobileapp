<div class="sidebar" id="sidebar">
    <div class="top-wrapper">
        <span class="sidebar-toggle" id="sidebarToggle"></span>
        <div class="main-logo"></div>
    </div>

    <div class="inner-container">
        <div class="menu-list">
            <ul>
                <li>
                    <a href="{{ url('vendor-dashboard') }}" class="{{ request()->is('vendor-dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ url('manage-profile') }}" class="{{ request()->is('manage-profile') ? 'active' : '' }}">
                        <i class="bi bi-person-circle"></i>
                        Manage Profile
                    </a>
                </li>
                <li>
                    <a href="{{ url('my-clients') }}" class="{{ request()->is('my-clients') ? 'active' : '' }}">
                        <i class="bi bi-list-check"></i>
                        My Clients
                    </a>
                </li>
                <li>
                    <a href="{{ url('contact-info') }}" class="{{ request()->is('contact-info') ? 'active' : '' }}">
                        <i class="bi bi-gear"></i>
                        Settings
                    </a>
                </li>
            </ul>
        </div>

        <div class="footer">
            <p>Vendor Mode</p>
        </div>
    </div>
</div>
