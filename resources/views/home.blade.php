@php

    function randomName()
    {
        $names = [
            'BrokoliBeruang',
            'KaktusKucing',
            'BambuBurung',
            'JagungJerapah',
            'PepayaPenguin',
            'LumutLemur',
            'KembangKelelawar',
            'CendawanCheetah',
            'SemangkaSigung',
            'KentangKoala',
            'MelatiMerak',
            'LadaLlama',
            'DurianDomba',
            'PisangPanda',
            'MawarMonyet',
            'TerataiTikus',
            'BonsaiBebek',
            'JamurJaguar',
            'KelapaKanguru',
            'LavenderLumba',
            'TomatTupai',
            'AnggurAnjing',
            'CemaraCicak',
            'EdelweissElang',
            'BayamBuaya',
            'PakisPaus',
            'KakaoKadal',
            'TehTarantula',
            'SeladaSerigala',
            'CeriCacing',
        ];
        return $names[array_rand($names)];
    }
@endphp
@extends('layouts.main')
@section('container')
    <div class="grid md:grid-cols-2 grid-cols-1 gap-x-12 gap-y-20">
        <div>
            <h1 class="text-2xl text-tosca font-bold"><span class="text-black text-sm font-normal">Halo,</span>
                {{ $user->name }}
            </h1>
            <h1 class="font-light text-sm">Sebelumnya kita mau ngucapin terimakasih atas dedikasimu sebagai
                {{ $user->division }}. Terima kasih udah meluangkan waktu untuk mengisi form evaluasi ini, pendapat kamu
                sangat berarti untuk BBJ
            </h1>
            @if ($targets)
                <div class="bg-white shadow-lg rounded-md p-6">
                    <form action="{{ route('home') }}" method="POST">
                        @csrf
                        <select
                            class="w-full mt-8 p-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600"
                            placeholder="Nomor Whatsapp" name="user_id" required>
                            <option value="">Partnermu</option>
                            @foreach ($targets as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <textarea id="text" rows="8" name="saran" class="mt-3 block p-2.5 w-full text-sm rounded-lg border"
                            placeholder="Kasih saran dong" required></textarea>
                        <textarea id="text" rows="8" name="kritik" class="mt-3 block p-2.5 w-full text-sm rounded-lg border"
                            placeholder="Ada kritik ga nih" required></textarea>
                        <button
                            class="w-full px-4 py-2 mt-10 text-sm font-bold text-white bg-tosca rounded-md hover:bg-tosca-700 focus:outline-none"
                            type="submit">Kirim</button>
                    </form>
                </div>
            @else
                <div class="bg-white shadow-lg rounded-md p-6">
                    <a href="/" class="bg-navy rounded-md p-2 text-white hover:bg-navy-600">Back home</a>
                </div>
            @endif
            <h1 class="text-center text-sm font-bold italic mt-6 text-slate-400">Made possible by IT and Friends</h1>

        </div>
        <div class="flex gap-y-6 flex-col overflow-scroll h-screen p-6">
            @foreach ($messages as $item)
                <div class="bg-white shadow-md p-6">
                    <div class="w-full flex gap-x-3">
                        <img class="rounded-full"
                            src="https://avatar.iran.liara.run/public/boy?username={{ randomName() }}" width="50"
                            alt="">
                        <div class="w-72">
                            @if ($user->division == 'PSDM')
                                <h1>{{ randomName() }} buat <a href="{{ route('mess', base64_encode($item->user->code)) }}"
                                        class="text-tosca font-bold text-md">{{ $item->user->name }}</a>
                                </h1>
                            @else
                                <h1>{{ randomName() }}</h1>
                            @endif
                            <h1 class="font-thin italic text-sm">
                                {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, DD MMMM hh:mm') }}</h1>
                        </div>
                    </div>
                    <h6 class="text-xl font-bold mt-4">Saran :</h6>
                    <p class="font-light text-justify">{{ $item->saran }}</p>
                    <h6 class="text-xl font-bold mt-4">Kritik :</h6>
                    <p class="font-light text-justify">{{ $item->kritik }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
