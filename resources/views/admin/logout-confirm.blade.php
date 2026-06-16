<x-app-layout>
    <div class="fixed inset-0 bg-green-50 dark:bg-gray-900 flex items-center justify-center p-4 z-50">
        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 w-full max-w-sm shadow-xl flex flex-col items-center text-center">
            
            <div class="w-32 h-32 bg-green-100 dark:bg-green-900 rounded-full mb-6 overflow-hidden flex items-center justify-center">
                <img src="{{ asset('images/logout-illustration.png') }}" alt="Logout" class="w-full h-full object-cover" />
            </div>

            <h2 class="text-2xl font-bold text-[#064e3b] dark:text-green-400 mb-3">Sudah selesai bekerja?</h2>
            <p class="text-gray-500 dark:text-gray-300 mb-8 text-sm leading-relaxed">
                Terima kasih telah berkontribusi menjaga kelestarian lingkungan hari ini. Apakah Anda yakin ingin mengakhiri sesi ini?
            </p>

            <div class="w-full space-y-3">
                <a href="{{ route('dashboard') }}" class="block w-full py-3 bg-[#2d7d5d] text-white rounded-xl font-semibold hover:bg-[#23664a] transition text-center">
                    Tetap di Sini
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full py-3 border-2 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        Keluar Sekarang
                    </button>
                </form>
            </div>

            <div class="mt-8 text-gray-400 text-[10px] font-bold tracking-widest uppercase">
                ♻ ECOBANK MANAGER
            </div>
        </div>
    </div>
</x-app-layout>