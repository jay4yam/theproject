@extends('layouts.back', [
                        'title' => 'Listing de toutes les compagnies aérienne',
                        'compagnyCssActive' => 'active'
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
                            <h1 class="admin">Liste des compagnies
                                <a class="white" href="{{ route('compagnies.create') }}" title="ajouter une compagnie">
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
                                    <th scope="col">Logo</th>
                                    <th scope="col">Compagnie</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Tel</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($allCompagnies as $compagny)
                                        <tr>
                                            <td scope="row">{{ $compagny->id }}</td>
                                            <td>
                                                <img class="img-back img-responsive" src="/storage/{{ $compagny->logo }}">
                                            </td>
                                            <td>
                                                <a href="{{ url()->route('compagnies.edit', ['compagny' => $compagny->id]) }}">
                                                    {{ $compagny->raison_sociale }}
                                                </a>
                                            </td>
                                            <td>{{ $compagny->email }}</td>
                                            <td>{{ $compagny->telephone }}</td>
                                            <td style="width: 11%;">
                                                <a href="{{ url()->route('compagnies.edit', ['compagny' => $compagny->id]) }}">
                                                    <button class="btn btn-info pull-left">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </a>
                                                <form class='delete' action="{{ route('compagnies.destroy', ['compagny' => $compagny->id]) }}">
                                                    {{ csrf_field() }}
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button class="btn btn-danger pull-right">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-terms-bottom ptb-10">
                            <button class="button button-primary" type="submit">
                                <i class="fas fa-plus-square"></i>
                                Ajouter une compagnie
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection