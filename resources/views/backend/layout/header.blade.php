<nav class="navbar navbar-expand-lg navbar-light container-fluid ">
    <ul class="navbar-nav justify-contain-end">
        <li class="nav-item d-block d-xl-none">
            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
            </a>
        </li>
        <li class="nav-item">
            <h4 class="nav-link">Welcome {{ auth()->user()->first_name }}!</h4>
        </li>
    </ul>
    @include('backend.layout.profile')
</nav>
