<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('partials._head')
</head>
<body>
    <div id="app">
        @include('partials._nav')
		@include('partials._message')
        @yield('content')
    </div>

    @include('partials._mainScript')
    @yield('script')
</body>
</html>
