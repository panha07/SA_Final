<style>


  /* Custom logo styling */
  .brand-logo img {
    max-height: 60px; /* Adjust the height as needed */
    max-width: 100%; /* Ensure the logo does not exceed the container width */
    padding: 10px; /* Add padding around the logo */
  }
</style>

<div>
  <div class="brand-logo d-flex align-items-center justify-content-between">
    <a href="{{route('job')}}" class="text-nowrap logo-img">
      <img src="{{asset('logo/fs_log.png')}}" alt="Company Logo" />
    </a>
    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
      <i class="ti ti-x fs-8"></i>
    </div>
  </div>
  <!-- Sidebar navigation-->
  <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
    <ul id="sidebarnav">
      <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
        <span class="hide-menu">Home</span>
      </li>
      {{-- <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('admin_home')}}" aria-expanded="false">
          <span>
            <iconify-icon icon="ic:baseline-home" class="fs-6"></iconify-icon>
          </span>
          <span class="hide-menu">Home</span>
        </a>
      </li> --}}
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('job')}}" aria-expanded="false">
          <span>
            <iconify-icon icon="ic:outline-dashboard" class="fs-6"></iconify-icon>
          </span>
          <span class="hide-menu">Dashboard</span>
        </a>
      </li>
      {{-- <li class="sidebar-item">
        <a class="sidebar-link" href="" aria-expanded="false">
          <span>
            <iconify-icon icon="carbon:package" class="fs-6"></iconify-icon>
          </span>
          <span class="hide-menu">Service Package</span>
        </a>
      </li> --}}
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('cv')}}" aria-expanded="false">
          <span>
            <iconify-icon icon="mdi:file-account" class="fs-6"></iconify-icon>
          </span>
          <span class="hide-menu">CV</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link" href="{{route('blog')}}" aria-expanded="false">
          <span>
            <i class="far fa-building"></i>
          </span>
          <span class="hide-menu">Company's Activities</span>
        </a>
      </li>
      <li class="sidebar-item">
        <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
          <span>
            <iconify-icon icon="mdi:account-settings" class="fs-6"></iconify-icon>
          </span>
          <span class="hide-menu">Account Setting</span>
        </a>
        <ul class="collapse first-level">
          <li class="sidebar-item">
            <a href="{{route('company_profile')}}" class="sidebar-link">
              <iconify-icon icon="mdi:office-building" class="fs-6"></iconify-icon>
              <span class="hide-menu">Company Profile</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a href="{{route('contactPerson')}}" class="sidebar-link">
              <iconify-icon icon="mdi:account-circle" class="fs-6"></iconify-icon>
              <span class="hide-menu">Contact Person</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- End Sidebar navigation -->
</div>

