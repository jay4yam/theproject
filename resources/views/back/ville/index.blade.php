@extends('layouts.back', [
                            'title' => 'liste des villes',
                            'voyageCssActive' => 'active'
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
                            <h1 class="admin">Liste des Villes
                                <a class="white" href="{{ route('villes.create') }}" title="ajouter un article">
                                <span class="float-right">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                </a>
                            </h1>
                        </div>
                        <div class="box-search-body text-left">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Photo Principale</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allVilles as $ville)
                                    <tr>
                                        <td scope="row">{{ $ville->id }}</td>
                                        <td scope="row">
                                            <a href="{{ route('villes.edit', ['ville' => $ville->id]) }}">
                                                {{ str_limit($ville->name, 60) }}<br>
                                            </a>
                                        </td>
                                        <td scope="row">
                                            {!! $ville->title !!}
                                        </td>
                                        <td>
                                            <img src="/storage/{{ $ville->main_photo }}" width="50px">
                                        </td>
                                        <td> options </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $allVilles->links() }}
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