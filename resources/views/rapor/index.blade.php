<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Rapor - KB Nurul'Ain</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- TOM SELECT -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #F8FAFC;
            overflow-x: hidden;
        }

        /* SIDEBAR IDENTIK */
        .sidebar {
            width: 270px;
            height: 100vh;
            background: white;
            border-right: 1px solid #E2E8F0;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .main-content {
            margin-left: 270px;
            min-height: 100vh;
            transition: 0.3s;
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

        .sidebar-menu {
            padding: 22px 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
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

        .nav-link-custom:hover {
            background: #F1F5F9;
            color: #0284C7;
        }

        .nav-link-custom.active {
            background: #E0F2FE;
            color: #0284C7;
            font-weight: 700;
        }

        .nav-link-custom i {
            font-size: 18px;
        }

        /* TOPBAR IDENTIK */
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

        .profile-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* CONTENT AREA */
        .content {
            padding: 32px;
        }

        .breadcrumb-text {
            font-size: 14px;
            color: #94A3B8;
            margin-bottom: 10px;
        }

        .page-title {
            font-size: 34px;
            font-weight: 800;
            color: #0F172A;
        }

        .page-subtitle {
            color: #64748B;
            margin-top: 6px;
        }

        /* CARD CUSTOM & FORM COMPONENTS */
        .card-custom {
            background: white;
            border-radius: 24px;
            border: 1px solid #F1F5F9;
            padding: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .03);
            transition: all .25s ease;
        }

        .form-label-custom {
            font-size: 14px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-control-custom {
            width: 100%;
            height: 52px;
            border: 1px solid #CBD5E1;
            border-radius: 14px;
            padding: 0 18px;
            outline: none;
            font-size: 14px;
            transition: .2s;
            background: #F8FAFC;
            font-weight: 600;
            color: #334155;
        }

        .form-control-custom:focus {
            border-color: #0284C7;
            background: white;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, .1);
        }

        /* TOM SELECT CUSTOM STYLING */
        .ts-wrapper.single .ts-control {
            height: 52px !important;
            min-height: 52px !important;
            border: 1px solid #CBD5E1 !important;
            border-radius: 14px !important;
            background: #F8FAFC !important;
            padding: 0 18px !important;
            display: flex !important;
            align-items: center !important;
            box-shadow: none !important;
        }

        .ts-wrapper.single .ts-control input {
            font-size: 14px !important;
        }

        .ts-wrapper.single .ts-control.focus {
            border-color: #0284C7 !important;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, .1) !important;
        }

        .ts-dropdown {
            border-radius: 14px !important;
            border: 1px solid #E2E8F0 !important;
            overflow: hidden;
            margin-top: 6px;
        }

        .ts-dropdown .option {
            padding: 12px 16px;
            font-size: 14px;
        }

        .ts-dropdown .active {
            background: #E0F2FE !important;
            color: #0284C7 !important;
        }

        .ts-wrapper {
            width: 100%;
        }

        /* STEP BADGE & NARASI COMPONENT */
        .section-label {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #94A3B8;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .badge-aspek {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-nabp   { background: #FEF3C7; color: #D97706; }
        .badge-jd     { background: #E0F2FE; color: #0E7490; }
        .badge-lmstrs { background: #EDE9FE; color: #7C3AED; }

        .narasi-group {
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .narasi-header {
            padding: 12px 16px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border-bottom: 1px solid #F1F5F9;
            background: #F8FAFC;
        }

        .narasi-number {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: #0284C7;
            color: white;
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .narasi-capaian {
            font-size: 12px;
            color: #475569;
            line-height: 1.5;
        }

        .narasi-textarea {
            width: 100%;
            border: none;
            outline: none;
            resize: none;
            padding: 12px 16px;
            font-size: 13px;
            color: #1E293B;
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.6;
            background: white;
            min-height: 80px;
        }

        .narasi-textarea:focus {
            background: #FAFBFF;
        }

        /* BUTTONS */
        .btn-generate {
            background: linear-gradient(135deg, #0284C7, #0369A1);
            border: none;
            color: white;
            padding: 14px 24px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: .2s;
            cursor: pointer;
        }

        .btn-generate:hover {
            opacity: .95;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.25);
        }

        .btn-generate:disabled {
            opacity: .6;
            cursor: not-allowed;
            transform: none;
        }

        .btn-save-rapor {
            background: #059669;
            border: none;
            color: white;
            padding: 14px 24px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: .2s;
        }

        .btn-save-rapor:hover {
            background: #047857;
            transform: translateY(-1px);
        }

        .btn-download-pdf {
            background: #7C3AED;
            border: none;
            color: white;
            padding: 14px 24px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: .2s;
        }

        .btn-download-pdf:hover {
            background: #6D28D9;
            color: white;
        }

        .step-badge {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #0284C7;
            color: white;
            font-weight: 800;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .step-badge.pending {
            background: #CBD5E1;
        }

        /* LOADING OVERLAY */
        .loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .5);
            z-index: 9999;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }

        .loading-overlay.show {
            display: flex;
        }

        .loading-card {
            background: white;
            border-radius: 20px;
            padding: 32px 40px;
            text-align: center;
            max-width: 380px;
        }

        /* RESPONSIVE BREKPOINTS IDENTIK */
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

            .content {
                padding: 24px;
            }

            .topbar {
                padding: 16px 20px;
            }

            .page-title {
                font-size: 30px;
            }

            .card-custom {
                padding: 24px;
            }
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 14px 16px;
                gap: 12px;
            }

            .content {
                padding: 18px;
            }

            .profile-img {
                width: 38px;
                height: 38px;
            }

            .page-title {
                font-size: 26px;
                line-height: 1.3;
            }

            .page-subtitle {
                font-size: 14px;
            }

            .breadcrumb-text {
                font-size: 12px;
            }

            .card-custom {
                padding: 20px;
                border-radius: 20px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 250px;
            }

            .brand-box {
                padding: 22px 18px;
            }

            .sidebar-menu {
                padding: 18px 12px;
            }

            .topbar {
                padding: 12px;
            }

            .content {
                padding: 14px;
            }

            .page-title {
                font-size: 22px;
            }

            .card-custom {
                padding: 16px;
                margin-top: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">

            <!-- BRAND -->
            <div class="brand-box d-flex align-items-center gap-3">
                <div class="brand-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
                <div>
                    <div class="brand-title">Dashboard Guru</div>
                    <div class="brand-sub">KB NURUL'AIN</div>
                </div>
            </div>

            <!-- MENU NAVIGASI (DENGAN ROUTE IDENTIK & DYNAMIC ACTIVE) -->
            <div class="sidebar-menu">
                <a href="/dashboard" class="nav-link-custom {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Beranda
                </a>
                <a href="/data-murid" class="nav-link-custom {{ request()->is('data-murid*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Data Murid
                </a>
                <a href="{{ route('penilaian.create') }}" class="nav-link-custom {{ request()->routeIs('penilaian.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i> Input Data Perkembangan
                </a>
                <a href="/perkembangan-anak" class="nav-link-custom {{ request()->is('perkembangan-anak*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart"></i> Perkembangan Anak
                </a>
                <a href="/hasil-analisis" class="nav-link-custom {{ request()->is('hasil-analisis*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i> Hasil Analisis
                </a>
                <a href="/catatan-anak-rumah" class="nav-link-custom {{ request()->is('catatan-anak-rumah*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i> Catatan Anak Dirumah
                </a>
                <a href="{{ route('rapor.index') }}" class="nav-link-custom {{ request()->routeIs('rapor.*') ? 'active' : '' }}">
                    <i class="bi bi-award"></i> Generate Rapor
                </a>
                <a href="/profil-guru" class="nav-link-custom {{ request()->is('profil-guru*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i> Profil Guru
                </a>

                <!-- PUSH KE BAWAH LOGOUT -->
                <div class="mt-auto pt-4">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="nav-link-custom text-danger border-0 bg-transparent w-100 text-start">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content flex-grow-1">

            <!-- TOPBAR -->
            <header class="topbar d-flex justify-content-between align-items-center">

                <!-- LEFT MOBILE BTN -->
                <div class="d-flex align-items-center gap-3 flex-grow-1">
                    <button class="btn d-lg-none border-0 px-0" onclick="toggleSidebar()">
                        <i class="bi bi-list fs-2"></i>
                    </button>
                </div>

                <!-- RIGHT PROFILE AREA -->
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-sm-block">
                        <div class="fw-bold">
                            <small class="text-muted">
                                {{ auth()->user()->nama }}
                            </small>
                        </div>
                    </div>

                    @if(isset($guru) && $guru->foto)
                        <img src="{{ asset('storage/' . $guru->foto) }}" class="profile-img">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'Guru') }}&background=0ea5e9&color=fff" class="profile-img">
                    @endif
                </div>

            </header>

            <!-- CONTENT AREA -->
            <div class="content">

                <!-- HEADER PAGE -->
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                    <div>
                        <div class="breadcrumb-text">Beranda / <span class="text-primary fw-bold">Generate Rapor</span></div>
                        <h1 class="page-title">Generate Rapor</h1>
                        <p class="page-subtitle">Laporan Capaian Pembelajaran Anak (LCPA)</p>
                    </div>

                    <a href="{{ route('rapor.list') }}" class="btn" style="background:#F1F5F9;color:#475569;border-radius:12px;font-weight:700;font-size:13px;">
                        <i class="bi bi-clock-history me-2"></i>Riwayat Rapor
                    </a>
                </div>

                <div class="row g-4">
                    <!-- KIRI: FORM SETUP (COL 4) -->
                    <div class="col-lg-4">

                        <!-- STEP 1: PILIH ANAK & SEMESTER -->
                        <div class="card-custom mb-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="step-badge" id="step1Badge">1</div>
                                <div>
                                    <div style="font-weight:800;color:#0F172A;font-size:14px;">Pilih Anak & Semester</div>
                                    <div style="font-size:12px;color:#94A3B8;">Isi data sebelum generate</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Nama Anak</label>
                                <select id="selectAnak" name="id_anak" required>
                                    <option value="">-- Pilih Anak --</option>
                                    @foreach($anak as $a)
                                        <option value="{{ $a->id_anak }}" data-nama="{{ $a->nama_anak }}">{{ $a->nama_anak }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Semester</label>
                                <select id="selectSemester" class="form-control-custom form-select">
                                    <option value="Semester Ganjil 2025/2026">Semester Ganjil 2025/2026</option>
                                    <option value="Semester Genap 2025/2026" selected>Semester Genap 2025/2026</option>
                                    <option value="Semester Ganjil 2026/2027">Semester Ganjil 2026/2027</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Tahun Ajaran</label>
                                <input type="text" id="inputTahun" class="form-control-custom" value="2025/2026">
                            </div>

                            <button class="btn-generate w-100 justify-content-center" onclick="generateRapor()" id="btnGenerate">
                                <i class="bi bi-stars"></i>
                                <span id="labelGenerate">Generate Rapor (LCPA)</span>
                            </button>
                        </div>

                        <!-- STEP 2: DDTK & PRESENSI (CARD DISIMPAN SAMPAI DIBUKA SCRIPT) -->
                        <div class="card-custom" id="cardDDTK" style="display:none;">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="step-badge pending" id="step2Badge">2</div>
                                <div>
                                    <div style="font-weight:800;color:#0F172A;font-size:14px;">DDTK & Presensi</div>
                                    <div style="font-size:12px;color:#94A3B8;">Isi data pengukuran & kehadiran</div>
                                </div>
                            </div>

                            <div class="section-label">Pengukuran Fisik</div>
                            <div class="row g-2 mb-3">
                                <div class="col-4">
                                    <label class="form-label-custom" style="font-size:11px;">Tinggi (cm)</label>
                                    <input type="text" id="tinggiBadan" class="form-control-custom form-control-sm h-auto py-2" placeholder="95">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom" style="font-size:11px;">Berat (kg)</label>
                                    <input type="text" id="beratBadan" class="form-control-custom form-control-sm h-auto py-2" placeholder="14">
                                </div>
                                <div class="col-4">
                                    <label class="form-label-custom" style="font-size:11px;">Lingkar (cm)</label>
                                    <input type="text" id="lingkarKepala" class="form-control-custom form-control-sm h-auto py-2" placeholder="51">
                                </div>
                            </div>

                            <div class="section-label">Kehadiran</div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label-custom" style="font-size:11px;">Hadir (hari)</label>
                                    <input type="number" id="hadir" class="form-control-custom form-control-sm h-auto py-2" value="0" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom" style="font-size:11px;">Sakit (hari)</label>
                                    <input type="number" id="sakit" class="form-control-custom form-control-sm h-auto py-2" value="0" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom" style="font-size:11px;">Izin (hari)</label>
                                    <input type="number" id="izin" class="form-control-custom form-control-sm h-auto py-2" value="0" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom" style="font-size:11px;">Tanpa Ket.</label>
                                    <input type="number" id="tanpaKet" class="form-control-custom form-control-sm h-auto py-2" value="0" min="0">
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn-save-rapor flex-grow-1 justify-content-center" onclick="simpanRapor()">
                                    <i class="bi bi-check-circle"></i> Simpan & Finalisasi
                                </button>
                            </div>

                            <div id="linkDownload" style="display:none;margin-top:10px;">
                                <a href="#" id="btnDownload" class="btn-download-pdf w-100 justify-content-center" target="_blank">
                                    <i class="bi bi-download"></i> Download PDF
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- KANAN: EDITOR NARASI (COL 8) -->
                    <div class="col-lg-8">
                        <div class="card-custom" id="cardNarasi">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <div style="font-weight:800;color:#0F172A;font-size:16px;">Editor Narasi Rapor</div>
                                    <div style="font-size:12px;color:#94A3B8;margin-top:2px;">Anda dapat mengedit sebelum cetak</div>
                                </div>
                                <span id="badgeStatus" class="badge" style="display:none;border-radius:8px;font-size:11px;padding:6px 12px;">Draft</span>
                            </div>

                            <!-- Placeholder sebelum generate -->
                            <div id="placeholderNarasi" class="text-center py-5" style="color:#94A3B8;">
                                <i class="bi bi-stars" style="font-size:48px;opacity:.3;"></i>
                                <div style="margin-top:12px;font-size:13px;">Pilih anak dan klik Generate untuk mulai membuat narasi rapor</div>
                            </div>

                            <!-- Konten narasi (muncul setelah generate) -->
                            <div id="kontenNarasi" style="display:none;">

                                <!-- A. NABP -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge-aspek badge-nabp"><i class="bi bi-heart-fill"></i> A. Nilai Agama dan Budi Pekerti</span>
                                    </div>
                                    @php
                                    $capaianNABP = [
                                        1 => "Anak percaya kepada Tuhan Yang Maha Esa, mulai mengenal dan mempraktikkan ajaran pokok sesuai dengan agama dan kepercayaan-Nya",
                                        2 => "Anak berpartisipasi aktif dalam menjaga kebersihan, kesehatan dan keselamatan diri sebagai bentuk rasa sayang terhadap dirinya dan rasa syukur pada Tuhan Yang Maha Esa",
                                        3 => "Anak menghargai sesama manusia dengan berbagai perbedaannya dan mempraktikkan perilaku baik dan berakhlak mulia",
                                        4 => "Anak menghargai alam dengan cara merawatnya dan menunjukkan rasa sayang terhadap makhluk hidup yang merupakan ciptaan Tuhan Yang Maha Esa",
                                    ];
                                    @endphp
                                    @foreach($capaianNABP as $no => $teks)
                                    <div class="narasi-group">
                                        <div class="narasi-header">
                                            <div class="narasi-number">{{ $no }}</div>
                                            <div class="narasi-capaian">{{ $teks }}</div>
                                        </div>
                                        <textarea class="narasi-textarea" id="narasi_nabp_{{ $no }}" placeholder="Narasi akan muncul setelah generate..."></textarea>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- B. JD -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge-aspek badge-jd"><i class="bi bi-person-fill"></i> B. Jati Diri</span>
                                    </div>
                                    @php
                                    $capaianJD = [
                                        1 => "Anak mengenali, mengekspresikan, dan mengelola emosi diri serta membangun hubungan sosial secara sehat",
                                        2 => "Anak memahami identitas dirinya yang terbentuk oleh ragam minat, kebutuhan, karakteristik gender, agama, dan sosial budaya",
                                        3 => "Anak mengenal dan memiliki perilaku positif terhadap identitas dan perannya sebagai bagian dari keluarga, sekolah, masyarakat, dan anak Indonesia",
                                        4 => "Anak menggunakan fungsi gerak (motorik kasar, halus, dan taktil) untuk mengeksplorasi dan memanipulasi berbagai objek dan lingkungan sekitar",
                                    ];
                                    @endphp
                                    @foreach($capaianJD as $no => $teks)
                                    <div class="narasi-group">
                                        <div class="narasi-header">
                                            <div class="narasi-number" style="background:#0284C7;">{{ $no }}</div>
                                            <div class="narasi-capaian">{{ $teks }}</div>
                                        </div>
                                        <textarea class="narasi-textarea" id="narasi_jd_{{ $no }}" placeholder="Narasi akan muncul setelah generate..."></textarea>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- C. LMSTRS -->
                                <div class="mb-4">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <span class="badge-aspek badge-lmstrs"><i class="bi bi-book-fill"></i> C. Dasar-dasar Literasi, Matematika, Sains, Teknologi, Rekayasa, dan Seni</span>
                                    </div>
                                    @php
                                    $capaianLMSTRS = [
                                        1 => "Anak mengenali dan memahami berbagai informasi, mengomunikasikan perasaan dan pikiran secara lisan, tulisan, atau menggunakan berbagai media serta membangun percakapan",
                                        2 => "Anak menunjukkan minat, kegemaran, dan berpartisipasi dalam kegiatan pramembaca dan pramenulis",
                                        3 => "Anak memiliki kemampuan menyatakan hubungan antar bilangan dengan berbagai cara, mengidentifikasi pola, mengenali bentuk dan karakteristik benda di sekitar",
                                        4 => "Anak mampu menyebutkan alasan, pilihan atau keputusannya, mampu memecahkan masalah sederhana, serta mengetahui hubungan sebab akibat",
                                        5 => "Anak menunjukkan rasa ingin tahu melalui observasi, eksplorasi, dan eksperimen dengan menggunakan lingkungan sekitar dan media sebagai sumber belajar",
                                        6 => "Anak menunjukkan kemampuan awal menggunakan dan merekayasa teknologi serta untuk mencari informasi, gagasan, dan keterampilan secara aman dan bertanggung jawab",
                                        7 => "Anak mengeksplorasi berbagai proses seni, mengekspresikannya, serta mengapresiasi karya seni",
                                    ];
                                    @endphp
                                    @foreach($capaianLMSTRS as $no => $teks)
                                    <div class="narasi-group">
                                        <div class="narasi-header">
                                            <div class="narasi-number" style="background:#7C3AED;">{{ $no }}</div>
                                            <div class="narasi-capaian">{{ $teks }}</div>
                                        </div>
                                        <textarea class="narasi-textarea" id="narasi_lmstrs_{{ $no }}" placeholder="Narasi akan muncul setelah generate..."></textarea>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- LOADING OVERLAY -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-card">
            <div class="spinner-border mb-3" style="color:#0284C7;width:48px;height:48px;" role="status"></div>
            <div style="font-weight:800;font-size:16px;color:#0F172A;" id="loadingTitle">Generating Narasi...</div>
            <div style="font-size:13px;color:#64748B;margin-top:6px;" id="loadingDesc">
                AI sedang menganalisis data perkembangan anak.<br>Proses ini membutuhkan beberapa menit.
            </div>
            <div style="margin-top:16px;">
                <div class="progress" style="height:6px;border-radius:999px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%;background:#0284C7;border-radius:999px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS DEPENDENCIES -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script>
        let currentRaporId = null;

        // INIALISASI TOM SELECT (Sama seperti halaman Input Penilaian)
        new TomSelect('#selectAnak', {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        // SIDEBAR TOGGLE FUNCTION
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        // GENERATE RAPOR AJAX
        function generateRapor() {
            const idAnak    = document.getElementById('selectAnak').value;
            const semester  = document.getElementById('selectSemester').value;
            const tahun     = document.getElementById('inputTahun').value;

            if (!idAnak) {
                alert('Pilih anak terlebih dahulu!');
                return;
            }

            // Tampilkan Loading Overlay
            document.getElementById('loadingOverlay').classList.add('show');
            document.getElementById('btnGenerate').disabled = true;
            document.getElementById('labelGenerate').textContent = 'Sedang generate...';

            fetch('{{ route("rapor.generate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    id_anak: idAnak,
                    semester: semester,
                    tahun_ajaran: tahun,
                })
            })
            .then(r => r.json())
            .then(data => {
                document.getElementById('loadingOverlay').classList.remove('show');
                document.getElementById('btnGenerate').disabled = false;
                document.getElementById('labelGenerate').textContent = 'Generate Ulang';

                if (!data.success) {
                    alert(data.message || 'Gagal generate narasi');
                    return;
                }

                currentRaporId = data.id_rapor;

                // Tampilkan Konten & Form Step 2
                document.getElementById('placeholderNarasi').style.display = 'none';
                document.getElementById('kontenNarasi').style.display = 'block';
                document.getElementById('cardDDTK').style.display = 'block';
                
                const badgeStatus = document.getElementById('badgeStatus');
                badgeStatus.style.display = 'inline-block';
                badgeStatus.textContent = 'Draft';
                badgeStatus.style.background = '#FEF3C7';
                badgeStatus.style.color = '#D97706';

                // Populasikan Textarea dengan Hasil AI
                const n = data.narasi;
                for (let i = 1; i <= 4; i++) {
                    const el = document.getElementById(`narasi_nabp_${i}`);
                    if (el && n[`nabp_${i}`]) el.value = n[`nabp_${i}`];
                    autoResize(el);
                }
                for (let i = 1; i <= 4; i++) {
                    const el = document.getElementById(`narasi_jd_${i}`);
                    if (el && n[`jd_${i}`]) el.value = n[`jd_${i}`];
                    autoResize(el);
                }
                for (let i = 1; i <= 7; i++) {
                    const el = document.getElementById(`narasi_lmstrs_${i}`);
                    if (el && n[`lmstrs_${i}`]) el.value = n[`lmstrs_${i}`];
                    autoResize(el);
                }

                document.getElementById('kontenNarasi').scrollIntoView({ behavior: 'smooth' });
            })
            .catch(err => {
                document.getElementById('loadingOverlay').classList.remove('show');
                document.getElementById('btnGenerate').disabled = false;
                document.getElementById('labelGenerate').textContent = 'Generate Rapor (LCPA)';
                alert('Terjadi kesalahan: ' + err.message);
            });
        }

        // SIMPAN RAPOR AJAX
        function simpanRapor() {
            if (!currentRaporId) { 
                alert('Generate narasi dulu!'); 
                return; 
            }

            const payload = {
                tinggi_badan:      document.getElementById('tinggiBadan').value,
                berat_badan:       document.getElementById('beratBadan').value,
                lingkar_kepala:    document.getElementById('lingkarKepala').value,
                hadir:             document.getElementById('hadir').value,
                sakit:             document.getElementById('sakit').value,
                izin:              document.getElementById('izin').value,
                tanpa_keterangan:  document.getElementById('tanpaKet').value,
            };

            for (let i = 1; i <= 4; i++) {
                payload[`narasi_nabp_${i}`]   = document.getElementById(`narasi_nabp_${i}`)?.value || '';
                payload[`narasi_jd_${i}`]     = document.getElementById(`narasi_jd_${i}`)?.value || '';
            }
            for (let i = 1; i <= 7; i++) {
                payload[`narasi_lmstrs_${i}`] = document.getElementById(`narasi_lmstrs_${i}`)?.value || '';
            }

            fetch(`/rapor/simpan/${currentRaporId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload)
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    const badgeStatus = document.getElementById('badgeStatus');
                    badgeStatus.textContent = '✓ Final';
                    badgeStatus.style.background = '#D1FAE5';
                    badgeStatus.style.color = '#059669';

                    const linkDiv = document.getElementById('linkDownload');
                    const btnDl   = document.getElementById('btnDownload');
                    btnDl.href    = `/rapor/download/${currentRaporId}`;
                    linkDiv.style.display = 'block';

                    alert('Rapor berhasil disimpan! Klik Download PDF untuk mencetak.');
                } else {
                    alert('Gagal menyimpan rapor.');
                }
            })
            .catch(err => alert('Error: ' + err.message));
        }

        // AUTO RESIZE TEXTAREA
        function autoResize(el) {
            if (!el) return;
            el.style.height = 'auto';
            el.style.height = el.scrollHeight + 'px';
        }

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('narasi-textarea')) {
                autoResize(e.target);
            }
        });
    </script>
</body>

</html>