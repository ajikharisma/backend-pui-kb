<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utama - KB Nurul'Ain</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #F8FAFC;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar{
            width: 270px;
            height: 100vh; /* GANTI dari min-height */
            background: white;
            border-right: 1px solid #E2E8F0;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* penting */
        }

        .main-content {
            margin-left: 270px;
            min-height: 100vh;
            transition: margin 0.3s ease;
        }

        .brand-box {
            padding: 28px 24px;
            border-bottom: 1px solid #F1F5F9;
        }

        .brand-icon {
            width: 50px;
            height: 50px;
            border-radius: 16px;
            background: #E0F2FE;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0284C7;
            font-size: 22px;
        }

        .brand-title {
            font-size: 16px;
            font-weight: 800;
            color: #0F172A;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: 12px;
            color: #94A3B8;
            margin-top: 3px;
        }

        .sidebar-menu{
            padding: 22px 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
            overflow-y: auto; /* INI YANG MEMBUAT SCROLL */
        }

        .sidebar-menu::-webkit-scrollbar{
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb{
            background: #CBD5E1;
            border-radius: 999px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 16px;
            border-radius: 14px;
            color: #64748B;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 6px;
            transition: .2s;
            font-size: 14px;
        }

        .nav-link-custom i {
            font-size: 18px;
        }

        .nav-link-custom:hover {
            background: #F1F5F9;
            color: #0284C7;
        }

        .nav-link-custom.active {
            background: #E0F2FE;
            color: #0284C7;
            font-weight: 700;
        }

        /* TOPBAR (Konsisten dengan Data Murid) */
        .topbar {
            background: white;
            padding: 18px 30px;
            border-bottom: 1px solid #E2E8F0;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-wrapper {
            position: relative;
            flex: 1;
            max-width: 350px;
        }

        /* FIX SEARCH ICON & INPUT */
        .search-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            /* Menarik ikon tepat ke tengah vertikal */
            color: #94A3B8;
            font-size: 16px;
            display: flex;
            align-items: center;
            pointer-events: none;
            /* Agar klik pada ikon tembus ke input */
        }

        .search-input {
            width: 320px;
            height: 46px;
            /* Tinggi yang konsisten */
            border: 1px solid #CBD5E1;
            border-radius: 999px;
            padding: 0 20px 0 46px;
            /* Padding kiri disesuaikan agar teks tidak menabrak ikon */
            outline: none;
            font-size: 14px;
            transition: .2s;
            background: white;
            display: flex;
            align-items: center;
        }

        .search-input:focus {
            border-color: #0284C7;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, .1);
        }

        /* PROFILE */
        .profile-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* DASHBOARD CARDS (Statistik) */
        .content {
            padding: 32px;
        }

        .welcome-title {
            font-size: 32px;
            font-weight: 800;
            color: #0F172A;
        }

        /* ===== STAT CARD BARU ===== */
        .stat-card {
            border-radius: 24px;
            padding: 24px;
            border: none;
            transition: transform 0.2s;
            color: white;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            background: white !important;
        }

        /* WARNA CARD */
        .bg-card-blue {
            background: #0284C7;
        }

        .bg-card-green {
            background: #10B981;
        }

        .bg-card-pink {
            background: #DB2777;
        }

        /* WARNA ICON */
        .text-icon-blue {
            color: #0284C7;
        }

        .text-icon-green {
            color: #10B981;
        }

        .text-icon-pink {
            color: #DB2777;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.9;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 800;
            margin-top: 4px;
        }

        /* CHART CARDS */
        .chart-card {
            background: white;
            border-radius: 24px;
            padding: 28px;
            border: 1px solid #F1F5F9;
            height: 100%;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 20px;
        }

        .inner-chart-box {
            background: #F8FAFC;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #F1F5F9;
        }

        /* PROGRESS BAR CUSTOM */
        .dist-item {
            margin-bottom: 20px;
        }

        .dist-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 14px;
        }

        .progress-custom {
            height: 10px;
            background: #E2E8F0;
            border-radius: 99px;
            overflow: hidden;
        }

        .progress-bar-blue {
            background: #0284C7;
        }

        .progress-bar-pink {
            background: #DB2777;
        }

        /* FAB */
        .fab-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #0E7490;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 8px 25px rgba(14, 116, 144, 0.4);
            cursor: pointer;
            z-index: 999;
            transition: .3s;
        }

        .fab-btn:hover {
            background: #0c6480;
            transform: scale(1.1);
        }

        /* RESPONSIVE */
        /* =========================================
        RESPONSIVE TABLET
        ========================================= */
        @media (max-width: 1024px) {

            .sidebar {
                transform: translateX(-100%);
                transition: 0.3s;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                padding: 16px 20px;
            }

            .content {
                padding: 24px;
            }

            .search-input {
                width: 220px;
            }

            .welcome-title {
                font-size: 28px;
            }
        }

        /* =========================================
        RESPONSIVE MOBILE
        ========================================= */
        @media (max-width: 768px) {

            .topbar {
                padding: 14px 16px;
            }

            .content {
                padding: 18px;
            }

            .welcome-title {
                font-size: 24px;
                line-height: 1.3;
            }

            .content p.text-secondary {
                font-size: 14px;
                line-height: 1.6;
            }

            /* SEARCH MOBILE */
            .search-wrapper {
                flex: 1;
                display: block !important;
            }

            .search-input {
                width: 100%;
                height: 42px;
                min-width: 0;
                font-size: 13px;
                padding: 10px 16px 10px 40px;
            }

            .search-wrapper i {
                top: 50%;
                transform: translateY(-50%);
                left: 14px;
            }

            /* PROFILE */
            .profile-img {
                width: 38px;
                height: 38px;
            }

            /* CARD */
            .stat-card {
                padding: 18px;
                border-radius: 20px;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .stat-label {
                font-size: 11px;
            }

            .stat-value {
                font-size: 28px;
            }

            /* CHART */
            .chart-card {
                padding: 20px;
                border-radius: 20px;
            }

            .inner-chart-box {
                padding: 16px;
            }

            /* DONUT CHART */
            #donutChartDashboard {
                max-height: 180px !important;
            }

            /* FAB */
            .fab-btn {
                width: 54px;
                height: 54px;
                font-size: 24px;
                bottom: 20px;
                right: 20px;
            }
        }

        /* =========================================
        EXTRA SMALL DEVICES
        ========================================= */
        @media (max-width: 480px) {

            .topbar {
                gap: 10px;
            }

            .welcome-title {
                font-size: 22px;
            }

            .search-input {
                height: 42px;
            }

            .stat-card {
                flex-direction: row;
                align-items: center;
                gap: 16px;
            }

            .chart-title {
                font-size: 16px;
            }

            .dist-info {
                font-size: 13px;
            }

            .sidebar {
                width: 250px;
            }

            .brand-box {
                padding: 22px 18px;
            }

            .sidebar-menu {
                padding: 18px 12px;
            }
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- SIDEBAR -->
        <aside class="sidebar" id="sidebar">
            <div class="brand-box d-flex align-items-center gap-3">
                <div class="brand-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <div>
                    <div class="brand-title">Dashboard Guru</div>
                    <div class="brand-sub">KB NURUL'AIN</div>
                </div>
            </div>

            <div class="sidebar-menu">
                <a href="/dashboard" class="nav-link-custom active">
                    <i class="bi bi-grid-fill"></i> Beranda
                </a>
                <a href="/data-murid" class="nav-link-custom">
                    <i class="bi bi-people"></i> Data Murid
                </a>
                <a href="/input-penilaian" class="nav-link-custom">
                    <i class="bi bi-journal-text"></i> Input Data Perkembangan
                </a>
                <a href="/perkembangan-anak" class="nav-link-custom">
                    <i class="bi bi-bar-chart"></i> Perkembangan Anak
                </a>
                <a href="/hasil-analisis" class="nav-link-custom">
                    <i class="bi bi-file-earmark-text"></i> Hasil Analisis
                </a>
                <a href="#" class="nav-link-custom">
                    <i class="bi bi-book"></i> Catatan Anak Dirumah
                </a>
                <a href="/profil-guru" class="nav-link-custom">
                    <i class="bi bi-person-badge"></i> Profil Guru
                </a>

                <div class="mt-5 pt-4">
                    <a href="/logout" class="nav-link-custom text-danger">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="main-content flex-grow-1">

            <!-- TOPBAR -->
            <header class="topbar d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn d-lg-none border-0 px-0" onclick="toggleSidebar()">
                        <i class="bi bi-list fs-2"></i>
                    </button>
                    <div class="search-wrapper">
                        <i class="bi bi-search"></i>
                        <input
                            type="text"
                            id="menuSearch"
                            class="search-input"
                            placeholder="Cari Menu...">
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-sm-block">
                        <div class="fw-bold">
                            <small class="text-muted">{{ auth()->user()->nama }}</small>
                        </div>
                    </div>
                    @if($guru && $guru->foto)
                    <img
                        src="{{ asset('storage/' . $guru->foto) }}"
                        class="profile-img">
                    @else
                    <img
                        src="https://ui-avatars.com/api/?name=Guru&background=0ea5e9&color=fff"
                        class="profile-img">
                    @endif
                </div>
            </header>

            <!-- CONTENT -->
            <div class="content">
                <!-- WELCOME SECTION -->
                <div class="mb-5">
                    <h1 class="welcome-title">Selamat datang, Bu Guru 👋</h1>
                    <p class="text-secondary">Mari pantau perkembangan anak-anak hari ini. Fokus pada pertumbuhan, hargai setiap kemajuan kecil.</p>
                </div>

                <!-- STATISTIC CARDS -->
                <!-- STATISTIC CARDS -->
                <div class="row g-4 mb-5">

                    <!-- Total Anak -->
                    <div class="col-xl-4 col-md-6">
                        <div class="stat-card bg-card-blue d-flex align-items-center gap-4 shadow-sm">
                            <div class="stat-icon text-icon-blue shadow-sm">
                                <i class="bi bi-people-fill"></i>
                            </div>

                            <div>
                                <div class="stat-label">Total Anak</div>
                                <div class="stat-value">{{ $totalAnak }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Anak Laki-Laki -->
                    <div class="col-xl-4 col-md-6">
                        <div class="stat-card bg-card-green d-flex align-items-center gap-4 shadow-sm">
                            <div class="stat-icon text-icon-green shadow-sm">
                                <i class="bi bi-gender-male"></i>
                            </div>

                            <div>
                                <div class="stat-label">Anak Laki-Laki</div>
                                <div class="stat-value">{{ $totalLaki }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Anak Perempuan -->
                    <div class="col-xl-4 col-md-12">
                        <div class="stat-card bg-card-pink d-flex align-items-center gap-4 shadow-sm">
                            <div class="stat-icon text-icon-pink shadow-sm">
                                <i class="bi bi-gender-female"></i>
                            </div>

                            <div>
                                <div class="stat-label">Anak Perempuan</div>
                                <div class="stat-value">{{ $totalPerempuan }}</div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- CHART SECTION -->
                <div class="row g-4">
                    <div class="col-xl-8">
                        <div class="chart-card">
                            <div class="chart-title">Diagram Interaktif</div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="inner-chart-box text-center">
                                        <small class="text-secondary fw-bold d-block mb-3">Siswa & Orang Tua Terdaftar</small>
                                        <div style="height: 200px;">
                                            <canvas id="barChartDashboard"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inner-chart-box d-flex flex-column align-items-center">
                                        <small class="text-secondary fw-bold align-self-start mb-3">Komposisi Gender</small>
                                        <div style="height: 180px; width: 100%; position: relative;">
                                            <canvas id="donutChartDashboard"></canvas>
                                            <div class="position-absolute top-50 start-50 translate-middle text-center">
                                                <div class="fw-bolder fs-4">{{ $totalAnak }}</div>
                                                <div class="text-muted" style="font-size: 8px;">TOTAL</div>
                                            </div>
                                        </div>
                                        <div class="mt-3 w-100">
                                            <div class="d-flex align-items-center gap-2 small fw-bold mb-1">
                                                <span class="p-1 rounded-circle" style="background:#0284C7"></span> Laki-laki ({{ $totalLaki }})
                                            </div>
                                            <div class="d-flex align-items-center gap-2 small fw-bold">
                                                <span class="p-1 rounded-circle" style="background:#DB2777"></span> Perempuan ({{ $totalPerempuan }})
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="chart-card">
                            <div class="chart-title">Distribusi Siswa</div>
                            <div class="mt-4">
                                <div class="dist-item">
                                    <div class="dist-info">
                                        <span>Laki-laki</span>
                                        <span>{{ $persenLaki }}%</span>
                                    </div>
                                    <div class="progress-custom">
                                        <div class="progress-bar-blue h-100" style="width: {{ $persenLaki }}%"></div>
                                    </div>
                                </div>
                                <div class="dist-item">
                                    <div class="dist-info">
                                        <span>Perempuan</span>
                                        <span>{{ $persenPerempuan }}%</span>
                                    </div>
                                    <div class="progress-custom">
                                        <div class="progress-bar-pink h-100" style="width: {{ $persenPerempuan }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
        
        // =========================
        // DATA DARI LARAVEL
        // =========================

        const totalAnak = {{ $totalAnak }};
        const totalOrangTua = {{ $totalOrangTua }};
        const totalLaki = {{ $totalLaki }};
        const totalPerempuan = {{ $totalPerempuan }};

        // =========================
        // BAR CHART
        // =========================

        const barCtx = document.getElementById('barChartDashboard').getContext('2d');

        new Chart(barCtx, {
            type: 'bar',

            data: {
                labels: ['Siswa', 'Ortu'],

                datasets: [{
                    data: [
                        totalAnak,
                        totalOrangTua
                    ],

                    backgroundColor: [
                        '#0284C7',
                        '#E2E8F0'
                    ],

                    borderRadius: 8,
                    barThickness: 30
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,

                        grid: {
                            color: '#F1F5F9'
                        },

                        border: {
                            display: false
                        }
                    },

                    x: {
                        grid: {
                            display: false
                        },

                        border: {
                            display: false
                        }
                    }
                }
            }
        });


        // =========================
        // DONUT CHART
        // =========================

        const donutCtx = document.getElementById('donutChartDashboard').getContext('2d');

        new Chart(donutCtx, {
            type: 'doughnut',

            data: {
                labels: ['Laki-laki', 'Perempuan'],

                datasets: [{
                    data: [
                        totalLaki,
                        totalPerempuan
                    ],

                    backgroundColor: [
                        '#0284C7',
                        '#DB2777'
                    ],

                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                cutout: '75%',

                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });


        // SEARCH MENU SIDEBAR
        const searchInput = document.getElementById('menuSearch');

        const menuItems = document.querySelectorAll('.nav-link-custom');

        searchInput.addEventListener('keyup', function() {

            const keyword = this.value.toLowerCase();

            menuItems.forEach(item => {

                const text = item.innerText.toLowerCase();

                if (text.includes(keyword)) {

                    item.style.display = 'flex';

                } else {

                    item.style.display = 'none';

                }

            });

        });
    </script>

</body>

</html>