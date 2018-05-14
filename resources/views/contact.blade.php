@extends('layouts.other', [
                            'title' => 'Contactez nous, par téléphone, par email, sur les réseaux sociaux | easyCopter',
                            'activeContactCss' => 'active'
                            ])

@section('content')
    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/images/backgrounds/background-27-1920x900.jpg">
        <div class="parallax-content">
            <div class="bg-overlay-darker">
                <div class="container section-34 section-md-100 section-lg-top-170 section-lg-bottom-165">
                    <h1 class="d-none d-lg-inline-block">{{ __('contact.contact_title') }}</h1>
                    <h6 class="font-italic">{{ __('contact.contact_subtitle') }}!</h6>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us V2-->
    <section class="section-80 bg-wild-wand">
        <div class="container">
            <div class="box box-insets-off bg-default d-xl-block">
                <div class="row row-offset-custom justify-content-sm-center justify-content-lg-between text-md-left">
                    <div class="col-md-8 order-md-1">
                        <div class="box-inner">
                            <h5 class="text-ubold">{{ __('contact.contact_contact_agence') }}</h5>
                            <p class="text-offset-2 text-small text-left">
                                {{ __('contact.contact_text') }}
                            </p>
                            <div class="row row-30 justify-content-sm-center">
                                <div class="col-md-6">
                                    <h5 class="text-ubold">{{ __('contact.contact_nos_coordonnees') }}</h5>
                                    <!-- Contact Info-->
                                    <address class="contact-info text-left">
                                        <!-- Adresses -->
                                        <p class="d-block text-small contact-info-address">
                                            <a class="text-gray" href="#">
                                                <span class="unit flex-row unit-spacing-xs">
                                                    <span class="unit-left">
                                                        <img class="img-responsive center-block" src="/images/icons/icon-01-16x21.png" width="16" height="21" alt="">
                                                    </span>
                                                    <span class="unit-body"><span>{{ __('contact.contact.address') }}</span></span>
                                                </span>
                                            </a>
                                        </p>
                                        <!-- TEL 1 -->
                                        <p class="d-block text-small">
                                            <a class="text-gray" href="callto:#">
                                                <span class="unit align-items-center flex-row unit-spacing-xs">
                                                    <span class="unit-left">
                                                        <img class="img-responsive center-block" src="/images/icons/icon-02-19x19.png" width="19" height="19" alt="">
                                                    </span>
                                                    <span class="unit-body">
                                                        <span>{{ __('contact.contact.tel') }}</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </p>
                                        <!-- TEL 2 -->
                                        <p class="d-block text-small">
                                            <a class="text-gray" href="callto:#">
                                                <span class="unit align-items-center flex-row unit-spacing-xs">
                                                    <span class="unit-left">
                                                        <img class="img-responsive center-block" src="/images/icons/icon-03-12x20.png" width="12" height="20" alt="">
                                                    </span>
                                                    <span class="unit-body">
                                                        <span>323-678-567</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </p>
                                        <!-- EMAIL -->
                                        <p class="d-block text-small">
                                            <a class="text-gray" href="mailto:{{ __('contact.contact.email') }}">
                                                <span class="unit align-items-center flex-row unit-spacing-xs">
                                                    <span class="unit-left">
                                                        <img class="img-responsive center-block" src="/images/icons/icon-04-20x13.png" width="20" height="13" alt="">
                                                    </span>
                                                    <span class="unit-body">
                                                        <span>{{ __('contact.contact.email') }}</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </p>
                                        <!-- URL -->
                                        <p class="d-block text-small">
                                            <a class="text-gray" href="#">
                                                <span class="unit align-items-center flex-row unit-spacing-xs">
                                                    <span class="unit-left">
                                                        <img class="img-responsive center-block" src="/images/icons/icon-05-19x19.png" width="19" height="19" alt="">
                                                    </span>
                                                    <span class="unit-body">
                                                        <span>{{ __('contact.contact.url') }}</span>
                                                    </span>
                                                </span>
                                            </a>
                                        </p>
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-ubold">{{ __('contact.contact.question') }}</h5>
                                    <!-- RD Mailform-->
                                    <form class="rd-mailform text-left" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
                                        <div class="form-wrap form-wrap-xs">
                                            <label class="form-label" for="questions-contact-name">{{ __('contact.contact.form.yourname') }}</label>
                                            <input class="form-input text-regular" id="questions-contact-name" type="text" name="name" data-constraints="@Required">
                                        </div>
                                        <div class="form-wrap form-wrap-xs">
                                            <label class="form-label" for="questions-contact-email">{{ __('contact.contact.form.email') }}</label>
                                            <input class="form-input text-regular" id="questions-contact-email" type="email" name="email" data-constraints="@Email @Required">
                                        </div>
                                        <div class="form-wrap form-wrap-xs">
                                            <label class="form-label" for="questions-contact-message">{{ __('contact.contact.form.message') }}</label>
                                            <textarea class="form-input text-regular" id="questions-contact-message" name="message" data-constraints="@Required" style="height:120px;"></textarea>
                                        </div>
                                        <div class="form-button text-center text-md-left">
                                            <button class="button button-width-110 button-primary" type="submit">{{ __('contact.contact.form.send') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 section-map-fullheight inset-xl-right-20">
                        <!-- RD Google Map-->
                        <div class="rd-google-map rd-google-map__model" data-zoom="14" data-x="43.5" data-y="7.0"
                             data-styles="[{&quot;featureType&quot;:&quot;administrative.country&quot;,&quot;elementType&quot;:&quot;geometry&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;simplified&quot;},{&quot;hue&quot;:&quot;#ff0000&quot;}]}]">
                            <ul class="map_locations">
                                <li data-y="43.5" data-x="7.0">
                                    <p>9870 St Vincent Place, Glasgow, DC 45 Fr 45.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection