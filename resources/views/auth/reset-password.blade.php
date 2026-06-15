<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi - EcoBank</title>
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

        <p class="text-sm text-[#2c5e47] font-medium mt-6 mb-2 text-left">Buat Kata Sandi Baru</p>
        <p class="text-xs text-gray-400 text-left mb-6 leading-relaxed">Silakan masukkan email Anda dan ketikkan kata sandi baru yang kuat untuk memperbarui akun Anda.</p>

        <form method="POST" action="{{ route('password.store') }}" class="w-full flex flex-col text-left" onsubmit="submitForm(this)">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="w-full mb-4">
                <label for="email" class="block text-sm font-semibold text-[#114d33] mb-2">Alamat Email</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="block w-full pl-11 pr-4 py-3 border border-emerald-600/30 rounded-xl bg-white text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#114d33]" />
                </div>
                @if ($errors->has('email'))
                    <span class="text-xs text-red-500 font-medium mt-1 block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="w-full mb-4">
                <label for="password" class="block text-sm font-semibold text-[#114d33] mb-2">Kata Sandi Baru</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" class="block w-full pl-11 pr-4 py-3 border border-emerald-600/30 rounded-xl bg-white text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#114d33]" />
                </div>
                @if ($errors->has('password'))
                    <span class="text-xs text-red-500 font-medium mt-1 block">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="w-full mb-6">
                <label for="password_confirmation" class="block text-sm font-semibold text-[#114d33] mb-2">Konfirmasi Kata Sandi Baru</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi baru" class="block w-full pl-11 pr-4 py-3 border border-emerald-600/30 rounded-xl bg-white text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#114d33]" />
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="text-xs text-red-500 font-medium mt-1 block">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <button type="submit" id="submit-btn" class="w-full flex justify-center items-center gap-2 px-4 py-3.5 bg-[#114d33] border border-transparent rounded-xl font-bold text-sm text-white hover:bg-[#0b3322] active:scale-[0.98] transition-all duration-150 shadow-md cursor-pointer text-center">
                <span id="btn-text">Perbarui Kata Sandi</span>
                <svg id="btn-icon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
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
            
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            text.innerText = 'Memperbarui...';
            
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>';
            icon.classList.add('animate-spin');
        }
    </script>
</body>
</html>