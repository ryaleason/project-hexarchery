<!-- resources/views/schedule/edit.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-purple-800">Edit Jadwal</h1>

        <form action="{{ route('schedule.update', $schedule->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ $schedule->name }}" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Hari</label>
                <select name="day" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin" {{ $schedule->day == 'Senin' ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ $schedule->day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ $schedule->day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ $schedule->day == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ $schedule->day == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Minggu ke-</label>
                <select name="week" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
                    <option value="">Pilih Minggu</option>
                    <option value="pertama" {{ $schedule->week == 'pertama' ? 'selected' : '' }}>Minggu Pertama</option>
                    <option value="kedua" {{ $schedule->week == 'kedua' ? 'selected' : '' }}>Minggu Kedua</option>
                    <option value="ketiga" {{ $schedule->week == 'ketiga' ? 'selected' : '' }}>Minggu Ketiga</option>
                    <option value="keempat" {{ $schedule->week == 'keempat' ? 'selected' : '' }}>Minggu Keempat</option>
                </select>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="bg-purple-500 text-white px-6 py-2 rounded hover:bg-purple-600 transition">
                    Perbarui
                </button>
                <a href="{{ route('schedule.index') }}" class="text-purple-500 hover:underline">
                    Batal
                </a>
            </div>
        </form>
    </div>
</body>
</html>
