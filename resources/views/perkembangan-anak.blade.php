<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perkembangan Anak - KB Nurul'Ain</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Font -->
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

        /* SIDEBAR */
        .sidebar {
            width: 270px;
            height: 100vh; /* penting */
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

            overflow-y: auto; /* ini bikin scroll */
        }

        /* SCROLLBAR */
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

        .topbar{
            background: white;
            padding: 18px 30px;
            border-bottom: 1px solid #E2E8F0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-wrapper{
            position: relative;
            max-width: 320px;
            flex:1;
        }

        .search-wrapper i{
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 15px;
        }

        .search-input{
            width: 100%;
            height: 48px;
            border: 1px solid #CBD5E1;
            border-radius: 999px;
            padding: 12px 18px 12px 46px;
            outline: none;
            font-size: 14px;
            transition: .2s;
            background: white;
        }

        .search-input:focus{
            border-color: #0284C7;
            box-shadow: 0 0 0 4px rgba(2,132,199,.1);
        }

        .content{
            padding: 32px;
        }

        .breadcrumb-text{
            font-size: 14px;
            color: #94A3B8;
            margin-bottom: 10px;
        }

        .page-title{
            font-size: 38px;
            font-weight: 800;
            color: #0F172A;
        }

        .page-subtitle{
            color: #64748B;
            margin-top: 6px;
        }

        .table-card{
            background: white;
            border-radius: 24px;
            margin-top: 28px;
            border: 1px solid #F1F5F9;
            overflow: hidden;
        }

        /* SCROLL TABEL */
        .table-wrapper{
            max-height: 500px;
            overflow-y: auto;
            overflow-x: auto;
        }

        /* Scrollbar custom */
        .table-wrapper::-webkit-scrollbar{
            width: 8px;
            height: 8px;
        }

        .table-wrapper::-webkit-scrollbar-thumb{
            background: #CBD5E1;
            border-radius: 999px;
        }

        .table-wrapper::-webkit-scrollbar-thumb:hover{
            background: #94A3B8;
        }

        /* Header tetap saat scroll */
        .table thead th{
            position: sticky;
            top: 0;
            z-index: 10;
            background: #F8FAFC;
        }

        .table thead th{
            background: #F8FAFC;
            border: none;
            color: #94A3B8;
            font-size: 12px;
            letter-spacing: 1px;
            font-weight: 700;
            padding: 22px 18px;
        }

        .table tbody td{
            padding: 18px;
            vertical-align: middle;
            border-color: #F1F5F9;
        }

        .student-img{
            width: 55px;
            height: 55px;
            border-radius: 50%;
            object-fit: cover;
        }

        .student-name{
            font-weight: 700;
            color: #0F172A;
        }

        .aspek-title{
            font-weight: 700;
            color: #0F172A;
            font-size: 14px;
        }

        .aspek-sub{
            font-size: 12px;
            color: #94A3B8;
            margin-top: 3px;
        }

        .badge-belum{
            background: #FEF3C7;
            color: #D97706;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .aksi-btn{
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            margin: 0 3px;
            transition: .2s;
        }

        .aksi-btn.view{
            background: #E0F2FE;
            color: #0284C7;
        }

        .aksi-btn.view:hover{
            background: #0284C7;
            color: white;
        }

        .stat-card{
            background: white;
            border-radius: 24px;
            padding: 24px;
            border: 1px solid #F1F5F9;
        }

        .stat-icon{
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .bg-blue-soft{
            background: #E0F2FE;
            color: #0284C7;
        }

        .bg-yellow-soft{
            background: #FEF3C7;
            color: #D97706;
        }

        .bg-green-soft{
            background: #DCFCE7;
            color: #15803D;
        }

        .stat-label{
            font-size: 12px;
            color: #94A3B8;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .stat-value{
            font-size: 24px;
            font-weight: 800;
            color: #0F172A;
            margin-top: 4px;
        }

        .profile-img{
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        .summary-box{
            background: linear-gradient(135deg,#E0F2FE,#F0F9FF);
            border-radius: 30px;
            padding: 40px;
            margin-top: 30px;
            position: relative;
            overflow: hidden;
        }

        .summary-title{
            font-size: 28px;
            font-weight: 800;
            color: #0284C7;
        }

        .summary-sub{
            color: #64748B;
            margin-top: 10px;
            max-width: 600px;
        }

        .mini-box{
            background: white;
            padding: 20px;
            border-radius: 20px;
            min-width: 120px;
            text-align: center;
        }

        .mini-box h3{
            font-size: 28px;
            font-weight: 800;
            color: #0284C7;
        }

        .mini-box p{
            font-size: 11px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: 1px;
            margin-top: 5px;
        }

        @media(max-width:768px){

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

            .content{
                padding: 20px;
            }

            .page-title{
                font-size: 28px;
            }

            .table{
                min-width: 900px;
            }

        }

    </style>
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
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

    <!-- MAIN -->
    <div class="main-content flex-grow-1">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="d-flex align-items-center gap-3">

                <button
                    class="btn d-lg-none border-0 px-0"
                    onclick="toggleSidebar()">

                    <i class="bi bi-list fs-2"></i>

                </button>

                <div class="search-wrapper">

                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="searchInput"
                        class="search-input"
                        placeholder="Cari nama anak...">

                </div>

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

        <!-- CONTENT -->
        <div class="content">

            <!-- HEADER -->
            <div>

                <div class="breadcrumb-text">
                    Beranda /
                    <span class="text-primary fw-bold">
                        Perkembangan Anak
                    </span>
                </div>

                <div class="page-title">
                    Perkembangan Anak
                </div>

                <div class="page-subtitle">
                    Data penilaian perkembangan anak yang sudah diinput guru dan menunggu proses analisis AI.
                </div>

            </div>

            <!-- LIST PERKEMBANGAN -->
            <div class="table-card mt-4">

                <div class="table-wrapper">

                    <table class="table align-middle mb-0">

                        <thead>
                            <tr>
                                <th>FOTO</th>
                                <th>NAMA ANAK</th>
                                <th>MINGGU PENILAIAN</th>
                                <th>STATUS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody id="tableBody">

                            @foreach($penilaian as $item)

                            <tr>

                                <!-- FOTO -->
                                <td width="90">

                                    @if($item->anak->foto)

                                        <img
                                            src="{{ asset('storage/' . $item->anak->foto) }}"
                                            class="student-img">

                                    @else

                                        <img
                                            src="https://ui-avatars.com/api/?name={{ urlencode($item->anak->nama_anak) }}&background=0ea5e9&color=fff"
                                            class="student-img">

                                    @endif

                                </td>

                                <!-- NAMA -->
                                <td>

                                    <div class="student-name">
                                        {{ $item->anak->nama_anak }}
                                    </div>

                                    <small class="text-muted">
                                        Kelompok {{ $item->anak->kelompok }}
                                    </small>

                                </td>

                                <!-- MINGGU -->
                                <td>

                                    <div class="fw-bold text-primary">
                                        Minggu {{ $item->rpph->minggu }}
                                    </div>

                                    <small class="text-muted">
                                        Tema: {{ $item->rpph->tema }}
                                    </small>

                                </td>

                                <!-- STATUS -->
                                <td>

                                    @if($item->status_analisis)

                                        <span class="badge bg-success">
                                            Sudah Dianalisis
                                        </span>

                                    @else

                                        <span class="badge-belum">
                                            Belum Dianalisis
                                        </span>

                                    @endif

                                </td>

                                <!-- AKSI -->
                                <td class="text-center">

                                    <a
                                        href="{{ route('detail-perkembangan', [
                                            'id_anak' => $item->id_anak,
                                            'minggu' => $item->rpph->minggu
                                        ]) }}"
                                        class="aksi-btn view">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- STATISTIK -->
            <div class="row mt-4">

                <div class="col-md-4 mb-3">

                    <div class="stat-card d-flex align-items-center gap-3">

                        <div class="stat-icon bg-blue-soft">
                            <i class="bi bi-journal-check"></i>
                        </div>

                        <div>

                            <div class="stat-label">
                                TOTAL PENILAIAN
                            </div>

                            <div class="stat-value">
                                {{ $totalPenilaian }}
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-3">

                    <div class="stat-card d-flex align-items-center gap-3">

                        <div class="stat-icon bg-yellow-soft">
                            <i class="bi bi-hourglass-split"></i>
                        </div>

                        <div>

                            <div class="stat-label">
                                MENUNGGU ANALISIS
                            </div>

                            <div class="stat-value">
                                {{ $pendingAnalisis }}
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-3">

                    <div class="stat-card d-flex align-items-center gap-3">

                        <div class="stat-icon bg-green-soft">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <div>

                            <div class="stat-label">
                                SUDAH DIANALISIS
                            </div>

                            <div class="stat-value">
                                {{ $sudahAnalisis }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- SUMMARY -->
            <div class="summary-box">

                <div class="summary-title">
                    Ringkasan Data Perkembangan
                </div>

                <div class="summary-sub">
                    Sebagian data perkembangan anak sudah berhasil diinput oleh guru dan sedang menunggu proses analisis menggunakan metode RBS dan LLM.
                </div>

                <div class="d-flex flex-wrap gap-3 mt-4">

                    <div class="mini-box">
                        <h3>{{ $totalPenilaian }}</h3>
                        <p>TOTAL DATA</p>
                    </div>

                    <div class="mini-box">
                        <h3>{{ $pendingAnalisis }}</h3>
                        <p>PENDING AI</p>
                    </div>

                    <div class="mini-box">
                        <h3>{{ $sudahAnalisis }}</h3>
                        <p>SELESAI</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    // SEARCH
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', function(){

        let value = this.value.toLowerCase();

        let rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {

            let nama = row.innerText.toLowerCase();

            row.style.display =
                nama.includes(value)
                ? ''
                : 'none';

        });

    });

    // SIDEBAR MOBILE
    function toggleSidebar() {

        document
            .querySelector('.sidebar')
            .classList
            .toggle('show');

    }

</script>

</body>
</html>