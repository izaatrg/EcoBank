<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use App\Models\Penjemputan;
use App\Models\TransaksiSetoran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * ==========================================
     * ADMIN METHODS - Manage Petugas
     * ==========================================
     */

    // Admin: list all petugas
    public function index()
    {
        $petugas = User::where('role', 'petugas')
            ->latest()
            ->paginate(10);

        return view('admin.petugas.index', compact('petugas'));
    }

    // Admin: create form
    public function create()
    {
        return view('admin.petugas.create');
    }

    // Admin: store new petugas
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
            'role' => 'petugas',
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil ditambahkan');
    }

    // Admin: edit form
    public function edit(int $id)
    {
        $petugas = User::findOrFail($id);

        return view('admin.petugas.edit', compact('petugas'));
    }

    // Admin: update petugas
    public function update(Request $request, int $id)
    {
        $petugas = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $petugas->id,
            'password' => 'nullable|confirmed|min:6',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500',
        ]);

        $petugas->name = $request->name;
        $petugas->email = $request->email;
        $petugas->no_hp = $request->no_hp;
        $petugas->alamat = $request->alamat;
        
        if ($request->filled('password')) {
            $petugas->password = Hash::make($request->password);
        }
        
        $petugas->save();

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil diupdate');
    }

    // Admin: delete petugas
    public function destroy(int $id)
    {
        $petugas = User::findOrFail($id);
        $petugas->delete();

        return redirect()->route('admin.petugas.index')->with('success', 'Petugas berhasil dihapus');
    }

    /**
     * ==========================================
     * PETUGAS METHODS - Own Dashboard & Profile
     * ==========================================
     */

    // Petugas: Dashboard
    public function dashboard()
    {
        $petugasId = auth()->id();
        $todayDate = now()->toDateString();

        return view('petugas.dashboard', [
            'totalSetoranHariIni' => TransaksiSetoran::where('petugas_id', $petugasId)
                ->where('tanggal_setor', $todayDate)
                ->count(),
            'totalKoinHariIni' => TransaksiSetoran::where('petugas_id', $petugasId)
                ->where('tanggal_setor', $todayDate)
                ->sum('total_koin'),
            'penjemputanMenunggu' => Penjemputan::where('status', 'menunggu')
                ->orWhere('status', 'diproses')
                ->count(),
            'riwayatTerakhir' => TransaksiSetoran::where('petugas_id', $petugasId)
                ->with(['warga', 'kategori'])
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }

    // Petugas: Show profile
    public function showProfile()
    {
        $petugas = auth()->user();

        return view('petugas.profile', compact('petugas'));
    }

    // Petugas: Update profile
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $petugas */
        $petugas = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $petugas->id,
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:500',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $petugas->name = $request->name;
        $petugas->email = $request->email;
        $petugas->no_hp = $request->no_hp;
        $petugas->alamat = $request->alamat;
        
        if ($request->filled('password')) {
            $petugas->password = Hash::make($request->password);
        }
        
        $petugas->save();

        return back()->with('success', 'Profil berhasil diupdate');
    }
}