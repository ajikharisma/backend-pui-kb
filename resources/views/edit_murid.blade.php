<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Murid - KB Nurul'Ain</title>

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

        .breadcrumb-text{
            font-size: 14px;
            color: #94A3B8;
            margin-bottom: 10px;
        }

        .page-title{
            font-size: 34px;
            font-weight: 800;
            color: #0F172A;
        }

        .page-subtitle{
            color: #64748B;
            margin-top: 6px;
        }

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
            margin-bottom: 24px;
        }

        .section-subtitle{
            color: #64748B;
            font-size: 14px;
            margin-top: 4px;
        }

        .form-label{
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

        .form-control-custom:focus{
            outline: none;
            border-color: #0284C7;
            box-shadow: 0 0 0 4px rgba(2,132,199,.1);
        }

        textarea.form-control-custom{
            min-height: 120px;
            resize: none;
        }

        .student-photo{
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #E0F2FE;
        }

        .btn-upload{
            background: #E0F2FE;
            color: #0284C7;
            border: none;
            padding: 10px 18px;
            border-radius: 14px;
            font-weight: 700;
        }

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

        .btn-save:hover{
            background: #0369A1;
        }

        .btn-delete{
            background: #DC2626;
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 700;
        }

        .btn-delete:hover{
            background: #B91C1C;
        }

        .btn-delete:hover{
            background: #FECACA;
        }

        .btn-batal{
            background: white;
            border: 1px solid #CBD5E1;
            color: #334155;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 700;
        }

        .btn-kembali{
            background: white;
            border: 1px solid #CBD5E1;
            color: #334155;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 700;
        }

        .badge-kelompok{
            background: #E0F2FE;
            color: #0284C7;
            padding: 10px 18px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            display: inline-block;
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

            .card-custom{
                padding: 22px;
            }

            .page-title{
                font-size: 28px;
            }

            /* === TAMBAHKAN KODE BARU DI BAWAH INI === */

            /* Foto profil guru mengecil secara pas di HP sesuai standarisasi dashboard */
            .profile-img {
                width: 38px;
                height: 38px;
            }

            /* Membuat baris judul dan tombol kembali responsif */
            .btn-kembali {
                width: 50%;
                text-align: center;
            }

            /* Tombol Batal dan Update Data di paling bawah menjadi full-width bertumpuk */
            .main-content .d-flex.justify-content-end.mt-4.flex-wrap {
                flex-direction: column-reverse; /* Tombol batal di bawah, update di atas */
                gap: 12px !important;
            }

            .btn-batal, .btn-simpan {
                width: 100%;
                text-align: center;
                padding: 14px;
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
        <header class="topbar d-flex justify-content-between align-items-center">

            <div>
                <button
                    class="btn d-lg-none border-0 px-0"
                    onclick="toggleSidebar()">

                    <i class="bi bi-list fs-2"></i>

                </button>
            </div>

            <div class="d-flex align-items-center gap-3">

                <div class="text-end d-none d-sm-block">
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

        <!-- CONTENT -->
        <div class="content">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

                <div>

                    <div class="breadcrumb-text">
                        Data Murid /
                        <span class="text-primary fw-bold">
                            Edit Data Murid
                        </span>
                    </div>

                    <div class="page-title">
                        Edit Data Murid
                    </div>

                    <div class="page-subtitle">
                        Perbarui informasi lengkap murid dan orang tua.
                    </div>

                </div>

                <!-- BUTTON KEMBALI -->
                <a href="/data-murid" class="btn-kembali text-decoration-none">

                    <i class="bi bi-arrow-left me-2"></i>

                    Kembali

                </a>

            </div>

            <form
                action="{{ route('update.murid', $anak->id_anak) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <!-- FOTO -->
                    <div class="form-card text-center col-lg-4">

                        <div class="upload-box">

                            @if($anak->foto)

                                <img
                                    src="{{ asset('storage/' . $anak->foto) }}"
                                    class="student-photo mb-4">

                            @else

                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($anak->nama_anak) }}&background=0ea5e9&color=fff"
                                    class="student-photo mb-4">

                            @endif

                            <div class="upload-title">
                                {{ $anak->nama_anak }}
                            </div>

                            <div class="upload-subtitle">
                                Kelompok {{ $anak->kelompok }}
                            </div>

                            <input
                                type="file"
                                class="form-control mt-4"
                                name="foto">

                        </div>

                    </div>

                    <!-- FORM -->
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
                                        value="{{ $anak->nama_anak }}"
                                        class="form-control-custom">

                                </div>

                                <!-- KELOMPOK -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Kelompok
                                    </label>

                                    <input
                                        type="text"
                                        value="Kelompok {{ $anak->kelompok }}"
                                        class="form-control-custom bg-light"
                                        readonly>

                                </div>

                                <!-- TEMPAT LAHIR -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Tempat Lahir
                                    </label>

                                    <input
                                        type="text"
                                        name="tempat_lahir"
                                        value="{{ $anak->tempat_lahir }}"
                                        class="form-control-custom">

                                </div>

                                <!-- TANGGAL LAHIR -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Tanggal Lahir
                                    </label>

                                    <input
                                        type="date"
                                        name="tanggal_lahir"
                                        value="{{ $anak->tanggal_lahir }}"
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

                                        <option value="Laki-laki"
                                            {{ $anak->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>

                                        <option value="Perempuan"
                                            {{ $anak->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
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
                                        value="{{ $anak->agama }}"
                                        class="form-control-custom">

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

                                <!-- NAMA ORANG TUA -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Nama Orang Tua
                                    </label>

                                    <input
                                        type="text"
                                        name="nama"
                                        value="{{ $user->nama }}"
                                        class="form-control-custom">

                                </div>

                                <!-- NO HP -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Nomor HP
                                    </label>

                                    <input
                                        type="text"
                                        name="no_hp"
                                        value="{{ $user->no_hp }}"
                                        class="form-control-custom">

                                </div>

                                <!-- ALAMAT -->
                                <div class="col-12 mb-4">

                                    <label class="form-label">
                                        Alamat Lengkap
                                    </label>

                                    <textarea
                                        name="alamat"
                                        class="form-control-custom">{{ $orangTua->alamat }}</textarea>

                                </div>

                                <!-- PASSWORD -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Password Baru
                                    </label>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control-custom"
                                        placeholder="Kosongkan jika tidak diganti">

                                </div>

                                <!-- EMAIL -->
                                <div class="col-md-6 mb-4">

                                    <label class="form-label">
                                        Email Orang Tua
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        value="{{ $user->email }}"
                                        class="form-control-custom">

                                </div>

                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-3 justify-content-end mt-4 flex-wrap">

                            <a
                                href="/data-murid"
                                class="btn-batal text-decoration-none">

                                Batal

                            </a>

                            <button
                                type="submit"
                                class="btn-simpan">

                                <i class="bi bi-check-circle me-2"></i>

                                Update Data

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<script>

    function toggleSidebar() {

        document
            .querySelector('.sidebar')
            .classList
            .toggle('show');

    }

</script>

</body>
</html>