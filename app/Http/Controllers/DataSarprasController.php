<?php

namespace App\Http\Controllers;

use App\Models\DataSarpras;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataSarprasController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dengan relasi prodi
        $query = DataSarpras::with('prodi')->latest();

        if ($search = $request->search) {
            $query->where('nama_barang', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%")
                ->orWhereHas('prodi', function ($q) use ($search) {
                    $q->where('nama_prodi', 'like', "%{$search}%");
                });
        }

        // Ambil data paginasi
        $sarpras = $query->paginate(20);

        // Ambil semua data prodi untuk dropdown
        $prodi = Prodi::with('fakultas')->get();

        return view('page.sarpras.index', compact('sarpras', 'prodi'));
    }



    public function create()
    {
        $prodi = Prodi::with('fakultas')->get();
        return view('page.sarpras.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_prodi' => 'nullable|exists:prodi,id',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string|max:50',
            'tanggal_pengadaan' => 'required|date',
            'spesifikasi' => 'required|string',
            'kode_seri' => 'required|string|max:100',
            'sumber' => 'required|in:HIBAH,LEMBAGA,YAYASAN',
            'keterangan' => 'nullable|string|max:255',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'lokasi_lain' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/sarpras', $filename);
            $validated['file_dokumen'] = $filename;
        }

        DataSarpras::create($validated);
        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil ditambahkan.');
    }


    public function edit($id)
    {
        //
    }

    // GANTI METHOD UPDATE - gunakan parameter ID
    public function update(Request $request, $id)
    {
        $sarpras = DataSarpras::findOrFail($id);

        $validated = $request->validate([
            'id_prodi' => 'nullable|exists:prodi,id',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:1',
            'kondisi' => 'required|string|max:50',
            'tanggal_pengadaan' => 'required|date',
            'spesifikasi' => 'required|string',
            'kode_seri' => 'required|string|max:100',
            'sumber' => 'required|in:HIBAH,LEMBAGA,YAYASAN',
            'keterangan' => 'nullable|string|max:255',
            'file_dokumen' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'lokasi_lain' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file_dokumen')) {
            if ($sarpras->file_dokumen) {
                Storage::delete('public/sarpras/' . $sarpras->file_dokumen);
            }
            $file = $request->file('file_dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/sarpras', $filename);
            $validated['file_dokumen'] = $filename;
        }

        $sarpras->update($validated);

        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil diperbarui.');
    }

    public function show($id)
    {
        $sarpras = DataSarpras::findOrFail($id);
        return view('page.sarpras.show', compact('sarpras'));
    }

    public function destroy($id)
    {
        $sarpras = DataSarpras::findOrFail($id);
        if ($sarpras->file_dokumen) {
            Storage::delete('public/sarpras/' . $sarpras->file_dokumen);
        }
        $sarpras->delete();
        return redirect()->route('sarpras.index')->with('success', 'Data sarpras berhasil dihapus.');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->selected_dosen;
        if ($ids) {
            $dosens = DataSarpras::whereIn('id', $ids)->get();
            foreach ($dosens as $d) {
                if ($d->file_dokumen && file_exists(public_path('storage/dokumen_dosen/' . $d->file_dokumen))) {
                    unlink(public_path('storage/dokumen_dosen/' . $d->file_dokumen));
                }
            }
            DataSarpras::whereIn('id', $ids)->delete();
        }

        return redirect()->route('dosen.index')->with('success', 'Data dosen terpilih berhasil dihapus.');
    }
}
