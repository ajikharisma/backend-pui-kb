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

        .kop {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
            clear: both;
        }

        .kop-text { 
            text-align: center; 
        }
        .kop-text h2 { font-size: 14pt; font-weight: bold; letter-spacing: 1px; }
        .kop-text h3 { font-size: 12pt; font-weight: bold; }
        .kop-text p  { font-size: 10pt; }

        .judul { text-align: center; margin: 10px 0 14px 0; }
        .judul h1 {
            font-size: 13pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .identitas table { width: 60%; border-collapse: collapse; margin-bottom: 14px; }
        .identitas td { padding: 2px 4px; font-size: 10.5pt; vertical-align: top; }

        .section-title {
            background: #d9d9d9;
            border: 1px solid #000;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 10.5pt;
            margin-bottom: 0;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            font-size: 10pt;
        }

        table.data th {
            background-color: #d9d9d9;
            border: 1px solid #000;
            padding: 5px 6px;
            text-align: center;
            font-weight: bold;
        }

        table.data td {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: top;
        }

        table.data td.center { text-align: center; }

        .badge-bsb { color: #155724; font-weight: bold; }
        .badge-bsh { color: #0c5460; font-weight: bold; }
        .badge-mb  { color: #856404; font-weight: bold; }
        .badge-bb  { color: #721c24; font-weight: bold; }

        .status-global {
            border: 2px solid #000;
            padding: 10px 14px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .status-global .label { font-size: 11pt; font-weight: bold; }
        .status-global .value { font-size: 13pt; font-weight: bold; }

        .rekomendasi-box {
            border: 1px solid #000;
            padding: 10px 12px;
            margin-bottom: 12px;
            font-size: 10pt;
            line-height: 1.6;
            page-break-inside: auto !important; /* Mengizinkan teks memotong halaman secara natural */
        }

        .rekomendasi-box * {
            page-break-inside: avoid; /* Mencegah satu baris kalimat terbelah horizontal di tengah huruf */
        }

        /* ── LAYOUT TANDA TANGAN FORMAL & AMAN UNTUK DOMPDF ── */
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
            clear: both;
            margin-top: 24px;
            font-size: 9.5pt;
            font-style: italic;
            border-top: 1px solid #ccc;
            padding-top: 6px;
        }
    </style>
</head>
<body>

{{-- ── KOP ── --}}
<div class="kop">
    <div class="kop-text">
        <h2>{{ strtoupper($nama_sekolah) }}</h2>
        <h3>LAPORAN HASIL ANALISIS PERKEMBANGAN ANAK</h3>
        <p>Jl. [Alamat Sekolah] &bull; Telp. [Nomor Telepon]</p>
    </div>
</div>

{{-- ── JUDUL ── --}}
<div class="judul">
    <h1>Laporan Hasil Analisis Perkembangan</h1>
    <p style="margin-top:4px; font-size:10.5pt;">
        Periode: {{ $periode }} &bull; Minggu ke-{{ $minggu }} &bull; Tema: {{ $tema }}
    </p>
</div>

{{-- ── IDENTITAS ── --}}
<div class="identitas">
    <table>
        <tr><td width="140">Nama Anak</td><td>:</td><td><strong>{{ $anak->nama_anak }}</strong></td></tr>
        <tr><td>Kelompok</td><td>:</td><td>{{ $kelompok }}</td></tr>
        <tr><td>Guru</td><td>:</td><td>{{ $guru }}</td></tr>
        <tr><td>Semester</td><td>:</td><td>{{ $periode }}</td></tr>
        <tr><td>Minggu ke-</td><td>:</td><td>{{ $minggu }}</td></tr>
        <tr><td>Tanggal Analisis</td><td>:</td><td>{{ $tanggalAnalisis ? \Carbon\Carbon::parse($tanggalAnalisis)->format('d F Y') : '-' }}</td></tr>
        <tr><td>Tanggal Cetak</td><td>:</td><td>{{ $tanggal_cetak }}</td></tr>
    </table>
</div>

{{-- ── STATUS GLOBAL ── --}}
<div class="section-title">A. Kesimpulan Status Perkembangan Global</div>
<div style="border: 2px solid #000; padding: 10px 14px; margin-bottom: 12px;">
    <table width="100%" style="border-collapse:collapse;">
        <tr>
            <td width="50%" style="font-size:11pt;">
                <strong>Status Perkembangan Minggu Ini:</strong>
            </td>
            <td width="50%">
                <strong style="font-size:13pt;">
                    @if($dominanGlobal === 'BSB')
                        <span class="badge-bsb">{{ $statusGlobal }}</span>
                    @elseif($dominanGlobal === 'BSH')
                        <span class="badge-bsh">{{ $statusGlobal }}</span>
                    @elseif($dominanGlobal === 'MB')
                        <span class="badge-mb">{{ $statusGlobal }}</span>
                    @else
                        <span class="badge-bb">{{ $statusGlobal }}</span>
                    @endif
                </strong>
            </td>
        </tr>
    </table>
</div>

{{-- ── HASIL PER ASPEK ── --}}
<div class="section-title">B. Hasil Analisis Per Aspek Perkembangan</div>
<table class="data">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="25%">Aspek</th>
            <th width="15%">Nilai Dominan</th>
            <th width="25%">Status Perkembangan</th>
            <th width="8%">BB</th>
            <th width="8%">MB</th>
            <th width="8%">BSH</th>
            <th width="8%">BSB</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hasilAnalisis as $no => $item)
        <tr>
            <td class="center">{{ $no + 1 }}</td>
            <td>{{ $item['aspek'] }}</td>
            <td class="center">
                <span class="badge-{{ strtolower($item['nilai_dominan']) }}">
                    {{ $item['nilai_dominan'] }}
                </span>
            </td>
            <td>{{ $item['status'] }}</td>
            <td class="center">{{ $item['distribusi']['BB'] }}</td>
            <td class="center">{{ $item['distribusi']['MB'] }}</td>
            <td class="center">{{ $item['distribusi']['BSH'] }}</td>
            <td class="center">{{ $item['distribusi']['BSB'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- ── INDIKATOR LEMAH ── --}}
@php
    $adaLemah = collect($hasilAnalisis)->filter(fn($h) => !empty($h['indikator_lemah']))->isNotEmpty();
@endphp

@if($adaLemah)
<div class="section-title">C. Indikator yang Perlu Perhatian</div>
<table class="data">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="25%">Aspek</th>
            <th width="55%">Indikator</th>
            <th width="15%">Capaian</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($hasilAnalisis as $item)
            @foreach($item['indikator_lemah'] as $ind)
            <tr>
                <td class="center">{{ $no++ }}</td>
                <td>{{ $item['aspek'] }}</td>
                <td>{{ $ind['nama'] ?? '-' }}</td>
                <td class="center">
                    <span class="badge-{{ strtolower($ind['nilai'] ?? 'bb') }}">
                        {{ $ind['nilai'] ?? '-' }}
                    </span>
                </td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endif

{{-- ── REKOMENDASI AI ── --}}
@if($rekomendasiAI)
<div class="section-title">D. Rekomendasi Pendampingan (Gemini AI)</div>
<div class="rekomendasi-box">
    @php
        // 1. Bersihkan simbol hashtag (##) untuk header
        $textCleaned = preg_replace('/#{1,6}\s*/', '', $rekomendasiAI);
        
        // 2. Ubah format **teks** menjadi <strong>teks</strong> menggunakan delimiter regex PHP yang valid ('/')
        $textWithBold = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $textCleaned);
    @endphp

    {!! nl2br($textWithBold) !!}
</div>
@endif

{{-- ── KETERANGAN SKALA ── --}}
<div class="section-title">E. Keterangan Skala Capaian</div>
<table class="data">
    <tr>
        <th width="12%">Kode</th>
        <th width="33%">Keterangan</th>
        <th width="55%">Deskripsi</th>
    </tr>
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
</table>

{{-- ── TANDA TANGAN ELEMEN TABEL MURNI ── --}}
<table class="ttd-table">
    <tr>
        <td width="38%">
            <p>Mengetahui,</p>
            <p>Kepala {{ $nama_sekolah }}</p>
            <div class="ttd-space"></div>
            <div class="ttd-nama-teks">( ....................................... )</div>
            <p style="font-size:9pt;">NIP. -</p>
        </td>

        <td width="24%"></td>

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
    @if($rekomendasiAI)
    &bull; Rekomendasi dihasilkan oleh Gemini AI berdasarkan hasil analisis Rule-Based System
    @endif
</div>

</body>
</html>