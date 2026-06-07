<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Murid - KB Nurul'Ain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body{
            background: #F8FAFC;
            overflow-x: hidden;
        }

        /* Efek blur estetik pada background saat modal terbuka */
        .modal-blur {
            backdrop-filter: blur(5px);
            transition: backdrop-filter 0.3s ease;
        }

        /* Memastikan font weight judul modal terlihat tegas */
        .fw-800 {
            font-weight: 800;
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

        .profile-box{
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .profile-name{
            white-space: nowrap;
        }

        .profile-name small{
            white-space: nowrap;
            display: block;
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

        .filter-box{
            min-width: 240px;
            border-radius: 14px;
            border: 1px solid #E2E8F0;
            padding: 12px 16px;
            font-weight: 600;
        }

        .btn-add{
            background: #0F766E;
            border: none;
            color: white;
            padding: 13px 24px;
            border-radius: 14px;
            font-weight: 700;
            transition: .2s;
        }

        .btn-add:hover{
            background: #115E59;
        }

        .table-card{
            background: white;
            border-radius: 24px;
            margin-top: 28px;
            overflow: hidden;
            border: 1px solid #F1F5F9;
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

        .badge-kelompok{
            background: #E0F2FE;
            color: #0284C7;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-status{
            background: #DCFCE7;
            color: #15803D;
            padding: 7px 14px;
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

        .aksi-btn.view{ background: #E0F2FE; color: #0284C7; }
        .aksi-btn.edit{ background: #FEF3C7; color: #D97706; }
        .aksi-btn.delete{ background: #FEE2E2; color: #DC2626; }

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

        .bg-blue-soft{ background: #E0F2FE; color: #0284C7; }
        .bg-green-soft{ background: #DCFCE7; color: #15803D; }
        .bg-pink-soft{ background: #FCE7F3; color: #DB2777; }

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

        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-top: 1px solid #F1F5F9;
        }

        .pagination-info { color: #64748B; font-size: 14px; }
        .pagination-info b { color: #0F172A; }

        .custom-pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .page-item-custom {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid #E2E8F0;
            color: #0F172A;
            text-decoration: none;
            font-weight: 700;
            transition: .2s;
        }

        .page-item-custom.active {
            background: #0284C7;
            color: white;
            border-color: #0284C7;
        }

        .page-item-custom:hover:not(.active) {
            background: #F8FAFC;
            border-color: #CBD5E1;
        }

        .page-item-nav {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid #E2E8F0;
            color: #64748B;
            text-decoration: none;
        }

        .alert-success-custom{
            background: white;
            border: 1px solid #BBF7D0;
            border-left: 6px solid #16A34A;
            padding: 18px 22px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
            animation: fadeIn .4s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,.04);
        }

        .alert-success-icon{
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: #DCFCE7;
            color: #16A34A;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .alert-success-title{ font-weight: 800; color: #166534; margin-bottom: 2px; }
        .alert-success-subtitle{ color: #64748B; font-size: 14px; }
        .btn-close-alert{ margin-left: auto; border: none; background: transparent; font-size: 20px; color: #94A3B8; }

        @keyframes fadeIn{
            from{ opacity: 0; transform: translateY(-10px); }
            to{ opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); transition: 0.3s; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; width: 100%; }
            .content { padding: 24px; }
            .topbar { padding: 16px 20px; }
            .page-title { font-size: 30px; }
            .search-input { width: 220px; }
            .table thead th, .table tbody td { padding: 16px; }
        }

        @media (max-width: 768px) {
            .topbar { padding: 14px 16px; gap: 12px; flex-wrap: wrap; }
            .content { padding: 18px; }
            .search-wrapper { width: 170px; }
            .search-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94A3B8; font-size: 18px; display: flex; align-items: center; }
            .search-input { width: 100%; height: 48px; padding: 0 20px 0 48px; font-size: 14px; }
            .profile-img { width: 40px; height: 40px; }
            .page-title { font-size: 26px; line-height: 1.3; }
            .page-subtitle { font-size: 14px; }
            .breadcrumb-text { font-size: 12px; }
            .btn-add { width: 100%; justify-content: center; }
            .table-card { border-radius: 20px; overflow-x: auto; }
            .table { min-width: 700px; }
            .table thead th { font-size: 11px; white-space: nowrap; }
            .table tbody td { font-size: 13px; white-space: nowrap; }
            .student-img { width: 48px; height: 48px; }
            .student-name { font-size: 14px; }
            .badge-kelompok, .badge-status { font-size: 11px; padding: 6px 12px; }
            .aksi-btn { width: 34px; height: 34px; border-radius: 10px; }
            .pagination-wrapper { flex-direction: column; gap: 16px; align-items: flex-start; }
            .pagination-info { font-size: 13px; }
            .page-item-custom, .page-item-nav { width: 36px; height: 36px; font-size: 13px; }
            .stat-card { padding: 18px; border-radius: 20px; }
            .stat-icon { width: 50px; height: 50px; font-size: 20px; }
            .stat-label { font-size: 11px; }
            .stat-value { font-size: 20px; }
        }

        @media (max-width: 480px) {
            .sidebar { width: 250px; }
            .brand-box { padding: 22px 18px; }
            .sidebar-menu { padding: 18px 12px; }
            .page-title { font-size: 22px; }
            .topbar { padding: 12px; }
            .content { padding: 14px; }
            .table-card { margin-top: 20px; }
            .pagination-wrapper { padding: 16px; }
            .stat-card { gap: 14px; }
        }
    </style>
</head>
<body>

<div class="d-flex">
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
            <a href="/data-murid" class="nav-link-custom active">
                <i class="bi bi-people"></i> Data Murid
            </a>
            <a href="{{ route('penilaian.create') }}" class="nav-link-custom">
                <i class="bi bi-journal-text"></i> Input Data Perkembangan
            </a>
            <a href="/perkembangan-anak" class="nav-link-custom">
                <i class="bi bi-bar-chart"></i> Perkembangan Anak
            </a>
            <a href="/hasil-analisis" class="nav-link-custom">
                <i class="bi bi-file-earmark-text"></i> Hasil Analisis
            </a>
            <a href="/catatan-anak-rumah" class="nav-link-custom">
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

    <div class="main-content flex-grow-1">
        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn d-lg-none border-0 px-0" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-2"></i>
                </button>
                <div class="search-wrapper">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama murid...">
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold">
                        <small class="text-muted">{{ auth()->user()->nama }}</small>
                    </div>
                </div>
                @if($guru && $guru->foto)
                    <img src="{{ asset('storage/' . $guru->foto) }}" class="profile-img">
                @else
                    <img src="https://ui-avatars.com/api/?name=Guru&background=0ea5e9&color=fff" class="profile-img">
                @endif
            </div>
        </header>

        <div class="content">
            @if(session('success'))
                <div class="alert-success-custom" id="successAlert">
                    <div class="alert-success-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div>
                        <div class="alert-success-title">Berhasil!</div>
                        <div class="alert-success-subtitle">{{ session('success') }}</div>
                    </div>
                    <button class="btn-close-alert" onclick="document.getElementById('successAlert').style.display='none'">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <div class="breadcrumb-text">
                        Beranda / <span class="text-primary fw-bold">Data Murid</span>
                    </div>
                    <div class="page-title">Data Murid</div>
                    <div class="page-subtitle">Kelola informasi dasar dan administrasi peserta didik.</div>
                </div>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="/tambah-murid" class="btn-add text-decoration-none">
                        <i class="bi bi-person-plus me-2"></i> Tambah Murid
                    </a>
                </div>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>FOTO</th>
                                <th>NAMA LENGKAP</th>
                                <th>KELOMPOK</th>
                                <th>UMUR</th>
                                <th>STATUS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach($anak as $item)
                            <tr>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" class="student-img">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama_anak) }}&background=0ea5e9&color=fff" class="student-img">
                                    @endif
                                </td>
                                <td class="student-name">{{ $item->nama_anak }}</td>
                                <td><span class="badge-kelompok">Kelompok {{ $item->kelompok }}</span></td>
                                <td class="fw-bold">{{\Carbon\Carbon::parse($item->tanggal_lahir)->age}} Tahun</td>
                                <td><span class="badge-status">AKTIF</span></td>
                                <td class="text-center">
                                    <a href="{{ route('detail.murid', $item->id_anak) }}" class="aksi-btn view">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('edit.murid', $item->id_anak) }}" class="aksi-btn edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="#" class="aksi-btn delete" onclick="mintaKonfirmasiHapus(event, '{{ route('hapus.murid', $item->id_anak) }}')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    <div class="pagination-wrapper">
                        <div class="pagination-info">
                            Menampilkan <b>1-{{ $anak->count() }}</b> dari <b>{{ $totalAnak }}</b> murid
                        </div>
                        <nav>
                            <ul class="custom-pagination">
                             <ul class="custom-pagination">

                                {{-- Tombol Previous --}}
                                @if($anak->onFirstPage())
                                    <li>
                                        <span class="page-item-nav" style="opacity:.5; cursor:not-allowed;">
                                            <i class="bi bi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $anak->previousPageUrl() }}" class="page-item-nav">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Nomor Halaman --}}
                                @for($i = 1; $i <= $anak->lastPage(); $i++)
                                    <li>
                                        <a href="{{ $anak->url($i) }}"
                                        class="page-item-custom {{ $anak->currentPage() == $i ? 'active' : '' }}">
                                            {{ $i }}
                                        </a>
                                    </li>
                                @endfor

                                {{-- Tombol Next --}}
                                @if($anak->hasMorePages())
                                    <li>
                                        <a href="{{ $anak->nextPageUrl() }}" class="page-item-nav">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <span class="page-item-nav" style="opacity:.5; cursor:not-allowed;">
                                            <i class="bi bi-chevron-right"></i>
                                        </span>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon bg-blue-soft"><i class="bi bi-people"></i></div>
                        <div>
                            <div class="stat-label">TOTAL MURID</div>
                            <div class="stat-value">{{ $totalAnak }} Anak</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon bg-green-soft"><i class="bi bi-gender-male"></i></div>
                        <div>
                            <div class="stat-label">LAKI-LAKI</div>
                            <div class="stat-value">{{ $totalLaki }} Anak</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon bg-pink-soft"><i class="bi bi-gender-female"></i></div>
                        <div>
                            <div class="stat-label">PEREMPUAN</div>
                            <div class="stat-value">{{ $totalPerempuan }} Anak</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade modal-blur" id="konfirmasiHapusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; padding: 12px;">
            <div class="modal-body text-center pt-4">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" 
                    style="width: 70px; height: 70px; background: #FEE2E2; color: #DC2626; border-radius: 50%; font-size: 32px;">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <h5 class="fw-800 text-dark mb-2" style="font-size: 18px;">Hapus Data Murid?</h5>
                <p class="text-muted small px-3 mb-4">Tindakan ini tidak dapat dibatalkan. Semua informasi perkembangan anak yang dipilih akan terhapus permanen dari sistem.</p>
                
                <div class="d-flex gap-2 justify-content-center pb-2">
                    <button type="button" class="btn border-0 fw-bold px-4 py-2" data-bs-dismiss="modal"
                            style="background: #F1F5F9; color: #64748B; border-radius: 12px; font-size: 14px; min-width: 110px;">
                        Batal
                    </button>
                    <a href="#" id="tombolEksekusiHapus" class="btn fw-bold px-4 py-2 text-white d-inline-flex align-items-center justify-content-center"
                       style="background: #DC2626; border-radius: 12px; font-size: 14px; min-width: 110px; text-decoration: none;">
                        Ya, Hapus
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // SEARCH TABLE
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(){
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tableBody tr');
            rows.forEach(row => {
                let nama = row.innerText.toLowerCase();
                row.style.display = nama.includes(value) ? '' : 'none';
            });
        });
    }

    // TOGGLE SIDEBAR MOBILE
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('show');
    }

    // Fungsi perantara untuk mengaktifkan modal konfirmasi kustom dengan metode GET
    function mintaKonfirmasiHapus(event, urlTujuan) {
        event.preventDefault(); 
        
        const tombolEksekusi = document.getElementById('tombolEksekusiHapus');
        if (tombolEksekusi) {
            tombolEksekusi.setAttribute('href', urlTujuan);
        }
        
        const modalHapus = new bootstrap.Modal(document.getElementById('konfirmasiHapusModal'));
        modalHapus.show();
    }
</script>

</body>
</html>