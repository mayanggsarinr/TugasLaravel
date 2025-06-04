<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Dashboard untuk admin: statistik semua prodi
            $mahasiswaprodi = DB::select('SELECT prodi.nama, COUNT(*) as jumlah FROM mahasiswa JOIN prodi ON mahasiswa.prodi_id = prodi.id GROUP BY prodi.nama');
            return view('dashboard.admin', compact('mahasiswaprodi'));
        } elseif ($user->role === 'dosen') {
            // Dashboard untuk dosen: hanya mahasiswa yang dibimbing dosen ini
            $mahasiswaprodi = DB::select(
                'SELECT prodi.nama, COUNT(*) as jumlah 
                 FROM mahasiswa 
                 JOIN prodi ON mahasiswa.prodi_id = prodi.id 
                 WHERE mahasiswa.dosen_id = ? 
                 GROUP BY prodi.nama',
                [$user->id]
            );
            return view('dashboard.dosen', compact('mahasiswaprodi'));
        } else {
            abort(403, 'Unauthorized');
        }
    }
}