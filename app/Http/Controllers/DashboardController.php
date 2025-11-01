<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\TenagaPendidik;
use App\Models\Arsip;
use App\Models\DataSarpras;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total data
        $totalDosen = Dosen::count();
        $totalTendik = TenagaPendidik::count();
        $totalArsip = Arsip::count();
        $totalSarpras = DataSarpras::count();

        // Statistik Dosen per Prodi
        $dosenPerProdi = Dosen::with('prodi')->get()
            ->groupBy('id_prodi')
            ->map(function($items) {
                return [
                    'prodi' => $items->first()->prodi->nama_prodi ?? 'Tidak Diketahui',
                    'total' => $items->count()
                ];
            })
            ->values(); // agar index array rapi

        // Statistik Arsip per bulan (1–12)
        $arsipPerBulan = collect(range(1,12))->map(function($bulan){
            return [
                'bulan' => $bulan,
                'total' => Arsip::whereYear('tanggal_dokumen', now()->year)
                                ->whereMonth('tanggal_dokumen', $bulan)
                                ->count()
            ];
        });

        return view('dashboard', compact(
            'totalDosen',
            'totalTendik',
            'totalArsip',
            'totalSarpras',
            'dosenPerProdi',
            'arsipPerBulan'
        ));
    }
}
