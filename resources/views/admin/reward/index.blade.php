@extends('layouts.admin')

@section('page_title', 'Tukar Koin')

@section('content')
<style>
    .reward-item {
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .reward-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .btn-soft {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-soft:active {
        transform: scale(0.95);
    }

    .modal-input {
        border: 1px solid #E2E8F0;
        padding: 12px 16px;
        border-radius: 12px;
        width: 100%;
        margin-bottom: 12px;
    }
</style>

<div class="space-y-8">
    <div class="flex flex-col md:flex-row justify-between items-start gap-8">
        <div class="max-w-xl">
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Katalog Penukaran Koin</h1>
            <p class="text-slate-500 mt-2 leading-relaxed">Tukarkan koin keberlanjutan Anda dengan berbagai barang bermanfaat.</p>
        </div>
        <div class="bg-[#1E5631] text-white p-6 rounded-2xl w-full md:w-80 shadow-lg flex-shrink-0">
            <div class="flex items-center gap-2 mb-2 opacity-80">
                <i class="fa-solid fa-wallet"></i>
                <span class="text-xs font-semibold uppercase tracking-widest">Nasabah Premium</span>
            </div>
            <p class="text-xs font-medium opacity-90">TOTAL KOIN TERSEDIA</p>
            <div class="text-3xl font-black mt-1">
                {{ number_format($saldo ?? 0, 0, ',', '.') }} <span class="text-xl font-bold">KOIN</span>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap gap-2">
        <button type="button" onclick="filterBarang('Semua', this)" class="px-5 py-2.5 bg-white border border-slate-200 rounded-full text-sm font-bold shadow-sm hover:bg-emerald-50 transition">Semua</button>
        @foreach(['Kebutuhan Pokok', 'Alat Tulis', 'Voucher', 'Elektronik'] as $cat)
        <button type="button" onclick="filterBarang('{{ $cat }}', this)" class="px-5 py-2.5 bg-white border border-slate-200 rounded-full text-sm font-bold shadow-sm hover:bg-emerald-50 transition">{{ $cat }}</button>
        @endforeach
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="ml-auto bg-[#1E5631] text-white px-6 py-2 rounded-full font-bold text-sm shadow-md hover:bg-emerald-900 transition">+ Tambah Barang</button>
    </div>

    <div id="gridKatalog" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($rewards as $item)
        <div class="reward-item bg-white p-4 rounded-3xl border border-slate-100 shadow-sm" data-kategori="{{ $item->kategori }}">
            <div class="h-40 bg-slate-100 rounded-2xl mb-4 overflow-hidden">
                @if($item->gambar)<img src="{{ asset('storage/'.$item->gambar) }}" class="w-full h-full object-cover">@endif
            </div>
            <h3 class="font-bold text-slate-800 mb-1 truncate">{{ $item->nama_reward }}</h3>
            <p class="text-[#1E5631] font-black text-lg mb-0">{{ number_format($item->jumlah_koin) }} Koin</p>

            <p class="text-xs font-bold text-slate-400 mb-4">Stok Tersedia: {{ $item->stok }}</p>

            <div class="flex gap-2">
                <button onclick="bukaModalEdit({{ json_encode($item) }})" class="btn-soft flex-1 bg-slate-100 py-2 rounded-xl text-xs font-bold text-slate-600">EDIT</button>
                <form action="{{ route('admin.reward.destroy', $item->id) }}" method="POST" class="flex-1">
                    @csrf @method('DELETE')
                    <button class="btn-soft w-full bg-red-50 text-red-600 py-2 rounded-xl text-xs font-bold">HAPUS</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full py-10 text-center text-slate-400">Belum ada barang tersedia.</div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $rewards->links() }}
    </div>
</div>

<div id="modalTambah" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
    <div class="bg-white p-8 rounded-3xl w-full max-w-sm shadow-2xl">
        <h2 class="text-2xl font-bold mb-6">Tambah Barang</h2>
        <form action="{{ route('admin.reward.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input name="nama_reward" class="modal-input" placeholder="Nama Barang" required>
            <input name="kategori" class="modal-input" placeholder="Kategori" required>
            <input name="jumlah_koin" type="number" class="modal-input" placeholder="Jumlah Koin" required>
            <input name="stok" type="number" class="modal-input" placeholder="Stok" required>
            <label class="text-xs font-bold text-slate-500 block mb-2">Upload Gambar:</label>
            <input type="file" name="gambar" class="mb-6 text-sm">
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="flex-1 bg-slate-100 py-3 rounded-2xl font-bold">Batal</button>
                <button type="submit" class="flex-1 bg-[#1E5631] text-white py-3 rounded-2xl font-bold">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
    <div class="bg-white p-8 rounded-3xl w-full max-w-sm shadow-2xl">
        <h2 class="text-2xl font-bold mb-6">Edit Barang</h2>
        <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input name="nama_reward" id="e_nama" class="modal-input">
            <input name="kategori" id="e_kategori" class="modal-input">
            <input name="jumlah_koin" id="e_koin" class="modal-input">
            <input name="stok" id="e_stok" class="modal-input">
            <label class="text-xs font-bold text-slate-500 block mb-2">Ganti Gambar:</label>
            <input type="file" name="gambar" class="mb-6 text-sm">
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="flex-1 bg-slate-100 py-3 rounded-2xl font-bold text-slate-600">Batal</button>
                <button type="submit" class="flex-1 bg-[#1E5631] py-3 rounded-2xl font-bold text-white">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function filterBarang(cat) {
        document.querySelectorAll('.reward-item').forEach(c => {
            c.style.display = (cat === 'Semua' || c.dataset.kategori === cat) ? 'block' : 'none';
        });
    }

    function bukaModalEdit(item) {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('formEdit').action = '/admin/reward/' + item.id;
        document.getElementById('e_nama').value = item.nama_reward;
        document.getElementById('e_kategori').value = item.kategori;
        document.getElementById('e_koin').value = item.jumlah_koin;
        document.getElementById('e_stok').value = item.stok;
    }
</script>
@endsection