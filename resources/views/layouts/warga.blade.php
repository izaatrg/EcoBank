<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank Warga - Portal Nasabah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FBF9;
        }

        .sidebar-active {
            background-color: #1b513e !important;
            color: #ffffff !important;
            font-weight: 700 !important;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in { animation: fadeIn .35s ease-out; }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.625rem;
            border-radius: 9999px;
            font-size: 0.625rem;
            font-weight: 800;
            letter-spacing: 0.04em;
        }

        .status-emerald { background: #d1fae5; color: #065f46; }
        .status-amber { background: #fef3c7; color: #92400e; }
        .status-red { background: #fee2e2; color: #991b1b; }
    </style>
</head>

<body class="antialiased text-slate-800">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#E8F9EE] flex flex-col fixed h-full z-50 border-r border-emerald-100/30">
            <div class="p-6 flex items-center gap-3 mt-2">
                <div class="w-10 h-10 bg-[#1b513e] rounded-xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-leaf text-xl"></i>
                </div>
                <div>
                    <span class="text-2xl font-extrabold tracking-tight text-[#1b513e] block">EcoBank</span>
                    <span class="text-[10px] font-bold text-[#52B788] uppercase tracking-wider block -mt-1">Warga Portal</span>
                </div>
            </div>

            <nav class="flex-1 px-4 mt-4 space-y-1 overflow-y-auto text-slate-700">
                <a href="{{ route('warga.dashboard') }}" class="{{ Request::routeIs('warga.dashboard') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-chart-line w-5 text-center"></i> Dashboard
                </a>
                <a href="{{ route('warga.setor.form') }}" class="{{ Request::routeIs('warga.setor.form') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-dumpster-fire w-5 text-center"></i> Setor Sampah
                </a>
                <a href="{{ route('warga.jemput.form') }}" class="{{ Request::routeIs('warga.jemput.form') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-truck w-5 text-center"></i> Jemput Sampah
                </a>
                <a href="{{ route('warga.tukar.form') }}" class="{{ Request::routeIs('warga.tukar.form') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-gift w-5 text-center"></i> Tukar Koin
                </a>
                
                <div class="border-t border-emerald-200/50 my-4"></div>
                
                <a href="{{ route('warga.riwayat') }}" class="{{ Request::routeIs('warga.riwayat') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-clock-rotate-left w-5 text-center"></i> Riwayat Setoran
                </a>
                <a href="{{ route('warga.jemput.history') }}" class="{{ Request::routeIs('warga.jemput.history') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-calendar-check w-5 text-center"></i> Jadwal Jemput
                </a>
                <a href="{{ route('warga.tukar.history') }}" class="{{ Request::routeIs('warga.tukar.history') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-receipt w-5 text-center"></i> Penukaran Reward
                </a>
            </nav>

            <!-- User Profile Card -->
            <div class="p-4 m-4 bg-emerald-50 rounded-2xl border border-emerald-100/50">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1b513e&color=fff" 
                         class="w-9 h-9 rounded-xl shadow-sm object-cover border border-emerald-600/10" 
                         alt="Warga Avatar">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-slate-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wider">Warga Nasabah</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 bg-white hover:bg-red-50 text-red-600 rounded-xl text-xs font-bold transition-all shadow-sm border border-red-50 cursor-pointer">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Content Area -->
        <div class="flex-1 ml-64 flex flex-col">
            <header class="flex justify-between items-center bg-white border-b border-slate-100 px-10 py-5 sticky top-0 z-40 shadow-xs">
                <div>
                    <h2 class="text-sm font-bold text-[#1b513e] tracking-wide flex items-center gap-2">
                        <span class="w-1.5 h-3.5 bg-[#1b513e] rounded-xs inline-block"></span>
                        @yield('page_title', 'Dashboard')
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <div style="font-size: 0.8rem; color: #64748b; font-weight: 600;">
                        {{ now()->format('l, d F Y') }}
                    </div>
                    <a href="{{ route('warga.profile') }}" class="w-9 h-9 flex items-center justify-center bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-emerald-600 hover:border-emerald-100 shadow-xs transition-all cursor-pointer">
                        <i class="fa-solid fa-user text-xs"></i>
                    </a>
                </div>
            </header>

            <main class="p-10 flex-1">
                @if(session('info'))
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6 text-sm text-blue-800 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>{{ session('info') }}</span>
                </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>