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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in { animation: fadeIn .35s ease-out; }

        .admin-input {
            width: 100%;
            background: rgba(248, 250, 252, 0.8);
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            outline: none;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .admin-input:focus {
            border-color: #1E5631;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(30, 86, 49, 0.12);
        }

        .admin-btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: #1E5631;
            color: #fff;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.75rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: background .2s, transform .15s, box-shadow .2s;
        }

        .admin-btn-primary:hover { background: #2D6A4F; box-shadow: 0 4px 14px rgba(30, 86, 49, 0.25); }
        .admin-btn-primary:active { transform: scale(0.98); }
        .admin-btn-primary.loading { opacity: 0.7; pointer-events: none; }

        .admin-btn-ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            padding: 0.5rem 0.75rem;
            border-radius: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
        }

        .admin-btn-ghost:hover { background: #f8fafc; border-color: #1E5631; color: #1E5631; }

        .admin-btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            border: 2px solid #1E5631;
            color: #1E5631;
            background: transparent;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
        }

        .admin-btn-outline:hover { background: #E8F9EE; }

        .filter-pill {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            color: #64748b;
            background: #fff;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            transition: all .2s;
        }

        .filter-pill:hover { border-color: #1E5631; color: #1E5631; }
        .filter-pill-active { background: #1E5631; color: #fff; border-color: #1E5631; }

        .toast-success {
            background: #d1e7dd;
            border: 1px solid #badbcc;
            color: #0f5132;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            animation: fadeIn .3s ease-out;
        }

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

        .receipt-paper { position: relative; }
        .receipt-paper::before,
        .receipt-paper::after {
            content: '';
            display: block;
            height: 8px;
            background: linear-gradient(135deg, #fff 33.33%, transparent 33.33%) 0 0,
                        linear-gradient(-135deg, #fff 33.33%, transparent 33.33%) 0 0;
            background-size: 12px 12px;
            background-color: #f8fafc;
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
                <a href="{{ route('admin.laporan.index') }}" class="{{ Request::routeIs('admin.laporan.*') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-chart-simple w-5 text-center"></i> Laporan
                </a>
                <a href="{{ route('admin.riwayat_transaksi.index') }}" class="{{ Request::routeIs('admin.riwayat_transaksi.*') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
                    <i class="fa-solid fa-clock-rotate-left w-5 text-center"></i> Riwayat Transaksi
                </a>
                <a href="{{ route('admin.estruck.index') }}" class="{{ Request::routeIs('admin.estruck.*') ? 'sidebar-active' : 'hover:bg-emerald-100/50' }} flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-sm font-medium">
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
                    <form method="GET" action="{{ request()->url() }}" class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="@yield('search_placeholder', 'Cari data...')"
                            class="bg-[#E8F9EE]/50 border border-transparent py-2 pl-10 pr-4 rounded-xl text-xs outline-none focus:bg-white focus:border-emerald-500 transition-all w-64 text-slate-700 placeholder-slate-400 font-medium">
                    </form>
                    <button onclick="showNotificationModal()" class="w-9 h-9 flex items-center justify-center bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-emerald-600 hover:border-emerald-100 shadow-xs transition-all cursor-pointer">
                        <i class="fa-regular fa-bell text-xs"></i>
                    </button>
                    <a href="{{ route('profile.edit') }}" class="w-9 h-9 flex items-center justify-center bg-white border border-slate-100 rounded-xl text-slate-400 hover:text-emerald-600 hover:border-emerald-100 shadow-xs transition-all cursor-pointer">
                        <i class="fa-solid fa-gear text-xs"></i>
                    </a>
                </div>
            </header>

            <main class="p-10 flex-1">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Notification Modal -->
    <div id="notificationModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4 shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-slate-800">Notifikasi</h3>
                <button onclick="hideNotificationModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="space-y-3">
                <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4">
                    <p class="text-sm font-bold text-emerald-800">Sistem Berjalan Normal</p>
                    <p class="text-xs text-emerald-600 mt-1">Semua fitur berfungsi dengan baik.</p>
                </div>
                <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">
                    <p class="text-sm font-bold text-slate-800">Belum Ada Notifikasi Baru</p>
                    <p class="text-xs text-slate-500 mt-1">Anda akan menerima notifikasi saat ada aktivitas penting.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showNotificationModal() {
            document.getElementById('notificationModal').classList.remove('hidden');
            document.getElementById('notificationModal').classList.add('flex');
        }

        function hideNotificationModal() {
            document.getElementById('notificationModal').classList.add('hidden');
            document.getElementById('notificationModal').classList.remove('flex');
        }

        document.querySelectorAll('.admin-form[data-loading]').forEach(form => {
            form.addEventListener('submit', function () {
                const btn = form.querySelector('button[type="submit"]');
                if (btn) {
                    btn.classList.add('loading');
                    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
                }
            });
        });

        document.querySelectorAll('.filter-pill').forEach(pill => {
            pill.addEventListener('click', function () {
                this.parentElement.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('filter-pill-active'));
                this.classList.add('filter-pill-active');
            });
        });
    </script>
</body>

</html>