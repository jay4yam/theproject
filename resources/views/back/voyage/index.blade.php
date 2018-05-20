@extends('layouts.back', [
                        'title' => 'Listing de toutes les voyages',
                        'voyagesCssActive' => 'active'
                        ])

@section('dedicated_css')
@endsection

@section('content')
    <!-- Destinations-->
    <section class="section-80 bg-wild-wand">
        <div class="container container-custom">
            <div class="row justify-content-sm-center">
                <div class="col-md-12 col-lg-12">
                    <!-- Box-->
                    <div class="box box-search bg-default d-block">
                        <div class="box-search-wrap">
                            <!-- RD Search Form-->
                            <h1 class="admin">Liste des voyages
                                <a class="white" href="{{ route('voyages.create') }}" title="ajouter un voyage">
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
                                    <th scope="col">Titre</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allVoyages as $voyage)
                                    <tr>
                                        <td scope="row">{{ $voyage->id }}</td>
                                        <td>
                                            <a href="{{ url()->route('voyages.edit', ['id' => $voyage->id]) }}">
                                                {{ $voyage->title }}
                                            </a>
                                        </td>
                                        <td> {{ $voyage->ville->name }}</td>
                                        <td> {{ $voyage->price }} €</td>
                                        <td> options </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $allVoyages->links() }}
                        </div>
                        <div class="box-terms-bottom ptb-10">
                            <button class="button button-primary" type="submit">
                                <i class="fas fa-plus-square"></i>
                                Ajouter un voyage
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection