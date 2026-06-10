<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use App\Models\Penjemputan;
use App\Models\PenukaranReward;
use App\Models\Reward;
use App\Models\SaldoKoin;
use App\Models\TransaksiSetoran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    /**
     * ==========================================
     * ADMIN METHODS - Manage Warga
     * ==========================================
     */

    // Admin: list all warga
    public function index()
    {
        $warga = User::where('role', 'warga')
            ->with('saldoKoin')
            ->latest()
            ->paginate(10);

        return view('admin.warga.index', compact('warga'));
    }

    // Admin: create form
    public function create()
    {
        return view('admin.warga.create');
    }

    // Admin: store new warga
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'warga',
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.warga.index')->with('success', 'Warga berhasil ditambahkan');
    }

    // Admin: edit form
    public function edit(int $id)
    {
        $warga = User::findOrFail($id);

        return view('admin.warga.edit', compact('warga'));
    }

    // Admin: update warga
    public function update(Request $request, int $id)
    {
        $warga = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $warga->id,
            'password' => 'nullable|confirmed|min:6',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500',
        ]);

        $warga->name = $request->name;
        $warga->email = $request->email;
        $warga->no_hp = $request->no_hp;
        $warga->alamat = $request->alamat;

        if ($request->filled('password')) {
            $warga->password = Hash::make($request->password);
        }

        $warga->save();

        return redirect()->route('admin.warga.index')->with('success', 'Warga berhasil diupdate');
    }

    // Admin: delete warga
    public function destroy(int $id)
    {
        $warga = User::findOrFail($id);
        $warga->delete();

        return redirect()->route('admin.warga.index')->with('success', 'Warga berhasil dihapus');
    }

    /**
     * ==========================================
     * WARGA METHODS - Own Dashboard & Profile
     * ==========================================
     */

    // Warga: Dashboard
    public function dashboard()
    {
        $wargaId = auth()->id();

        $saldo = SaldoKoin::where('warga_id', $wargaId)->first();
        $totalSetoran = TransaksiSetoran::where('warga_id', $wargaId)->count();
        $totalKoin = $saldo->total_koin ?? 0;

        return view('warga.dashboard', [
            'saldo' => $totalKoin,
            'totalSetoran' => $totalSetoran,
            'kategori' => KategoriSampah::all(),
            'rewards' => Reward::where('stok', '>', 0)->get(),
            'penjemputan' => Penjemputan::where('warga_id', $wargaId)
                ->latest()
                ->limit(5)
                ->get(),
            'penukaranHistory' => PenukaranReward::with('reward')
                ->where('warga_id', $wargaId)
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }

    // Warga: Show profile
    public function showProfile()
    {
        $warga = auth()->user();

        return view('warga.profile', compact('warga'));
    }

    // Warga: Update profile
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $warga */
        $warga = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $warga->id,
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $warga->name = $request->name;
        $warga->email = $request->email;
        $warga->no_hp = $request->no_hp;
        $warga->alamat = $request->alamat;

        if ($request->filled('password')) {
            $warga->password = Hash::make($request->password);
        }

        $warga->save();

        return back()->with('success', 'Profil berhasil diupdate');
    }
}