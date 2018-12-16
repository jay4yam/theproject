@extends('layouts.other', ['title' => 'Page de remerciement'])

@section('content')
    <section class="section parallax-container bg-black section-height-mac context-dark" data-parallax-img="/images/vue-aerienne-panier-parallax.jpg">
        <div class="parallax-content">
            <div class="bg-overlay-darker">
                <div class="container cart-parallax">
                    <h1 class="d-none d-lg-inline-block">{{ __('remerciement.title') }}</h1>
                    <h6 class="font-italic">{{ __('remerciement.subtitle') }}!</h6>
                </div>
            </div>
        </div>
    </section>

    <section class="section-45 bg-wild-wand">
        <div class="container">
            <div class="box box-insets-off bg-default d-xl-block">
                <div class="recap-panier box-inner">
                    <div class="row">
                        <div class="col-md-12">
                            Merci, <b>{{ ucfirst($mainOrder->user->profile->fullName) }} {{ ucfirst($mainOrder->user->profile->firstName) }}</b><br>
                            EasyCopter vous  remercie de votre confiance.
                        </div>
                        @foreach($mainOrder->itemsOrder as $item)
                            <div class="col-md-4 pt-20">
                                <img src="/storage/voyages/thumbnails/{{ $item->voyage->main_photo }}">
                            </div>
                            <div class="col-md-5 pt-20" style="text-align: left;">
                                <h6>{{ $item->voyage->title }}</h6>
                                <p>
                                    {{ $item->voyage->subtitle }}<br>
                                </p>
                                <div>
                                    <p class="pt-20">
                                        Ce coyage sera assuré par :
                                    </p>
                                    <h6><a href="{{ route('compagnie.front.show', ['id' => $item->voyage->compagnies->first()->id]) }}">{{ strtoupper($item->voyage->compagnies->first()->raison_sociale) }}</a></h6>
                                    <p>
                                        {{ $item->voyage->compagnies->first()->adresse }}<br>
                                        {{ $item->voyage->compagnies->first()->code_postal }} {{ $item->voyage->compagnies->first()->ville }}<br>
                                        Tel. {{ $item->voyage->compagnies->first()->telephone }}<br>
                                        email. {{ $item->voyage->compagnies->first()->mail_resa }}<br>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3 flex-middle">
                                @php
                                $qrCode = 'order_id :'.$mainOrder->order_id.'\n';
                                $qrCode .= 'Customer name:'.$mainOrder->user->profile->fullName.'\n';
                                $qrCode .= 'Customer firstName:'.$mainOrder->user->profile->firstName.'\n';
                                $qrCode .= 'Customer Email:'.$mainOrder->user->email.'\n';
                                @endphp
                                <div>{!! QrCode::encoding('UTF-8')->size('200')->generate($qrCode) !!}</div>
                                <div class="calendar">
                                    <i class="fa fa-3x fa-calendar-check-o" aria-hidden="true" style="float:left;"></i>
                                    Départ prévu le:<br>
                                    <b>{{ date( "d M Y", strtotime( $item->date_voyage ) ) }}</b>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    <div class="row">
                        <div class="col-md-12">Vous allez recevoir toutes les instructions par mail</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('images/100pour100-secure.png') }}" width="40%">
                            <p>Paiement 100% sécurisé</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('images/site-de-confiance.png') }}" width="40%">
                            <p>Achat garanti</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('images/site-prefere.png') }}" width="40%">
                            <p>100% satisfait</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
