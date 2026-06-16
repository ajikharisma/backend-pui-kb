<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis - KB Nurul'Ain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            font-family:'Plus Jakarta Sans',sans-serif;
        }

        body{
            background:#F8FAFC;
            overflow-x:hidden;
        }

        /* SIDEBAR */
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

        /* SCROLL SIDEBAR */
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

        /* TOPBAR */
        .topbar {
            background: white;
            padding: 18px 30px;
            border-bottom: 1px solid #E2E8F0;
            
            display: flex;
            /* Mengatur semua komponen di dalam topbar agar berkumpul di pojok kanan */
            justify-content: flex-end; 
            align-items: center;
            min-height: 75px;
        }

        .profile-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* CONTENT */
        .content{
            padding:32px;
        }

        .page-title{
            font-size:32px;
            font-weight:800;
            color:#0F172A;
        }

        .page-subtitle{
            color:#64748B;
            margin-top:6px;
            font-size:14px;
        }

        /* FILTER */
        .table-card{
            background:white;
            border-radius:24px;
            margin-top:28px;
            overflow:hidden;
            border:1px solid #F1F5F9;
        }

        .table thead th{
            background:#F8FAFC;
            border:none;
            color:#94A3B8;
            font-size:12px;
            letter-spacing:1px;
            font-weight:700;
            padding:22px 18px;
        }

        .table tbody td{
            padding:18px;
            vertical-align:middle;
            border-color:#F1F5F9;
        }

        .student-img{
            width:55px;
            height:55px;
            border-radius:50%;
            object-fit:cover;
        }

        .student-name{
            font-weight:700;
            color:#0F172A;
        }

        .aksi-btn{
            width:38px;
            height:38px;
            border-radius:12px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            text-decoration:none;
            margin:0 3px;
            transition:.2s;
        }

        .aksi-btn.view{
            background:#E0F2FE;
            color:#0284C7;
        }

        .aksi-btn.view:hover{
            background:#0284C7;
            color:white;
        }

        .filter-card{
            background:white;
            border-radius:24px;
            padding:24px;
            border:1px solid #F1F5F9;
            margin-bottom:28px;
        }

        .form-control,
        .form-select{
            border-radius:14px;
            border:1px solid #E2E8F0;
            padding:12px 14px;
            font-size:14px;
        }

        .btn-filter{
            background:#0284C7;
            color:white;
            border:none;
            padding:12px 22px;
            border-radius:14px;
            font-weight:700;
        }

        /* CARD LIST */
        .analysis-card{
            background:white;
            border-radius:24px;
            border:1px solid #F1F5F9;
            padding:24px;
            transition:.2s;
            height:100%;
        }

        .analysis-card:hover{
            transform:translateY(-3px);
            box-shadow:0 10px 30px rgba(0,0,0,.06);
        }

        .child-avatar{
            width:60px;
            height:60px;
            border-radius:50%;
            object-fit:cover;
        }

        .child-name{
            font-size:18px;
            font-weight:800;
            color:#0F172A;
        }

        .child-info{
            font-size:13px;
            color:#64748B;
        }

        /* STATUS */
        .status-badge{
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:7px 14px;
            border-radius:999px;
            font-size:12px;
            font-weight:700;
        }

        .badge-bsb{
            background:#D1FAE5;
            color:#065F46;
        }

        .badge-bsh{
            background:#DBEAFE;
            color:#1E40AF;
        }

        .badge-mb{
            background:#FEF3C7;
            color:#92400E;
        }

        .badge-bb{
            background:#FEE2E2;
            color:#991B1B;
        }

        /* STAT */
        .mini-stat{
            background:#F8FAFC;
            border-radius:16px;
            padding:14px;
            text-align:center;
        }

        .mini-stat-value{
            font-size:20px;
            font-weight:800;
            color:#0F172A;
        }

        .mini-stat-label{
            font-size:11px;
            color:#94A3B8;
            font-weight:700;
            margin-top:4px;
        }

        /* BUTTON */
        .btn-detail{
            width:100%;
            background:#0F172A;
            color:white;
            border:none;
            padding:12px;
            border-radius:14px;
            font-weight:700;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
        }

        .btn-detail:hover{
            background:#1E293B;
            color:white;
        }

        /* EMPTY */
        .empty-box{
            background:white;
            border-radius:24px;
            padding:60px 30px;
            text-align:center;
            border:1px dashed #CBD5E1;
        }

        .empty-icon{
            font-size:60px;
            color:#CBD5E1;
            margin-bottom:16px;
        }

        /* RESPONSIVE BREAKPOINTS (PERBAIKAN UTAMA) */
        @media(max-width:1024px){
            .sidebar {
                transform: translateX(-100%);
                transition: 0.3s;
                display: flex !important; /* Kembalikan display flex agar script toggle bekerja */
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        @media(max-width:768px){

            .profile-img {
                width: 38px;
                height: 38px;
            }

            .content {
                padding: 16px;
            }

            .page-title {
                font-size: 26px;
            }

            .topbar {
                padding: 15px;
                justify-content: space-between !important; /* Membuat tombol menu di kiri dan profil di kanan */
            }

            /* 1. Mengubah struktur tabel menjadi list card bertumpuk */
            .table-card {
                background: transparent;
                border: none;
                overflow: visible;
            }

            .table-responsive {
                border: none;
            }

            .table, .table thead, .table tbody, .table th, .table td, .table tr {
                display: block;
                width: 100%;
            }

            .table thead {
                display: none; /* Sembunyikan header tabel asli */
            }

            .table tbody tr {
                background: white;
                border: 1px solid #F1F5F9;
                border-radius: 20px;
                padding: 20px;
                margin-bottom: 16px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.02);
                display: flex;
                flex-direction: column;
                gap: 12px;
            }

            .table tbody td {
                padding: 0 !important;
                border: none !important;
                width: 100% !important;
                text-align: left !important;
            }

            /* Tata Letak Foto & Nama berdampingan */
            .table tbody tr td:nth-child(1) {
                display: inline-block;
                width: auto !important;
                float: left;
                margin-right: 15px;
            }

            .table tbody tr td:nth-child(2) {
                display: block;
                overflow: hidden;
                margin-bottom: 5px;
            }

            /* Pembatas info Minggu, Status, Confidence, dan Tombol Aksi */
            .table tbody tr td:nth-child(3) {
                border-top: 1px dashed #E2E8F0 !important;
                padding-top: 12px !important;
            }

            /* Custom label teks bantuan sebelum data muncul */
            .table tbody tr td:nth-child(3)::before { content: "Periode: "; font-weight: 700; color: #94A3B8; font-size: 13px; }
            .table tbody tr td:nth-child(4)::before { content: "Status: "; font-weight: 700; color: #94A3B8; font-size: 13px; display: inline-block; margin-right: 5px; }
            .table tbody tr td:nth-child(5)::before { content: "Confidence: "; font-weight: 700; color: #94A3B8; font-size: 13px; }

            .table tbody tr td:nth-child(4) {
                display: flex;
                align-items: center;
            }

            .table tbody tr td:nth-child(5) div {
                display: inline-block;
            }

            /* Tombol Aksi Memanjang Penuh di bawah Card */
            .table tbody tr td:nth-child(6) {
                display: block;
                margin-top: 5px;
            }

            .aksi-btn {
                width: 100%;
                height: 44px;
                margin: 0;
            }
        }
    </style>
</head>
<body>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="sidebar">

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

            <a href="/dashboard" class="nav-link-custom">
                <i class="bi bi-grid"></i>
                Beranda
            </a>

            <a href="/data-murid" class="nav-link-custom">
                <i class="bi bi-people"></i>
                Data Murid
            </a>

            <a href="{{ route('penilaian.create') }}" class="nav-link-custom">
                <i class="bi bi-journal-text"></i>
                Input Data Perkembangan
            </a>

            <a href="/perkembangan-anak" class="nav-link-custom">
                <i class="bi bi-bar-chart"></i>
                Perkembangan Anak
            </a>

            <a href="/hasil-analisis" class="nav-link-custom active">
                <i class="bi bi-file-earmark-bar-graph"></i>
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

            <div class="mt-auto pt-4">

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

        {{-- TOPBAR --}}
        <header class="topbar d-flex justify-content-between align-items-center">

            <div>
                <button class="btn d-lg-none border-0 px-0" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-2"></i>
                </button>
            </div>

            <div class="d-flex align-items-center gap-2">
                
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold">
                        <small class="text-muted">
                            {{ auth()->user()->nama }}
                        </small>
                    </div>
                </div>

                @if($guru && $guru->foto)
                    <img src="{{ asset('storage/' . $guru->foto) }}" class="profile-img">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=0ea5e9&color=fff&length=2" class="profile-img">
                @endif

            </div>

        </header>

        {{-- CONTENT --}}
        <div class="content">

            {{-- TITLE --}}
            <div class="mb-4">
                <div class="page-title">
                    Hasil Analisis
                </div>

                <div class="page-subtitle">
                    Daftar seluruh hasil analisis perkembangan anak
                </div>
            </div>

            {{-- FILTER --}}
            <div class="filter-card">

                <form method="GET" action="{{ route('hasil.analisis') }}">

                    <div class="row g-3 align-items-end">

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                Cari Nama Anak
                            </label>

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="Cari anak...">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                Minggu
                            </label>

                            <select name="minggu" class="form-select">
                                <option value="">Semua Minggu</option>

                                @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}"
                                        {{ request('minggu') == $i ? 'selected' : '' }}>
                                        Minggu {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="BSB">BSB</option>
                                <option value="BSH">BSH</option>
                                <option value="MB">MB</option>
                                <option value="BB">BB</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn-filter w-100">
                                <i class="bi bi-search"></i>
                                Filter
                            </button>
                        </div>

                    </div>

                </form>

            </div>

            {{-- LIST HASIL ANALISIS --}}
            <div class="table-card mt-4">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>
                            <tr>
                                <th>FOTO</th>
                                <th>NAMA ANAK</th>
                                <th>MINGGU</th>
                                <th>STATUS</th>
                                <th>CONFIDENCE</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($hasil as $group)

                                @php
                                    /*
                                    |--------------------------------------------------------------------------
                                    | AMBIL DATA PERTAMA & DATA GLOBAL
                                    |--------------------------------------------------------------------------
                                    */
                                    $item = $group->first();

                                    if(!$item){
                                        continue;
                                    }

                                    // Mengambil kode dominan global ('BB', 'MB', 'BSH', 'BSB') dari hasil put() controller
                                    $dominanGlobal = $group['nilai_dominan_global'] ?? $item->nilai_dominan;

                                    /*
                                    |--------------------------------------------------------------------------
                                    | FIX STATUS BADGE: Mengikuti Logika Dominan Global
                                    |--------------------------------------------------------------------------
                                    */
                                    $badgeClass = match($dominanGlobal){
                                        'BSB'   => 'bg-success-subtle text-success', // Hijau
                                        'BSH'   => 'bg-primary-subtle text-primary', // Biru
                                        'MB'    => 'bg-warning-subtle text-warning', // Oranye/Kuning (Mulai Berkembang)
                                        default => 'bg-danger-subtle text-danger'    // Merah
                                    };

                                    /*
                                    |--------------------------------------------------------------------------
                                    | RATA CONFIDENCE
                                    |--------------------------------------------------------------------------
                                    */
                                    $avgConfidence = round($group->avg('confidence'));

                                @endphp

                                <tr>

                                    {{-- FOTO --}}
                                    <td width="90">

                                        @if(!empty($item->anak->foto))

                                            <img
                                                src="{{ asset('storage/' . $item->anak->foto) }}"
                                                class="student-img">

                                        @else

                                            <img
                                                src="https://ui-avatars.com/api/?name={{ urlencode($item->anak->nama_anak ?? 'Anak') }}&background=0ea5e9&color=fff"
                                                class="student-img">

                                        @endif

                                    </td>

                                    {{-- NAMA --}}
                                    <td>

                                        <div class="student-name">
                                            {{ $item->anak->nama_anak ?? '-' }}
                                        </div>

                                        <small class="text-muted">
                                            Kelompok {{ $item->anak->kelompok ?? '-' }}
                                        </small>

                                    </td>

                                    {{-- MINGGU --}}
                                    <td>

                                        <div class="fw-bold text-primary">
                                            Minggu {{ $item->rpph->minggu ?? '-' }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $item->rpph->tema ?? '-' }}
                                        </small>

                                    </td>

                                    {{-- SESUDAH (KODE BARU YANG BENAR) --}}
                                    {{-- STATUS --}}
                                    <td>
                                        <span class="badge rounded-pill {{ $badgeClass }} px-3 py-2">
                                            {{-- Mengambil status global hasil kalkulasi kelompok data --}}
                                            {{ $group['status_global'] ?? ($item->status_global ?? '-') }}
                                        </span>
                                    </td>

                                    {{-- CONFIDENCE --}}
                                    <td>

                                        <div class="fw-bold">
                                            {{ $avgConfidence }}%
                                        </div>

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="text-center">

                                        <a href="{{ route('detail.hasil.analisis', [
                                                'id_anak' => $item->id_anak,
                                                'minggu' => $item->rpph->minggu ?? 1
                                            ]) }}"
                                            class="aksi-btn view">

                                            <i class="bi bi-eye"></i>
                                            <span class="d-inline d-md-none ms-2">Lihat Hasil Detail</span>

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="bi bi-file-earmark-x fs-1 d-block mb-3"></i>

                                            Belum ada hasil analisis

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

    </div>

</div>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('show');
    }
</script>

</body>
</html>