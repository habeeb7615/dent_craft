<div class="sidebar">
    <div class="main-logo fix-height">
        <a href="#" class="hamburg-menu">
            <img />
        </a>
        <figure  class="collaps-text">
            <img class="img-fluid" />
        </figure>
    </div>
    <div class="sidebar-content remain-height custom-scrollbar">
        <div class="sidebar-top-menu">
            <a href="{{ route('admin.quotation.new_quotation') }}" class="btn btn-primary new-quatation">
                <span ><i class="bi bi-plus-circle-fill"></i> <small class="show-on-hover">New Quotation</small></span>
                <p class="collaps-text">New Quotation</p>
            </a>
            <div class="sidebar-top-menu-list menu-list-top">
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="menu-link">
                            <span><i class="bi bi-house-door"></i><small class="show-on-hover">Dashboard</small></span>
                            <p class="collaps-text">Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.check_vehicle_registration') }}" class="menu-link">
                            <span><i class="bi bi-journal-text"></i><small class="show-on-hover">Check Vehicle Registration</small></span>
                            <p class="collaps-text">Check Vehicle Registration</p>
                        </a>
                    </li>
                    {{-- <li class="dropdown">

                        <a class="dropdown-toggle menu-link"  type="button" id="dropdownMenuButton" data-toggle="dropdown">
                            <span><i class="bi bi-journal-code"></i><small class="show-on-hover">API</small></span>
                            <p class="collaps-text">API</p>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <ul>
                                <li>
                                    <a class="dropdown-item menu-link" href="#">
                                        <span><i class="bi bi-journal-text"></i><small class="show-on-hover">Check Vehicle Registration</small></span>
                                        <p class="collaps-text">Check Vehicle Registration</p>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item menu-link" href="#" >
                                        <span><i class="bi bi-gear"></i><small class="show-on-hover">Check for Parts</small></span>
                                        <p class="collaps-text">Check for Parts</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                    <li>
                        <a href="{{ route('admin.quotation.notifications.index') }}" class="menu-link">
                            <span><i class="bi bi-app-indicator"></i><small class="show-on-hover">Notifications</small></span>
                            <p class="collaps-text">Notifications</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar-bottom-menu">
            <div class="user-profile">
                <figure>
                    <img onclick="javascript:window.location.href = '/admin/profile';" src="{{ auth()->user()->profile_image_url }}" alt="">
                </figure>
                <p class="collaps-text">Welcome</p>
                <h4 class="collaps-text">{{ auth()->user()->name }}</h4>
            </div>
            <div class="sidebar-top-menu-list menu-list-bottom">
                <ul>
                    <li>
                        <a href="{{ route('admin.profile') }}" class="menu-link" >
                            <span><i class="bi bi-person-circle"></i><small class="show-on-hover">Profile</small></span>
                            <p class="collaps-text">Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:changeTheme()" class="menu-link" >
                            <span><i class="bi bi-circle-half"></i><small class="show-on-hover">Light/Dark</small></span>
                            <p class="collaps-text">Light/Dark</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.get_change_password') }}" class="menu-link" >
                            <span><i class="bi bi-key"></i><small class="show-on-hover">Change Password</small></span>
                            <p class="collaps-text">Change Password</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.get_email_and_comments') }}" class="menu-link" >
                            <span><i class="bi bi-chat-right-dots"></i><small class="show-on-hover">Email & Comments</small></span>
                            <p class="collaps-text">Email & Comments</p>
                        </a>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="post">
                            @csrf
                            <a onclick="javascript:submit_form()" href="#" class="menu-link">
                                <span><i class="bi bi-box-arrow-left"><small class="show-on-hover">Logout</small></i></span>
                                <p class="collaps-text">Logout</p>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function submit_form() {
            $('#logout-form').submit()
        }
    </script>
@endpush
