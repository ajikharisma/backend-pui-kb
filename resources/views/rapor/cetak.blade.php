<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Rapor - {{ $anak->nama_anak }}</title>
    <style>
        @page {
            margin: 12mm 12mm 12mm 12mm;
        }
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9pt;
            color: #000;
            line-height: 1.3;
        }

        /* ══ HEADER / KOP RAPOR ══ */
        .header-box {
            border: 2px solid #000;
            margin-bottom: 10px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: middle;
            padding: 8px 10px;
        }
        .logo-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #000;
            text-align: center;
            line-height: 56px;
            background: #E0F2FE;
            font-size: 22px;
            color: #0E7490;
            font-weight: 800;
            margin: 0 auto;
        }
        .header-text {
            text-align: center;
        }
        .header-text h2 {
            font-size: 13pt;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .header-text h1 {
            font-size: 11pt;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        .header-text p {
            font-size: 8pt;
            color: #333;
        }
        .header-bottom {
            background: #1E3A5F;
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 10pt;
            font-weight: 800;
            letter-spacing: 1.5px;
            border-top: 1px solid #000;
        }

        /* ══ IDENTITAS ANAK ══ */
        .identitas-box {
            border: 1px solid #000;
            margin-bottom: 10px;
        }
        .identitas-title {
            background: #1E3A5F;
            color: white;
            padding: 4px 10px;
            font-weight: 800;
            font-size: 9.5pt;
            letter-spacing: 1px;
        }
        .identitas-table {
            width: 100%;
            border-collapse: collapse;
            padding: 8px;
        }
        .identitas-foto {
            width: 85px;
            height: 105px;
            border: 1px solid #CBD5E1;
            text-align: center;
            background: #F8FAFC;
        }
        .identitas-data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .identitas-data-table td {
            padding: 2px 4px;
            font-size: 9pt;
            vertical-align: top;
        }
        .identitas-data-table td.label {
            width: 120px;
            font-weight: 600;
        }
        .identitas-data-table td.separator {
            width: 10px;
        }

        /* ══ TABEL CAPAIAN PEMBELAJARAN ══ */
        .aspek-section {
            margin-bottom: 10px;
            page-break-inside: avoid;
        }
        .aspek-title {
            background: #1E3A5F;
            color: white;
            padding: 4px 10px;
            font-weight: 800;
            font-size: 9.5pt;
            border: 1px solid #000;
            border-bottom: none;
        }
        table.capaian {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5pt;
        }
        table.capaian th {
            background: #BFD3E6;
            border: 1px solid #000;
            padding: 5px 6px;
            text-align: center;
            font-weight: 800;
            font-size: 8.5pt;
        }
        table.capaian td {
            border: 1px solid #000;
            padding: 5px 6px;
            vertical-align: top;
        }
        table.capaian td.no-col {
            text-align: center;
            width: 5%;
            font-weight: 700;
        }
        table.capaian td.capaian-col {
            width: 38%;
        }
        table.capaian td.narasi-col {
            width: 57%;
            line-height: 1.4;
            text-align: justify;
        }

        /* ══ TABEL PRESENSI & DDTK ══ */
        .side-by-side-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            page-break-inside: avoid;
        }
        .side-by-side-table td.box-cell {
            vertical-align: top;
        }
        .data-box {
            border: 1px solid #000;
        }
        .data-box-title {
            background: #1E3A5F;
            color: white;
            padding: 4px 8px;
            font-weight: 800;
            font-size: 9pt;
            letter-spacing: .5px;
        }
        table.data-inner {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5pt;
        }
        table.data-inner th {
            background: #BFD3E6;
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            font-weight: 700;
        }
        table.data-inner td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }

        /* ══ TANDA TANGAN ══ */
        .ttd-section {
            border: 1px solid #000;
            padding: 8px;
            margin-top: 10px;
            page-break-inside: avoid;
        }
        .ttd-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        .ttd-table td {
            vertical-align: top;
            width: 33.33%;
            padding: 0 5px;
        }
        .ttd-table p {
            font-size: 8.5pt;
            margin-bottom: 2px;
        }
        .ttd-space {
            height: 45px;
        }
        .ttd-line {
            border-top: 1px solid #000;
            padding-top: 3px;
            font-size: 8.5pt;
            font-weight: 700;
        }
        .ttd-nip {
            font-size: 8pt;
            color: #333;
            margin-top: 1px;
        }

        /* ══ FOOTER NOTE ══ */
        .footer-note {
            margin-top: 8px;
            font-size: 7.5pt;
            color: #555;
            font-style: italic;
            text-align: center;
            border-top: 1px dashed #ccc;
            padding-top: 4px;
        }

        /* ══ PAGE BREAK CONTROL ══ */
        tr { page-break-inside: avoid; }
        thead { display: table-header-group; }
    </style>
</head>
<body>

