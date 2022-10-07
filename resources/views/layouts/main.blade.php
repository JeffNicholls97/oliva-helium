<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="icon" href="{{ url('images/favicon.ico') }}">
    @livewireStyles
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#f9f9fb] font-sans">
    <main class="p-5 h-screen">
        <div class="flex gap-5 h-full">
            <livewire:menu-bar />
            <div class="flex-grow flex flex-col gap-5">
                <livewire:top-bar />
                <div class="bg-white overflow-y-auto p-5 rounded-lg flex-grow">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>


    @livewireScripts
    @livewireChartsScripts
</body>
</html>
