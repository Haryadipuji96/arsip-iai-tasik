<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Fakultas</title>
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
                            <i class="fas fa-university text-blue-600 text-xl mr-2"></i>
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
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-800">Tambah Fakultas</h1>
                        </div>
                        <a href="{{ route('fakultas.index') }}"
                           class="text-sm text-gray-600 hover:text-gray-800 transition flex items-center space-x-1 self-start sm:self-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Kembali</span>
                        </a>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('fakultas.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block font-medium text-gray-700 mb-1 text-sm sm:text-base">Nama Fakultas</label>
                            <input type="text" name="nama_fakultas"
                                   class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 text-sm sm:text-base focus:ring-2 focus:ring-green-400 focus:border-green-500 transition"
                                   placeholder="Masukkan nama fakultas..." required>
                        </div>

                        <div>
                            <label class="block font-medium text-gray-700 mb-1 text-sm sm:text-base">Dekan</label>
                            <input type="text" name="dekan"
                                   class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 text-sm sm:text-base focus:ring-2 focus:ring-green-400 focus:border-green-500 transition"
                                   placeholder="Masukkan nama dekan...">
                        </div>

                        <div>
                            <label class="block font-medium text-gray-700 mb-1 text-sm sm:text-base">Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                      class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 text-sm sm:text-base focus:ring-2 focus:ring-green-400 focus:border-green-500 transition"
                                      placeholder="Masukkan deskripsi fakultas..."></textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-3 pt-4">
                            <a href="{{ route('fakultas.index') }}"
                               class="bg-red-500 hover:bg-red-600 text-white px-4 sm:px-5 py-2 rounded-lg shadow transition text-center">
                                Batal
                            </a>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-5 py-2 rounded-lg shadow transition">
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