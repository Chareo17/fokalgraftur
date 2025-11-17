<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $undangan->judul }} - Undangan Resmi</title>
    <style>
        @page {
            margin: 15mm 20mm;
            size: A4 portrait;
        }
        
        body { 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #2c3e50;
            font-size: 11pt;
            line-height: 1.5;
        }
        
        /* Header */
        .header-logos {
            width: 100%;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #1e3c72;
        }
        
        .header-logos table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .header-logos td {
            vertical-align: middle;
        }
        
        .logo-cell {
            width: 60px;
        }
        
        .logo-cell img {
            width: 50px;
            height: 50px;
        }
        
        .header-center {
            text-align: center;
            padding: 0 15px;
        }
        
        .header-center h1 {
            margin: 0 0 3px 0;
            font-size: 13pt;
            font-weight: bold;
            color: #1e3c72;
            text-transform: uppercase;
        }
        
        .header-center p {
            margin: 0;
            font-size: 9pt;
            color: #666;
        }
        
        /* Judul */
        .document-title {
            text-align: center;
            margin: 15px 0;
            padding: 15px;
            background: #1e3c72;
            color: white;
            border-radius: 5px;
        }
        
        .document-title h2 {
            margin: 0 0 5px 0;
            font-size: 18pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .document-title p {
            margin: 0;
            font-size: 10pt;
            font-style: italic;
        }
        
        /* Info Box */
        .info-box {
            margin: 15px 0;
            padding: 12px 15px;
            background: #f5f5f5;
            border-left: 4px solid #d4af37;
        }
        
        .info-box table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-box td {
            padding: 4px 0;
            font-size: 10pt;
        }
        
        .info-label {
            width: 140px;
            font-weight: bold;
            color: #1e3c72;
        }
        
        .info-colon {
            width: 15px;
        }
        
        /* Target */
        .target-section {
            margin: 15px 0;
        }
        
        .target-section h3 {
            font-size: 11pt;
            color: #1e3c72;
            margin: 0 0 8px 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .role-badge { 
            display: inline-block;
            background: #2a5298;
            color: white;
            padding: 6px 16px;
            border-radius: 15px;
            font-size: 10pt;
            font-weight: bold;
            margin-right: 8px;
        }
        
        /* Description */
        .description-box {
            margin: 15px 0;
            padding: 12px 15px;
            background: #fafafa;
            border-left: 4px solid #d4af37;
            border: 1px solid #e0e0e0;
        }
        
        .description-box h3 {
            margin: 0 0 10px 0;
            color: #1e3c72;
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .description-box p {
            margin: 0;
            text-align: justify;
            line-height: 1.6;
            font-size: 10pt;
        }
        
        /* Signature */
        .signature-section {
            margin-top: 25px;
            text-align: right;
        }
        
        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 180px;
        }
        
        .signature-place {
            text-align: left;
            margin-bottom: 5px;
            font-size: 10pt;
        }
        
        .signature-role {
            font-size: 9pt;
            color: #666;
            font-style: italic;
            margin-bottom: 50px;
        }
        
        .signature-name {
            border-top: 2px solid #2c3e50;
            padding-top: 8px;
            font-weight: bold;
            color: #1e3c72;
            font-size: 11pt;
        }
        
        /* Footer */
        .page-footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 8pt;
            color: #888;
        }
        
        .page-footer p {
            margin: 3px 0;
        }
        
        /* Page 2 */
        .page-break {
            page-break-after: always;
        }
        
        .image-page {
            text-align: center;
        }
        
        .image-page img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- HALAMAN 1 -->
    <div class="page-break">
        <!-- Header dengan Logo -->
        <div class="header-logos">
            <table>
                <tr>
                    <td class="logo-cell">
                        @if(file_exists(public_path('assets/img/grafika1.png')))
                            @php
                                $logo1 = base64_encode(file_get_contents(public_path('assets/img/grafika1.png')));
                            @endphp
                            <img src="data:image/png;base64,{{ $logo1 }}" alt="Logo 1">
                        @endif
                    </td>
                    <td class="header-center">
                        <h1>SMK GRAFIKA YAYASAN LEKTUR</h1>
                        <p>Undangan Resmi dari Pihak Sekolah</p>
                    </td>
                    <td class="logo-cell" style="text-align: right;">
                        @if(file_exists(public_path('assets/img/grafika2.png')))
                            @php
                                $logo2 = base64_encode(file_get_contents(public_path('assets/img/grafika2.png')));
                            @endphp
                            <img src="data:image/png;base64,{{ $logo2 }}" alt="Logo 2">
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        
        <!-- Judul -->
        <div class="document-title">
            <h2>{{ $undangan->judul }}</h2>
            <p>Undangan Resmi</p>
        </div>
        
        <!-- Info -->
        <div class="info-box">
            <table>
                <tr>
                    <td class="info-label">Nomor Undangan</td>
                    <td class="info-colon">:</td>
                    <td>{{ str_pad($undangan->id, 5, '0', STR_PAD_LEFT) }}/UND/{{ $undangan->created_at->format('Y') }}</td>
                </tr>
                <tr>
                    <td class="info-label">Dibuat Oleh</td>
                    <td class="info-colon">:</td>
                    <td>{{ $author }}</td>
                </tr>
                <tr>
                    <td class="info-label">Tanggal dibuat</td>
                    <td class="info-colon">:</td>
                    <td>{{ $undangan->created_at->format('d F Y, H:i') }} WIB</td>
                </tr>
            </table>
        </div>
        
        <!-- Target -->
        <div class="target-section">
            <h3>Ditujukan Kepada</h3>
            @if($undangan->role_target)
                @foreach($undangan->role_target as $role)
                    @if($role == 'alumni')
                        <span class="role-badge">ALUMNI</span>
                    @elseif($role == 'siswa')
                        <span class="role-badge">SISWA</span>
                    @endif
                @endforeach
            @endif
        </div>
        
        <!-- Deskripsi -->
        <div class="description-box">
            <h3>Perihal</h3>
            <p>{{ $undangan->deskripsi }}</p>
        </div>
        
        <!-- Tanda Tangan -->
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-place">Jakarta, {{ $undangan->created_at->format('d F Y') }}</div>
                <div class="signature-role">Hormat kami,</div>
                @if($undangan->gambar_barcode_tanda_tangan)
                    @php
                        $barcodePath = storage_path('app/public/' . $undangan->gambar_barcode_tanda_tangan);
                        if (File::exists($barcodePath)) {
                            $barcodeData = File::get($barcodePath);
                            $barcodeExtension = strtolower(pathinfo($undangan->gambar_barcode_tanda_tangan, PATHINFO_EXTENSION));
                            $barcodeMimeType = $barcodeExtension === 'png' ? 'png' : ($barcodeExtension === 'gif' ? 'gif' : 'jpeg');
                            $barcode_base64 = 'data:image/' . $barcodeMimeType . ';base64,' . base64_encode($barcodeData);
                        }
                    @endphp
                    @if(isset($barcode_base64))
                        <div style="text-align: center; margin-bottom: 10px;">
                            <img src="{{ $barcode_base64 }}" alt="Barcode Tanda Tangan" style="max-width: 150px; max-height: 50px;">
                        </div>
                    @endif
                @endif
                <div class="signature-name">{{ $author }}</div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="page-footer">
            <p><strong>Dicetak pada:</strong> {{ now()->format('d F Y, H:i') }} WIB</p>
            <p>Dokumen ID: {{ $undangan->id }} | Dokumen ini sah tanpa tanda tangan basah</p>
        </div>
    </div>
    
    <!-- HALAMAN 2: GAMBAR -->
    @if($undangan->gambar && $gambar_base64)
        @php
            $extension = pathinfo($undangan->gambar, PATHINFO_EXTENSION);
            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
        @endphp
        
        @if($isImage)
            <div class="image-page">
                <img src="{{ $gambar_base64 }}" alt="Lampiran Undangan">
            </div>
        @endif
    @endif
</body>
</html>