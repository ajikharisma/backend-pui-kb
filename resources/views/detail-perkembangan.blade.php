<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Detail Perkembangan Anak
    </title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>

        *{
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body{
            background: #F8FAFC;
            overflow-x: hidden;
        }

        html{
            overflow-x:hidden;
            width:100%;
        }

        .sidebar{
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

        .main-content{
            margin-left: 270px;
            min-height: 100vh;
        }

        .brand-box{
            padding: 28px 24px;
            border-bottom: 1px solid #F1F5F9;
        }

        .brand-icon{
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

        .brand-title{
            font-size: 16px;
            font-weight: 800;
            color: #0F172A;
            line-height: 1.2;
        }

        .brand-sub{
            font-size: 12px;
            color: #94A3B8;
            margin-top: 3px;
        }

        .sidebar-menu{
            padding: 22px 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-menu::-webkit-scrollbar{
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb{
            background: #CBD5E1;
            border-radius: 999px;
        }

        .nav-link-custom{
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

        .nav-link-custom i{
            font-size: 18px;
        }

        .nav-link-custom:hover{
            background: #F1F5F9;
            color: #0284C7;
        }

        .nav-link-custom.active{
            background: #E0F2FE;
            color: #0284C7;
            font-weight: 700;
        }

        .topbar{
            background: white;
            padding: 18px 30px;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-img{
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        .content{
            padding: 32px;
        }

        .detail-card{
            background: white;
            border-radius: 28px;
            padding: 28px;
            border: 1px solid #E2E8F0;
            margin-bottom: 28px;
        }

        .student-photo{
            width: 110px;
            height: 110px;
            border-radius: 24px;
            object-fit: cover;
            border: 5px solid #E0F2FE;
        }

        .badge-kelompok{
            background: #DCFCE7;
            color: #15803D;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .badge-umur{
            background: #E0F2FE;
            color: #0284C7;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .table-custom{
            border-radius: 20px;
            border: 1px solid #E2E8F0;
        }

        .table-custom thead{
            background: #F8FAFC;
        }

        .table-custom th{
            padding: 18px;
            font-size: 12px;
            color: #64748B;
            text-transform: uppercase;
            font-weight: 800;
        }

        .table-custom td{
            padding: 20px 18px;
            vertical-align: top;
            font-size: 14px;
        }

        .badge-bsb{
            background: #BBF7D0;
            color: #166534;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-mb{
            background: #FDE68A;
            color: #92400E;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .ai-box{
            border: 2px dashed #CBD5E1;
            border-radius: 28px;
            background: #F8FAFC;
            padding: 50px;
            text-align: center;
        }

        .btn-analisis{
            background: #00667C;
            color: white;
            border: none;
            padding: 15px 28px;
            border-radius: 16px;
            font-weight: 700;
        }

        .btn-analisis:hover{
            background: #005569;
        }

        .btn-kembali {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            border: 1px solid #CBD5E1;
            padding: 10px 20px;
            border-radius: 12px;
            text-decoration: none;
            color: #334155;
            font-weight: 700;
            font-size: 14px;
            transition: .2s;
        }

        .btn-kembali:hover {
            background: #F8FAFC;
            color: #0F172A;
        }

        .btn-cetak {
            display: inline-flex; 
            align-items: center; 
            gap: 8px;
            background: #0F766E; 
            border: none;
            color: white; 
            padding: 10px 20px;
            border-radius: 12px; 
            font-weight: 700; 
            font-size: 14px;
            text-decoration: none; 
            transition: .2s; 
            cursor: pointer;
        }

        .btn-cetak:hover { 
            background: #115E59; 
            color: white; 
        }

        .profile-wrapper{
            width:100%;
        }

        .profile-wrapper img{
            max-width:100%;
        }

        .profile-wrapper h2{
            word-break: break-word;
        }

        .detail-card{
            overflow: hidden;
        }

        .row{
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .ai-box{
            border: 2px dashed #CBD5E1;
            border-radius: 28px;
            background: #F8FAFC;
            padding: 50px;
            text-align: center;
            overflow-wrap: break-word;
        }

        /* ── TAMBAHKAN CSS INI DI BAGIAN UTAMA STYLE ── */
        .btn-analisis:disabled {
            background: #CBD5E1 !important;
            color: #64748B !important;
            cursor: not-allowed !important;
            opacity: 1 !important;
        }

        @media(max-width:992px){

            .sidebar{
                transform: translateX(-100%);
                transition: .3s;
            }

            .sidebar.show{
                transform: translateX(0);
            }

            .main-content{
                margin-left: 0;
            }

        }

        @media(max-width:768px){

            .profile-img{
                width: 38px;
                height: 38px;
            }

            .btn-kembali {
                width: 50% !important;
                justify-content: flex-start !important;
                order: 2 !important;
            }

            .btn-cetak {
                width: 50% !important;
                justify-content: flex-start !important;
                order: 1 !important;
            }

            .button-group-header {
                width: 100% !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 8px !important;
            }

            .content{
                padding: 16px;
            }

            .detail-card{
                padding: 20px 16px;
                border-radius: 20px;
            }

            /* Perbaikan Profile Anak agar berjejer rapi ke bawah di HP */
            .profile-wrapper {
                flex-direction: column !important;
                text-align: center !important;
            }

            .student-photo{
                width: 100px;
                height: 100px;
            }

            .topbar{
                padding: 15px;
            }

            /* Mengubah tabel mentah menjadi susunan list card agar tidak perlu di-scroll */
            .table-responsive {
                border: none;
            }

            .table-custom, .table-custom thead, .table-custom tbody, .table-custom th, .table-custom td, .table-custom tr {
                display: block;
                width: 100%;
            }

            .table-custom thead {
                display: none; /* Sembunyikan header asli */
            }

            .table-custom tbody tr {
                background: #F8FAFC;
                border: 1px solid #E2E8F0;
                border-radius: 16px;
                padding: 16px;
                margin-bottom: 12px;
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .table-custom td {
                padding: 0 !important;
                border: none !important;
            }

            /* ── GANTI SEKSI INI AGAR KOLOM DESKRIPSI DI HP MUNCUL ── */
            .table-custom td:nth-child(1)::before { content: "Tanggal: "; font-weight: 700; color: #64748B; }
            .table-custom td:nth-child(2)::before { content: "Topik: "; font-weight: 700; color: #64748B; }
            .table-custom td:nth-child(3)::before { content: "Aspek: "; font-weight: 700; color: #64748B; }
            .table-custom td:nth-child(4)::before { content: "Capaian: "; font-weight: 700; color: #64748B; }
            .table-custom td:nth-child(5)::before { content: "Deskripsi: "; font-weight: 700; color: #64748B; }
            
            .table-custom td:nth-child(5) { 
                border-top: 1px dashed #E2E8F0 !important; 
                padding-top: 8px !important; 
                margin-top: 4px;
            }

            .ai-box {
                padding: 30px 16px !important;
            }

            .btn-analisis {
                width: 100% !important;
            }

            .btn-analisis:disabled {
                background: #CBD5E1 !important;
                color: #64748B !important;
                cursor: not-allowed !important;
                opacity: 1 !important;
                border: none !important;
            }

            h1{ font-size: 1.5rem; }
            h2{ font-size: 1.3rem; }
        }

    </style>

</head>

<script>

    function toggleSidebar() {

        document
            .querySelector('.sidebar')
            .classList
            .toggle('show');

    }

</script>

<body>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <div class="brand-box d-flex align-items-center gap-3">

            <div class="brand-icon">
                <i class="bi bi-mortarboard-fill"></i>
            </div>

            <div>
                <div class="brand-title">
                    Dashboard Guru
                </div>

                <div class="brand-sub">
                    KB NURUL'AIN
                </div>
            </div>

        </div>

        <div class="sidebar-menu">

            <a href="/dashboard" class="nav-link-custom">
                <i class="bi bi-grid"></i>
                Beranda
            </a>

            <a href="/data-murid" class="nav-link-custom">
                <i class="bi bi-people"></i>
                Data Murid
            </a>

            <a href="/input-penilaian" class="nav-link-custom">
                <i class="bi bi-journal-text"></i>
                Input Data Perkembangan
            </a>

            <a href="/perkembangan-anak" class="nav-link-custom active">
                <i class="bi bi-bar-chart"></i>
                Perkembangan Anak
            </a>

            <a href="/hasil-analisis" class="nav-link-custom">
                <i class="bi bi-file-earmark-text"></i>
                Hasil Analisis
            </a>

            <a href="/catatan-anak-rumah" class="nav-link-custom">
                <i class="bi bi-book"></i>
                Catatan Anak Dirumah
            </a>

            <a href="/profil-guru" class="nav-link-custom">
                <i class="bi bi-person-badge"></i>
                Profil Guru
            </a>

            <div class="mt-5">
                <form action="/logout" method="POST">
                    @csrf

                    <button type="submit" class="nav-link-custom text-danger border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-right"></i>
                        Keluar
                    </button>
                </form>
            </div>

        </div>

    </div>

    {{-- MAIN --}}
    <div class="main-content flex-grow-1">

        <header class="topbar d-flex justify-content-between align-items-center">

            <div>
                <button
                    class="btn d-lg-none border-0 px-0"
                    onclick="toggleSidebar()">

                    <i class="bi bi-list fs-2"></i>

                </button>
            </div>

            <div class="d-flex align-items-center gap-3">

                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold">
                        <small class="text-muted">
                            {{ auth()->user()->nama }}
                        </small>
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

        {{-- CONTENT --}}
        <div class="content">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
                    style="border-radius:16px;border:none;background:#DCFCE7;color:#166534;">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                <div>

                    <div class="text-muted mb-2">
                        Perkembangan Anak /
                        <span class="text-primary fw-bold">
                            Detail
                        </span>
                    </div>

                    <h1 class="fw-bold mb-1">
                        Detail Perkembangan Anak
                    </h1>

                    <p class="text-muted mb-0">
                        Data perkembangan mingguan anak
                    </p>

                </div>

                <div class="d-flex gap-2 align-items-center button-group-header">
                    
                    <a href="{{ route('laporan.perkembangan', ['id_anak' => $anak->id_anak, 'minggu' => $minggu]) }}"
                    target="_blank"
                    class="btn-cetak">
                        <i class="bi bi-printer"></i> 
                        Cetak Laporan Perkembangan
                    </a>

                    <a href="/perkembangan-anak" class="btn-kembali">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                </div>

            </div>

            {{-- PROFILE --}}
            <div class="detail-card">

                <div class="row g-4 align-items-center">

                    <div class="col-12 col-lg-8">
                        <div class="d-flex flex-column flex-md-row align-items-center text-center text-md-start gap-4 profile-wrapper">

                            @if($anak->foto)
                                <img
                                    src="{{ asset('storage/' . $anak->foto) }}"
                                    class="student-photo">
                            @else
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($anak->nama_anak) }}&background=0ea5e9&color=fff"
                                    class="student-photo">
                            @endif

                            <div>
                                <h2 class="fw-bold mb-3">
                                    {{ $anak->nama_anak }}
                                </h2>

                                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2">

                                    <span class="badge-kelompok">
                                        Kelompok {{ $anak->kelompok }}
                                    </span>

                                    <span class="badge-umur">
                                        Umur
                                        {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->age }}
                                        Tahun
                                    </span>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <label class="fw-bold text-muted mb-2">
                            Periode
                        </label>

                        <div class="form-control-custom">

                            <div class="fw-bold text-primary">
                                Minggu {{ $minggu }}
                            </div>

                            <small class="text-muted d-block mt-1">
                                Tema: {{ $tema }}
                            </small>

                        </div>
                    </div>

                </div>

            </div>

            {{-- TABLE --}}
            <div class="detail-card">

                <h5 class="fw-bold mb-4">
                    Data Perkembangan Mentah
                </h5>

                <div class="table-responsive">

                    <table class="table table-custom align-middle mb-0">

                        <thead>

                            <tr>

                                <th>Tanggal</th>
                                <th>Topik Harian</th>
                                <th>Aspek</th>
                                <th>Capaian</th>
                                <th>Deskripsi</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($penilaian as $item)

                                <tr>

                                    <td>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F') }}
                                    </td>

                                    <td>
                                        {{ $item->rpph->topik_harian ?? '-' }}
                                    </td>

                                    <td class="fw-bold text-primary">
                                        {{ $item->indikator->aspek->nama_aspek ?? '-' }}
                                    </td>

                                    <td>

                                        @if($item->nilai == 'BSB')

                                            <span class="badge-bsb">
                                                BSB
                                            </span>

                                        @else

                                            <span class="badge-mb">
                                                {{ $item->nilai }}
                                            </span>

                                        @endif

                                    </td>

                                    <td style="line-height: 1.8">
                                        {{ $item->deskripsi }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-5">

                                        Belum ada data perkembangan

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- ── KOTAK AI BOX DINAMIS SINKRON TOTAL ── --}}
            <div class="ai-box">

                <div class="mb-3">
                    @if(isset($status_analisis) && $status_analisis)
                        <span class="badge text-bg-success px-4 py-2 rounded-pill fw-bold" style="background-color: #DCFCE7 !important; color: #15803D !important;">
                            <i class="bi bi-check-circle-fill me-1"></i> Status Analisis : Sudah Diproses
                        </span>
                    @else
                        <span class="badge text-bg-secondary px-4 py-2 rounded-pill">
                            Status Analisis : Belum Diproses
                        </span>
                    @endif
                </div>

                @if(isset($status_analisis) && $status_analisis)
                    <p class="text-muted mb-4">
                        Analisis data mingguan anak telah selesai diproses. Anda dapat melihat hasil lengkapnya pada menu Hasil Analisis.
                    </p>
                @else
                    <p class="text-muted mb-4">
                        Gunakan AI untuk menganalisis perkembangan anak berdasarkan data mingguan.
                    </p>
                @endif

                <form action="{{ route('proses-analisis', ['id_anak' => $anak->id_anak, 'minggu' => $minggu]) }}" 
                    method="POST"
                    onsubmit="loadingAnalisis(this)">
                    @csrf
                    
                    <button type="submit" id="btnAnalisis" class="btn-analisis" @if(isset($status_analisis) && $status_analisis) disabled @endif>
                        @if(isset($status_analisis) && $status_analisis)
                            <i class="bi bi-lock-fill me-1"></i> Analisis Selesai (Disabled)
                        @else
                            <span id="iconAnalisis">🔥</span>
                            <span id="labelAnalisis">Proses Analisis AI</span>
                        @endif
                    </button>
                </form>

            </div>

            {{-- Script Loading Tetap Dipertahankan Sesuai Aslinya ── --}}
            <script>
            function loadingAnalisis(form) {
                const icon  = document.getElementById('iconAnalisis');
                const label = document.getElementById('labelAnalisis');
                const btn   = document.getElementById('btnAnalisis');

                btn.disabled          = true;
                btn.style.opacity     = '0.7';
                btn.style.cursor      = 'not-allowed';
                if(icon) icon.textContent = '⏳';
                if(label) label.textContent = 'Sedang menganalisis... mohon tunggu';

                return true;
            }
            </script>

        </div>

    </div>

</div>

</body>
</html>