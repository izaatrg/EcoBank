<!-- resources/views/components/logout-modal.blade.php -->
<div class="fixed inset-0 flex items-center justify-center bg-green-50/80 p-4 z-50">
    <div class="bg-white rounded-3xl p-8 w-full max-w-sm shadow-lg flex flex-col items-center text-center">
        <!-- Ilustrasi -->
        <div class="w-32 h-32 bg-green-100 rounded-full mb-6 overflow-hidden">
            <img src="{{ asset('images/logout-illustration.png') }}" alt="Logout" class="w-full h-full object-cover" />
        </div>

        <h2 class="text-2xl font-bold text-[#064e3b] mb-3">Sudah selesai bekerja?</h2>
        <p class="text-gray-500 mb-8 text-sm">Terima kasih telah berkontribusi menjaga kelestarian lingkungan hari ini. Apakah Anda yakin ingin mengakhiri sesi ini?</p>

        <div class="w-full space-y-3">
            <button onclick="closeModal()" class="w-full py-3 bg-[#2d7d5d] text-white rounded-xl font-semibold hover:bg-[#23664a]">
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