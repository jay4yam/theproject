@extends('layouts.back', [
                            'title' => 'Listing de tous les articles du blog',
                            'blogCssActive' => 'active'
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
                            <h1 class="admin">Liste des articles
                                <a class="white" href="{{ route('blogs.create') }}" title="ajouter un article">
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
                                    <th scope="col">Visible</th>
                                    <th scope="col">Crée le</th>
                                    <th scope="col">Crée par</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allBlogArticles as $article)
                                    <tr>
                                        <td scope="row">{{ $article->id }}</td>
                                        <td>
                                            <a href="{{ route('blogs.edit', ['id' => $article->id]) }}">
                                            {{ str_limit($article->title, 60) }}<br>
                                            </a>
                                            <small class="xx-small">
                                                /{!! $article->categories->first()['title'] ? $article->categories->first()['title'] : '<strong>sans-cat</strong>' !!}/{{ str_slug($article->title) }}
                                            </small>
                                        </td>
                                        <td>
                                            {!! $article->is_public ? '<i class="fas fa-eye"></i> oui': '<i class="fas fa-eye-slash"></i> non' !!}
                                        </td>
                                        <td>{{ $article->created_at->format('d M Y') }}</td>
                                        <td>{{ $article->user->profile->firstName    }}</td>
                                        <td> options </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-terms-bottom ptb-10">
                            <button class="button button-primary" type="submit">
                                <i class="fas fa-plus-square"></i>
                                Ajouter un article
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection