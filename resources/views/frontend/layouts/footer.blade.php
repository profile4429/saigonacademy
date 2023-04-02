<div class=" container-fluid footer"
    style="background-image: url('https://saigonacademy.com/themes/custom/bulma_theta/images/footer_bg.png'); background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h5 style="color: #88191c"><strong>{{ __('home.footer_header') }}</strong></h5>
                <div class="row my-3">
                    @foreach ($contact as $item)
                        <div class="col-md-6 mb-3">
                            <p><strong>{{ $item->title }}</strong></p>

                            <p>{{ $item->address }}</p>
                            <p><strong>Hotline: <span style="color: red">{{ $item->phone }}</span></strong></p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 social-media-links">
                <h5 class="social-media-links__title" style="color: #88191c"><strong>{{ __('home.ketnoi') }}</strong>
                </h5>
                <ul class="social-media-links__list">
                    <li><i class="fa-brands fa-youtube"></i> <a href="#"
                            aria-label="Link to SaiGonAcademy's Youtube channel">Youtube</a></li>
                    <li><i class="fa-brands fa-facebook"></i> <a href="#"
                            aria-label="Link to SaiGonAcademy's Facebook page">Facebook</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid copyright">
    <p class="text-center copyright_content">Copyright © 2012 Saigon Academy. All Rights Reserved.</p>
</div>

<style>
    .footer {
        background-image: url('https://saigonacademy.com/themes/custom/bulma_theta/images/footer_bg.png');
        margin-top: 2rem;
    }

    .footer_title {
        margin-left: 5rem;
    }

    .copyright {
        background-color: #273276;

    }

    .copyright_content {
        margin: 0px;
        color: white;
    }
</style>
