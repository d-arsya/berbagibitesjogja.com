@extends('layouts.main')
@section('container')
    <div class="max-w-lg mx-auto mt-6">
        <div class="flex flex-row flex-wrap gap-3">
        </div>
        <div class="p-4">
            <div>
                <div class="w-full rounded-lg bg-white shadow-xl mt-4 py-5 px-6">
                    <h1 class="text-lg text-tosca font-semibold text-center">Confess BBJ</h1>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="relative z-0 w-full mt-8 group">
                            <input type="text" name="code" id="code"
                                class="block py-2.5 px-2.5 w-full text-sm text-gray-900 bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " name="code" required />
                            <label for="code"
                                class="peer-focus:font-medium absolute text-md text-gray-700 duration-300 transform -translate-y-8 scale-75 top-2 left-6 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-8">Kode
                                Akses</label>
                        </div>
                        <button
                            class="w-full px-4 py-2 mt-10 text-sm font-medium text-white bg-navy rounded-md hover:bg-navy-600 focus:outline-none focus:ring-2 focus:ring-navy-500 focus:ring-opacity-50"
                            type="submit">Daftar</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
