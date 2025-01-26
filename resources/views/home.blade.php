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
                {{ $user->role }} di
                divisi
                {{ $user->division }}. Terima kasih udah meluangkan waktu untuk mengisi form evaluasi ini, pendapat kamu
                sangat berarti untuk BBJ
            </h1>
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
                    <textarea id="text" rows="8" name="text" class="mt-3 block p-2.5 w-full text-sm rounded-lg border"
                        placeholder="Mau confess apa niih..." required></textarea>
                    <button
                        class="w-full px-4 py-2 mt-10 text-sm font-bold text-white bg-tosca rounded-md hover:bg-tosca-700 focus:outline-none"
                        type="submit">Kirim</button>
                </form>
            </div>
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
                            @if ($user->division == 'Friend')
                                <h1>{{ randomName() }} buat <span
                                        class="text-tosca font-bold text-md">{{ $item->user->name }}</span>
                                </h1>
                            @else
                                <h1>{{ randomName() }}</h1>
                            @endif
                            <h1 class="font-thin italic text-sm">
                                {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, DD MMMM hh:mm') }}</h1>
                        </div>
                    </div>
                    <p class="font-light mt-6 text-justify">{{ $item->text }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
