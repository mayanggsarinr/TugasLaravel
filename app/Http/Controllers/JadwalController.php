<?php

namespace App\Http\Controllers;


use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Sesi;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::all(); // SELECT * FROM jadwal + relasi
        return view('jadwal.index')->with('jadwal', $jadwal);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mataKuliah = MataKuliah::all();
        $users = User::all();
        $sesi = Sesi::all();

        return view('jadwal.create', compact('mataKuliah', 'users', 'sesi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $input = $request->validate([
            'tahun_akademik' => 'required',
            'kode_smt' => 'required',
            'kelas' => 'required',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'user_id' => 'required|exists:users,id',
            'sesi_id' => 'required|exists:sesi,id',
        ]);

        // Simpan data ke tabel jadwal
        Jadwal::create($input);

        // Redirect ke route jadwal.index
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($jadwal)
    {
        $jadwal = Jadwal::findOrFail($jadwal);
        $mataKuliah = MataKuliah::all();
        $users = User::all();
        $sesi = Sesi::all();

        return view('jadwal.edit', compact('jadwal', 'mataKuliah', 'users', 'sesi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $jadwal)
    {
        $jadwal = Jadwal::findOrFail($jadwal);

        // Validasi input
        $input = $request->validate([
            'tahun_akademik' => 'required|max:10',
            'kode_smt' => 'required|max:10',
            'kelas' => 'required|max:20',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'user_id' => 'required|exists:users,id',
            'sesi_id' => 'required|exists:sesi,id',
        ]);

        // Update data jadwal
        $jadwal->update($input);

        // Redirect ke route jadwal.index
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        // Redirect ke route jadwal.index
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}