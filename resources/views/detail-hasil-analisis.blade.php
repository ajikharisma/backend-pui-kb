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
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        body { background: #F8FAFC; overflow-x: hidden; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 270px; height: 100vh;
            background: white; border-right: 1px solid #E2E8F0;
            position: fixed; left: 0; top: 0; z-index: 100;
            display: flex; flex-direction: column; overflow: hidden;
        }
        .main-content { margin-left: 270px; min-height: 100vh; }
        .brand-box { padding: 28px 24px; border-bottom: 1px solid #F1F5F9; }
        .brand-icon {
            width: 50px; height: 50px; border-radius: 16px;
            background: #E0F2FE; display: flex; align-items: center;
            justify-content: center; color: #0284C7; font-size: 22px;
        }
        .brand-title { font-size: 16px; font-weight: 800; color: #0F172A; line-height: 1.2; }
        .brand-sub   { font-size: 12px; color: #94A3B8; margin-top: 3px; }
        .sidebar-menu {
            padding: 22px 16px; display: flex;
            flex-direction: column; flex: 1; overflow-y: auto;
        }
        .sidebar-menu::-webkit-scrollbar { width: 6px; }
        .sidebar-menu::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 999px; }
        .nav-link-custom {
            display: flex; align-items: center; gap: 14px;
            padding: 13px 16px; border-radius: 14px; color: #64748B;
            text-decoration: none; font-weight: 600; margin-bottom: 6px;
            transition: .2s; font-size: 14px;
        }
        .nav-link-custom i { font-size: 18px; }
        .nav-link-custom:hover { background: #F1F5F9; color: #0284C7; }
        .nav-link-custom.active { background: #E0F2FE; color: #0284C7; font-weight: 700; }

        /* ── TOPBAR ── */
        .topbar {
            background: white; padding: 18px 30px;
            border-bottom: 1px solid #E2E8F0;
            display: flex; justify-content: space-between;
            align-items: center; gap: 16px; flex-wrap: wrap;
        }
        .profile-img { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; }

        /* ── CONTENT ── */
        .content { padding: 32px; }
        .breadcrumb-text { font-size: 14px; color: #94A3B8; margin-bottom: 10px; }
        .page-title { font-size: 32px; font-weight: 800; color: #0F172A; }
        .page-subtitle { color: #64748B; margin-top: 6px; font-size: 14px; }

        /* ── GLOBAL STATUS CARD ── */
        .global-card {
            border-radius: 24px;
            padding: 32px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            border: none;
        }
        .global-card::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 180px; height: 180px;
            border-radius: 50%;
            opacity: .08;
            background: white;
        }
        .global-card::after {
            content: '';
            position: absolute;
            bottom: -60px; right: 60px;
            width: 120px; height: 120px;
            border-radius: 50%;
            opacity: .05;
            background: white;
        }
        .global-bsb  { background: linear-gradient(135deg, #059669, #10B981); }
        .global-bsh  { background: linear-gradient(135deg, #0284C7, #38BDF8); }
        .global-mb   { background: linear-gradient(135deg, #D97706, #FBBF24); }
        .global-bb   { background: linear-gradient(135deg, #DC2626, #F87171); }

        .global-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,.2);
            color: white; padding: 8px 18px;
            border-radius: 999px; font-size: 13px; font-weight: 700;
            margin-bottom: 16px; backdrop-filter: blur(4px);
        }
        .global-status-text {
            font-size: 28px; font-weight: 800; color: white;
            line-height: 1.2; margin-bottom: 8px;
        }
        .global-sub { color: rgba(255,255,255,.8); font-size: 14px; }

        .global-pill {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,.15);
            color: white; padding: 6px 14px;
            border-radius: 999px; font-size: 12px; font-weight: 700;
            margin: 4px 4px 0 0;
        }

        /* ── ASPEK GRID ── */
        .aspek-card {
            background: white; border-radius: 20px;
            border: 1px solid #F1F5F9;
            padding: 24px; height: 100%;
            transition: box-shadow .2s;
        }
        .aspek-card:hover { box-shadow: 0 8px 30px rgba(0,0,0,.06); }

        .aspek-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 18px; }
        .aspek-icon {
            width: 44px; height: 44px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .aspek-name { font-size: 14px; font-weight: 700; color: #0F172A; margin-bottom: 4px; }

        /* Status badge warna */
        .badge-bsb  { background: #D1FAE5; color: #065F46; }
        .badge-bsh  { background: #DBEAFE; color: #1E40AF; }
        .badge-mb   { background: #FEF3C7; color: #92400E; }
        .badge-bb   { background: #FEE2E2; color: #991B1B; }
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; border-radius: 999px;
            font-size: 11px; font-weight: 700; letter-spacing: .3px;
        }

        /* Distribusi bar */
        .distribusi-label {
            font-size: 11px; font-weight: 700; color: #94A3B8;
            letter-spacing: .5px; margin-bottom: 8px;
        }
        .dist-row { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
        .dist-key {
            width: 36px; font-size: 11px; font-weight: 800;
            text-align: center; padding: 3px 6px;
            border-radius: 6px; flex-shrink: 0;
        }
        .dist-key.bb  { background: #FEE2E2; color: #DC2626; }
        .dist-key.mb  { background: #FEF3C7; color: #D97706; }
        .dist-key.bsh { background: #DBEAFE; color: #2563EB; }
        .dist-key.bsb { background: #D1FAE5; color: #059669; }
        .dist-bar-wrap {
            flex: 1; height: 8px; background: #F1F5F9;
            border-radius: 999px; overflow: hidden;
        }
        .dist-bar { height: 100%; border-radius: 999px; transition: width .6s ease; }
        .bar-bb  { background: #EF4444; }
        .bar-mb  { background: #F59E0B; }
        .bar-bsh { background: #3B82F6; }
        .bar-bsb { background: #10B981; }
        .dist-count { font-size: 12px; font-weight: 700; color: #64748B; width: 20px; text-align: right; }

        /* Confidence */
        .confidence-row {
            display: flex; align-items: center; justify-content: space-between;
            margin-top: 16px; padding-top: 16px;
            border-top: 1px solid #F1F5F9;
        }
        .confidence-label { font-size: 11px; font-weight: 700; color: #94A3B8; letter-spacing: .5px; }
        .confidence-val   { font-size: 13px; font-weight: 800; color: #0F172A; }

        /* Warning tidak reliable */
        .warning-chip {
            display: inline-flex; align-items: center; gap: 5px;
            background: #FFF7ED; color: #C2410C;
            padding: 4px 10px; border-radius: 999px;
            font-size: 11px; font-weight: 700; margin-top: 8px;
        }

        /* Indikator lemah */
        .ind-lemah-wrap { margin-top: 16px; }
        .ind-lemah-title { font-size: 11px; font-weight: 700; color: #94A3B8; letter-spacing: .5px; margin-bottom: 8px; }
        .ind-chip {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 4px 10px; border-radius: 8px;
            font-size: 11px; font-weight: 600; margin: 3px 3px 0 0;
        }
        .ind-chip.bb  { background: #FEE2E2; color: #DC2626; }
        .ind-chip.mb  { background: #FEF3C7; color: #D97706; }

        /* Rekomendasi */
        .rekomendasi-card {
            background: #F8FAFC; border-radius: 14px;
            padding: 16px; margin-top: 16px;
            border-left: 4px solid #0284C7;
        }
        .rekomendasi-title { font-size: 11px; font-weight: 700; color: #0284C7; letter-spacing: .5px; margin-bottom: 6px; }
        .rekomendasi-text  { font-size: 13px; color: #475569; line-height: 1.6; }

        /* Aspek icon warna */
        .icon-agama    { background: #FEF3C7; color: #D97706; }
        .icon-jati     { background: #FCE7F3; color: #DB2777; }
        .icon-literasi { background: #DBEAFE; color: #2563EB; }
        .icon-sains    { background: #D1FAE5; color: #059669; }
        .icon-sosem    { background: #EDE9FE; color: #7C3AED; }
        .icon-seni     { background: #FFE4E6; color: #E11D48; }
        .icon-default  { background: #F1F5F9; color: #64748B; }

        /* Section title */
        .section-title {
            font-size: 18px; font-weight: 800; color: #0F172A;
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
        }
        .section-title::after {
            content: ''; flex: 1; height: 1px; background: #F1F5F9;
        }

        /* Stat mini */
        .stat-mini {
            background: white; border-radius: 16px;
            padding: 18px 20px; border: 1px solid #F1F5F9;
            display: flex; align-items: center; gap: 14px;
        }
        .stat-mini-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 20px;
        }
        .stat-mini-val   { font-size: 20px; font-weight: 800; color: #0F172A; }
        .stat-mini-label { font-size: 11px; font-weight: 700; color: #94A3B8; letter-spacing: .5px; }

        /* Tombol aksi */
        .btn-back {
            display: inline-flex; align-items: center; gap: 8px;
            background: white; border: 1px solid #E2E8F0;
            color: #475569; padding: 10px 20px;
            border-radius: 12px; font-weight: 600; font-size: 14px;
            text-decoration: none; transition: .2s;
        }
        .btn-back:hover { background: #F8FAFC; color: #0F172A; }

        .btn-cetak {
            display: inline-flex; align-items: center; gap: 8px;
            background: #0F766E; border: none;
            color: white; padding: 10px 20px;
            border-radius: 12px; font-weight: 700; font-size: 14px;
            text-decoration: none; transition: .2s; cursor: pointer;
        }
        .btn-cetak:hover { background: #115E59; color: white; }

        @media print {
            .sidebar,
            .topbar,
            .btn-back,
            .btn-cetak {
                display: none !important;
            }

            .main-content {
                margin-left: 0 !important;
            }

            body {
                background: white;
            }

            .content {
                padding: 0;
            }

            .aspek-card,
            .global-card,
            .stat-mini {
                break-inside: avoid;
            }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); transition: .3s; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; width: 100%; }
            .content { padding: 24px; }
        }
        @media (max-width: 768px) {
            .profile-img { width: 38px; height: 38px; }
            .content { padding: 18px; }
            .global-status-text { font-size: 22px; }
            .page-title { font-size: 26px; }
        }
    </style>
</head>
<body>

<div class="d-flex">

    {{-- ── SIDEBAR ── --}}
    <div class="sidebar" id="sidebar">
        <div class="brand-box d-flex align-items-center gap-3">
            <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div>
                <div class="brand-title">Dashboard Guru</div>
                <div class="brand-sub">KB NURUL'AIN</div>
            </div>
        </div>
        <div class="sidebar-menu">
            <a href="/dashboard" class="nav-link-custom"><i class="bi bi-grid"></i> Beranda</a>
            <a href="/data-murid" class="nav-link-custom"><i class="bi bi-people"></i> Data Murid</a>
            <a href="{{ route('penilaian.create') }}" class="nav-link-custom"><i class="bi bi-journal-text"></i> Input Data Perkembangan</a>
            <a href="/perkembangan-anak" class="nav-link-custom"><i class="bi bi-bar-chart"></i> Perkembangan Anak</a>
            <a href="/hasil-analisis" class="nav-link-custom active"><i class="bi bi-file-earmark-bar-graph"></i> Hasil Analisis</a>
            <a href="/catatan-anak-rumah" class="nav-link-custom"><i class="bi bi-book"></i> Catatan Anak Dirumah</a>
            <a href="/profil-guru" class="nav-link-custom"><i class="bi bi-person-badge"></i> Profil Guru</a>
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

    {{-- ── MAIN ── --}}
    <div class="main-content flex-grow-1">

        {{-- TOPBAR --}}
        <header class="topbar d-flex justify-content-between align-items-center">
            
            <div>
                <button class="btn d-lg-none border-0 px-0" onclick="toggleSidebar()">
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
                    <img src="{{ asset('storage/' . $guru->foto) }}" class="profile-img">
                @else
                    <img src="https://ui-avatars.com/api/?name=Guru&background=0ea5e9&color=fff" class="profile-img">
                @endif
            </div>

        </header>

        {{-- CONTENT --}}
        <div class="content">

            {{-- BREADCRUMB & JUDUL --}}
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                <div>
                    <div class="page-title">Laporan Perkembangan</div>
                    <div class="page-subtitle">
                        {{ $anak->nama_anak }} &bull; Minggu ke-{{ $minggu }} &bull; {{ $tema }}
                    </div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="/hasil-analisis" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button class="btn-cetak" onclick="window.print()">
                        <i class="bi bi-printer"></i> Cetak Laporan
                    </button>
                </div>
            </div>

            {{-- ── STAT MINI: RINGKASAN ANGKA ── --}}
            @php
                $totalAspek    = count($hasilAnalisis);
                $aspekBSB      = collect($hasilAnalisis)->where('dominan', 'BSB')->count();
                $aspekBSH      = collect($hasilAnalisis)->where('dominan', 'BSH')->count();
                $aspekMB       = collect($hasilAnalisis)->where('dominan', 'MB')->count();
                $aspekBB       = collect($hasilAnalisis)->where('dominan', 'BB')->count();
                $aspekReliable = collect($hasilAnalisis)->where('reliable', true)->count();
            @endphp

            <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                    <div class="stat-mini">
                        <div class="stat-mini-icon" style="background:#E0F2FE;color:#0284C7;">
                            <i class="bi bi-layers"></i>
                        </div>
                        <div>
                            <div class="stat-mini-val">{{ $totalAspek }}</div>
                            <div class="stat-mini-label">TOTAL ASPEK</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-mini">
                        <div class="stat-mini-icon" style="background:#D1FAE5;color:#059669;">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div>
                            <div class="stat-mini-val">{{ $aspekBSB + $aspekBSH }}</div>
                            <div class="stat-mini-label">ASPEK BAIK</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-mini">
                        <div class="stat-mini-icon" style="background:#FEF3C7;color:#D97706;">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <div>
                            <div class="stat-mini-val">{{ $aspekMB + $aspekBB }}</div>
                            <div class="stat-mini-label">PERLU STIMULASI</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-mini">
                        <div class="stat-mini-icon" style="background:#EDE9FE;color:#7C3AED;">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <div class="stat-mini-val">{{ $aspekReliable }}/{{ $totalAspek }}</div>
                            <div class="stat-mini-label">DATA VALID</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── GLOBAL STATUS CARD ── --}}
            @php
                $globalClass = match($statusGlobal['dominan']) {
                    'BSB' => 'global-bsb',
                    'BSH' => 'global-bsh',
                    'MB'  => 'global-mb',
                    default => 'global-bb',
                };
                $globalIcon = match($statusGlobal['dominan']) {
                    'BSB' => 'bi-trophy-fill',
                    'BSH' => 'bi-check-circle-fill',
                    'MB'  => 'bi-arrow-up-circle-fill',
                    default => 'bi-exclamation-triangle-fill',
                };
            @endphp

            <div class="global-card {{ $globalClass }} mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="global-badge">
                            <i class="bi {{ $globalIcon }}"></i>
                            KESIMPULAN PERKEMBANGAN MINGGU INI
                        </div>
                        <div class="global-status-text">
                            {{ $statusGlobal['status'] }}
                        </div>
                        <div class="global-sub mb-3">
                            {{ $anak->nama_anak }} &bull; Tema: {{ $tema }} &bull; Minggu ke-{{ $minggu }}
                        </div>

                        {{-- Distribusi global --}}
                        @if($statusGlobal['distribusi_aspek']['BSB'] > 0)
                            <span class="global-pill"><i class="bi bi-star-fill"></i> BSB: {{ $statusGlobal['distribusi_aspek']['BSB'] }} aspek</span>
                        @endif
                        @if($statusGlobal['distribusi_aspek']['BSH'] > 0)
                            <span class="global-pill"><i class="bi bi-check-circle-fill"></i> BSH: {{ $statusGlobal['distribusi_aspek']['BSH'] }} aspek</span>
                        @endif
                        @if($statusGlobal['distribusi_aspek']['MB'] > 0)
                            <span class="global-pill"><i class="bi bi-arrow-up-circle"></i> MB: {{ $statusGlobal['distribusi_aspek']['MB'] }} aspek</span>
                        @endif
                        @if($statusGlobal['distribusi_aspek']['BB'] > 0)
                            <span class="global-pill"><i class="bi bi-exclamation-triangle"></i> BB: {{ $statusGlobal['distribusi_aspek']['BB'] }} aspek</span>
                        @endif
                    </div>
                    <div class="col-md-4 d-none d-md-flex justify-content-end">
                        <div style="font-size:100px;opacity:.15;">
                            <i class="bi {{ $globalIcon }}"></i>
                        </div>
                    </div>
                </div>

                <!-- tanggal cetak -->
                <div class="text-end mb-4">
                    <small class="text-muted">
                        Dicetak pada: {{ $tanggalAnalisis 
                            ? \Carbon\Carbon::parse($tanggalAnalisis)->translatedFormat('d F Y') 
                            : now()->translatedFormat('d F Y') }}
                    </small>
                </div>

                {{-- Warning global --}}
                @if(!$statusGlobal['global_reliable'])
                    <div class="mt-3 p-3 rounded-3" style="background:rgba(255,255,255,.15);">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <small style="color:rgba(255,255,255,.9);font-weight:600;">
                            Data masih terbatas ({{ $statusGlobal['reliable_aspek'] }} dari {{ $statusGlobal['total_aspek'] }} aspek memiliki data valid).
                            Tambahkan lebih banyak penilaian untuk hasil yang lebih akurat.
                        </small>
                    </div>
                @endif
                @if($statusGlobal['ada_bb'])
                    <div class="mt-2 p-3 rounded-3" style="background:rgba(255,255,255,.15);">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <small style="color:rgba(255,255,255,.9);font-weight:600;">
                            Terdapat aspek yang Belum Berkembang. Perlu perhatian dan stimulasi khusus dari orang tua.
                        </small>
                    </div>
                @endif
            </div>

            {{-- REKOMENDASI AI — VERSI STABIL & AMAN --}}
            @if(isset($rekomendasiAI) && $rekomendasiAI)
                <div style="background:white;border-radius:20px;
                            border:1px solid #F1F5F9;padding:28px;
                            margin-bottom:28px;border-left:4px solid #7C3AED;">

                    {{-- Header --}}
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
                        <div style="width:36px;height:36px;background:#EDE9FE;
                                    border-radius:10px;display:flex;
                                    align-items:center;justify-content:center;
                                    color:#7C3AED;font-size:18px;">
                            ✨
                        </div>
                        <div style="flex:1;">
                            <div style="font-size:13px;font-weight:800;
                                        color:#7C3AED;letter-spacing:.5px;">
                                REKOMENDASI AI — GEMINI
                            </div>
                            <div style="font-size:11px;color:#94A3B8;">
                                Dihasilkan berdasarkan analisis perkembangan minggu ini
                            </div>
                        </div>
                        <span style="background:#EDE9FE;color:#7C3AED;
                                    padding:4px 12px;border-radius:999px;
                                    font-size:11px;font-weight:700;white-space:nowrap;">
                            ✅ AI Generated
                        </span>
                    </div>

                    {{-- Konten rekomendasi --}}
                    <div id="rekomendasiContainer" style="font-size:14px;color:#334155;line-height:1.8;"></div>

                    {{-- RAW TEXT (hidden) --}}
                    <textarea id="rawRekomendasi" style="display:none;">{{ $rekomendasiAI }}</textarea>   

                    {{-- Timestamp --}}
                    @php
                        $aiTime = \App\Models\HasilAnalisis::where('id_anak', $id_anak)
                            ->where('ai_generated', true)
                            ->value('ai_generated_at');
                    @endphp
                    @if($aiTime)
                        <div style="margin-top:16px;padding-top:16px;
                                    border-top:1px solid #F1F5F9;
                                    font-size:11px;color:#94A3B8;">
                            <i class="bi bi-clock me-1"></i>
                            Digenerate pada: {{ \Carbon\Carbon::parse($aiTime)->translatedFormat('d M Y, H:i') }} WIB
                        </div>
                    @endif

                </div>

                <script>
                (function () {
                    const rawEl = document.getElementById('rawRekomendasi');
                    if (!rawEl) return;
                    
                    const rawTeks = rawEl.value;
                    function parseMarkdown(text) {
                        if (!text) return '';
                        return text
                            .replace(/^## (.+)$/gm, '<div style="font-size:15px;font-weight:800;color:#0F172A;margin:20px 0 8px;padding-bottom:6px;border-bottom:2px solid #EDE9FE;">$1</div>')
                            .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')
                            .replace(/^[-*] (.+)$/gm, '<div style="display:flex;gap:8px;margin-bottom:8px;"><span style="color:#7C3AED;font-weight:800;flex-shrink:0;">•</span><span>$1</span></div>')
                            .replace(/\n\n/g, '<div style="height:10px;"></div>')
                            .replace(/\n/g, '<br>');
                    }

                    const container = document.getElementById('rekomendasiContainer');
                    if (container && rawTeks) {
                        container.innerHTML = parseMarkdown(rawTeks);
                    }
                })();
                </script>
            @endif

            {{-- ── DETAIL PER ASPEK ── --}}
            <div class="section-title">
                <i class="bi bi-grid-3x3-gap-fill" style="color:#0284C7;"></i>
                Rincian Per Aspek Perkembangan
            </div>

            @if(count($hasilAnalisis) > 0)
            <div class="row g-4 mb-4">
                @foreach($hasilAnalisis as $hasil)
                @php
                    $badgeClass = match($hasil['dominan']) {
                        'BSB' => 'badge-bsb',
                        'BSH' => 'badge-bsh',
                        'MB'  => 'badge-mb',
                        default => 'badge-bb',
                    };
                    $dotColor = match($hasil['dominan']) {
                        'BSB' => '#10B981',
                        'BSH' => '#3B82F6',
                        'MB'  => '#F59E0B',
                        default => '#EF4444',
                    };
                    // Icon per aspek (sesuaikan dengan nama aspek di DB)
                    $aspekLower = strtolower($hasil['aspek']);
                    $iconClass = 'icon-default';
                    $iconName  = 'bi-patch-check';
                    if (str_contains($aspekLower, 'agama') || str_contains($aspekLower, 'moral')) {
                        $iconClass = 'icon-agama'; $iconName = 'bi-heart-fill';
                    } elseif (str_contains($aspekLower, 'jati') || str_contains($aspekLower, 'fisik') || str_contains($aspekLower, 'motorik')) {
                        $iconClass = 'icon-jati'; $iconName = 'bi-person-arms-up';
                    } elseif (str_contains($aspekLower, 'bahasa') || str_contains($aspekLower, 'literasi')) {
                        $iconClass = 'icon-literasi'; $iconName = 'bi-book-fill';
                    } elseif (str_contains($aspekLower, 'kognitif') || str_contains($aspekLower, 'sains') || str_contains($aspekLower, 'matematika')) {
                        $iconClass = 'icon-sains'; $iconName = 'bi-lightbulb-fill';
                    } elseif (str_contains($aspekLower, 'sosial') || str_contains($aspekLower, 'emosional') || str_contains($aspekLower, 'sosem')) {
                        $iconClass = 'icon-sosem'; $iconName = 'bi-people-fill';
                    } elseif (str_contains($aspekLower, 'seni') || str_contains($aspekLower, 'kreativ')) {
                        $iconClass = 'icon-seni'; $iconName = 'bi-palette-fill';
                    }
                @endphp

                <div class="col-md-6 col-xl-4">
                    <div class="aspek-card">

                        {{-- Header aspek --}}
                        <div class="aspek-header">
                            <div class="d-flex align-items-center gap-3 flex-grow-1">
                                <div class="aspek-icon {{ $iconClass }}">
                                    <i class="bi {{ $iconName }}"></i>
                                </div>
                                <div>
                                    <div class="aspek-name">{{ $hasil['aspek'] }}</div>
                                    <span class="status-badge {{ $badgeClass }}">
                                        <span style="--badge-dot: {{ $dotColor }}; background-color: var(--badge-dot);"></span>
                                        {{ $hasil['status'] }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Warning tidak reliable --}}
                        @if(!$hasil['reliable'])
                            <div class="warning-chip mb-3">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                Data terbatas ({{ $hasil['total'] }} penilaian)
                            </div>
                        @endif

                        {{-- Distribusi nilai --}}
                        <div class="distribusi-label">DISTRIBUSI NILAI</div>

                        @foreach(['BB','MB','BSH','BSB'] as $kode)
                        @php
                            $jml   = $hasil['distribusi'][$kode];
                            $pct   = $hasil['total'] > 0 ? ($jml / $hasil['total']) * 100 : 0;
                            $kLow  = strtolower($kode);
                        @endphp
                        <div class="dist-row">
                            <div class="dist-key {{ $kLow }}">{{ $kode }}</div>
                            <div class="dist-bar-wrap">
                                <div class="dist-bar bar-{{ $kLow }}" style="--bar-width: {{ $pct }}%; width: var(--bar-width);"></div>
                            </div>
                            <div class="dist-count">{{ $jml }}</div>
                        </div>
                        @endforeach

                        {{-- Confidence --}}
                        <div class="confidence-row">
                            <span class="confidence-label">CONFIDENCE</span>
                            <span class="confidence-val">{{ $hasil['confidence'] }}%</span>
                        </div>

                        {{-- Indikator lemah --}}
                        @if(isset($hasil['indikator_lemah']) && count($hasil['indikator_lemah']) > 0)
                            <div class="ind-lemah-wrap">
                                <div class="ind-lemah-title">INDIKATOR PERLU PERHATIAN</div>
                                @foreach($hasil['indikator_lemah'] as $ind)
                                    <span class="ind-chip {{ strtolower($ind['nilai']) }}">
                                        <i class="bi bi-dot"></i>
                                        {{ Str::limit($ind['nama'], 40) }} — {{ $ind['nilai'] }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Rekomendasi Aspek (Diperbaiki agar tidak memicu Undefined Key) --}}
                        <div class="rekomendasi-card">
                            <div class="rekomendasi-title">
                                <i class="bi bi-lightbulb-fill me-1"></i>
                                REKOMENDASI UNTUK ORANG TUA
                            </div>
                            <div class="rekomendasi-text">
                                @if(count($hasil['indikator_lemah']) > 0)
                                    Perlu stimulasi tambahan pada indikator yang dinilai kurang. Panduan aktivitas harian dapat dibaca pada kolom Rekomendasi AI di atas.
                                @else
                                    Capaian perkembangan anak sangat baik. Pertahankan stimulasi positif secara konsisten di rumah.
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
            @endif

            {{-- ── INFO ANAK ── --}}
            <div class="section-title">
                <i class="bi bi-person-circle" style="color:#0284C7;"></i>
                Informasi Anak
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div style="background:white;border-radius:20px;padding:24px;border:1px solid #F1F5F9;">
                        <div class="d-flex align-items-center gap-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($anak->nama_anak) }}&background=0ea5e9&color=fff&size=80"
                                 style="width:72px;height:72px;border-radius:50%;">
                            <div>
                                <div style="font-size:18px;font-weight:800;color:#0F172A;">{{ $anak->nama_anak }}</div>
                                <div style="font-size:13px;color:#64748B;margin-top:4px;">
                                    Kelompok {{ $anak->kelompok }}
                                    &bull; @if($anak->tanggal_lahir)
                                                {{ \Carbon\Carbon::parse($anak->tanggal_lahir)->age }} Tahun
                                            @else
                                                -
                                            @endif
                                </div>
                                <div style="font-size:12px;color:#94A3B8;margin-top:4px;">
                                    Analisis: Minggu ke-{{ $minggu }} &bull; Tema: {{ $tema }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="background:white;border-radius:20px;padding:24px;border:1px solid #F1F5F9;height:100%;">
                        <div style="font-size:12px;font-weight:700;color:#94A3B8;letter-spacing:.5px;margin-bottom:12px;">CATATAN ANALISIS</div>
                        <div style="font-size:13px;color:#475569;line-height:1.7;">
                            Laporan ini dihasilkan oleh sistem Rule-Based System (RBS) berdasarkan
                            penilaian guru pada minggu ke-{{ $minggu }}.
                            @if(!$statusGlobal['global_reliable'])
                                <span style="color:#D97706;font-weight:600;">
                                    Sebagian data masih terbatas, disarankan untuk menambah penilaian agar hasil lebih akurat.
                                </span>
                            @else
                                Hasil analisis sudah didasarkan pada data yang cukup.
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- end .content --}}
    </div>{{-- end .main-content --}}
</div>

<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('show');
    }

    // Animasi bar distribusi saat halaman load
    document.addEventListener('DOMContentLoaded', function () {
        const bars = document.querySelectorAll('.dist-bar');
        bars.forEach(bar => {
            const targetWidth = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => { bar.style.width = targetWidth; }, 200);
        });
    });
</script>

</body>
</html>