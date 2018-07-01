<div class="modal modal-custom fade text-center" id="subscribe" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-sm-center align-items-sm-center">
                        <div class="col-md-6 bg-image bg-image-1"></div>
                        <div class="col-md-6">
                            <div class="modal-body-column-content">
                                <h5 class="text-ubold">{{ __('home.subscribenewletter') }}   </h5>
                                <p class="font-italic text-small text-black">{{ __('home.subscribeGetOff') }} <span class="text-ubold">{{ __('home.getOff') }}</span> {{ __('home.firsttour') }}</p>
                                <!-- RD Mailform-->
                                {{ Form::open(['url' => App::getLocale().'/newsletter-subscribe']) }}
                                <div class="form-wrap form-wrap-xs">
                                    <label class="form-label" for="contact-email">{{ __('home.labelEmailNewsletter') }}</label>
                                    <input class="form-input" id="contact-email" type="email" name="email" data-constraints="@Email @Required">
                                </div>
                                <button class="button button-primary button-block" type="submit">{{ __('home.subscribeAction') }}</button>
                            {{ Form::close() }}
                            <!-- List Inline-->
                                <ul class="list-inline list-primary list-inline-13">
                                    <li class="text-center"><a class="icon fa fa-facebook-f text-black" href="#"></a></li>
                                    <li class="text-center"><a class="icon fa fa-twitter text-black" href="#"></a></li>
                                    <li class="text-center"><a class="icon fa fa-youtube text-black" href="#"></a></li>
                                    <li class="text-center"><a class="icon fa fa-linkedin text-black" href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>