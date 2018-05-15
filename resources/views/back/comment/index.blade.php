@extends('layouts.back', [
                            'title' => 'Listing de tous les commentaires du blog',
                            'blogCommentActive' => 'active'
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
                            <h1 class="admin">Liste des Commentaires
                            </h1>
                        </div>
                        <div class="box-search-body text-left">
                            <table class="table table-striped table-responsive-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#id</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Utilisateur</th>
                                    <th scope="col">Crée le</th>
                                    <th scope="col">lié à </th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td scope="row">{{ $comment->id }}</td>
                                        <td>
                                            <a href="{{ route('comments.edit', ['id' => $comment->id]) }}">
                                                {{ str_limit($comment->content, 100) }}<br>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $comment->user->email }}
                                        </td>
                                        <td>{{ $comment->created_at->format('d M Y') }}</td>
                                        <td>{{ $comment->commentable instanceof \App\Models\Blog ? 'blog' : 'voyage' }}</td>
                                        <td> options </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-terms-bottom ptb-10">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection