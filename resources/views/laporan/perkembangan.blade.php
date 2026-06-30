<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #000;
            line-height: 1.4;
        }

        /* ── KOP ── */
        .kop {
            display: flex;
            align-items: center;
            border-bottom: 3px double #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .kop-text { flex: 1; text-align: center; }
        .kop-text h2 { font-size: 14pt; font-weight: bold; letter-spacing: 1px; }
        .kop-text h3 { font-size: 12pt; font-weight: bold; }
        .kop-text p  { font-size: 10pt; }

        /* ── JUDUL LAPORAN ── */
        .judul {
            text-align: center;
            margin: 10px 0 14px 0;
        }

        .judul h1 {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── IDENTITAS ── */
        .identitas {
            width: 100%;
            margin-bottom: 14px;
        }

        .identitas table {
            width: 60%;
            border-collapse: collapse;
        }

        .identitas td {
            padding: 2px 4px;
            font-size: 10.5pt;
            vertical-align: top;
        }

        .identitas td:nth-child(2) { width: 8px; }

        /* ── TABEL DATA ── */
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            font-size: 10pt;
            table-layout: fixed; /* Memaksa lebar kolom konsisten */
        }

        /* Mencegah satu baris terpotong di tengah-tengah teks */
        table.data tr {
            page-break-inside: avoid !important;
        }

        /* Memunculkan ulang Header otomatis di halaman baru jika terpotong */
        table.data thead {
            display: table-header-group;
        }

        table.data th {
            background-color: #d9d9d9;
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            font-weight: bold;
        }

        table.data td {
            border: 1px solid #000;
            padding: 5px 6px;
            vertical-align: middle;
            word-wrap: break-word; /* Mencegah teks keluar kotak */
        }

        table.data td.center { text-align: center; }
        table.data td.bold   { font-weight: bold; }

        /* ── BADGE NILAI ── */
        .badge-bsb { color: #155724; font-weight: bold; }
        .badge-bsh { color: #0c5460; font-weight: bold; }
        .badge-mb  { color: #856404; font-weight: bold; }
        .badge-bb  { color: #721c24; font-weight: bold; }

        /* ── SECTION TITLE ── */
        .section-title {
            background: #d9d9d9;
            border: 1px solid #000;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 10.5pt;
            margin-bottom: 0;
            page-break-after: avoid;
            margin-top: 14px;
        }

        /* ── TTD ── */
        .ttd-table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
            page-break-inside: avoid;
        }

        .ttd-table td {
            border: none !important;
            padding: 0;
            text-align: center;
            vertical-align: top;
        }

        .ttd-space {
            height: 65px;
        }

        .ttd-nama-teks {
            font-weight: bold;
            border-top: 1px solid #000;
            padding-top: 3px;
            display: block;
            width: 200px;
            margin: 0 auto 5px auto;
        }

        .catatan {
            margin-top: 16px;
            font-size: 9.5pt;
            font-style: italic;
            border-top: 1px solid #ccc;
            padding-top: 6px;
            page-break-inside: avoid;
        }
    </style>
</head>
<body>

{{-- ── KOP SURAT ── --}}
<div class="kop">
    <div class="kop-text">
        <h2>{{ strtoupper($nama_sekolah) }}</h2>
        <h3>LAPORAN DATA PERKEMBANGAN ANAK</h3>
        <p>Jl. [Alamat Sekolah] &bull; Telp. [Nomor Telepon]</p>
    </div>
</div>

{{-- ── JUDUL ── --}}
<div class="judul">
    <h1>Laporan Perkembangan Harian Anak</h1>
    <p style="margin-top:4px; font-size:10.5pt;">
        Periode: {{ $periode }} &bull; Minggu ke-{{ $minggu }} &bull; Tema: {{ $tema }}
    </p>
</div>

{{-- ── IDENTITAS ── --}}
<div class="identitas">
    <table>
        <tr>
            <td width="140">Nama Anak</td>
            <td>:</td>
            <td><strong>{{ $anak->nama_anak }}</strong></td>
        </tr>
        <tr>
            <td>Kelompok</td>
            <td>:</td>
            <td>{{ $kelompok }}</td>
        </tr>
        <tr>
            <td>Guru</td>
            <td>:</td>
            <td>{{ $guru }}</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>:</td>
            <td>{{ $periode }}</td>
        </tr>
        <tr>
            <td>Minggu ke-</td>
            <td>:</td>
            <td>{{ $minggu }}</td>
        </tr>
        <tr>
            <td>Tanggal Cetak</td>
            <td>:</td>
            <td>{{ $tanggal_cetak }}</td>
        </tr>
    </table>
</div>

{{-- ── TABEL PENILAIAN PER ASPEK ── --}}
<div class="section-title">A. Rekapitulasi Penilaian Per Aspek Perkembangan</div>
<table class="data">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 20%;">Aspek Perkembangan</th>
            <th style="width: 40%;">Indikator</th>
            <th style="width: 15%;">Asesmen</th>
            <th style="width: 10%;">Capaian</th>
            <th style="width: 10%;">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($perAspek as $aspek => $items)
            @foreach($items as $idx => $item)
                <tr>
                    {{-- Melepas Rowspan ke struktur flat agar aman di beda halaman --}}
                    <td class="center bold">{{ $loop->first ? $no++ : '' }}</td>
                    <td class="bold">{{ $loop->first ? $aspek : '' }}</td>
                    <td>{{ $item->indikator->nama_indikator ?? '-' }}</td>
                    <td class="center">{{ $item->asesmen->nama_asesmen ?? '-' }}</td>
                    <td class="center">
                        <span class="badge-{{ strtolower($item->nilai) }}">
                            {{ $item->nilai }}
                        </span>
                    </td>
                    <td class="center">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

{{-- ── REKAPITULASI PER HARI ── --}}
<div class="section-title">B. Rekapitulasi Penilaian Per Hari</div>
<table class="data">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 15%;">Tanggal</th>
            <th style="width: 20%;">Topik Harian</th>
            <th style="width: 20%;">Aspek</th>
            <th style="width: 30%;">Indikator</th>
            <th style="width: 10%;">Capaian</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($perHari as $tanggal => $items)
            @foreach($items as $idx => $item)
                <tr>
                    {{-- Rowspan dihilangkan diganti teks repetitif yang jauh lebih aman untuk PDF multi-halaman --}}
                    <td class="center">{{ $loop->first ? $no++ : '' }}</td>
                    <td class="center">
                        {{ $loop->first ? \Carbon\Carbon::parse($tanggal)->format('d/m/Y') : '' }}
                    </td>
                    <td>
                        {{ $loop->first ? ($item->rpph->topik_harian ?? '-') : '' }}
                    </td>
                    <td>{{ $item->indikator->aspek->nama_aspek ?? '-' }}</td>
                    <td>{{ $item->indikator->nama_indikator ?? '-' }}</td>
                    <td class="center">
                        <span class="badge-{{ strtolower($item->nilai) }}">
                            {{ $item->nilai }}
                        </span>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

{{-- ── KETERANGAN SKALA ── --}}
<div class="section-title">C. Keterangan Skala Capaian</div>
<table class="data">
    <thead>
        <tr>
            <th style="width: 15%;">Kode</th>
            <th style="width: 35%;">Keterangan</th>
            <th style="width: 50%;">Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="center badge-bsb">BSB</td>
            <td>Berkembang Sangat Baik</td>
            <td>Anak sudah dapat melakukan secara mandiri dan konsisten</td>
        </tr>
        <tr>
            <td class="center badge-bsh">BSH</td>
            <td>Berkembang Sesuai Harapan</td>
            <td>Anak sudah dapat melakukan sesuai harapan perkembangan usia</td>
        </tr>
        <tr>
            <td class="center badge-mb">MB</td>
            <td>Mulai Berkembang</td>
            <td>Anak mulai dapat melakukan dengan bantuan atau bimbingan</td>
        </tr>
        <tr>
            <td class="center badge-bb">BB</td>
            <td>Belum Berkembang</td>
            <td>Anak belum dapat melakukan meskipun sudah distimulasi</td>
        </tr>
    </tbody>
</table>

{{-- ── TANDA TANGAN ── --}}
<table class="ttd-table">
    <tr>
        <!-- Kolom Kiri: Kepala Sekolah -->
        <td width="38%">
            <p>Mengetahui,</p>
            <p>Kepala {{ $nama_sekolah }}</p>
            <div class="ttd-space"></div>
            <div class="ttd-nama-teks">( ....................................... )</div>
            <p style="font-size:9pt;">NIP. -</p>
        </td>

        <!-- Kolom Penyangga Tengah (Menggeser TTD Guru ke Kiri) -->
        <td width="24%"></td>

        <!-- Kolom Kanan: Guru Kelas -->
        <td width="38%">
            <p>{{ $tanggal_cetak }}</p>
            <p>Guru Kelompok {{ $kelompok }}</p>
            <div class="ttd-space"></div>
            <div class="ttd-nama-teks">( {{ $guru }} )</div>
            <p style="font-size:9pt;">NIP. -</p>
        </td>
    </tr>
</table>

<div class="catatan">
    * Laporan ini digenerate secara otomatis oleh Sistem Informasi Perkembangan Anak {{ $nama_sekolah }}
</div>

</body>
</html>