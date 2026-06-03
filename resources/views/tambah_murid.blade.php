<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Murid - KB Nurul'Ain</title>

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
        .sidebar{
            width: 270px;
            height: 100vh; /* GANTI dari min-height */
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
            overflow-y: auto; /* INI YANG MEMBUAT SCROLL */
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

        /* TOPBAR */
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

        .profile-img{
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
        }

        .content{
            padding: 32px;
        }

        /* HEADER */
        .breadcrumb-text{
            font-size: 14px;
            color: #94A3B8;
            margin-bottom: 10px;
        }

        .page-title{
            font-size: 36px;
            font-weight: 800;
            color: #0F172A;
        }

        .page-subtitle{
            color: #64748B;
            margin-top: 6px;
        }

        /* CARD */
        .form-card{
            background: white;
            border-radius: 24px;
            padding: 28px;
            border: 1px solid #F1F5F9;
            margin-top: 28px;
        }

        .section-title{
            font-size: 20px;
            font-weight: 800;
            color: #0F172A;
        }

        .section-subtitle{
            color: #64748B;
            font-size: 14px;
            margin-top: 4px;
        }

        /* FORM */
        .form-label{
            font-size: 14px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 10px;
        }

        .form-control-custom{
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
            /* cursor: not-allowed; */
        }

        .form-control-custom:focus{
            border-color: #0284C7;
            box-shadow: 0 0 0 4px rgba(2,132,199,.1);
        }

        textarea.form-control-custom{
            height: 120px;
            padding-top: 16px;
            resize: none;
        }

        .form-select-custom{
            width: 100%;
            height: 52px;
            border: 1px solid #CBD5E1;
            border-radius: 14px;
            padding: 0 18px;
            outline: none;
            font-size: 14px;
            background: white;
        }

        /* FOTO */
        .upload-box{
            border: 2px dashed #CBD5E1;
            border-radius: 24px;
            padding: 40px 20px;
            text-align: center;
            background: #F8FAFC;
        }

        .upload-icon{
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #E0F2FE;
            color: #0284C7;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 34px;
        }

        .upload-title{
            font-weight: 700;
            margin-top: 18px;
            color: #0F172A;
        }

        .upload-subtitle{
            font-size: 13px;
            color: #94A3B8;
            margin-top: 5px;
        }

        /* BUTTON */
        .btn-simpan{
            background: #0F766E;
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 700;
            transition: .2s;
        }

        .btn-simpan:hover{
            background: #115E59;
        }

        .btn-batal{
            background: white;
            border: 1px solid #CBD5E1;
            color: #334155;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 700;
        }

        /* RESPONSIVE */
        @media(max-width:1024px){

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

            .page-title{
                font-size: 28px;
            }

            .topbar{
                padding: 14px 16px;
            }

        }

    </style>
</head>
<body>

<div class="d-flex">

    <!-- SIDEBAR -->
    <div class="sidebar">

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

            <a href="/data-murid" class="nav-link-custom active">
                <i class="bi bi-people"></i>
                Data Murid
            </a>

            <a href="/perkembangan-anak" class="nav-link-custom">
                <i class="bi bi-journal-text"></i>
                Input Data Perkembangan
            </a>

            <a href="#" class="nav-link-custom">
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
                <a href="/logout" class="nav-link-custom text-danger">
                    <i class="bi bi-box-arrow-right"></i>
                    Keluar
                </a>
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
                        class="search-input"
                        placeholder="Cari menu...">

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
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <div class="breadcrumb-text">
                        Data Murid /
                        <span class="text-primary fw-bold">
                            Tambah Murid
                        </span>
                    </div>

                    <div class="page-title">
                        Tambah Murid Baru
                    </div>

                    <div class="page-subtitle">
                        Lengkapi data murid untuk pendaftaran baru.
                    </div>

                </div>

                <!-- BUTTON KEMBALI -->
                <a href="/data-murid" class="btn-batal text-decoration-none">

                    <i class="bi bi-arrow-left me-2"></i>

                    Kembali

                </a>

            </div>

            <!-- FORM -->
            <form action="/simpan-murid" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <!-- LEFT -->
                    <div class="col-lg-4 mb-4">

                        <div class="form-card">

                            <div class="upload-box">

                                <div class="upload-icon">
                                    <i class="bi bi-person"></i>
                                </div>

                                <div class="upload-title">
                                    Upload Foto Murid
                                </div>

                                <div class="upload-subtitle">
                                    PNG / JPG Maksimal 2MB
                                </div>

                                <input
                                    type="file"
                                    class="form-control mt-4"
                                    name="foto">

                            </div>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-lg-8">

                        <!-- INFORMASI ANAK -->
                        <div class="form-card">

                            <div class="section-title">
                                Informasi Anak
                            </div>

                            <div class="section-subtitle mb-4">
                                Data utama murid
                            </div>

                            <div class="row">

                                <!-- NAMA -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Nama Lengkap
                                    </label>

                                    <input
                                        type="text"
                                        name="nama_anak"
                                        class="form-control-custom"
                                        placeholder="Masukkan nama lengkap">

                                </div>

                                <!-- KELOMPOK -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Kelompok
                                    </label>

                                    <!-- VALUE YANG DITAMPILKAN -->
                                    <input
                                        type="text"
                                        class="form-control-custom"
                                        value="Kelompok {{ $guru->kelompok }}"
                                        readonly>

                                    <!-- VALUE YANG DIKIRIM -->
                                    <input
                                        type="hidden"
                                        name="kelompok"
                                        value="{{ $guru->kelompok }}">

                                </div>

                                <!-- TEMPAT LAHIR -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Tempat Lahir
                                    </label>

                                    <input
                                        type="text"
                                        name="tempat_lahir"
                                        class="form-control-custom"
                                        placeholder="Contoh: Pekanbaru">

                                </div>

                                <!-- TANGGAL LAHIR -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Tanggal Lahir
                                    </label>

                                    <input
                                        type="date"
                                        name="tanggal_lahir"
                                        class="form-control-custom">

                                </div>

                                <!-- JENIS KELAMIN -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Jenis Kelamin
                                    </label>

                                    <select
                                        name="jenis_kelamin"
                                        class="form-select-custom">

                                        <option value="">
                                            Pilih Jenis Kelamin
                                        </option>

                                        <option value="Laki-laki">
                                            Laki-laki
                                        </option>

                                        <option value="Perempuan">
                                            Perempuan
                                        </option>

                                    </select>

                                </div>

                                <!-- AGAMA -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Agama
                                    </label>

                                    <input
                                        type="text"
                                        name="agama"
                                        class="form-control-custom"
                                        placeholder="Masukkan agama">

                                </div>

                            </div>

                        </div>

                        <!-- DATA ORANG TUA -->
                        <div class="form-card">

                            <div class="section-title">
                                Data Orang Tua
                            </div>

                            <div class="section-subtitle mb-4">
                                Informasi wali murid
                            </div>

                            <div class="row">

                                <!-- NAMA ORTU -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Nama Orang Tua
                                    </label>

                                    <input
                                        type="text"
                                        name="nama_ortu"
                                        class="form-control-custom"
                                        placeholder="Masukkan nama orang tua">

                                </div>

                                <!-- NO HP -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Nomor HP
                                    </label>

                                    <input
                                        type="text"
                                        name="no_hp"
                                        class="form-control-custom"
                                        placeholder="08xxxxxxxxxx">

                                </div>

                                <!-- ALAMAT -->
                                <div class="col-12 mb-4">

                                    <label class="form-label">
                                        Alamat Lengkap
                                    </label>

                                    <textarea
                                        name="alamat"
                                        class="form-control-custom"
                                        placeholder="Masukkan alamat lengkap"></textarea>

                                </div>

                                <!-- PASSWORD -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Password Akun
                                    </label>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control-custom"
                                        placeholder="Masukkan password">

                                </div>

                                <!-- EMAIL ORANG TUA -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Email Orang Tua
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control-custom"
                                        placeholder="contoh@gmail.com">

                                </div>

                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-3 justify-content-end mt-4">

                            <a href="/data-murid" class="btn-batal text-decoration-none">
                                Batal
                            </a>

                            <button type="submit" class="btn-simpan">

                                <i class="bi bi-check-circle me-2"></i>

                                Simpan Data

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

    function toggleSidebar(){

        document
            .querySelector('.sidebar')
            .classList
            .toggle('show');

    }

</script>

</body>
</html>