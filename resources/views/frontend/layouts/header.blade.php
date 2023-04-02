<div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand mx-5" href="{{ route('showHomepage') }}"><img
                    src="https://saigonacademy.com/themes/custom/bulma_theta/logo.png" alt="Logo"></a>
            <button class="navbar-toggler m-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="introDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">{{ __('header.gioithieu') }}</a>
                        <ul class="dropdown-menu" aria-labelledby="introDropdown">
                            @foreach ($intro as $item)
                                <li><a class="dropdown-item"
                                        href="{{ route('showIntro') }}?id={{ $item->id }}">{{ $item->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item"><a href="{{ route('showPrograms') }}"
                            class="nav-link">{{ __('header.chuongtrinhhoc') }}</a></li>
                    <li class="nav-item"><a href="{{ route('showAdmissions') }}"
                            class="nav-link">{{ __('header.tuyensinh') }}</a></li>
                    <li class="nav-item"><a href="{{ route('showNews') }}"
                            class="nav-link">{{ __('header.tintuc') }}</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">{{ __('header.tuyendung') }}</a></li>
                    <li class="nav-item"><a href="{{ route('showContact') }}"
                            class="nav-link">{{ __('header.lienhe') }}</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-globe"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="{{ url('locale/en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ url('locale/vi') }}">Tiếng Việt</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<style>
    .nav-link {
        color: #ae1f24;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        display: block;

    }

    .nav-link:hover {
        color: red;
    }

    .dropdown-item {
        color: #ae1f24;
        font-size: 15px;
        font-weight: bold;
        text-transform: uppercase;
        display: block;
    }
</style>
