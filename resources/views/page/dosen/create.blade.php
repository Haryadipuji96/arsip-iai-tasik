<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dosen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header/Navbar -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <i class="fas fa-user-graduate text-blue-600 text-xl mr-2"></i>
                            <span class="font-semibold text-xl text-gray-800">Sistem Akademik</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="ml-3 relative">
                            <div class="flex items-center space-x-4">
                                <a href="#" class="text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-bell"></i>
                                </a>
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium">
                                        U
                                    </div>
                                    <span class="ml-2 text-gray-700 hidden sm:block">User</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="py-6">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl rounded-2xl p-4 sm:p-6 md:p-8 w-full border border-gray-100">
                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 pb-4 border-b">
                        <div class="flex items-center space-x-3 mb-3 sm:mb-0">
                            <div class="bg-green-100 text-blue-600 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-800">Tambah Data Dosen</h1>
                        </div>
                        <a href="{{ route('dosen.index') }}"
                            class="text-sm text-gray-600 hover:text-gray-800 transition flex items-center space-x-1 self-start sm:self-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Kembali</span>
                        </a>
                    </div>

                    <form action="{{ route('dosen.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Program Studi -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-sm sm:text-base">Program Studi</label>
                            <select name="id_prodi" class="w-full border rounded px-3 py-2 text-sm sm:text-base" required>
                                <option value="">-- Pilih Prodi --</option>
                                @foreach ($prodi as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->nama_prodi }} ({{ $p->fakultas->nama_fakultas }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nama -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-sm sm:text-base">Nama Lengkap</label>
                            <input type="text" name="nama" class="w-full border rounded px-3 py-2 text-sm sm:text-base" required>
                        </div>

                        <!-- Tempat & Tanggal Lahir -->
                        <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium mb-1 text-sm sm:text-base">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="w-full border rounded px-3 py-2 text-sm sm:text-base">
                            </div>
                            <div>
                                <label class="block font-medium mb-1 text-sm sm:text-base">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2 text-sm sm:text-base">
                            </div>
                        </div>

                        <!-- NIK -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-sm sm:text-base">NIK</label>
                            <input type="text" name="nik" class="w-full border rounded px-3 py-2 text-sm sm:text-base">
                        </div>

                        <!-- Pendidikan Terakhir -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-sm sm:text-base">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" class="w-full border rounded px-3 py-2 text-sm sm:text-base">
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-sm sm:text-base">Jabatan</label>
                            <input type="text" name="jabatan" class="w-full border rounded px-3 py-2 text-sm sm:text-base">
                        </div>

                        <!-- TMT Kerja -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-sm sm:text-base">TMT Kerja</label>
                            <input type="date" name="tmt_kerja" class="w-full border rounded px-3 py-2 text-sm sm:text-base">
                        </div>

                        <!-- Masa Kerja -->
                        <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium mb-1 text-sm sm:text-base">Masa Kerja (Tahun)</label>
                                <input type="number" name="masa_kerja_tahun" class="w-full border rounded px-3 py-2 text-sm sm:text-base"
                                    min="0">
                            </div>
                            <div>
                                <label class="block font-medium mb-1 text-sm sm:text-base">Masa Kerja (Bulan)</label>
                                <input type="number" name="masa_kerja_bulan" class="w-full border rounded px-3 py-2 text-sm sm:text-base"
                                    min="0" max="11">
                            </div>
                        </div>

                        <!-- Golongan -->
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-sm sm:text-base">Golongan</label>
                            <input type="text" name="golongan" class="w-full border rounded px-3 py-2 text-sm sm:text-base">
                        </div>

                        <!-- Masa Kerja Golongan -->
                        <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium mb-1 text-sm sm:text-base">Masa Kerja Golongan (Tahun)</label>
                                <input type="number" name="masa_kerja_golongan_tahun" class="w-full border rounded px-3 py-2 text-sm sm:text-base"
                                    min="0">
                            </div>
                            <div>
                                <label class="block font-medium mb-1 text-sm sm:text-base">Masa Kerja Golongan (Bulan)</label>
                                <input type="number" name="masa_kerja_golongan_bulan" class="w-full border rounded px-3 py-2 text-sm sm:text-base"
                                    min="0" max="11">
                            </div>
                        </div>

                        {{-- 🔹 Upload File Dokumen --}}
                        <div class="mb-6">
                            <label for="file_dokumen" class="block font-medium mb-1 text-sm sm:text-base">
                                Upload File Dokumen
                            </label>
                            <div class="flex flex-col w-full">
                                <input type="file" name="file_dokumen" id="file_dokumen"
                                    class="flex w-full rounded-md border border-blue-300 bg-white text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-blue-600 file:text-white file:text-sm file:font-medium"
                                    accept=".pdf,.doc,.docx,.jpg,.png" />
                                <p class="text-gray-500 text-xs mt-1">
                                    Format diizinkan: <b>PDF, DOC, DOCX, JPG, PNG</b> | Maksimal <b>5MB</b>
                                </p>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2">
                            <a href="{{ route('dosen.index') }}" 
                               class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 text-center transition">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>