<div class="navbar-collapse  px-0" id="navbarNav">
    <ul class="navbar-nav flex-row ms-auto align-items-center ">
        <!-- Home Link -->
        <li class="nav-item">
            <a href="{{ route('frontend.home') }}" class="nav-link d-flex align-items-center" title="Go to Home">
                <span class="btn btn-outline-primary  mt-2 d-block">
                    <i class="fas fa-home"></i>
                </span>
            </a>
        </li>
        <li>
            <a href="{{ route('frontend.logout') }}" class="btn btn-outline-primary  mt-2 d-block">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</div>
