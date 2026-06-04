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
            overflow: hidden;
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

        .btn-kembali{
            background: white;
            border: 1px solid #CBD5E1;
            padding: 12px 22px;
            border-radius: 14px;
            text-decoration: none;
            color: #334155;
            font-weight: 700;
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

            .content{
                padding: 18px;
            }

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

        <!-- MENU -->
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

        {{-- TOPBAR --}}
        <header class="topbar">

        <div>
            <button
                class="btn d-lg-none border-0"
                onclick="toggleSidebar()">

                <i class="bi bi-list fs-2"></i>

            </button>
        </div>

        <div class="d-flex align-items-center gap-3">

            <div class="text-end">

                <small class="text-muted fw-bold">
                    {{ auth()->user()->nama }}
                </small>

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
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <div class="text-muted mb-2">
                        Perkembangan Anak /
                        <span class="text-primary fw-bold">
                            Detail
                        </span>
                    </div>

                    <h1 class="fw-bold">
                        Detail Perkembangan Anak
                    </h1>

                    <p class="text-muted">
                        Data perkembangan mingguan anak
                    </p>

                </div>

                <a href="/perkembangan-anak"
                   class="btn-kembali">

                    <i class="bi bi-arrow-left me-2"></i>
                    Kembali

                </a>

            </div>

            {{-- PROFILE --}}
            <div class="detail-card">

                <div class="d-flex justify-content-between flex-wrap gap-4">

                    <div class="d-flex align-items-center gap-4">

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

                            <div class="d-flex gap-2 flex-wrap">

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

                    <div>

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

                <div class="table-responsive table-custom">

                    <table class="table align-middle mb-0">

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

            {{-- AI BOX --}}
            <div class="ai-box">

                <div class="mb-3">

                    <span class="badge text-bg-secondary px-4 py-2 rounded-pill">

                        Status Analisis :
                        Belum Diproses

                    </span>

                </div>

                <p class="text-muted mb-4">

                    Gunakan AI untuk menganalisis perkembangan anak
                    berdasarkan data mingguan.

                </p>

                <form 
                    action="{{ route('proses-analisis', [
                        'id_anak' => $anak->id_anak,
                        'minggu'  => $minggu
                    ]) }}" 
                    method="POST"
                    onsubmit="loadingAnalisis(this)">

                    @csrf

                    <button type="submit" id="btnAnalisis" class="btn-analisis">
                        <span id="iconAnalisis">🔥</span>
                        <span id="labelAnalisis">Proses Analisis AI</span>
                    </button>

                </form>

                <script>
                function loadingAnalisis(form) {
                    const icon  = document.getElementById('iconAnalisis');
                    const label = document.getElementById('labelAnalisis');
                    const btn   = document.getElementById('btnAnalisis');

                    // Ubah tampilan tombol
                    btn.disabled          = true;
                    btn.style.opacity     = '0.7';
                    btn.style.cursor      = 'not-allowed';
                    icon.textContent      = '⏳';
                    label.textContent     = 'Sedang menganalisis... mohon tunggu';

                    // Biarkan form submit berjalan normal
                    return true;
                }
                </script>

            </div>

        </div>

    </div>

</div>

</body>
</html>