@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/back-office/setting/category/index.css')}}"/>
@endsection

<div class="row pagination-detail clearfix">
    <div class="col-xs-12 col-sm-4 left clearfix"></div>
    <div class="col-xs-12 col-sm-8 right">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-number disabled"><a class="not-active"><</a></li>
                @else
                    <li class="page-number"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><</a></li>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled"><a>{{ $element }}</a></li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-number active"><a>{{ $page }}</a></li>
                            @elseif ($page > 0)
                                <li class="page-number"><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <li class="page-number"><a href="{{ $paginator->nextPageUrl() }}" rel="next">></a></li>
                @else
                    <li class="page-number disabled"><a class="not-active">></a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>