@extends('layouts.back', [
                        'title' => 'Listing de toutes les utilisateurs',
                        'userCssActive' => 'active'
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
                            <h1 class="admin">Liste des utilisateurs
                                <a class="white" href="{{ route('users.create') }}" title="ajouter un utilisateur">
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
                                    <th scope="col">Email</th>
                                    <th scope="col">Telephone</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Pays</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allUsers as $user)
                                    <tr>
                                        <td scope="row">{{ $user->id }}</td>
                                        <td>
                                            <a href="{{ url()->route('users.edit', ['id' => $user->id]) }}">{{ $user->email }}</a>
                                        </td>
                                        <td> {{ $user->profile->phoneNumber }}</td>
                                        <td> {{ $user->profile->city }}</td>
                                        <td> {{ $user->profile->country }}</td>
                                        <td>
                                            {{ $user->role }}
                                        </td>
                                        <td> options </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $allUsers->links() }}
                        </div>
                        <div class="box-terms-bottom ptb-10">
                            <button class="button button-primary" type="submit">
                                <i class="fas fa-plus-square"></i>
                                Ajouter un utilisateur
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection