<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Catatan Anak di Rumah - KB Nurul'Ain</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body{
            background: #F8FAFC;
            overflow-x: hidden;
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

        /* TOPBAR WITH CORRECTION */
        .topbar {
            background: white;
            padding: 18px 30px;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        .content{
            padding: 32px;
        }

        /* DETAIL BLOCKS */
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

        .badge-wali{
            background: #EDE9FE;
            color: #6D28D9;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }

        .form-control-custom {
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            padding: 14px 20px;
            border-radius: 16px;
            min-width: 180px;
        }

        .catatan-box {
            background: #F8FAFC;
            border-radius: 22px;
            /* Atas kanan bawah kiri (Jarak atas diperkecil menjadi 16px) */
            padding: 1px 28px 24px 28px; 
            border: 1px solid #E2E8F0;
            line-height: 1.8;
            color: #334155;
            font-size: 15px;
            white-space: pre-line;
        }

        .btn-kembali{
            background: white;
            border: 1px solid #CBD5E1;
            padding: 12px 22px;
            border-radius: 14px;
            text-decoration: none;
            color: #334155;
            font-weight: 700;
            transition: .2s;
            display: inline-flex;
            align-items: center;
        }

        .btn-kembali:hover {
            background: #F8FAFC;
            color: #0284C7;
            border-color: #0284C7;
        }

        /* RESPONSIVE DESIGN */
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

        @media(max-width:768px) {
            .profile-img {
                width: 38px;
                height: 38px;
            }

            .content{
                padding: 18px;
            }
            .detail-card {
                padding: 20px;
                border-radius: 22px;
            }
            .student-photo {
                width: 90px;
                height: 90px;
                border-radius: 20px;
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
                <i class="bi bi-grid"></i> Beranda
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
            <a href="/catatan-anak-rumah" class="nav-link-custom active">
                <i class="bi bi-book"></i> Catatan Anak Dirumah
            </a>
            <a href="/profil-guru" class="nav-link-custom">
                <i class="bi bi-person-badge"></i> Profil Guru
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

    {{-- MAIN CONTENT --}}
    <div class="main-content flex-grow-1">

        {{-- TOPBAR --}}
        <header class="topbar">
            <div>
                <button class="btn d-lg-none border-0 px-0" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-2"></i>
                </button>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <small class="text-muted fw-bold">
                        {{ auth()->user()->nama }}
                    </small>
                </div>

                @if(isset($guru) && $guru->foto)
                    <img src="{{ asset('storage/' . $guru->foto) }}" class="profile-img">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=0ea5e9&color=fff" class="profile-img">
                @endif
            </div>
        </header>

        {{-- CONTENT AREA --}}
        <div class="content">

            {{-- BREADCRUMB & ACTION HEADER --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <div class="text-muted mb-2">
                        Catatan Anak di Rumah / <span class="text-primary fw-bold">Detail Catatan</span>
                    </div>
                    <h1 class="fw-bold m-0">Detail Catatan Anak</h1>
                    <p class="text-muted m-0 mt-1">Informasi lengkap mengenai laporan aktivitas harian anak dari orang tua.</p>
                </div>

                <a href="/catatan-anak-rumah" class="btn-kembali">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
            </div>

            {{-- PROFILE CARD (Foto, Nama Anak, Nama Orang Tua) --}}
            <div class="detail-card">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
                    <div class="d-flex align-items-center gap-4 flex-wrap flex-sm-nowrap">
                        @if($catatan->anak->foto)
                            <img src="{{ asset('storage/' . $catatan->anak->foto) }}" class="student-photo">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($catatan->anak->nama_anak) }}&background=0ea5e9&color=fff" class="student-photo">
                        @endif

                        <div>
                            <h2 class="fw-bold mb-3 text-dark">
                                {{ $catatan->anak->nama_anak }}
                            </h2>
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge-kelompok">
                                    Kelompok {{ $catatan->anak->kelompok }}
                                </span>
                                <span class="badge-wali">
                                    <i class="bi bi-person-heart me-1"></i> Wali: {{ $catatan->orangTua->user->nama ?? 'Orang Tua' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- KOTAK INFORMASI TANGGAL --}}
                    <div>
                        <label class="fw-bold text-muted mb-2">
                            Tanggal Dikirim
                        </label>
                        <div class="form-control-custom">
                            <div class="fw-bold text-primary">
                                <i class="bi bi-calendar3 me-2"></i>
                                {{ \Carbon\Carbon::parse($catatan->tanggal)->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TEXT CONTENT CARD (Judul & Isi Lengkap) --}}
            <div class="detail-card">
                <div class="mb-4 border-bottom pb-3">
                    <small class="text-muted d-block fw-bold uppercase mb-1" style="font-size: 11px; letter-spacing: 0.5px;">JUDUL LAPORAN</small>
                    <h4 class="fw-800 text-dark m-0">
                        {{ $catatan->judul_catatan }}
                    </h4>
                </div>

                <div>
                    <small class="text-muted d-block fw-bold uppercase mb-2" style="font-size: 11px; letter-spacing: 0.5px;">ISI CATATAN LENGKAP DARI RUMAH</small>
                    <div class="catatan-box">
                        {{ $catatan->isi_catatan }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // MOBILE SIDEBAR TOGGLE
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('show');
    }
</script>

</body>
</html>