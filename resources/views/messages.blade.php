@php
    use Carbon\Carbon;
@endphp
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>{{ $active ?? '' ? "$active |" : '' }}Berbagi Bites Jogja</title>
</head>

<body class="bg-navy pb-72">
    <header class="w-full bg-tosca p-5">
        <a href="https://berbagibitesjogja.site">
            <img src="{{ asset('assets/putih.png') }}" class="h-12 inline" alt="">
            <span class="font-bold text-2xl text-white">Berbagi Bites Jogja</span>
        </a>
    </header>
    <div class="max-w-lg mx-auto px-8">
        <div class="pt-6 h-screen bg-navy">
            {{-- ada  --}}
            <h1 class="text-center text-2xl font-bold text-white mb-6">Confess Buat {{ $target->nama }}</h1>
            @foreach ($target->messages() as $item)
            <div class="bg-tosca p-2 text-white rounded-md mt-3">
                <h1 class="italic text-xs text-gray-800">{{ $item->created_at }}</h1>
                <h1 class="text-md">{{ $item->pesan }}</h1>
            </div>
            @endforeach
            <a href="/" class="mt-3 block w-max bg-tosca-700 hover:bg-tosca-900 p-2 text-white rounded-md">Mau Confess?</a>
        </div>
    </div>
    <footer class="fixed bottom-0 w-full bg-navy py-4">
        <h1 id="clickFooter" class="text-center text-sm text-white font-semibold">© Copyright 2024 BERBAGI BITES
            JOGJA. All Rights Reserved.</h1>
    </footer>
</body>

</html>
