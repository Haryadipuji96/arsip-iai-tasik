<?php

namespace App\Http\Controllers;

use App\Models\TenagaPendidik;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TenagaPendidikController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dengan relasi prodi
        $query = TenagaPendidik::with('prodi')->latest();

        if ($search = $request->search) {
            $query->where('nama_tendik', 'like', "%{$search}%")
                ->orWhere('jabatan', 'like', "%{$search}%")
                ->orWhereHas('prodi', function ($q) use ($search) {
                    $q->where('nama_prodi', 'like', "%{$search}%");
                });
        }

        // Ambil data paginasi
        $tenaga = $query->paginate(20);

        // Ambil semua data prodi untuk dropdown
        $prodi = Prodi::with('fakultas')->get();

        return view('page.tenaga_pendidik.index', compact('tenaga', 'prodi'));
    }



    public function create()
    {
        $prodi = Prodi::all();
        return view('page.tenaga_pendidik.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_prodi' => 'required|exists:prodi,id',
            'nama_tendik' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:100',
            'status_kepegawaian' => 'required|in:PNS,Honorer,Kontrak',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_hp' => 'nullable|string|max:20|unique:tenaga_pendidik,no_hp',
            'email' => 'nullable|email|unique:tenaga_pendidik,email',
            'alamat' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('tenaga_pendidik', 'public');
        }

        TenagaPendidik::create($data);

        return redirect()->route('tenaga-pendidik.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(TenagaPendidik $tenagaPendidik)
    {
        //
    }

    public function update(Request $request, TenagaPendidik $tenagaPendidik)
    {
        $request->validate([
            'id_prodi' => 'required|exists:prodi,id',
            'nama_tendik' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50|unique:tenaga_pendidik,nip,' . $tenagaPendidik->id . ',id',
            'jabatan' => 'nullable|string|max:100',
            'status_kepegawaian' => 'required|in:PNS,Honorer,Kontrak',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'no_hp' => 'nullable|string|max:20|unique:tenaga_pendidik,no_hp,' . $tenagaPendidik->id . ',id',
            'email' => 'nullable|email|unique:tenaga_pendidik,email,' . $tenagaPendidik->id . ',id',
            'alamat' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);


        $data = $request->all();

        if ($request->hasFile('file')) {
            if ($tenagaPendidik->file) {
                Storage::disk('public')->delete($tenagaPendidik->file);
            }
            $data['file'] = $request->file('file')->store('tenaga_pendidik', 'public');
        }

        $tenagaPendidik->update($data);

        return redirect()->route('tenaga-pendidik.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(TenagaPendidik $tenagaPendidik)
    {
        if ($tenagaPendidik->file) {
            Storage::disk('public')->delete($tenagaPendidik->file);
        }
        $tenagaPendidik->delete();
        return redirect()->route('tenaga-pendidik.index')->with('success', 'Data berhasil dihapus.');
    }

    public function show(TenagaPendidik $tenagaPendidik)
    {
        return view('page.tenaga_pendidik.show', compact('tenagaPendidik'));
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->selected_dosen;
        if ($ids) {
            $dosens = TenagaPendidik::whereIn('id', $ids)->get();
            foreach ($dosens as $d) {
                if ($d->file_dokumen && file_exists(public_path('storage/dokumen_dosen/' . $d->file_dokumen))) {
                    unlink(public_path('storage/dokumen_dosen/' . $d->file_dokumen));
                }
            }
            TenagaPendidik::whereIn('id', $ids)->delete();
        }

        return redirect()->route('dosen.index')->with('success', 'Data dosen terpilih berhasil dihapus.');
    }
}