{{-- ══ HEADER ══ --}}
<div class="header-box">
    <table class="header-table">
        <tr>
            <td style="width: 70px;">
                <div class="logo-circle">KB</div>
            </td>
            <td>
                <div class="header-text">
                    <h2>{{ strtoupper($nama_sekolah ?? 'KB NURUL AIN') }}</h2>
                    <h1>Laporan Capaian Pembelajaran Anak</h1>
                    <p>Jl. [Alamat Sekolah] &bull; Telp. [Nomor Telepon] &bull; Kabupaten Bintan</p>
                </div>
            </td>
            <td style="width: 70px;">
                <div class="logo-circle">KB</div>
            </td>
        </tr>
    </table>
    <div class="header-bottom">LAPORAN CAPAIAN PEMBELAJARAN ANAK (LCPA)</div>
</div>

{{-- ══ IDENTITAS ANAK ══ --}}
<div class="identitas-box">
    <div class="identitas-title">DATA PESERTA DIDIK</div>
    <table class="identitas-table">
        <tr>
            <td style="width: 90px; vertical-align: top;">
                <div class="identitas-foto">
                    @if(isset($anak->foto) && $anak->foto && file_exists(storage_path('app/public/' . $anak->foto)))
                        <img src="{{ storage_path('app/public/' . $anak->foto) }}" style="width:100%; height:103px; object-fit:cover;" alt="Foto">
                    @else
                        <div style="padding-top: 35px; color:#888; font-size:8pt;">Foto<br>Anak</div>
                    @endif
                </div>
            </td>
            <td style="vertical-align: top; padding-left: 10px;">
                <table class="identitas-data-table">
                    <tr>
                        <td class="label">Nama Lengkap</td>
                        <td class="separator">:</td>
                        <td><strong>{{ $anak->nama_anak ?? '-' }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Tahun Pelajaran</td>
                        <td class="separator">:</td>
                        <td>{{ $rapor->tahun_ajaran ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Semester</td>
                        <td class="separator">:</td>
                        <td>{{ $rapor->semester ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Kelompok</td>
                        <td class="separator">:</td>
                        <td>{{ $anak->kelompok ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Fase</td>
                        <td class="separator">:</td>
                        <td>{{ $rapor->fase ?? 'Fase Fondasi' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tempat / Tgl Lahir</td>
                        <td class="separator">:</td>
                        <td>
                            {{ $anak->tempat_lahir ?? '-' }},
                            {{ isset($anak->tanggal_lahir) && $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Nama Orang Tua</td>
                        <td class="separator">:</td>
                        <td>{{ $anak->orangTua?->user?->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Guru Kelas</td>
                        <td class="separator">:</td>
                        <td>{{ $guru ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

{{-- ══ A. NABP ══ --}}
@php
$capaianNABP = [
    1 => "Anak percaya kepada Tuhan Yang Maha Esa, mulai mengenal dan mempraktikkan ajaran pokok sesuai dengan agama dan kepercayaan-Nya",
    2 => "Anak berpartisipasi aktif dalam menjaga kebersihan, kesehatan dan keselamatan diri sebagai bentuk rasa sayang terhadap dirinya dan rasa syukur pada Tuhan Yang Maha Esa",
    3 => "Anak menghargai sesama manusia dengan berbagai perbedaannya dan mempraktikkan perilaku baik dan berakhlak mulia",
    4 => "Anak menghargai alam dengan cara merawatnya dan menunjukkan rasa sayang terhadap makhluk hidup yang merupakan ciptaan Tuhan Yang Maha Esa",
];
@endphp
<div class="aspek-section">
    <div class="aspek-title">A. NILAI AGAMA DAN BUDI PEKERTI</div>
    <table class="capaian">
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th class="capaian-col">Capaian Pembelajaran</th>
                <th class="narasi-col">Tingkat Ketercapaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($capaianNABP as $no => $teks)
            <tr>
                <td class="no-col">{{ $no }}</td>
                <td class="capaian-col">{{ $teks }}</td>
                <td class="narasi-col">
                    {{ $rapor->{'narasi_nabp_' . $no} ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ══ B. JATI DIRI ══ --}}
@php
$capaianJD = [
    1 => "Anak mengenali, mengekspresikan, dan mengelola emosi diri serta membangun hubungan sosial secara sehat",
    2 => "Anak memahami identitas dirinya yang terbentuk oleh ragam minat, kebutuhan, karakteristik gender, agama, dan sosial budaya",
    3 => "Anak mengenal dan memiliki perilaku positif terhadap identitas dan perannya sebagai bagian dari keluarga, sekolah, masyarakat, dan anak Indonesia",
    4 => "Anak menggunakan fungsi gerak (motorik kasar, halus, dan taktil) untuk mengeksplorasi dan memanipulasi berbagai objek dan lingkungan sekitar",
];
@endphp
<div class="aspek-section">
    <div class="aspek-title">B. JATI DIRI</div>
    <table class="capaian">
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th class="capaian-col">Capaian Pembelajaran</th>
                <th class="narasi-col">Tingkat Ketercapaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($capaianJD as $no => $teks)
            <tr>
                <td class="no-col">{{ $no }}</td>
                <td class="capaian-col">{{ $teks }}</td>
                <td class="narasi-col">
                    {{ $rapor->{'narasi_jd_' . $no} ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ══ C. LMSTRS ══ --}}
@php
$capaianLMSTRS = [
    1 => "Anak mengenali dan memahami berbagai informasi, mengomunikasikan perasaan dan pikiran secara lisan, tulisan, atau menggunakan berbagai media serta membangun percakapan",
    2 => "Anak menunjukkan minat, kegemaran, dan berpartisipasi dalam kegiatan pramembaca dan pramenulis",
    3 => "Anak memiliki kemampuan menyatakan hubungan antar bilangan dengan berbagai cara, mengidentifikasi pola, mengenali bentuk dan karakteristik benda di sekitar",
    4 => "Anak mampu menyebutkan alasan, pilihan atau keputusannya, mampu memecahkan masalah sederhana, serta mengetahui hubungan sebab akibat",
    5 => "Anak menunjukkan rasa ingin tahu melalui observasi, eksplorasi, dan eksperimen dengan menggunakan lingkungan sekitar dan media sebagai sumber belajar",
    6 => "Anak menunjukkan kemampuan awal menggunakan dan merekayasa teknologi serta untuk mencari informasi, gagasan, dan keterampilan secara aman dan bertanggung jawab",
    7 => "Anak mengeksplorasi berbagai proses seni, mengekspresikannya, serta mengapresiasi karya seni",
];
@endphp
<div class="aspek-section">
    <div class="aspek-title">C. DASAR-DASAR LITERASI, MATEMATIKA, SAINS, TEKNOLOGI, REKAYASA, DAN SENI</div>
    <table class="capaian">
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th class="capaian-col">Capaian Pembelajaran</th>
                <th class="narasi-col">Tingkat Ketercapaian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($capaianLMSTRS as $no => $teks)
            <tr>
                <td class="no-col">{{ $no }}</td>
                <td class="capaian-col">{{ $teks }}</td>
                <td class="narasi-col">
                    {{ $rapor->{'narasi_lmstrs_' . $no} ?? '-' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ══ PRESENSI & DDTK (SIDE BY SIDE TABLE) ══ --}}
<table class="side-by-side-table">
    <tr>
        {{-- Kehadiran --}}
        <td class="box-cell" style="width: 49%; padding-right: 1%;">
            <div class="data-box">
                <div class="data-box-title">REKAP KEHADIRAN</div>
                <table class="data-inner">
                    <thead>
                        <tr>
                            <th>Hadir</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Tanpa Ket.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $rapor->hadir ?? 0 }} hari</td>
                            <td>{{ $rapor->sakit ?? 0 }} hari</td>
                            <td>{{ $rapor->izin ?? 0 }} hari</td>
                            <td>{{ $rapor->tanpa_keterangan ?? 0 }} hari</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </td>

        {{-- DDTK --}}
        <td class="box-cell" style="width: 49%; padding-left: 1%;">
            <div class="data-box">
                <div class="data-box-title">DETEKSI DINI TUMBUH KEMBANG (DDTK)</div>
                <table class="data-inner">
                    <thead>
                        <tr>
                            <th>Tinggi Badan</th>
                            <th>Berat Badan</th>
                            <th>Lingkar Kepala</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ isset($rapor->tinggi_badan) && $rapor->tinggi_badan ? $rapor->tinggi_badan . ' cm' : '-' }}</td>
                            <td>{{ isset($rapor->berat_badan) && $rapor->berat_badan ? $rapor->berat_badan . ' kg' : '-' }}</td>
                            <td>{{ isset($rapor->lingkar_kepala) && $rapor->lingkar_kepala ? $rapor->lingkar_kepala . ' cm' : '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
</table>

{{-- ══ TANDA TANGAN ══ --}}
<div class="ttd-section">
    <table class="ttd-table">
        <tr>
            <td>
                <p>Mengetahui,</p>
                <p>Orang Tua / Wali</p>
                <div class="ttd-space"></div>
                <div class="ttd-line">
                    {{ $anak->orangTua?->user?->nama ?? '( ....................... )' }}
                </div>
                <div class="ttd-nip">&nbsp;</div>
            </td>
            <td>
                <p>Bintan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Guru Kelompok {{ $anak->kelompok ?? '-' }}</p>
                <div class="ttd-space"></div>
                <div class="ttd-line">{{ $guru ?? '( ....................... )' }}</div>
                <div class="ttd-nip">NIP. -</div>
            </td>
            <td>
                <p>Mengetahui,</p>
                <p>Kepala {{ $nama_sekolah ?? 'KB Nurul Ain' }}</p>
                <div class="ttd-space"></div>
                <div class="ttd-line">( ....................... )</div>
                <div class="ttd-nip">NIP. -</div>
            </td>
        </tr>
    </table>
</div>

{{-- ══ CATATAN KAKI ══ --}}
<div class="footer-note">
    * Rapor ini digenerate secara otomatis oleh Sistem Informasi Perkembangan Anak {{ $nama_sekolah ?? 'KB Nurul Ain' }}
    &bull; Narasi tingkat ketercapaian dibantu oleh Gemini AI berdasarkan data analisis perkembangan anak
</div>

</body>
</html>