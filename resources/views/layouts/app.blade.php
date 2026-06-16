<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>

        <div id="logoutModal" class="hidden fixed inset-0 flex items-center justify-center bg-green-50/80 p-4 z-50">
            <div class="bg-white rounded-3xl p-8 w-full max-w-sm shadow-lg flex flex-col items-center text-center">
                <div class="w-32 h-32 bg-green-100 rounded-full mb-6 overflow-hidden">
                    <img src="{{ asset('images/logout-illustration.png') }}" alt="Logout" class="w-full h-full object-cover" />
                </div>
                <h2 class="text-2xl font-bold text-[#064e3b] mb-3">Sudah selesai bekerja?</h2>
                <p class="text-gray-500 mb-8 text-sm">Terima kasih telah berkontribusi menjaga kelestarian lingkungan hari ini. Apakah Anda yakin ingin mengakhiri sesi ini?</p>
                <div class="w-full space-y-3">
                    <button onclick="document.getElementById('logoutModal').classList.add('hidden')" class="w-full py-3 bg-[#2d7d5d] text-white rounded-xl font-semibold hover:bg-[#23664a]">
                        Tetap di Sini
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-3 border-2 border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50">
                            Keluar Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>