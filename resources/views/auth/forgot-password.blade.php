<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - EcoBank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="bg-[#e2f7ed] min-h-screen flex flex-col justify-center items-center p-4 antialiased">

    <div class="w-full max-w-md bg-white rounded-[32px] shadow-xl p-8 sm:p-10 border border-emerald-100/30 text-center">
        
        <div class="flex justify-center mb-5">
            <div class="bg-[#114d33] h-16 w-16 rounded-2xl shadow-md flex items-center justify-center">
                <i class="fas fa-recycle text-3xl text-white"></i>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-[#114d33] tracking-wide">EcoBank</h2>
        <p class="text-xs text-gray-500 mt-1 font-semibold uppercase tracking-wider">Sistem Manajemen Sampah</p>

        <div class="w-full bg-[#f0fbf6] border border-emerald-100 rounded-2xl p-4 my-6 text-xs text-[#2c5e47] leading-relaxed text-center font-medium">
            Lupa kata sandi Anda? Tidak masalah. Beritahu kami alamat email Anda yang terdaftar, dan kami akan mengirimkan link tautan atur ulang kata sandi melalui email untuk memilih kata sandi baru.
        </div>

        @if (session('status'))
            <div class="w-full mb-5 text-xs font-semibold text-[#114d33] bg-[#e2f7ed] border border-emerald-200 p-4 rounded-xl text-center flex items-center justify-center gap-2 shadow-sm animate-fade-in">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Link atur ulang kata sandi telah berhasil dikirim ke email Anda!</span>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="w-full flex flex-col text-left" onsubmit="submitForm(this)">
            @csrf

            <div class="w-full mb-5">
                <label for="email" class="block text-sm font-semibold text-[#114d33] mb-2">Username atau Email</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           placeholder="Masukkan email terdaftar Anda" 
                           class="block w-full pl-11 pr-4 py-3.5 border border-emerald-600/30 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#114d33] focus:border-transparent transition duration-200 text-sm" />
                </div>
                @if ($errors->has('email'))
                    <span class="text-xs text-red-500 font-medium mt-2 block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <button type="submit" id="submit-btn" class="w-full flex justify-center items-center gap-2 px-4 py-3.5 bg-[#114d33] border border-transparent rounded-xl font-bold text-sm text-white hover:bg-[#0b3322] active:scale-[0.98] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#114d33] transition-all duration-150 shadow-md cursor-pointer text-center mb-4">
                <span id="btn-text">Kirim Link Atur Ulang</span>
                <svg id="btn-icon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>

            <div class="text-center">
                <a class="text-sm font-semibold text-[#114d33] hover:text-[#0b3322] hover:underline transition duration-150" href="{{ route('login') }}">
                    Kembali ke halaman login
                </a>
            </div>
        </form>
    </div>

    <div class="mt-8 text-center">
        <p class="text-xs text-[#86938c] font-bold tracking-widest uppercase">SUSTAINABILITY FIRST</p>
    </div>

    <script>
        function submitForm(form) {
            const btn = document.getElementById('submit-btn');
            const text = document.getElementById('btn-text');
            const icon = document.getElementById('btn-icon');
            
            // Kunci tombol biar tidak double click
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            text.innerText = 'Memproses...';
            
            // Ubah ikon panah jadi spinner loading muter
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>';
            icon.classList.add('animate-spin');
        }
    </script>

</body>
</html>