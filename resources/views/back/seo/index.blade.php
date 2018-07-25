@extends('layouts.back', [
                            'title' => 'Plugins SEO',
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
                            <h1 class="admin">Gestion du SEO</h1>
                        </div>
                        <div class="box-search-body text-left">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#id</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Title or Name</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allItems as $item)
                                    <tr>
                                        <td scope="row">{{ $item['model']->id }}</td>
                                        <td scope="row">{{ $item['type'] }}</td>
                                        <td scope="row">
                                            <a href="{{ route('seo.create', ['type' => $item['type'] , 'id' => $item['model']->id ]) }}">
                                            {!! $item['model']->title !!}
                                            </a>
                                        </td>
                                        <td> options </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-terms-bottom ptb-10">
                            <button class="button button-primary" type="submit">
                                <i class="fas fa-plus-square"></i>
                                Ajouter une ville
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection