@extends('themes::layout')

@php
    $menu = \Kho8k\Core\Models\Menu::getTree();
    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 8]);
                try {
                    $data[] = [
                        'label' => $label,
                        'data' => \Kho8k\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp

@push('header')
    <link rel="stylesheet" href="{{ asset('/themes/pcc/libs/bootstrap-3.3.6/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/libs/bootstrap3-dialog/css/bootstrap-dialog.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/css/movie-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/css/bootstrap.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/css/bootstrap.social.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/css/bootstrap.grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/libs/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/libs/owl.carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/libs/wowslider/wowslider.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/libs/slidebars/slidebars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/css/style926f.css?ver=2.45') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/css/responsivepv.css') }}">
    <link rel="stylesheet" href="{{ asset('/themes/pcc/css/custom926f.css?ver=2.45') }}">
@endpush

@section('body')
    @include('themes::themepcc.inc.header')
    <main class="pb-5">
        <div id="sb-site" style="-webkit-transform: none; -moz-transform: unset; -o-transform: unset; transform: none;">
            <div class="pd120">
	    	 @if (get_theme_option('ads_header'))
        		<div class="ad-container watch-banner-2">
            			{!! get_theme_option('ads_header') !!}
        		</div>
    		 @endif
	    </div>
            <div class="light-overlay"></div>
            @yield('slider_recommended')
            <section id="content">
                <div class="container-fluid clearfix">
                    @yield('breadcrumb')
                    <div class="column-with-300">
                        @yield('content')
                    </div>
                    @include('themes::themepcc.inc.aside')
                </div>
            </section>
        </div>
    </main>
@endsection

@section('footer')
    @php
        $randomTags = \Kho8k\Core\Models\Tag::inRandomOrder()->limit(6)->get();
    @endphp
    <div id="footer" class="full">
        <div class="footer-tags">
            <div class="col-xs-12">
                <div class="nav-footer">
                    <ul id="menuFooter" class="menu-footer">
                        @foreach($randomTags as $tag)
                            <li class="tag"><a href="/tu-khoa/{{ $tag->slug }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
	<div id="top_footer" class="full">
            {!! get_theme_option('footer') !!}
        </div>
    </div>

    @if (get_theme_option('ads_catfish'))
        <div id="catfish" style="width: 100%;position:fixed;bottom:0;left:0;z-index:222" class="mp-adz">
            <div style="position: relative; margin: 0 auto; text-align: center; overflow: visible;" id="container-ads">
                <button id="close-catfish" style="position: absolute; top: -10px; right: 10px; background-color: transparent; border: none; font-size: 20px; cursor: pointer; color: #fff;">&times;</button>
                {!! get_theme_option('ads_catfish') !!}
            </div>
        </div>

        <script>
            document.getElementById('close-catfish').addEventListener('click', function() {
                document.getElementById('catfish').style.display = 'none';
            });
        </script>
    @endif

    <script src="{{ asset('/themes/pcc/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/themes/pcc/js/core.min.js') }}"></script>
    <script src="{{ asset('/themes/pcc/js/toastr.min.js') }}"></script>
    <script src="{{ asset('/themes/pcc/js/function.js') }}"></script>
    {{-- <script src="{{ asset('/themes/pcc/js/custom926f.js?ver=2.45') }}"></script> --}}

    {!! setting('site_scripts_google_analytics') !!}
@endsection
