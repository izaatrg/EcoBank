<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank - Ubah Sampah Menjadi Berkah</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F2FAF5] text-gray-900 antialiased overflow-x-hidden">

    <nav class="sticky top-0 z-50 bg-white border-b-2 border-[#D1E7DD] shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 bg-[#1E5631] rounded-lg flex items-center justify-center text-white text-lg shadow-sm">
                    ♻️
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-2xl font-extrabold text-[#1E5631] tracking-tight">EcoBank</span>
                    <span class="text-[10px] font-bold text-[#1E5631] tracking-[0.15em] uppercase">Stewardship</span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-8 font-semibold text-gray-750">
                <a href="#beranda" class="hover:text-[#059669] transition-colors relative after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#059669] hover:after:w-full after:transition-all">Beranda</a>
                <a href="#tentang-kami" class="hover:text-[#059669] transition-colors relative after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#059669] hover:after:w-full after:transition-all">Tentang Kami</a>
                <a href="#cara-kerja" class="hover:text-[#059669] transition-colors relative after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#059669] hover:after:w-full after:transition-all">Cara Kerja</a>
                <a href="#manfaat" class="hover:text-[#059669] transition-colors relative after:content-[''] after:absolute after:left-0 after:bottom-[-4px] after:w-0 after:h-[2px] after:bg-[#059669] hover:after:w-full after:transition-all">Manfaat</a>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/warga/dashboard') }}" class="bg-[#059669] text-white font-bold px-5 py-2.5 rounded-xl hover:bg-[#064e3b] transition-all duration-300 shadow-md transform hover:-translate-y-0.5 text-sm">
                    Dashboard Warga
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="border-2 border-red-500 text-red-600 font-bold px-4 py-2 rounded-xl hover:bg-red-50 transition-all duration-300 text-sm cursor-pointer">
                        Keluar
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="bg-[#059669] text-white font-bold px-8 py-2.5 rounded-xl hover:bg-[#064e3b] transition-all duration-300 shadow-md transform hover:-translate-y-0.5">
                    Masuk
                </a>
                @endauth
                @endif
            </div>
        </div>
    </nav>

    <section id="beranda" class="relative h-[calc(100vh-80px)] flex items-center justify-center overflow-hidden"
        x-data="{ 
                activeSlide: 1, 
                slides: [
                    { id: 1, img: 'https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?q=80&w=1920&auto=format&fit=crop' }, 
                    { id: 2, img: 'https://images.unsplash.com/photo-1595278069441-2cf29f8005a4?q=80&w=1920&auto=format&fit=crop' }, 
                    { id: 3, img: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1920&auto=format&fit=crop' }  
                ],
                next() {
                    this.activeSlide = this.activeSlide === this.slides.length ? 1 : this.activeSlide + 1;
                },
                prev() {
                    this.activeSlide = this.activeSlide === 1 ? this.slides.length : this.activeSlide - 1;
                },
                init() {
                    setInterval(() => { this.next(); }, 4000); 
                }
             }">

        <template x-for="slide in slides" :key="slide.id">
            <div class="absolute inset-0 z-0 transition-opacity duration-1000 ease-in-out"
                :class="activeSlide === slide.id ? 'opacity-100' : 'opacity-0'">
                <img :src="slide.img" class="w-full h-full object-cover" alt="EcoBank Background">
                <div class="absolute inset-0 bg-black/60 backdrop-blur-[1px]"></div>
            </div>
        </template>

        <button @click="prev()" class="absolute left-4 z-20 text-white/50 hover:text-white bg-black/10 hover:bg-black/30 w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold transition-all focus:outline-none select-none">
            &#10094;
        </button>

        <button @click="next()" class="absolute right-4 z-20 text-white/50 hover:text-white bg-black/10 hover:bg-black/30 w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold transition-all focus:outline-none select-none">
            &#10095;
        </button>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center space-y-6 text-white">
            <div class="inline-flex items-center gap-2 bg-[#059669] text-white px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-500 mx-auto shadow-md">
                🌱 Solusi Cerdas Pengelolaan Sampah Digital
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-[1.15] tracking-tight drop-shadow-md">
                Ubah Sampah Jadi <span class="text-[#34d399]">Koin</span>,<br>Jaga Lingkungan Tetap <span class="text-[#34d399]">Asri</span>
            </h1>

            <p class="text-gray-200 text-base md:text-lg leading-relaxed font-medium max-w-2xl mx-auto drop-shadow-sm">
                Sampah bukan lagi akhir, melainkan awal dari sebuah perubahan. Bersama EcoBank, mari pilah sampah anorganik Anda dari rumah, kumpulkan koin digitalnya, lalu tukarkan dengan berbagai hadiah atau benefit menarik!
            </p>

            <div class="flex flex-wrap justify-center gap-4 pt-4">
                @auth
                <a href="{{ url('/warga/dashboard') }}" class="bg-[#059669] hover:bg-[#064e3b] text-white font-bold px-8 py-3.5 rounded-xl transition-all duration-300 shadow-lg transform hover:-translate-y-1">
                    Kembali ke Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" class="bg-[#059669] hover:bg-[#064e3b] text-white font-bold px-8 py-3.5 rounded-xl transition-all duration-300 shadow-lg transform hover:-translate-y-1">
                    Mulai Menabung
                </a>
                @endauth
                <a href="#cara-kerja" class="bg-white/10 hover:bg-white/20 text-white font-bold px-8 py-3.5 rounded-xl border-2 border-white/30 transition-all duration-300 backdrop-blur-sm transform hover:-translate-y-1">
                    Pelajari Cara Kerja
                </a>
            </div>

            <div class="flex justify-center gap-2.5 pt-6">
                <template x-for="slide in slides" :key="slide.id">
                    <button @click="activeSlide = slide.id"
                        class="h-2.5 rounded-full transition-all duration-300"
                        :class="activeSlide === slide.id ? 'w-8 bg-[#34d399]' : 'w-2.5 bg-white/50'"></button>
                </template>
            </div>
        </div>
    </section>

    <section id="tentang-kami" class="bg-white py-24 border-b-2 border-[#D1E7DD]">
        <div class="max-w-4xl mx-auto px-6 text-center space-y-6">
            <h2 class="text-xs font-black uppercase tracking-widest text-[#059669]">Tentang Kami</h2>
            <h3 class="text-3xl font-extrabold text-gray-900 md:text-4xl leading-snug">
                Membangun Ekosistem Bank Sampah yang Modern dan Berkelanjutan
            </h3>
            <p class="text-gray-700 leading-relaxed text-base md:text-lg font-medium">
                EcoBank hadir untuk mendukung pengelolaan sampah berbasis komunitas melalui sistem digital yang memudahkan proses setor sampah, pengelolaan koin, dan pemantauan aktivitas secara terintegrasi.
            </p>
        </div>
    </section>

    <section id="cara-kerja" class="max-w-7xl mx-auto px-6 py-24 space-y-16">
        <div class="text-center space-y-4">
            <h2 class="text-xs font-black uppercase tracking-widest text-[#059669]">Alur Tabungan</h2>
            <h3 class="text-3xl font-extrabold text-gray-900">3 Langkah Mudah Menabung</h3>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl border-2 border-[#D1E7DD] space-y-4 shadow-sm hover:border-[#059669] transition-all duration-300">
                <div class="w-12 h-12 bg-[#D1E7DD] text-[#064e3b] rounded-xl flex items-center justify-center text-xl font-black">1</div>
                <h4 class="text-xl font-extrabold text-gray-900">Pilah Sampah</h4>
                <p class="text-sm text-gray-650 leading-relaxed font-medium">
                    Pisahkan sampah yang dapat didaur ulang seperti plastik, kertas, botol, dan logam sebelum dilakukan penyetoran.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl border-2 border-[#D1E7DD] space-y-4 shadow-sm hover:border-[#059669] transition-all duration-300">
                <div class="w-12 h-12 bg-[#D1E7DD] text-[#064e3b] rounded-xl flex items-center justify-center text-xl font-black">2</div>
                <h4 class="text-xl font-extrabold text-gray-900">Setor atau Ajukan Penjemputan</h4>
                <p class="text-sm text-gray-650 leading-relaxed font-medium">
                    Setorkan sampah ke bank sampah atau ajukan layanan penjemputan melalui EcoBank. Petugas akan melakukan verifikasi dan pencatatan secara digital.
                </p>
            </div>

            <div class="bg-white p-8 rounded-2xl border-2 border-[#D1E7DD] space-y-4 shadow-sm hover:border-[#059669] transition-all duration-300">
                <div class="w-12 h-12 bg-[#D1E7DD] text-[#064e3b] rounded-xl flex items-center justify-center text-xl font-black">3</div>
                <h4 class="text-xl font-extrabold text-gray-900">Dapatkan Koin & Tukarkan Reward</h4>
                <p class="text-sm text-gray-650 leading-relaxed font-medium">
                    Setiap setoran yang berhasil akan dikonversi menjadi koin yang dapat dipantau dan ditukarkan melalui sistem EcoBank.
                </p>
            </div>
        </div>
    </section>

    <section id="manfaat" class="bg-white py-24 border-t-2 border-[#D1E7DD]">
        <div class="max-w-7xl mx-auto px-6 space-y-16">
            <div class="text-center space-y-4">
                <h2 class="text-xs font-black uppercase tracking-widest text-[#059669]">Manfaat Aplikasi</h2>
                <h3 class="text-3xl font-extrabold text-gray-900">Kenapa Harus Menggunakan EcoBank?</h3>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-[#F4FBF7] rounded-2xl border border-[#D1E7DD] space-y-3 shadow-sm hover:border-[#059669] transition-colors">
                    <div class="text-3xl">📱</div>
                    <h4 class="text-lg font-bold text-gray-900">1. Praktis & Terintegrasi</h4>
                    <p class="text-sm text-gray-650 font-medium leading-relaxed">
                        Kelola proses setor dan penjemputan sampah secara digital dalam satu platform.
                    </p>
                </div>

                <div class="p-6 bg-[#F4FBF7] rounded-2xl border border-[#D1E7DD] space-y-3 shadow-sm hover:border-[#059669] transition-colors">
                    <div class="text-3xl">🪙</div>
                    <h4 class="text-lg font-bold text-gray-900">2. Dapatkan Insentif Koin</h4>
                    <p class="text-sm text-gray-650 font-medium leading-relaxed">
                        Setiap transaksi sampah menghasilkan koin yang dapat ditukarkan.
                    </p>
                </div>

                <div class="p-6 bg-[#F4FBF7] rounded-2xl border border-[#D1E7DD] space-y-3 shadow-sm hover:border-[#059669] transition-colors">
                    <div class="text-3xl">🌍</div>
                    <h4 class="text-lg font-bold text-gray-900">3. Dukung Lingkungan Berkelanjutan</h4>
                    <p class="text-sm text-gray-650 font-medium leading-relaxed">
                        Mendorong kebiasaan pengelolaan sampah yang lebih tertib dan ramah lingkungan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-950 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 bg-[#059669] rounded-md flex items-center justify-center text-white text-sm">♻️</div>
                <span class="text-lg font-bold text-white tracking-tight">EcoBank</span>
            </div>
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} EcoBank. Hak Cipta Dilindungi Undang-Undang.
            </p>
        </div>
        </nav>

</body>

</html>