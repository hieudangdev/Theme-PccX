<div class="col-xlg-2 col-lg-15 col-md-3 col-sm-4 col-xs-6">
    <div class="item">
        <a class="inner" href="{{ $movie->episodes->sortBy([['server', 'asc']])->groupBy('server')->first()->sortByDesc('name', SORT_NATURAL)->groupBy('name')->last()->sortByDesc('type')->first()->getUrl() }}"
            title="{{$movie->name}}">
            <img
                data-src="{{$movie->getThumbUrl()}}"
                alt="{{$movie->name}}"
                class="movie-thumb lazyload lazy-loaded"
            />
            <span class="thumb-icon">
                <i class="sp-movie-icon-play"></i>
            </span>
            <span class="overlay"></span>
            <div class="description">
                <h3 class="text-nowrap">{{$movie->name}}</h3>
                <div class="meta clearfix">
                    <span class="pull-left">{{$movie->publish_year}}</span>
                    <span class="pull-right">{{$movie->episode_time}}</span>
                </div>
            </div>
            <span class="badge">{{$movie->quality}} {{$movie->language}}</span>
        </a>
    </div>
</div>
