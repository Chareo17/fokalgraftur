<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.header')
</head>
<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
</body>

</html>
