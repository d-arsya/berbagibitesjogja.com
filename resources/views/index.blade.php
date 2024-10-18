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
            <h1 class="text-center text-2xl font-bold text-white">Confess BBJ</h1>
            <div class="w-full rounded-lg bg-tosca mt-8 py-5 px-6">
                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <select name="target" id="target"
                        class="bg-navy border border-navy text-white font-bold text-sm rounded-lg focus:ring-navy focus:border-navy block w-full p-2.5" required>
                        <option value="">Mau Buat Siapa?</option>
                        @foreach ($targets as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <textarea id="pesan" rows="8" name="pesan"
                        class="mt-3 block p-2.5 w-full text-sm text-white bg-navy rounded-lg border border-navy focus:ring-navy focus:border-navy"
                        placeholder="Mau confess apa niih..." required></textarea>

                    <input type="submit" value="Kirim"
                        class="w-full bg-white rounded-md p-1 text-lg font-bold mt-10 text-navy">
                </form>
            </div>
                <form action="{{ route('messages') }}" method="POST">
                    @csrf
                    <div class="flex flex-row justify-between gap-3 items-center mt-3">
                        <input type="text" name="kode" id="kode" class="bg-gray-50 border h-max border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" placeholder="Kode Akses" required />
                    </div>
                </form>
        </div>
    </div>
    <footer class="fixed bottom-0 w-full bg-navy py-4">
        <h1 id="clickFooter" class="text-center text-sm text-white font-semibold">© Copyright 2024 BERBAGI BITES
            JOGJA. All Rights Reserved.</h1>
    </footer>
</body>

</html>
