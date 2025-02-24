<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.web.head')
    <body>
        @include('layouts.web.navbar')
        @yield('content')
        @include('layouts.web.script')
    </body>
</html>
