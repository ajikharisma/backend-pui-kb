<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Penilaian - KB Nurul'Ain</title>

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

        .form-card{
            overflow: hidden;
        }

        .form-card,
        .nilai-card,
        .form-control-custom,
        .btn-save{
            transition: all .25s ease;
        }

        .ts-wrapper.single .ts-control{

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

        .ts-wrapper.single .ts-control input{

            font-size: 14px !important;
        }

        .ts-wrapper.single .ts-control.focus{

            border-color: #0284C7 !important;

            box-shadow: 0 0 0 4px rgba(2,132,199,.1) !important;
        }

        .ts-dropdown{

            border-radius: 14px !important;

            border: 1px solid #E2E8F0 !important;

            overflow: hidden;

            margin-top: 6px;
        }

        .ts-dropdown .option{

            padding: 12px 16px;

            font-size: 14px;
        }

        .ts-dropdown .active{

            background: #E0F2FE !important;

            color: #0284C7 !important;
        }

        .ts-wrapper{
            width: 100%;
        }

        body {
            background: #F8FAFC;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 270px;
            height: 100vh;
            /* GANTI dari min-height */
            background: white;
            border-right: 1px solid #E2E8F0;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            /* penting */
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
            /* INI YANG MEMBUAT SCROLL */
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

        /* TOPBAR (Identik dengan Data Murid) */
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
            max-width: 320px;
            flex: 1;
        }

        .search-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 15px;
        }

        .search-input {
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

        .search-input:focus {
            border-color: #0284C7;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, .1);
        }

        .profile-img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* CONTENT */
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

        /* FORM CARD */
        .form-card {
            background: white;
            border-radius: 28px;
            padding: 32px;
            border: 1px solid #F1F5F9;
            margin-top: 28px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .03);
        }

        .section-title {
            font-size: 18px;
            font-weight: 800;
            color: #0F172A;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #0284C7;
        }

        /* INPUT CUSTOM */
        .form-label {
            font-size: 14px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 10px;
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

        textarea.form-control-custom {
            height: auto;
            padding-top: 16px;
        }

        /* NILAI CARD STYLE */
        .nilai-card {
            border-radius: 20px;
            padding: 20px;
            cursor: pointer;
            transition: .3s;
            border: 2px solid transparent;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .nilai-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .nilai-title {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .nilai-sub {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            line-height: 1.2;
        }

        .bb {
            background: #FEF2F2;
            color: #DC2626;
        }

        .mb {
            background: #FFF7ED;
            color: #EA580C;
        }

        .bsh {
            background: #ECFEFF;
            color: #0891B2;
        }

        .bsb {
            background: #ECFDF5;
            color: #059669;
        }

        .nilai-active {
            border-color: #0284C7 !important;
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.15) !important;
        }

        /* BUTTON */
        .btn-save {
            background: #0284C7;
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 16px;
            font-weight: 700;
            transition: .2s;
        }

        .btn-save:hover {
            background: #0369A1;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.3);
        }

        /* RESPONSIVE */
        /* =========================================
        TABLET
        ========================================= */
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

            .form-card {
                padding: 24px;
            }

            .search-input {
                width: 220px;
            }
        }

        /* =========================================
        MOBILE
        ========================================= */
        @media (max-width: 768px) {

            .topbar {
                padding: 14px 16px;
                gap: 12px;
                flex-wrap: wrap;
            }

            .content {
                padding: 18px;
            }

            .search-wrapper {
                width: 170px;
            }

            .search-wrapper i {
                position: absolute;
                left: 16px;
                top: 50%;
                transform: translateY(-50%);
                color: #94A3B8;
                font-size: 18px;
                line-height: 1;
                display: flex;
                align-items: center;
            }

            .search-input {
                width: 100%;
                height: 48px;
                border: 1px solid #CBD5E1;
                border-radius: 999px;
                padding: 0 20px 0 48px;
                outline: none;
                font-size: 14px;
                transition: .2s;
                background: white;
            }

            .profile-img {
                width: 40px;
                height: 40px;
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

            .form-card {
                padding: 20px;
                border-radius: 22px;
            }

            .section-title {
                font-size: 16px;
                margin-bottom: 16px;
            }

            .form-label {
                font-size: 13px;
                margin-bottom: 8px;
            }

            .form-control-custom {
                height: 48px;
                font-size: 13px;
                padding: 0 14px;
                border-radius: 12px;
            }

            textarea.form-control-custom {
                padding-top: 14px;
            }

            /* SELECT RESPONSIVE */
            select.form-control-custom {
                padding-right: 40px;
                background-position: right 14px center;
                background-size: 14px;
            }

            /* NILAI CARD */
            .nilai-card {
                padding: 16px 10px;
                border-radius: 16px;
            }

            .nilai-title {
                font-size: 20px;
            }

            .nilai-sub {
                font-size: 10px;
            }

            /* BUTTON */
            .btn-save {
                width: 100%;
                padding: 14px;
                border-radius: 14px;
                font-size: 14px;
            }

            /* ROW SPACING */
            .row.g-4 {
                --bs-gutter-y: 1rem;
            }
        }

        /* =========================================
        EXTRA SMALL
        ========================================= */
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

            .form-card {
                padding: 16px;
                margin-top: 18px;
            }

            .nilai-title {
                font-size: 18px;
            }

            .nilai-sub {
                font-size: 9px;
            }

            .section-title {
                font-size: 15px;
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

                <a href="/input-penilaian" class="nav-link-custom active">
                    <i class="bi bi-journal-text"></i>
                    Input Data Perkembangan
                </a>

                <a href="/perkembangan-anak" class="nav-link-custom">
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

                <!-- PUSH KE BAWAH -->
                <div class="mt-auto pt-4">

                    <a href="/logout" class="nav-link-custom text-danger">
                        <i class="bi bi-box-arrow-right"></i>
                        Keluar
                    </a>

                </div>

            </div>

        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content flex-grow-1">
            <!-- TOPBAR -->
            <header class="topbar">

                <!-- LEFT -->
                <div class="d-flex align-items-center gap-3">

                    <!-- BUTTON MOBILE -->
                    <button
                        class="btn d-lg-none border-0 px-0"
                        onclick="toggleSidebar()">

                        <i class="bi bi-list fs-2"></i>

                    </button>

                    <!-- SEARCH -->
                    <div class="search-wrapper">

                        <i class="bi bi-search"></i>

                        <input
                            type="text"
                            class="search-input"
                            placeholder="Cari nama murid...">

                    </div>

                </div>

                <!-- RIGHT PROFILE -->
                <div class="d-flex align-items-center gap-3">

                    <!-- NAMA -->
                    <div class="text-end d-none d-sm-block">

                        <div class="fw-bold">
                            <small class="text-muted">
                                {{ auth()->user()->nama }}
                            </small>
                        </div>

                    </div>

                    <!-- FOTO -->
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

            <!-- CONTENT AREA -->
            <div class="content">
                <div class="mb-4">
                    <div class="breadcrumb-text">Beranda / <span class="text-primary fw-bold">Input Penilaian</span></div>
                    <h1 class="page-title">Input Penilaian Harian</h1>
                    <p class="page-subtitle">Input perkembangan anak berdasarkan indikator RPPH hari ini.</p>
                </div>

                <div class="form-card shadow-sm">
                    <form id="formPenilaian" action="javascript:void(0);">
                        @csrf

                        <input
                            type="hidden"
                            name="id_guru"
                            value="{{ $guru->id_guru }}">

                        <!-- DATA IDENTITAS -->
                        <div class="section-title"><i class="bi bi-person-check"></i> Identitas & Waktu</div>
                        <div class="row g-4 mb-5">
                            <div class="col-md-4">
                                <label class="form-label">Pilih Anak</label>
                                <select 
                                    name="id_anak" 
                                    id="pilihAnak"
                                    required>

                                    <option value="">-- Pilih Anak --</option>

                                    @foreach($anak as $a)
                                        <option value="{{ $a->id_anak }}">
                                            {{ $a->nama_anak }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Penilaian</label>
                                <input type="date" name="tanggal" class="form-control-custom" required value="{{ date('Y-m-d') }}">
                            </div>

                            <div class="col-md-4">

                                <label class="form-label">
                                    Periode Penilaian
                                </label>

                                <select
                                    name="periode"
                                    class="form-control-custom form-select w-100"
                                    required>

                                    <option value="">
                                        -- Pilih Periode --
                                    </option>

                                    <option value="Semester Ganjil 2025/2026">
                                        Semester Ganjil 2025/2026
                                    </option>

                                    <option value="Semester Genap 2025/2026">
                                        Semester Genap 2025/2026
                                    </option>

                                </select>

                            </div>
                        </div>

                        <!-- MATERI PENILAIAN -->
                        <div class="section-title"><i class="bi bi-book"></i> Materi Perkembangan</div>
                        <div class="row g-4 mb-5">
                            <div class="col-12">
                                <label class="form-label">Tema Mingguan (RPPH)</label>
                                <select name="id_rpph" class="form-control-custom form-select w-100" required>
                                    <option value="">-- Pilih Tema --</option>
                                    @foreach($rpph as $r)
                                    <option value="{{ $r->id_rpph }}">
                                        Minggu Ke-{{ $r->minggu }}
                                        | {{ $r->hari }}
                                        | {{ $r->tema }}
                                        | {{ $r->topik_harian }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Indikator Penilaian</label>

                                <select
                                    name="id_indikator"
                                    id="indikatorSelect"
                                    class="form-control-custom form-select w-100"
                                    required>

                                    <option value="">
                                        -- Pilih Indikator --
                                    </option>

                                </select>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label">
                                    Jenis Asesmen
                                </label>

                                <select
                                    name="id_asesmen"
                                    id="asesmenSelect"
                                    class="form-control-custom form-select w-100"
                                    required>

                                    <option value="">
                                        -- Pilih Asesmen --
                                    </option>

                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Aspek Perkembangan</label>

                                <input
                                    type="text"
                                    id="aspekDisplay"
                                    class="form-control-custom"
                                    readonly
                                    placeholder="Otomatis dari indikator">
                            </div>
                        </div>

                        <!-- HASIL PENILAIAN -->
                        <div class="section-title"><i class="bi bi-star"></i> Hasil Penilaian</div>
                        <div class="row g-3 mb-5">
                            <div class="col-6 col-md-3">
                                <label class="nilai-card bb w-100 text-center">
                                    <input type="radio" name="nilai" value="BB" hidden required>
                                    <div class="nilai-title">BB</div>
                                    <div class="nilai-sub">Belum Berkembang</div>
                                </label>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="nilai-card mb w-100 text-center">
                                    <input type="radio" name="nilai" value="MB" hidden>
                                    <div class="nilai-title">MB</div>
                                    <div class="nilai-sub">Mulai Berkembang</div>
                                </label>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="nilai-card bsh w-100 text-center">
                                    <input type="radio" name="nilai" value="BSH" hidden>
                                    <div class="nilai-title">BSH</div>
                                    <div class="nilai-sub">Sesuai Harapan</div>
                                </label>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="nilai-card bsb w-100 text-center">
                                    <input type="radio" name="nilai" value="BSB" hidden>
                                    <div class="nilai-title">BSB</div>
                                    <div class="nilai-sub">Sangat Baik</div>
                                </label>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label">Catatan Guru (Opsional)</label>
                            <textarea
                                name="deskripsi"
                                id="catatanGuru"
                                rows="4"
                                class="form-control-custom"
                                placeholder="Contoh: Anak mampu menghitung angka 1-10 tanpa bantuan">
                            </textarea>
                        </div>

                        <div id="alertBox"></div>

                        <div class="text-end d-grid d-md-block">
                            <button type="submit" class="btn-save shadow-sm">
                                <i class="bi bi-check-circle me-2"></i> Simpan Penilaian Harian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        document.getElementById('formPenilaian')
        .addEventListener('submit', async function(e){

            e.preventDefault();

            let form = this;

            let formData = new FormData(form);

            let response = await fetch("{{ route('penilaian.store') }}", {

                method: "POST",

                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },

                body: formData

            });

            let result = await response.json();

            let alertBox =
                document.getElementById('alertBox');

            if(response.ok){

                alertBox.innerHTML = `
                    <div class="alert alert-success">
                        Penilaian berhasil disimpan
                    </div>
                `;

                // reset sebagian field saja
                document.getElementById('indikatorSelect').value = '';
                document.getElementById('asesmenSelect').innerHTML =
                    '<option value="">-- Pilih Asesmen --</option>';

                document.getElementById('aspekDisplay').value = '';
                document.getElementById('catatanGuru').value = '';

                // reset radio
                document.querySelectorAll('input[name="nilai"]')
                .forEach(r => r.checked = false);

                document.querySelectorAll('.nilai-card')
                .forEach(c => c.classList.remove('nilai-active'));

            } else {

                alertBox.innerHTML = `
                    <div class="alert alert-danger">
                        Gagal menyimpan penilaian
                    </div>
                `;
            }

        });

        // =========================
        // FILTER INDIKATOR DARI RPPH
        // =========================

        const rpphSelect = document.querySelector('[name="id_rpph"]');
        const indikatorSelect = document.getElementById('indikatorSelect');
        const asesmenSelect = document.getElementById('asesmenSelect');
        const aspekDisplay = document.getElementById('aspekDisplay');

        rpphSelect.addEventListener('change', async function () {

            let rpphId = this.value;

            indikatorSelect.innerHTML =
                '<option value="">Loading indikator...</option>';

            let response = await fetch(`/get-indikator/${rpphId}`);

            let data = await response.json();

            indikatorSelect.innerHTML =
                '<option value="">-- Pilih Indikator --</option>';

            data.forEach(item => {

                indikatorSelect.innerHTML += `
                    <option
                        value="${item.id_indikator}"
                        data-aspek="${item.aspek}">
                        ${item.nama_indikator}
                    </option>
                `;
            });

        });

        // =========================
        // FILTER ASESMEN DARI INDIKATOR
        // =========================

        indikatorSelect.addEventListener('change', async function () {

            let indikatorId = this.value;

            let selected =
                this.options[this.selectedIndex];

            aspekDisplay.value =
                selected.dataset.aspek || '';

            asesmenSelect.innerHTML =
                '<option value="">Loading asesmen...</option>';

            let response =
                await fetch(`/get-asesmen/${indikatorId}`);

            let data = await response.json();

            asesmenSelect.innerHTML =
                '<option value="">-- Pilih Asesmen --</option>';

            data.forEach(item => {

                asesmenSelect.innerHTML += `
                    <option value="${item.id_asesmen}">
                        ${item.nama_asesmen}
                    </option>
                `;
            });

        });

        // =========================
        // VALIDASI CATATAN
        // =========================

        const radioNilai =
            document.querySelectorAll('input[name="nilai"]');

        const catatan =
            document.getElementById('catatanGuru');

        radioNilai.forEach(radio => {

            radio.addEventListener('change', function () {

                if (this.value === 'BB' || this.value === 'MB') {

                    catatan.required = true;
                    catatan.placeholder =
                        'Catatan wajib diisi untuk BB/MB';

                } else {

                    catatan.required = false;
                    catatan.placeholder =
                        'Catatan opsional';

                }

            });

        });

        // SIDEBAR TOGGLE
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        // ACTIVE CARD NILAI
        const cards = document.querySelectorAll('.nilai-card');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                cards.forEach(c => c.classList.remove('nilai-active'));
                this.classList.add('nilai-active');
            });
        });
    </script>

    <!-- TOM SELECT -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script>

        // semua select otomatis jadi modern
        new TomSelect('select[name="id_anak"]', {

        create: false,

        sortField: {
            field: "text",
            direction: "asc"
        }

    });

    </script>

</body>

</html>