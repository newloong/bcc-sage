<!doctype html>
<html @php(language_attributes())>
@include('partials.head')
<body @php(body_class())>
@php(do_action('get_header'))
    @include('partials.header')
    <div class="wrap container container-fluid " role="document">
        <div class="content clearfix row-fluid">
            <main class="col-sm-8 clearfix">
                @yield('content')
            </main>
            @if (App\display_sidebar())
                <aside id="sidebar" class="fluid-sidebar sidebar col-sm-4">
                    @include('partials.sidebar')
                </aside>
            @endif
        </div>
    </div>
    @php(do_action('get_footer'))
        @include('partials.footer')
        @php(wp_footer())
</body>
</html>
