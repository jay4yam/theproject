@extends('layouts.back', [
                            'title' => 'Scrap URL',
                            'seoCssActive' => 'active'
                            ])

@section('content')
    <!-- Villes -->
    <section class="section-80 bg-wild-wand">
        <div class="container container-custom">
            <div class="row justify-content-sm-center">
                <div class="col-md-12 col-lg-12">
                    <!-- Box-->
                    <div class="box box-search bg-default d-block">
                        <div class="box-search-wrap">
                            <!-- RD Search Form-->
                            <h1 class="admin">Scrap des url</h1>
                        </div>
                        <div class="box-search-body text-left">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#id</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Compagnie</th>
                                    <th scope="col" style="width: 11%">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($urls as $url)
                                    <tr>
                                        <td style="vertical-align: middle">{{ $url->id }}</td>
                                        <td style="vertical-align: middle; font-size: smaller">{{ $url->url }}</td>
                                        <td style="vertical-align: middle">
                                            <div class="progress">
                                                <div class="progress-bar {{ Config::get('progressBar.'.$url->status.'.color') }}"
                                                     role="progressbar"
                                                     style="width: {{ Config::get('progressBar.'.$url->status.'.width') }}%"
                                                     aria-valuenow="{{ Config::get('progressBar.'.$url->status.'.width') }}"
                                                     aria-valuemin="0" aria-valuemax="100">
                                                    {{ $url->status }}
                                                </div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle; font-size: smaller">{{ $url->compagnie->raison_sociale }}</td>
                                        <td style="vertical-align: middle">
                                            <a href="{{ url()->route('scrap.edit', ['scrap' => $url->id]) }}">
                                                <button class="btn btn-info pull-left">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                            <form class='delete' action="{{ route('scrap.destroy', ['scrap' => $url->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button class="btn btn-danger pull-right">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-terms-bottom ptb-10">
                            <a href="{{ url()->route('scrap.scraping') }}" class="button button-primary" type="submit">
                                <i class="fas fa-plus-square"></i>
                                Scrap Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection