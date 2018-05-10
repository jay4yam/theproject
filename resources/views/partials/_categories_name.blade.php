@foreach($categoriesName as $category)
    <li class="text-small">
        <a class="text-silver-chalice" href="{{ route('blog.categorie', [ 'locale' => App::getLocale() , 'id' => $category['id'], 'categorie' => str_slug($category['title'])]) }}">
            <span class="pull-left">{{ $category['title'] }} ({{ $category['count'] }})</span>
            <span class="pull-right text-ubold icon mdi mdi-chevron-right"></span>
            <span class="clearfix"></span>
        </a>
    </li>
@endforeach