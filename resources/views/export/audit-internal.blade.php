<!-- Export PDF -->
<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF</title>
    <style>
        :root {
            --blue: #29166f;
        }

        /**
         * A4 Paper size
         */
        body {
            width: 100%;
            height: 100%;
        }

        body > div {
            width: 100%;
            height: 99%;
            /*margin: 6% 5% 5% 5%;*/
        }

        h1, h2, h3, h4, h5, h6, p {
            margin: 0;
        }

        table {
            margin-top: 5mm;
        }

        a {
            text-decoration: none;
        }

        span {
            font-family: 'DejaVu Sans', sans-serif;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .table-text-center {
            vertical-align: middle !important;
        }

        .no-border-top {
            border-top: none !important;
        }

        .no-border-bottom {
            border-bottom: none !important;
        }

        .no-border-right {
            border-right: none !important;
        }

        .no-border-left {
            border-left: none !important;
        }

        .bg-grey {
            background-color: #eaeaea;
        }

        /**
         * Cover
         */

        .page-break {
            page-break-after: always;
        }

        .cover {
            border: 5px solid black;
            background-color: white;
            margin-top: -35mm;
            z-index: 5;
        }

        .img-logo {
            height: 10%;
            width: auto;
        }

        .logo-left {
            float: left;
            margin-right: 5mm;
        }

        .logo-right {
            float: right;
        }

        .box {
            width: 90%;
            height: 90%;
            margin: 5%;
            position: relative;
            display: block;
        }

        .cover-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 80%;
            position: relative;
        }

        .cover-content table {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 14pt;
        }

        .cover-content table tr td:first-child {
            padding-right: 5mm;
        }

        .cover-content h1, .cover-content h2 {
            font-weight: bold;
        }

        .cover-content h1 {
            padding-top: 15%;
        }

        .cover-content h3 {
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /**
         * Pelaksanaan Audit
         */
        .header * {
            color: blue;
        }

        .header > h4 {
            margin: 0;
            padding: 2mm 0 0;
            font-size: 12pt;
            font-weight: bold;
        }

        .header > h6 {
            margin: 1mm;
            padding: 0 0 2mm;
            font-size: 9pt;
            text-decoration: none;
        }

        .content {
            /*min-height: 90%;*/
        }

        .content table, .content table td {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 12pt;
        }

        .content table td {
            vertical-align: top;
            padding: 1mm;
        }

        .content table td ol {
            margin: 0;
        }

        .img-signature {
            width: 25mm;
        }

        header {
            position: fixed;
            top: -35mm;
            left: 0;
            right: 0;
            z-index: 1;
        }

        main {
            z-index: 2;
        }

        @page {
            margin: 45mm 10mm 10mm;
        }
    </style>
</head>
<body>
<?php
$kriteria = [
    "Visi, Misi, Tujuan dan Sasaran, Kriteria",
    "Tata Pamong, Tata Kelola dan Kerjasama",
    "Mahasiswa",
    "Sumber Daya Manusia",
    "Keuangan, Sarana dan Prasarana",
    "Pendidikan",
    "Penelitian",
    "Pengabdian kepada masyarakat",
    "Luaran dan Capaian Tridarma"
];
$temuan_type = ['Minor', 'Mayor', 'Observasi', 'Positive'];
$logo_udinus = getImageFromPathToBase64(public_path("assets/image/logo-udinus.jpg"));
$logo_lpm = getImageFromPathToBase64(public_path("assets/image/logo-lpm.png"));
$signature = getImageFromPathToBase64(public_path("assets/image/example-signature.png"));
?>

<header class="header">
    <img src="{{ $logo_udinus }}" alt="Logo Udinus" class="img-logo logo-left">
    <img src="{{ $logo_lpm }}" alt="Logo LPM" class="img-logo logo-right">
    <h4 class="text-center">
        UNIVERSITAS DIAN NUSWANTORO <br>
        KANTOR PENJAMINAN MUTU
    </h4>
    <h6 class="text-center">
        Jl. Imam Bonjol 207, Semarang 50131 <br>
        Email : <a href="mailto:sekretariat@kpm.dinus.ac.id">sekretariat@kpm.dinus.ac.id</a>,
        Telp: <a href="tel:0243517261">024-3517261</a>,
        Fax: 024-3569684
    </h6>
</header>

<main>
    <!-- Cover -->
    <div style="display: block;" class="page-break cover">
        <div class="header">
            <img src="{{ $logo_udinus }}" alt="Logo Udinus" class="img-logo logo-left" style="margin-left: 5mm;margin-top: 5mm;">
            <img src="{{ $logo_lpm }}" alt="Logo LPM" class="img-logo logo-right" style="margin-right: 5mm;margin-top: 5mm;">
        </div>

        <div class="box">
            <div class="cover-content">
                <h1 class="text-center" style="margin-top: 30%;">
                    LAPORAN <br> AUDIT MUTU INTERNAL
                </h1>

                <table>
                    <tr>
                        <td>Fakultas</td>
                        <td>: Ilmu Komputer</td>
                    </tr>
                    <tr>
                        <td>Auditee</td>
                        <td>: Dr. Abdul Syukur</td>
                    </tr>
                    <tr>
                        <td>Ketua Auditor</td>
                        <td>: Dr. Drs. Agus Prayitno, M.M.</td>
                    </tr>
                    <tr>
                        <td>Anggota Auditor</td>
                        <td>: Juli Ratnawati, SE, M.Si</td>
                    </tr>
                    <tr>
                        <td>Siklus/Tahun</td>
                        <td>: 1/2022</td>
                    </tr>
                </table>

                <h3 class="text-center">
                    KANTOR PENJAMINAN MUTU <br> UNIVERSITAS DIAN NUSWANTORO <br> 2022
                </h3>
            </div>
        </div>
    </div> <!-- ./ Cover -->

    <!-- Information -->
    <div style="display: block;" class="page-break">
        <div class="content">
            <h3 class="text-center">LAPORAN AUDIT MUTU INTERNAL <br> UNIVERSITAS DIAN NUSWANTORO</h3>
            <table>
                <tr>
                    <td colspan="3" class="bg-grey">PELAKSANAAN AUDIT</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey" style="width: 35mm;">Fakultas</td>
                    <td colspan="2">Ilmu Komputer</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey">Tanggal Audit</td>
                    <td colspan="2">23 September 2022</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey">Tujuan</td>
                    <td colspan="2">Konfirmasi kelengkapan dokumen 9 kriteria APS 4.0</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey">Lingkup Audit</td>
                    <td colspan="2">9 kriteria APS 4.0</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey">Kriteria Audit</td>
                    <td colspan="2">
                        <ol>
                            @foreach($kriteria as $i => $value)
                                <li>{{ $value }}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>

                <tr>
                    <td colspan="3" class="bg-grey">Ringkasan Hasil</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey"><span>&Sigma;</span>Positive</td>
                    <td colspan="2">3</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey"><span>&Sigma;</span>Observasi</td>
                    <td colspan="2">10</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey"><span>&Sigma;</span>KTS Minor</td>
                    <td colspan="2">10</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey"><span>&Sigma;</span>KTS Major</td>
                    <td colspan="2">2</td>
                </tr>

                <tr>
                    <td colspan="3" class="bg-grey">Pengesahan</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey">Auditee</td>
                    <td class="text-center" style="width: 80mm">
                        <img src="{{ $signature }}" alt="Signature" class="img-signature">
                        <br>
                        [Dr. Abdul Syukur]
                    </td>
                    <td class="text-center table-text-center">23 Sept 2022</td>
                </tr>
                <tr>
                    <td class="text-right bg-grey no-border-bottom">Auditor</td>
                    <td class="text-center" style="width: 80mm">
                        <img src="{{ $signature }}" alt="Signature" class="img-signature">
                        <br>
                        [Dr. Drs. Agus Prayitno, M.M.]
                    </td>
                    <td class="text-center table-text-center">23 Sept 2022</td>
                </tr>
                <tr style="border: none;">
                    <td class="bg-grey no-border-top"></td>
                    <td class="text-center">
                        [Juli Ratnawati, SE, M.Si]
                    </td>
                    <td class="text-center table-text-center"></td>
                </tr>
            </table>
        </div>
    </div> <!-- Information -->

    <!-- Kelangkapan Dokumen -->
    <div style="display: block;" class="page-break">
        <div class="content">
            <h3>I. PENGECEKAN KELENGKAPAN DOKUMEN</h3>
            <table>
                <thead>
                <tr>
                    <td class="bg-grey text-center" style="width: 7mm;"><b>No.</b></td>
                    <td class="bg-grey" style="width: 65mm;"><b>STANDAR</b></td>
                    <td class="bg-grey text-center" style="width: 5mm;"><b><span>&#x2713;</span></b></td>
                    <td class="bg-grey text-center" style="width: 5mm;"><b><span>&#x2715;</span></b></td>
                    <td class="bg-grey"><b>Catatan</b></td>
                </tr>
                </thead>
                @foreach($kriteria as $i => $row)
                    <tr>
                        <td class="text-center">{{ ($i+1) }}.</td>
                        <td>Visi, Misi, Tujuan, dan Sasaran</td>
                        <td class="text-center">{{ rand(5,15) }}</td>
                        <td class="text-center">{{ rand(0,8) }}</td>
                        <td>
                            @if($i == 0)
                                Perlu Disusun : <br>
                                1.3. Rencana Induk Pengembangan <br>
                                1.4. Dokumen Penyusunan, SK Pembentukan TIM, Prosedur Penyusunan Visi Misi
                            @else
                                {!! nl2br($faker->realText($maxNbChars = 500, $indexSize = 2)) !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div> <!-- Kelangkapan Dokumen -->

    <!-- Capaian Standar -->
    <div style="display: block;" class="page-break">
        <div class="content">
            <h3>II. CAPAIAN STANDAR</h3>
            <table>
                <thead>
                <tr>
                    <td class="bg-grey text-center" style="width: 7mm;"><b>No.</b></td>
                    <td class="bg-grey" style="width: 65mm;"><b>KRITERIA</b></td>
                    <td class="bg-grey text-center"><b>STANDAR</b></td>
                    <td class="bg-grey text-center"><b>CAPAIAN</b></td>
                    <td class="bg-grey"><b>KET.</b></td>
                </tr>
                </thead>
                @foreach($kriteria as $i => $row)
                    <tr>
                        <td class="text-center">{{ ($i+1) }}.</td>
                        <td>{!! nl2br($faker->realText($maxNbChars = 30, $indexSize = 1)) !!}</td>
                        <td>{!! nl2br($faker->realText($maxNbChars = 300, $indexSize = 1)) !!}</td>
                        <td class="text-center">{{ rand(0,100) }}%</td>
                        <td class="text-center">{{ (rand(0,1) === 0 ? 'BELUM MEMENUHI' : 'MEMENUHI') }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div> <!-- Capaian Standar -->

    <!-- Daftar Temuan -->
    <div style="display: block;" class="page-break">
        <div class="content">
            <h3>III. DAFTAR TEMUAN</h3>
            <table>
                <thead>
                <tr>
                    <td class="bg-grey text-center" style="width: 7mm;"><b>No.</b></td>
                    <td class="bg-grey" style="width: 25mm;"><b>Temuan</b></td>
                    <td class="bg-grey" style="width: 35mm;"><b>Referensi</b></td>
                    <td class="bg-grey" style="width: 60mm;"><b>Pernyataan</b></td>
                    <td class="bg-grey"><b>Bukti</b></td>
                </tr>
                </thead>
                @for($i= 1;$i<=rand(10,15);$i++)
                    <tr>
                        <td class="text-center">{{ ($i) }}.</td>
                        <td>{{ $temuan_type[array_rand($temuan_type)] }}</td>
                        <td>{{ $faker->realText($maxNbChars = 30, $indexSize = 1) }}</td>
                        <td>{{ $faker->realText($maxNbChars = 500, $indexSize = 1) }}</td>
                        <td>{{ $faker->realText($maxNbChars = 400, $indexSize = 1) }}</td>
                    </tr>
                @endfor
            </table>
        </div>
    </div> <!-- Daftar Temuan -->

    <!-- Rekomendasi Perbaikan -->
    <div style="display: block;" class="page-break">
        <div class="content">
            <h3>IV. REKOMENDASI PERBAIKAN</h3>
            <table>
                <thead>
                <tr>
                    <td class="bg-grey text-center" style="width: 7mm;"><b>No.</b></td>
                    <td class="bg-grey" style="width: 25mm;"><b>Area</b></td>
                    <td class="bg-grey" style="width: 60mm;"><b>Rekomendasi Perbaikan</b></td>
                    <td class="bg-grey" style="width: 35mm;"><b>PIC</b></td>
                    <td class="bg-grey" style=""><b>Target Pemenuhan</b></td>
                    <td class="bg-grey"><b>Paraf Auditee</b></td>
                </tr>
                </thead>
                @for($i= 1;$i<=rand(10,15);$i++)
                    <tr>
                        <td class="text-center">{{ ($i) }}.</td>
                        <td>{{ $kriteria[array_rand($kriteria)] }}</td>
                        <td>{{ $faker->realText($maxNbChars = rand(100,500), $indexSize = 1) }}</td>
                        <td>{{ $faker->jobTitle }}</td>
                        <td>{{ rand(1,3) }} Bulan</td>
                        <td>
                            <img src="{{ $signature }}" alt="Paraf" style="width: 20mm;">
                        </td>
                    </tr>
                @endfor
            </table>
        </div>
    </div> <!-- Rekomendasi Perbaikan -->

    <!-- Daftar Tilik -->
    <div style="display: block;" class="page-break">
        <div class="content">
            <h3 class="text-center">DAFTAR TILIK <br> AUDIT MUTU INTERNAL</h3>
            <table>
                <tr>
                    <td colspan="2"> Tanggal Audit :</td>
                    <td colspan="2"> Program Studi :</td>
                </tr>
                <tr>
                    <td class="bg-grey text-center" style="width: 7mm;"><b>No.</b></td>
                    <td class="bg-grey text-center" style="width: 80mm;"><b>Rincian Pertanyaan</b></td>
                    <td class="bg-grey text-center" style="width: 25mm;"><b>Auditee</b></td>
                    <td class="bg-grey text-center"><b>Elemen Terkait</b></td>
                </tr>
                @for($i = 1; $i <= 6; $i++)
                    <tr>
                        <td class="text-center" style="height: 30mm;">{{ $i }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor
            </table>
        </div>
    </div> <!-- Daftar Tilik -->

    <!-- Daftar Hadir -->
    <div>
        <div class="content">
            <h3 class="text-center">DAFTAR HADIR AUDIT MUTU INTERNAL</h3>

            <div>
                <p style="font-weight: bold;margin-top: 5mm;margin-bottom: 2mm;">
                    Hari
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    : Senin
                </p>
                <div>
                    <div style="float: left">
                        <p style="font-weight: bold;">
                            Tanggal Audit
                            &nbsp;
                            : 3 Mei 2022
                        </p>
                    </div>

                    <div style="float: right">
                        <p style="font-weight: bold;">
                            Tempat
                            &nbsp;
                            : R. Kaprogdi TI
                        </p>
                    </div>
                </div>
            </div>
            <br>

            <table>
                <tr>
                    <td class="bg-grey text-center" style="width: 7mm;"><b>No.</b></td>
                    <td class="bg-grey text-center"><b>Nama</b></td>
                    <td class="bg-grey text-center"><b>Jabatan</b></td>
                    <td class="bg-grey text-center"><b>Tanda Tangan</b></td>
                </tr>
                @for($i = 1; $i <= 15; $i++)
                    <tr>
                        <td class="text-center">{{ $i }}</td>
                        <td>{{ $faker->name }}</td>
                        <td>{{ $faker->jobTitle }}</td>
                        <td></td>
                    </tr>
                @endfor
            </table>

            <p style="margin-top: 10mm;margin-bottom:1mm;padding-left: 1mm;">Semarang, </p>
            <table style="border: none !important;margin-top: 0;">
                <tr style="border: none !important;">
                    <td style="width: 60%;border: none !important;">
                        Ketua Auditor,<br>
                        <img src="{{ $signature }}" alt="Signature" style="height
                        : 30mm;"><br>
                        <b>(Dr. Drs. Agus Prayitno, M.M.)</b>
                    </td>
                    <td style="width: 40%;border: none !important;">
                        Anggota Auditor,<br>
                        <img src="{{ $signature }}" alt="Signature" style="height
                        : 30mm;"><br>
                        <b>(Juli Ratnawati, SE, M.Si)</b>
                    </td>
                </tr>
            </table>
        </div>
    </div> <!-- Daftar Hadir -->
</main>

</body>
</html>
