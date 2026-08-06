<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Rapor - KB Nurul'Ain</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

        /* STAT CARDS */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 22px;
            border: 1px solid #F1F5F9;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .03);
            transition: .25s;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: #0F172A;
            margin-top: 4px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 700;
            color: #94A3B8;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        /* TABLE CARD & COMPONENTS */
        .table-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #F1F5F9;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .03);
        }

        .table-toolbar {
            padding: 20px 24px;
            border-bottom: 1px solid #F1F5F9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-wrapper {
            position: relative;
            max-width: 280px;
            flex: 1;
        }

        .search-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 14px;
        }

        .search-input {
            width: 100%;
            height: 44px;
            border: 1px solid #CBD5E1;
            border-radius: 12px;
            padding: 0 16px 0 42px;
            outline: none;
            font-size: 13px;
            transition: .2s;
            background: #F8FAFC;
        }

        .search-input:focus {
            border-color: #0284C7;
            background: white;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, .1);
        }

        .filter-select {
            height: 44px;
            border: 1px solid #CBD5E1;
            border-radius: 12px;
            padding: 0 16px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            background: #F8FAFC;
            outline: none;
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: #0284C7;
            background: white;
        }

        /* TABLE CUSTOM STYLING */
        .table thead th {
            background: #F8FAFC;
            border: none;
            color: #94A3B8;
            font-size: 11px;
            letter-spacing: 1px;
            font-weight: 700;
            padding: 16px 20px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-color: #F8FAFC;
            font-size: 13px;
        }

        .table tbody tr:hover {
            background: #FAFBFF;
        }

        .student-img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #E0F2FE;
        }

        .student-name {
            font-weight: 700;
            color: #0F172A;
            font-size: 14px;
        }

        /* BADGE STATUS */
        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-draft { background: #FEF3C7; color: #D97706; }
        .badge-final { background: #D1FAE5; color: #059669; }

        /* AKSI BUTTON */
        .aksi-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            margin: 0 2px;
            transition: .2s;
            border: none;
            cursor: pointer;
        }

        .aksi-download { background: #EDE9FE; color: #7C3AED; }
        .aksi-delete   { background: #FEE2E2; color: #DC2626; }

        .aksi-btn:hover {
            opacity: .85;
            transform: translateY(-2px);
        }

        /* BUTTON GENERATE BARU */
        .btn-new-rapor {
            background: #0284C7;
            color: white;
            border-radius: 14px;
            padding: 12px 22px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: .2s;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.2);
        }

        .btn-new-rapor:hover {
            background: #0369A1;
            color: white;
            transform: translateY(-1px);
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 64px 24px;
            color: #94A3B8;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            border-radius: 24px;
            background: #F1F5F9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 16px;
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

            .search-wrapper {
                max-width: 100%;
                width: 100%;
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

                <!-- LEFT MOBILE BTN & BREADCRUMB -->
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
                <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
                    <div>
                        <div class="breadcrumb-text">
                            Beranda / 
                            <a href="{{ route('rapor.index') }}" class="text-decoration-none text-primary fw-bold">Generate Rapor</a> / 
                            <span class="fw-bold text-dark">Riwayat</span>
                        </div>
                        <h1 class="page-title">Riwayat Rapor</h1>
                        <p class="page-subtitle">Daftar rapor yang sudah digenerate untuk kelompok {{ $guru->kelompok ?? '-' }}</p>
                    </div>

                    <a href="{{ route('rapor.index') }}" class="btn-new-rapor">
                        <i class="bi bi-plus-lg"></i> Generate Rapor Baru
                    </a>
                </div>

                <!-- STAT CARDS -->
                @php
                    $totalRapor  = $rapor->count();
                    $totalFinal  = $rapor->where('status', 'final')->count();
                    $totalDraft  = $rapor->where('status', 'draft')->count();
                @endphp
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="stat-card d-flex align-items-center gap-3">
                            <div class="stat-icon" style="background:#E0F2FE;color:#0284C7;">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div>
                                <div class="stat-label">Total Rapor</div>
                                <div class="stat-value">{{ $totalRapor }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card d-flex align-items-center gap-3">
                            <div class="stat-icon" style="background:#D1FAE5;color:#059669;">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div>
                                <div class="stat-label">Sudah Final</div>
                                <div class="stat-value">{{ $totalFinal }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card d-flex align-items-center gap-3">
                            <div class="stat-icon" style="background:#FEF3C7;color:#D97706;">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                            <div>
                                <div class="stat-label">Masih Draft</div>
                                <div class="stat-value">{{ $totalDraft }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TABEL RAPOR -->
                <div class="table-card">
                    <div class="table-toolbar">
                        <div class="fw-bold" style="font-size:15px;color:#0F172A;">
                            Daftar Rapor
                        </div>
                        <div class="d-flex gap-2 align-items-center flex-wrap w-100 w-md-auto">
                            <!-- Filter status -->
                            <select class="filter-select" id="filterStatus" onchange="filterTabel()">
                                <option value="semua">Semua Status</option>
                                <option value="final">Final</option>
                                <option value="draft">Draft</option>
                            </select>

                            <!-- Search -->
                            <div class="search-wrapper">
                                <i class="bi bi-search"></i>
                                <input type="text" class="search-input" id="searchInput" placeholder="Cari nama anak..." onkeyup="searchTabel()">
                            </div>
                        </div>
                    </div>

                    @if($rapor->isEmpty())
                        <div class="empty-state">
                            <div class="empty-icon"><i class="bi bi-award" style="color:#CBD5E1;"></i></div>
                            <div style="font-weight:800;font-size:15px;color:#475569;margin-bottom:6px;">
                                Belum ada rapor
                            </div>
                            <div style="font-size:13px;">
                                Klik "Generate Rapor Baru" untuk mulai membuat rapor anak.
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" id="tabelRapor">
                                <thead>
                                    <tr>
                                        <th>NAMA ANAK</th>
                                        <th>SEMESTER</th>
                                        <th>TAHUN AJARAN</th>
                                        <th>DIBUAT</th>
                                        <th>STATUS</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach($rapor as $r)
                                    <tr data-nama="{{ strtolower($r->anak->nama_anak ?? '') }}" data-status="{{ $r->status }}">
                                        <!-- Nama anak -->
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @if($r->anak?->foto)
                                                    <img src="{{ asset('storage/' . $r->anak->foto) }}" class="student-img" alt="foto">
                                                @else
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($r->anak->nama_anak ?? 'A') }}&background=0ea5e9&color=fff" class="student-img" alt="foto">
                                                @endif
                                                <div>
                                                    <div class="student-name">{{ $r->anak->nama_anak ?? '-' }}</div>
                                                    <div style="font-size:11px;color:#94A3B8;">
                                                        Kelompok {{ $r->anak->kelompok ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- Semester -->
                                        <td>
                                            <div style="font-weight:600;color:#334155;">{{ $r->semester }}</div>
                                        </td>
                                        <!-- Tahun ajaran -->
                                        <td>
                                            <div style="color:#64748B;">{{ $r->tahun_ajaran }}</div>
                                        </td>
                                        <!-- Dibuat -->
                                        <td>
                                            <div style="color:#64748B;font-size:12px;">
                                                {{ $r->created_at?->format('d M Y') ?? '-' }}
                                            </div>
                                            <div style="color:#94A3B8;font-size:11px;">
                                                {{ $r->created_at?->format('H:i') ?? '' }}
                                            </div>
                                        </td>
                                        <!-- Status -->
                                        <td>
                                            @if($r->status === 'final')
                                                <span class="badge-status badge-final">
                                                    <i class="bi bi-check-circle-fill"></i> Final
                                                </span>
                                            @else
                                                <span class="badge-status badge-draft">
                                                    <i class="bi bi-pencil-square"></i> Draft
                                                </span>
                                            @endif
                                        </td>
                                        <!-- Aksi -->
                                        <td class="text-center">
                                            {{-- Download PDF --}}
                                            <a href="{{ route('rapor.download', $r->id_rapor) }}" class="aksi-btn aksi-download" title="Download PDF" target="_blank">
                                                <i class="bi bi-download" style="font-size:13px;"></i>
                                            </a>
                                            {{-- Hapus --}}
                                            <button class="aksi-btn aksi-delete" title="Hapus Rapor" onclick="konfirmasiHapus('{{ $r->id_rapor }}', '{{ $r->anak->nama_anak ?? '' }}')">
                                                <i class="bi bi-trash" style="font-size:13px;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination info -->
                        <div style="padding:16px 24px;border-top:1px solid #F8FAFC;font-size:13px;color:#64748B;">
                            Menampilkan <strong>{{ $rapor->count() }}</strong> rapor
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS -->
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
            <div class="modal-content border-0 shadow-lg" style="border-radius:20px;padding:8px;">
                <div class="modal-body text-center pt-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:64px;height:64px;background:#FEE2E2;color:#DC2626;border-radius:50%;font-size:28px;">
                        <i class="bi bi-trash"></i>
                    </div>
                    <h5 class="fw-bold" style="font-size:17px;color:#0F172A;">Hapus Rapor?</h5>
                    <p class="text-muted" style="font-size:13px;" id="modalHapusTeks">
                        Rapor ini akan dihapus permanen.
                    </p>
                    <div class="d-flex gap-2 justify-content-center pb-2">
                        <button type="button" class="btn border-0 fw-bold px-4" data-bs-dismiss="modal" style="background:#F1F5F9;color:#64748B;border-radius:12px;font-size:13px;">
                            Batal
                        </button>
                        <button type="button" id="btnEksekusiHapus" class="btn fw-bold px-4 text-white" style="background:#DC2626;border-radius:12px;font-size:13px;">
                            Ya, Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS DEPENDENCIES -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let raporIdToDelete = null;

        // SIDEBAR TOGGLE
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        // KONFIRMASI HAPUS MODAL
        function konfirmasiHapus(id, namaAnak) {
            raporIdToDelete = id;
            document.getElementById('modalHapusTeks').textContent =
                `Rapor atas nama ${namaAnak} akan dihapus permanen dan tidak dapat dikembalikan.`;
            new bootstrap.Modal(document.getElementById('modalHapus')).show();
        }

        document.getElementById('btnEksekusiHapus').addEventListener('click', function () {
            if (!raporIdToDelete) return;
            fetch(`/rapor/${raporIdToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal menghapus rapor.');
                }
            })
            .catch(() => alert('Terjadi kesalahan.'));
        });

        // SEARCH & FILTER TABEL
        function searchTabel() {
            const val = document.getElementById('searchInput').value.toLowerCase();
            const filter = document.getElementById('filterStatus').value;

            document.querySelectorAll('#tableBody tr').forEach(row => {
                const nama   = row.dataset.nama || '';
                const status = row.dataset.status || '';

                const matchNama   = nama.includes(val);
                const matchStatus = filter === 'semua' || status === filter;

                row.style.display = (matchNama && matchStatus) ? '' : 'none';
            });
        }

        function filterTabel() {
            searchTabel();
        }
    </script>
</body>

</html>