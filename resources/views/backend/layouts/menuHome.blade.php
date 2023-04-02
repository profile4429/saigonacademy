<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark min-vh-100">
                <a href="#"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Manage</span>
                </a>
                <ul class="nav nav-pills flex-column mb-auto" id="menu">
                    <li class="nav-item">
                        <a href="{{ route('intro') }}" class="nav-link nav-link-hover align-middle px-0">
                            <i class="fa-solid fa-bolt"></i></i></i> <span class="ms-1 d-none d-sm-inline">Intro</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('programs') }}" class="nav-link nav-link-hover align-middle px-0">
                            <i class="fa-solid fa-network-wired"></i> <span class="ms-1 d-none d-sm-inline">Programs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admissions') }}" class="nav-link nav-link-hover align-middle px-0">
                            <i class="fa-solid fa-ticket"></i></i> <span class="ms-1 d-none d-sm-inline">Admissions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('news') }}" class="nav-link nav-link-hover align-middle px-0">
                            <i class="fa-solid fa-newspaper"></i></i> <span class="ms-1 d-none d-sm-inline">News</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="nav-link nav-link-hover align-middle px-0">
                            <i class="fa-solid fa-address-card"></i></i> <span class="ms-1 d-none d-sm-inline">Contact</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('language') }}" class="nav-link nav-link-hover align-middle px-0">
                            <i class="fa-regular fa-globe"></i></i> <span class="ms-1 d-none d-sm-inline">Language</span> </a>
                    </li>
                    <li>
                        <a href="{{ route('feedback') }}" class="nav-link nav-link-hover align-middle px-0">
                            <i class="fa-solid fa-comment"></i></i> <span class="ms-1 d-none d-sm-inline">Feedback</span> </a>
                    </li>
                    <li>
                        <a href="{{ route('picture') }}" class="nav-link nav-link-hover align-middle px-0">
                            <i class="fa-solid fa-image"></i></i> <span class="ms-1 d-none d-sm-inline">Picture</span> </a>
                    </li>
                </ul>
                <hr class="mt-3">
                <div class="dropdown mt-auto">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30"
                            class="rounded-circle me-2">
                        <span class="d-none d-sm-inline-block">S</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a href="{{ route('showlogin') }}" class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
            @yield('content')
        </div>
    </div>
</div>

<style>
    .nav-link-hover:hover {
        color: #fff;
        background-color: #6c757d;
    }
</style>
