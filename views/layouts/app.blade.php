<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link rel="stylesheet" href="{{ path('/css/app.css') }}">

</head>
<body class="bg-gray-200 min-h-screen font-base">
<div id="app">

    <div class="flex flex-col md:flex-row">

        <base-sidebar></base-sidebar>

        <div class="w-full md:flex-1">
            <main>
                <!-- Replace with your content -->
                <div class="px-8 py-6">
                    @yield('content')
                </div>
                <!-- /End replace -->
            </main>
        </div>
    </div>
</div>
</body>
<script>
    window.routes = {!! json_encode(routes())  !!};
</script>
<script src="{{ path('/js/app.js') }}" defer></script>
</html>
