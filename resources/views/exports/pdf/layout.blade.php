<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Times New Roman', Georgia, serif; font-size: 11pt; color: #000; padding: 2cm; }
        .kop { display: flex; align-items: center; justify-content: center; border-bottom: 4px double #000; padding-bottom: 12px; margin-bottom: 20px; text-align: center; }
        .kop h1 { font-size: 13pt; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        .kop h2 { font-size: 12pt; font-weight: 700; text-transform: uppercase; margin: 2px 0; }
        .kop p { font-size: 9pt; }
        .kop .italic { font-style: italic; }
        .title-section { text-align: center; margin-bottom: 20px; }
        .title-section h3 { font-size: 12pt; text-decoration: underline; text-transform: uppercase; }
        .title-section p { font-size: 10pt; font-style: italic; margin-top: 4px; }
        table { width: 100%; border-collapse: collapse; font-size: 10pt; margin-bottom: 20px; }
        th { background: #4472C4; color: #fff; font-weight: 700; text-align: left; }
        th, td { border: 1px solid #000; padding: 6px 8px; }
        tr:nth-child(even) { background: #f5f5f5; }
        .footer { margin-top: 30px; font-size: 9pt; font-style: italic; }
        .signature { display: flex; justify-content: space-between; margin-top: 40px; }
        .signature div { text-align: center; width: 45%; }
        .signature .space { height: 60px; }
        .total-row { font-weight: 700; background: #e8e8e8 !important; }
    </style>
</head>
<body>
    {{-- KOP SURAT --}}
    <div class="kop">
        <div>
            <h1>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h1>
            <h2>MADRASAH TSANAWIYAH NEGERI AL IHSAN - RABI</h2>
            <p class="italic">Gambah Dalam, Kec. Kandangan, Kabupaten Hulu Sungai Selatan, Kalimantan Selatan</p>
            <p><strong>Gedung Perpustakaan - Sistem Manajemen Digital</strong></p>
        </div>
    </div>

    <div class="title-section">
        <h3>{{ $title }}</h3>
        <p>Dicetak pada: {{ now()->translatedFormat('l, d F Y – H:i') }} WIB</p>
    </div>

    @yield('content')

    <p class="footer">Dokumen ini digenerate secara otomatis oleh sistem perpustakaan digital MTSN Al Ihsan - Rabi.</p>

    <div class="signature">
        <div>
            <p>Mengetahui,</p>
            <p><strong>Kepala Perpustakaan</strong></p>
            <div class="space"></div>
            <p><strong>_________________________</strong></p>
            <p>NIP. ..............................</p>
        </div>
        <div>
            <p>Kandangan, {{ now()->translatedFormat('d F Y') }}</p>
            <p><strong>Dibuat Oleh,</strong></p>
            <div class="space"></div>
            <p><strong>{{ Auth::user()->name ?? 'Pustakawan' }}</strong></p>
            <p>NIP. {{ Auth::user()->username ?? '..............................' }}</p>
        </div>
    </div>
</body>
</html>
