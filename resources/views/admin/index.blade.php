<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>JADWAL PIKET PANAHAN HEXA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tab styling dan animasi */
        .minggu-tab {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .minggu-tab::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: #8b5cf6;
            transition: width 0.3s ease;
        }

        .minggu-tab:hover::after {
            width: 100%;
        }

        .active-tab {
            background-color: #c084fc;
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(192, 132, 252, 0.4);
        }

        /* Tab content transition */
        .week-container {
            display: none;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .week-container.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
            animation: fadeIn 0.5s ease forwards;
        }

        /* Card animations */
        .schedule-card {
            transition: all 0.3s ease;
        }

        .schedule-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .person-icon {
            transition: all 0.3s ease;
        }

        .schedule-card:hover .person-icon {
            transform: scale(1.1) rotate(10deg);
            background-color: #a855f7;
        }

        /* Success message animation */
        .success-alert {
            animation: slideDown 0.5s ease forwards, fadeOut 0.5s ease 3s forwards;
        }

        /* Add button animation */
        .add-button {
            transition: all 0.3s ease;
        }

        .add-button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(168, 85, 247, 0.4);
        }

        /* Logout button animation */
        .logout-button {
            transition: all 0.3s ease;
        }

        .logout-button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        /* Keyframe animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        /* Page load animation */
        .page-title {
            animation: titleAnimation 1s ease forwards;
        }

        @keyframes titleAnimation {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tab navigation container animation */
        .tab-container {
            animation: fadeIn 0.8s ease 0.3s forwards;
            opacity: 0;
        }
    </style>
</head>
<body class="bg-gray-50 p-8">
    <!-- Header dengan tombol logout -->
    <div class="flex justify-center items-center mb-8">
        <h1 class="page-title items-center text-4xl font-bold text-gray-900">JADWAL PIKET PANAHAN HEXA</h1>
        
    </div>

    <!-- Tab Navigation -->
    <div class="tab-container flex justify-center mb-10 gap-4">
        <button class="minggu-tab active-tab px-6 py-3 rounded-full text-white bg-purple-400 hover:bg-purple-500 transition" data-target="minggu-pertama">
            Minggu Pertama
        </button>
        <button class="minggu-tab px-6 py-3 rounded-full text-white bg-purple-400 hover:bg-purple-500 transition" data-target="minggu-kedua">
            Minggu Kedua
        </button>
        <button class="minggu-tab px-6 py-3 rounded-full text-white bg-purple-400 hover:bg-purple-500 transition" data-target="minggu-ketiga">
            Minggu ketiga
        </button>
        <button class="minggu-tab px-6 py-3 rounded-full text-white bg-purple-400 hover:bg-purple-500 transition" data-target="minggu-keempat">
            Minggu keempat
        </button>
    </div>

    @if(session('success'))
    <div class="success-alert mb-6 p-4 bg-green-200 text-green-800 rounded mx-auto max-w-4xl">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add Schedule Button -->
    <div class="flex justify-end mb-6 mx-auto max-w-4xl">
        <a href="{{ route('schedule.create') }}" class="add-button bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600 transition">
            Tambah Jadwal
        </a>

        <form action="{{ route('logout') }}" method="POST" class="">
            @csrf
            <button type="submit" class="logout-button bg-red-500 text-white px-4 py-2 rounded ml-10 flex items-center hover:bg-red-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>

    <!-- Minggu Pertama Content -->
    <div id="minggu-pertama" class="week-container active">
        <h2 class="text-2xl font-bold mb-6 text-purple-700 text-center">Jadwal Minggu Pertama</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach($schedules->where('week', 'pertama') as $schedule)
            <div class="schedule-card p-6 bg-purple-100 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="person-icon bg-purple-400 rounded-full p-2 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-purple-800">{{ $schedule->name }}</h3>
                </div>
                <p class="text-purple-700">{{ $schedule->day }}</p>
                <a href="{{ route('schedule.edit', $schedule->id) }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block hover:text-blue-700 transition-colors">
                    Sunting
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Minggu Kedua Content -->
    <div id="minggu-kedua" class="week-container">
        <h2 class="text-2xl font-bold mb-6 text-purple-700 text-center">Jadwal Minggu Kedua</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach($schedules->where('week', 'kedua') as $schedule)
            <div class="schedule-card p-6 bg-purple-100 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="person-icon bg-purple-400 rounded-full p-2 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-purple-800">{{ $schedule->name }}</h3>
                </div>
                <p class="text-purple-700">{{ $schedule->day }}</p>
                <a href="{{ route('schedule.edit', $schedule->id) }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block hover:text-blue-700 transition-colors">
                    Sunting
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Minggu Ketiga Content -->
    <div id="minggu-ketiga" class="week-container">
        <h2 class="text-2xl font-bold mb-6 text-purple-700 text-center">Jadwal Minggu Ketiga</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach($schedules->where('week', 'ketiga') as $schedule)
            <div class="schedule-card p-6 bg-purple-100 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="person-icon bg-purple-400 rounded-full p-2 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-purple-800">{{ $schedule->name }}</h3>
                </div>
                <p class="text-purple-700">{{ $schedule->day }}</p>
                <a href="{{ route('schedule.edit', $schedule->id) }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block hover:text-blue-700 transition-colors">
                    Sunting
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Minggu Keempat Content -->
    <div id="minggu-keempat" class="week-container">
        <h2 class="text-2xl font-bold mb-6 text-purple-700 text-center">Jadwal Minggu Keempat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach($schedules->where('week', 'keempat') as $schedule)
            <div class="schedule-card p-6 bg-purple-100 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="person-icon bg-purple-400 rounded-full p-2 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-purple-800">{{ $schedule->name }}</h3>
                </div>
                <p class="text-purple-700">{{ $schedule->day }}</p>
                <a href="{{ route('schedule.edit', $schedule->id) }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block hover:text-blue-700 transition-colors">
                    Sunting
                </a>
            </div>
            @endforeach
        </div>
    </div>

    

    <!-- Modal untuk konfirmasi logout -->
    <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-8 max-w-md w-full transform transition-all">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Konfirmasi Logout</h3>
            <p class="text-gray-700 mb-6">Apakah Anda yakin ingin keluar dari aplikasi?</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelLogout" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                    Batal
                </button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                        Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Tab navigation functionality dengan animasi
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.minggu-tab');
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs and containers
                    document.querySelectorAll('.minggu-tab').forEach(t => {
                        t.classList.remove('active-tab');
                    });

                    document.querySelectorAll('.week-container').forEach(c => {
                        c.classList.remove('active');
                    });

                    // Add active class to clicked tab with small delay for animation
                    this.classList.add('active-tab');

                    // Show the corresponding container
                    const targetId = this.getAttribute('data-target');
                    setTimeout(() => {
                        document.getElementById(targetId).classList.add('active');
                    }, 100);
                });
            });

            // Animate schedule cards on page load
            const scheduleCards = document.querySelectorAll('.schedule-card');
            scheduleCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 + (index * 100));
            });

            // Logout functionality dengan konfirmasi modal
            const logoutButton = document.querySelector('.logout-button');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');

            if (logoutButton) {
                logoutButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    logoutModal.classList.remove('hidden');
                    // Tambahkan animasi fade in
                    logoutModal.style.opacity = '0';
                    setTimeout(() => {
                        logoutModal.style.transition = 'opacity 0.3s ease';
                        logoutModal.style.opacity = '1';
                    }, 10);
                });
            }

            if (cancelLogout) {
                cancelLogout.addEventListener('click', function() {
                    // Tambahkan animasi fade out
                    logoutModal.style.opacity = '0';
                    setTimeout(() => {
                        logoutModal.classList.add('hidden');
                    }, 300);
                });
            }

            // Tutup modal ketika mengklik diluar modal
            logoutModal.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    logoutModal.style.opacity = '0';
                    setTimeout(() => {
                        logoutModal.classList.add('hidden');
                    }, 300);
                }
            });
        });
    </script>
</body>
</html>