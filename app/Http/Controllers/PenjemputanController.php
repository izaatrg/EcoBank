<?php

namespace App\Http\Controllers;

use App\Models\Penjemputan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjemputanController extends Controller
{
    /**
     * ==========================================
     * ADMIN METHODS
     * ==========================================
     */

    // Admin: List all penjemputan
    public function index()
    {
        $penjemputan = Penjemputan::with(['warga', 'petugas'])
            ->latest()
            ->paginate(10);

        return view('admin.penjemputan.index', [
            'penjemputan' => $penjemputan,
            'warga' => User::where('role', 'warga')->get(),
        ]);
    }

    // Admin: Create form
    public function create()
    {
        return view('admin.penjemputan.create', [
            'warga' => User::where('role', 'warga')->get(),
            'petugas' => User::where('role', 'petugas')->get(),
        ]);
    }

    // Admin: Store new penjemputan
    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:users,id',
            'petugas_id' => 'nullable|exists:users,id',
            'tanggal_jemput' => 'required|date|after_or_equal:today',
            'jam_jemput' => 'required|date_format:H:i',
            'catatan' => 'nullable|string|max:500',
        ]);

        Penjemputan::create([
            'warga_id' => $request->warga_id,
            'petugas_id' => $request->petugas_id,
            'tanggal_jemput' => $request->tanggal_jemput,
            'jam_jemput' => $request->jam_jemput,
            'catatan' => $request->catatan,
            'status' => 'menunggu',
        ]);

        return redirect()->route('admin.penjemputan.index')->with('success', 'Penjemputan berhasil ditambahkan');
    }

    // Admin: Edit form
    public function edit(int $id)
    {
        $penjemputan = Penjemputan::findOrFail($id);

        return view('admin.penjemputan.edit', [
            'penjemputan' => $penjemputan,
            'warga' => User::where('role', 'warga')->get(),
            'petugas' => User::where('role', 'petugas')->get(),
        ]);
    }

    // Admin: Update penjemputan
    public function update(Request $request, int $id)
    {
        $request->validate([
            'warga_id' => 'required|exists:users,id',
            'petugas_id' => 'nullable|exists:users,id',
            'tanggal_jemput' => 'required|date',
            'jam_jemput' => 'required|date_format:H:i',
            'catatan' => 'nullable|string|max:500',
            'status' => 'required|in:menunggu,diproses,selesai,dibatalkan',
        ]);

        $penjemputan = Penjemputan::findOrFail($id);

        $penjemputan->update([
            'warga_id' => $request->warga_id,
            'petugas_id' => $request->petugas_id,
            'tanggal_jemput' => $request->tanggal_jemput,
            'jam_jemput' => $request->jam_jemput,
            'catatan' => $request->catatan,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.penjemputan.index')->with('success', 'Penjemputan berhasil diupdate');
    }

    // Admin: Delete penjemputan
    public function destroy(int $id)
    {
        $penjemputan = Penjemputan::findOrFail($id);
        $penjemputan->delete();

        return redirect()->route('admin.penjemputan.index')->with('success', 'Penjemputan berhasil dihapus');
    }

    // Admin/Petugas: Update status
    public function updateStatus(Request $request, int $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,dibatalkan',
        ]);

        $jemput = Penjemputan::findOrFail($id);

        // Assign petugas if not assigned and role is petugas
        if (!$jemput->petugas_id && auth()->user()->role === 'petugas') {
            $jemput->petugas_id = auth()->id();
        }

        $jemput->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status penjemputan berhasil diperbarui');
    }

    /**
     * ==========================================
     * PETUGAS METHODS
     * ==========================================
     */

    // Petugas: View all penjemputan (read-only)
    public function show(int $id)
    {
        $penjemputan = Penjemputan::findOrFail($id);

        return view('petugas.penjemputan.show', compact('penjemputan'));
    }

    /**
     * ==========================================
     * WARGA METHODS
     * ==========================================
     */

    // Warga: Show form to request pickup
    public function showFormWarga()
    {
        return view('warga.jemput.form');
    }

    // Warga: Store pickup request
    public function storeWarga(Request $request)
    {
        $request->validate([
            'tanggal_jemput' => 'required|date|after_or_equal:today',
            'jam_jemput' => 'required|date_format:H:i',
            'catatan' => 'nullable|string|max:500',
        ]);

        Penjemputan::create([
            'warga_id' => auth()->id(),
            'tanggal_jemput' => $request->tanggal_jemput,
            'jam_jemput' => $request->jam_jemput,
            'catatan' => $request->catatan,
            'status' => 'menunggu',
        ]);

        return redirect()->route('warga.jemput.history')->with('success', 'Permintaan penjemputan berhasil dikirim!');
    }

    // Warga: View pickup history
    public function historyWarga()
    {
        $penjemputan = Penjemputan::where('warga_id', auth()->id())
            ->with('petugas')
            ->latest()
            ->paginate(10);

        return view('warga.jemput.history', compact('penjemputan'));
    }
}
