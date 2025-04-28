<!-- resources/views/schedule/create.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Form container animation */
        .form-container {
            animation: slideIn 0.7s ease forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form field animations */
        .form-field {
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateX(-20px);
        }

        .form-field:focus-within {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.2);
        }

        /* Button animation */
        .submit-button {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.4);
        }

        .submit-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 150%;
            height: 150%;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            opacity: 0;
            transition: transform 0.6s, opacity 0.6s;
        }

        .submit-button:active::after {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            transition: 0s;
        }

        /* Title animation */
        .page-title {
            position: relative;
            display: inline-block;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background-color: #a855f7;
            animation: lineExpand 1s ease forwards 0.5s;
        }

        @keyframes lineExpand {
            to {
                width: 100%;
            }
        }

        /* Back link animation */
        .back-link {
            transition: all 0.3s ease;
        }

        .back-link:hover {
            transform: translateX(-3px);
            color: #7e22ce;
        }
    </style>
</head>
<body class="bg-gray-50 p-8">
    <div class="form-container max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="page-title text-2xl font-bold mb-6 text-purple-800">Tambah Jadwal Penerbangan</h1>

        <form action="{{ route('schedule.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="form-field" style="animation: slideIn 0.5s ease forwards 0.2s;">
                <label class="block mb-1 font-medium text-gray-700">Nama</label>
                <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
            </div>

            <div class="form-field" style="animation: slideIn 0.5s ease forwards 0.3s;">
                <label class="block mb-1 font-medium text-gray-700">Hari</label>
                <select name="day" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
                    <option value="">Pilih Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
            </div>

            <div class="form-field" style="animation: slideIn 0.5s ease forwards 0.4s;">
                <label class="block mb-1 font-medium text-gray-700">Minggu ke-</label>
                <select name="week" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
                    <option value="">Pilih Minggu</option>
                    <option value="pertama">Minggu Pertama</option>
                    <option value="kedua">Minggu Kedua</option>
                    <option value="ketiga">Minggu Ketiga</option>
                    <option value="keempat">Minggu Keempat</option>
                </select>
            </div>

            <div class="flex items-center gap-4 pt-2" style="animation: slideIn 0.5s ease forwards 0.5s;">
                <button type="submit" class="submit-button bg-purple-500 text-white px-6 py-2 rounded hover:bg-purple-600 transition">
                    Simpan
                </button>
                <a href="{{ route('schedule.index') }}" class="back-link text-purple-500 hover:underline">
                    Kembali
                </a>
            </div>
        </form>
    </div>

    <script>
        // Fokuskan otomatis pada field nama saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                document.querySelector('input[name="name"]').focus();
            }, 800);
        });
    </script>
</body>
</html>
