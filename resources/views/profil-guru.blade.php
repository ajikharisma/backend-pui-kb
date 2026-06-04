<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru - KB Nurul'Ain</title>

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

        .form-control-custom:focus{
            border-color: #0284C7;
            box-shadow: 0 0 0 4px rgba(2,132,199,.1);
        }

        .form-select-custom{
            width: 100%;
            height: 52px;
            border: 1px solid #CBD5E1;
            border-radius: 14px;
            padding: 0 18px;
            background: #F8FAFC;
            font-size: 14px;
        }

        textarea.form-control-custom{
            min-height: 120px;
            padding-top: 16px;
            resize: none;
        }

        .student-photo{
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #E0F2FE;
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

            .page-title{
                font-size: 28px;
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

            <a href="/profil-guru" class="nav-link-custom active">
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
        <header class="topbar d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-3">
                <button class="btn d-lg-none border-0 px-0" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-2"></i>
                </button>
                <div>
                    <div class="fw-bold" style="font-size:15px;">Profil Biodata Guru</div>
                    <div style="font-size:12px;color:#94A3B8;">Kelola informasi akun Anda secara langsung</div>
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
                    <img src="{{ asset('storage/' . $guru->foto) }}" class="profile-img">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=0ea5e9&color=fff" class="profile-img">
                @endif
            </div>

        </header>

        <!-- CONTENT -->
        <div class="content">

            <div class="breadcrumb-text">
                Dashboard /
                <span class="text-primary fw-bold">
                    Profil Guru
                </span>
            </div>

            <div class="page-title">
                Profil Guru
            </div>

            <div class="page-subtitle">
                Kelola informasi akun dan biodata guru.
            </div>

            <!-- CARD -->
            <div class="form-card">

                <div class="section-title">
                    Informasi Guru
                </div>

                <div class="section-subtitle mb-4">
                    Data lengkap profil guru
                </div>

                <form
                    action="{{ route('profil-guru.update') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- FOTO -->
                        <div class="col-12 text-center mb-5">

                            @if($guru->foto)

                                <img
                                    src="{{ asset('storage/' . $guru->foto) }}"
                                    class="student-photo mb-3">

                            @else

                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=0ea5e9&color=fff"
                                    class="student-photo mb-3">

                            @endif

                            <div>
                                <input
                                    type="file"
                                    name="foto"
                                    class="form-control mt-3">
                            </div>

                        </div>

                        <!-- ID GURU -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                ID Guru
                            </label>

                            <input
                                type="text"
                                value="{{ $guru->id_guru }}"
                                class="form-control-custom bg-light"
                                readonly>

                        </div>

                        <!-- ROLE -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Role
                            </label>

                            <input
                                type="text"
                                value="{{ $user->role }}"
                                class="form-control-custom bg-light"
                                readonly>

                        </div>

                        <!-- NAMA -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="nama"
                                value="{{ $user->nama }}"
                                class="form-control-custom">

                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ $user->email }}"
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

                        <!-- KELOMPOK -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Kelompok
                            </label>

                            <input
                                type="text"
                                value="{{ $guru->kelompok }}"
                                class="form-control-custom bg-light"
                                readonly>

                        </div>

                        <!-- TANGGAL LAHIR -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label">
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                name="tanggal_lahir"
                                value="{{ $guru->tanggal_lahir }}"
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
                                    {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>

                                <option value="Perempuan"
                                    {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>

                            </select>

                        </div>

                        <!-- ALAMAT -->
                        <div class="col-12 mb-4">

                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea
                                name="alamat"
                                class="form-control-custom">{{ $guru->alamat }}</textarea>

                        </div>

                    </div>

                    <button type="submit" class="btn-simpan">

                        <i class="bi bi-check-circle me-2"></i>

                        Simpan Perubahan

                    </button>

                </form>

            </div>

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