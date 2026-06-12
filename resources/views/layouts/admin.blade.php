<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank Stewardship - Dashboard</title>
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
            background-color: #92E3A9 !important;
            color: #1E5631 !important;
            font-weight: 700 !important;
        }
    </style>
</head>

<body class="antialiased text-slate-800">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-[#E8F9EE] flex flex-col fixed h-full z-50 border-r border-emerald-100/30">
            <div class="p-6 flex items-center gap-3 mt-2">
                <div class="w-10 h-10 bg-[#2D6A4F] rounded-xl flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-recycle text-xl"></i>
                </div>
                <div>
                    <span class="text-2xl font-extrabold tracking-tight text-[#1E5631] block">EcoBank</span>
                    <span class="text-[10px] font-bold text-[#52B788] uppercase tracking-wider block -mt-1">Stewardship</span>
                </div>
            </div>

            <nav class="flex-1 px-4 mt-4 space-y-1 overflow-y-auto text-slate-700">
                <a href="{{ route('admin.dashboard') }}" class="{{ Request::routeIs('admin.dashboard') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-table-columns w-5 text-center"></i> Dashboard
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="{{ Request::routeIs('admin.kategori.*') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-arrows-spin w-5 text-center"></i> Data Sampah
                </a>
                <a href="{{ route('admin.warga.index') }}" class="{{ Request::routeIs('admin.warga.*') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-users w-5 text-center"></i> Daftar Tamu
                </a>
                <a href="{{ route('admin.barang_masuk.index') }}" class="{{ Request::routeIs('admin.barang_masuk.*') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-download w-5 text-center"></i> Barang Masuk
                </a>
                <a href="{{ route('admin.barang_keluar.index') }}"
                    class="{{ Request::routeIs('admin.barang_keluar.*') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-upload w-5 text-center"></i> Barang Keluar
                </a>

                <a href="{{ route('admin.reward.index') }}" class="{{ Request::routeIs('admin.reward.*') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-money-bill-transfer w-5 text-center"></i> Tukar Koin
                </a>
                <div class="border-t border-emerald-200/50 my-4"></div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-emerald-100/50 transition-all text-sm font-medium">
                    <i class="fa-solid fa-chart-simple w-5 text-center"></i> Laporan
                </a>
                <a href="{{ route('admin.transaksi.index') }}" class="{{ Request::routeIs('admin.transaksi.*') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-clock-rotate-left w-5 text-center"></i> Riwayat Transaksi
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-emerald-100/50 transition-all text-sm font-medium">
                    <i class="fa-solid fa-receipt w-5 text-center"></i> E-Struk
                </a>
            </nav>

            <div class="p-4 m-4 bg-emerald-50 rounded-2xl border border-emerald-100/50">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=2D6A4F&color=fff" class="w-9 h-9 rounded-xl shadow-sm" alt="User Avatar">
                    <div>
                        <p class="text-xs font-bold text-slate-900">Budi Santoso</p>
                        <p class="text-[10px] font-medium text-slate-400 uppercase tracking-wider">Manager</p>
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

        <div class="flex-1 ml-64 flex flex-col">
            <header class="flex justify-between items-center bg-white border-b border-slate-100 px-10 py-5 sticky top-0 z-40 shadow-xs">
                <div>
                    <h2 class="text-sm font-bold text-[#1E5631] tracking-wide flex items-center gap-2">
                        <span class="w-1.5 h-3.5 bg-[#2D6A4F] rounded-xs inline-block"></span>
                        @yield('page_title', 'Dashboard')
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text"
                            placeholder="@yield('search_placeholder', 'Cari data...')"
                            class="bg-[#E8F9EE]/50 border border-transparent py-2 pl-10 pr-4 rounded-xl text-xs outline-none focus:bg-white focus:border-emerald-500 transition-all w-64 text-slate-700 placeholder-slate-400 font-medium">
                    </div>
                    <button class="w-9 h-9 flex items-center justify-center bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-emerald-600 hover:border-emerald-100 shadow-xs transition-all cursor-pointer">
                        <i class="fa-regular fa-bell text-xs"></i>
                    </button>
                    <button class="w-9 h-9 flex items-center justify-center bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-emerald-600 hover:border-emerald-100 shadow-xs transition-all cursor-pointer">
                        <i class="fa-solid fa-gear text-xs"></i>
                    </button>
                </div>
            </header>

            <main class="p-10 flex-1">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>