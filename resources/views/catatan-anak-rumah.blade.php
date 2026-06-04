<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Anak di Rumah - KB Nurul'Ain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        /* TOPBAR (Konsisten dengan Dashboard Utama) */
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

        /* FIX SEARCH ICON & INPUT BERDASARKAN CODE BARU */
        .search-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 16px;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .search-input {
            width: 320px;
            height: 46px;
            border: 1px solid #CBD5E1;
            border-radius: 999px;
            padding: 0 20px 0 46px;
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

        .catatan-judul{
            font-weight: 700;
            color: #0F172A;
            font-size: 14px;
        }

        .catatan-preview{
            font-size: 13px;
            color: #64748B;
            margin-top: 3px;
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .badge-tanggal{
            background: #F1F5F9;
            color: #475569;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
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
            border: none;
        }

        .aksi-btn.view{
            background: #E0F2FE;
            color: #0284C7;
        }

        .aksi-btn.view:hover{
            background: #0284C7;
            color: white;
        }

        /* MODAL CUSTOM STYLE */
        .modal-content-custom {
            border-radius: 28px;
            border: none;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        }

        .modal-header-custom {
            padding: 24px 30px;
            border-bottom: 1px solid #F1F5F9;
        }

        .modal-body-custom {
            padding: 30px;
        }

        .detail-box {
            background: #F8FAFC;
            border-radius: 20px;
            padding: 20px;
            border: 1px solid #F1F5F9;
        }

        /* RESPONSIVE BREAKPOINTS (MENGIKUTI STYLE CODE UTAMA) */
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

            .page-title {
                font-size: 28px;
            }
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 14px 16px;
            }

            .content {
                padding: 18px;
            }

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
                left: 14px;
            }

            .profile-img {
                width: 38px;
                height: 38px;
            }

            .table{
                min-width: 900px;
            }
        }

        @media (max-width: 480px) {
            .topbar {
                gap: 10px;
            }
            .sidebar {
                width: 250px;
            }
        }
    </style>
</head>
<body>

<div class="d-flex">

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

            <div class="mt-5 pt-4">
                <form action="/logout" method="POST">
                    @csrf

                    <button type="submit" class="nav-link-custom text-danger border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-right"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="main-content flex-grow-1">

        <header class="topbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <button class="btn d-lg-none border-0 px-0" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-2"></i>
                </button>
                <div class="search-wrapper">
                    <i class="bi bi-search"></i>
                    <input
                        type="text"
                        id="searchInput"
                        class="search-input"
                        placeholder="Cari nama anak atau judul...">
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold">
                        <small class="text-muted">{{ auth()->user()->nama }}</small>
                    </div>
                </div>
                @if(isset($guru) && $guru->foto)
                <img
                    src="{{ asset('storage/' . $guru->foto) }}"
                    class="profile-img">
                @else
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=0ea5e9&color=fff"
                    class="profile-img">
                @endif
            </div>
        </header>

        <div class="content">
            <div>
                <div class="breadcrumb-text">
                    Beranda / <span class="text-primary fw-bold">Catatan Anak di Rumah</span>
                </div>
                <div class="page-title">List Catatan Anak</div>
                <div class="page-subtitle">
                    Laporan aktivitas harian anak di rumah yang dikirimkan langsung oleh orang tua murid.
                </div>
            </div>

            <div class="table-card mt-4">
                <div class="table-wrapper">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>FOTO</th>
                                <th>NAMA ANAK / ORANG TUA</th>
                                <th>JUDUL CATATAN</th>
                                <th>TANGGAL KIRIM</th>
                                <th>STATUS</th>
                                <th class="text-center">DETAIL</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach($catatan as $item)
                            <tr>
                                <td width="90">
                                    @if($item->anak->foto)
                                        <img src="{{ asset('storage/' . $item->anak->foto) }}" class="student-img">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->anak->nama_anak) }}&background=0ea5e9&color=fff" class="student-img">
                                    @endif
                                </td>

                                <td>
                                    <div class="student-name">{{ $item->anak->nama_anak }}</div>
                                    <small class="text-muted d-block">Kelompok {{ $item->anak->kelompok }}</small>
                                    <small class="text-primary fw-semibold">
                                        <i class="bi bi-person-heart"></i>
                                        Wali: {{ $item->orangTua->user->nama ?? '-' }}
                                    </small>
                                </td>

                                <td>
                                    <div class="catatan-judul">
                                        {{ $item->judul_catatan }}
                                    </div>

                                    <div class="catatan-preview">
                                        {{ Str::limit($item->isi_catatan, 80) }}
                                    </div>
                                </td>

                                <td>
                                    <div class="badge-tanggal">
                                        <i class="bi bi-calendar3"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                                    </div>
                                </td>

                                <td>
                                    @if($item->dibaca_at)
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Sudah Dibaca
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-envelope-fill"></i>
                                            Belum Dibaca
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('catatan.show', $item->id_catatan) }}"
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
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-custom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-book-half text-primary fs-4"></i>
                    <h5 class="modal-title fw-800 text-dark" id="detailModalLabel">Detail Catatan Rumah</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-custom">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <small class="text-muted d-block uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">NAMA ANAK</small>
                        <span id="modalNamaAnak" class="fw-bold text-dark fs-5">-</span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">NAMA ORANG TUA</small>
                        <span id="modalNamaOrtu" class="fw-bold text-primary fs-5">-</span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">TANGGAL KIRIM</small>
                        <span id="modalTanggal" class="fw-bold text-secondary fs-5">-</span>
                    </div>
                </div>

                <div class="mb-2">
                    <small class="text-muted d-block uppercase fw-bold mb-2" style="font-size: 11px; letter-spacing: 0.5px;">JUDUL UTAMA</small>
                    <h6 id="modalJudul" class="fw-800 text-dark border-bottom pb-2 fs-5">-</h6>
                </div>

                <div class="mt-3">
                    <small class="text-muted d-block uppercase fw-bold mb-2" style="font-size: 11px; letter-spacing: 0.5px;">ISI KEGIATAN & PERKEMBANGAN DI RUMAH</small>
                    <div class="detail-box">
                        <p id="modalIsi" class="text-secondary lh-lg mb-0" style="font-size: 14px; white-space: pre-line;">-</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-secondary px-4 py-2" style="border-radius: 12px; font-weight: 600;" data-bs-dismiss="modal">Tutup Catatan</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // LIVE SEARCH SYSTEM (Bekerja untuk Tabel List Catatan)
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function(){
        let value = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            let contentText = row.innerText.toLowerCase();
            row.style.display = contentText.includes(value) ? '' : 'none';
        });
    });

    // MOBILE SIDEBAR TOGGLE
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }

    // INJECT DATA TO MODAL DYNAMICALLY
    function showDetail(namaAnak, namaOrtu, judul, tanggal, isi) {
        document.getElementById('modalNamaAnak').innerText = namaAnak;
        document.getElementById('modalNamaOrtu').innerText = namaOrtu;
        document.getElementById('modalTanggal').innerText = tanggal;
        document.getElementById('modalJudul').innerText = judul;
        document.getElementById('modalIsi').innerText = isi;
    }
</script>

</body>
</html>