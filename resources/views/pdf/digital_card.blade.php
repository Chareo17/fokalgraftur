<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Digital Alumni</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            width: 380px;
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            border-radius: 25px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(255,255,255,0.2);
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 25px 25px 0 0;
        }
        .card-header {
            position: relative;
            z-index: 2;
            padding: 20px;
            text-align: center;
            color: white;
        }
        .card-header .logo-text {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .card-title {
            font-weight: 600;
            font-size: 1.4rem;
            margin: 0;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }
        .card-subtitle {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-top: 5px;
        }
        .card-body {
            padding: 25px;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        .photo-frame {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border: 3px solid #667eea;
            border-radius: 50%;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            position: relative;
        }
        .photo-frame img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
        .photo-frame .no-photo {
            font-size: 3rem;
            color: #64748b;
        }
        .info-section {
            background: rgba(102, 126, 234, 0.05);
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid rgba(102, 126, 234, 0.1);
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        .info-label::before {
            content: '•';
            color: #667eea;
            font-weight: bold;
            margin-right: 8px;
            font-size: 1.2rem;
        }
        .info-value {
            font-weight: 600;
            font-size: 1rem;
            color: #1e293b;
        }
        .card-footer {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 20px;
            text-align: center;
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 500;
            border-top: 1px solid rgba(102, 126, 234, 0.1);
        }
        .decorative-element {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            z-index: 1;
        }
        .decorative-element-2 {
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="decorative-element"></div>
        <div class="decorative-element-2"></div>
        <div class="card-header">
            <div class="logo-text">USNI</div>
            <h1 class="card-title">ALUMNI</h1>
            <div class="card-subtitle">DIGITAL CARD</div>
        </div>
        <div class="card-body">
            {{-- <div class="photo-frame">
                @if($profile->profile_image)
                    <img src="{{ public_path('storage/' . $profile->profile_image) }}" alt="Foto Profil">
                @else
                    <div class="no-photo">👤</div>
                @endif
            </div> --}}
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">{{ $profile->name ?? '' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jurusan</span>
                    <span class="info-value">{{ $profile->jurusan ?? '' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tahun Lulusan</span>
                    <span class="info-value">{{ $profile->tahun_lulusan ?? '' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nomor Induk Alumni</span>
                    <span class="info-value">{{ $profile->nia ?? '' }}</span>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {{-- <strong>Valid Until: Lifetime</strong><br>
            <small>Universitas Semarang</small> --}}
        </div>
    </div>
</body>
</html>
