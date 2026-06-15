<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - EcoBank</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', ui-sans-serif, system-ui, sans-serif; }
    </style>
</head>
<body class="bg-[#e2f7ed] min-h-screen antialiased">

    <nav class="bg-white border-b border-emerald-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-[#114d33] h-9 w-9 rounded-xl flex items-center justify-center shadow-sm">
                        <i class="fas fa-recycle text-base text-white"></i>
                    </div>
                    <span class="font-bold text-lg text-[#114d33] tracking-wide">EcoBank</span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-semibold text-[#114d33] bg-[#f0fbf6] px-3 py-1.5 rounded-xl border border-emerald-100">
                        <i class="fas fa-user-circle mr-1.5"></i>{{ Auth::user()->name ?? 'Admin' }}
                    </span>
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-500 hover:text-[#114d33] transition duration-150">
                        <i class="fas fa-arrow-left mr-1"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 py-10 sm:px-6">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-[#114d33]">Pengaturan Akun</h1>
            <p class="text-xs text-gray-500 mt-1">Kelola informasi profil, foto pengguna, keamanan kata sandi, dan privasi akun EcoBank Anda.</p>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="w-full mb-6 text-xs font-semibold text-[#114d33] bg-[#f0fbf6] border border-emerald-200 p-4 rounded-xl flex items-center gap-2 shadow-sm">
                <i class="fas fa-check-circle text-emerald-600 text-sm"></i>
                <span>Profil dan foto Anda berhasil diperbarui!</span>
            </div>
        @endif

        <div class="space-y-8">

            <div class="bg-white rounded-[24px] shadow-sm p-6 sm:p-8 border border-emerald-100/30">
                <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                    <div class="h-8 w-8 rounded-lg bg-[#f0fbf6] text-[#114d33] flex items-center justify-center">
                        <i class="fas fa-id-card text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-[#114d33]">Informasi Profil</h3>
                        <p class="text-xs text-gray-400">Perbarui foto profil, nama panggilan, dan alamat email Anda.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('patch')

                    <div class="flex flex-col sm:flex-row items-center gap-5 bg-[#f0fbf6]/50 p-4 rounded-2xl border border-emerald-100/40 mb-6">
                        <div class="relative group">
                            <img id="avatar-preview" 
                                 src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name ?? 'Admin').'&background=114d33&color=ffffff' }}" 
                                 alt="Avatar" 
                                 class="w-20 h-20 rounded-full object-cover border-2 border-[#114d33] shadow-sm" />
                            
                            <label for="avatar-input" class="absolute bottom-0 right-0 bg-[#114d33] text-white text-xs p-1.5 rounded-full shadow-md cursor-pointer hover:bg-[#0b3322] transition duration-150">
                                <i class="fas fa-camera"></i>
                            </label>
                        </div>
                        
                        <div class="text-center sm:text-left flex-1">
                            <h4 class="text-xs font-bold text-[#114d33] mb-1">Foto Profil Anda</h4>
                            <p class="text-[11px] text-gray-400 mb-2">Ekstensi yang didukung: JPG, JPEG, atau PNG (Maks. 2MB)</p>
                            
                            <input id="avatar-input" name="avatar" type="file" accept="image/*" class="hidden" onchange="previewImage(this)" />
                            <button type="button" onclick="document.getElementById('avatar-input').click()" class="px-3 py-1.5 border border-emerald-600/30 text-[#114d33] hover:bg-emerald-50 text-[11px] font-semibold rounded-xl transition duration-150">
                                Pilih Foto Baru
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="name" class="block text-xs font-semibold text-[#114d33] mb-2">Nama Pengguna</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $user->name ?? 'Admin') }}" required autocomplete="name"
                               class="block w-full px-4 py-3 border border-emerald-600/20 rounded-xl bg-white text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#114d33]" />
                        @if($errors->get('name'))
                            <span class="text-xs text-red-500 font-medium mt-1 block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-semibold text-[#114d33] mb-2">Alamat Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $user->email ?? 'admin@gmail.com') }}" required autocomplete="username"
                               class="block w-full px-4 py-3 border border-emerald-600/20 rounded-xl bg-white text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#114d33]" />
                        @if($errors->get('email'))
                            <span class="text-xs text-red-500 font-medium mt-1 block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-[#114d33] hover:bg-[#0b3322] text-white text-xs font-bold rounded-xl shadow-sm transition duration-150">
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-[24px] shadow-sm p-6 sm:p-8 border border-emerald-100/30">
                <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                    <div class="h-8 w-8 rounded-lg bg-[#f0fbf6] text-[#114d33] flex items-center justify-center">
                        <i class="fas fa-lock text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-[#114d33]">Perbarui Kata Sandi</h3>
                        <p class="text-xs text-gray-400">Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman.</p>
                    </div>
                </div>

                @if (session('status') === 'password-updated')
                    <div class="w-full mb-4 text-xs font-semibold text-[#114d33] bg-[#f0fbf6] border border-emerald-200 p-3 rounded-xl flex items-center gap-2">
                        <i class="fas fa-check-circle"></i> Kata sandi berhasil diperbarui!
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                    @csrf
                    @method('put')

                    <div>
                        <label for="current_password" class="block text-xs font-semibold text-[#114d33] mb-2">Kata Sandi Saat Ini</label>
                        <input id="current_password" name="current_password" type="password" class="block w-full px-4 py-3 border border-emerald-600/20 rounded-xl bg-white text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#114d33]" />
                        @if($errors->updatePassword->get('current_password'))
                            <span class="text-xs text-red-500 font-medium mt-1 block">{{ $errors->updatePassword->first('current_password') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold text-[#114d33] mb-2">Kata Sandi Baru</label>
                        <input id="password" name="password" type="password" class="block w-full px-4 py-3 border border-emerald-600/20 rounded-xl bg-white text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#114d33]" />
                        @if($errors->updatePassword->get('password'))
                            <span class="text-xs text-red-500 font-medium mt-1 block">{{ $errors->updatePassword->first('password') }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-[#114d33] mb-2">Konfirmasi Kata Sandi Baru</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="block w-full px-4 py-3 border border-emerald-600/20 rounded-xl bg-white text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-[#114d33]" />
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-[#114d33] hover:bg-[#0b3322] text-white text-xs font-bold rounded-xl shadow-sm transition duration-150">
                            Perbarui Sandi
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-[24px] shadow-sm p-6 sm:p-8 border border-red-100/50">
                <div class="flex items-center gap-3 border-b border-gray-100 pb-4 mb-6">
                    <div class="h-8 w-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-red-600">Hapus Akun</h3>
                        <p class="text-xs text-gray-400">Setelah akun Anda dihapus, semua data sampah di dalamnya akan terhapus secara permanen.</p>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button onclick="alert('Fitur hapus dilewati untuk keperluan demo tugas bootcamp')" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl shadow-sm transition duration-150">
                        Hapus Akun Permanen
                    </button>
                </div>
            </div>

        </div>
    </main>

    <div class="py-8 text-center">
        <p class="text-[10px] text-[#86938c] font-bold tracking-widest uppercase">SUSTAINABILITY FIRST • ECOBANK 2026</p>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('avatar-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>