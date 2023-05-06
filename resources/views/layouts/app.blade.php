<html>
    <head>
        <title>Casino Application</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Toastr messages --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    </head>
    <body>
        <div id="app">
            @include('components/Navigation')

            <main>
                @yield('content')
            </main>
        </div>
        <script>
            @if(Session::has('message'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.success("{{ session('message') }}");
            @endif

                @if(Session::has('error'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.error("{{ session('error') }}");
            @endif

                @if(Session::has('info'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.info("{{ session('info') }}");
            @endif

                @if(Session::has('warning'))
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
            toastr.warning("{{ session('warning') }}");
            @endif
        </script>
    </body>
</html>
