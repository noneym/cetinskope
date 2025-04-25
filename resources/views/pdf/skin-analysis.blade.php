<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cilt Analiz Raporu - {{ $analysis->name }}</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path(' fonts/DejaVuSans.ttf') }}');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path(' fonts/DejaVuSans-Bold.ttf') }}');
            font-weight: bold;
            font-style: normal;
        }

        body {
            font-family: 'DejaVu Sans', 'Helvetica', 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #ec407a;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #ec407a;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 14px;
            margin-top: 0;
        }

        .logo {
            margin-bottom: 20px;
        }

        .patient-info {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 30px;
        }

        .patient-info h2 {
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 10px;
            color: #333;
        }

        .patient-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .photos {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .photo-container {
            width: 30%;
            text-align: center;
        }

        .photo-container img {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .photo-caption {
            font-size: 12px;
            color: #666;
        }

        .analysis-section {
            margin-bottom: 30px;
        }

        .analysis-section h2 {
            font-size: 20px;
            color: #ec407a;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .section-item {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .section-item h3 {
            font-size: 16px;
            margin-top: 0;
            margin-bottom: 10px;
            color: #ec407a;
        }

        .section-item ul {
            margin: 0;
            padding-left: 20px;
        }

        .section-item li {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }

        .disclaimer {
            font-style: italic;
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }

        .contact {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>CetinScope - Cilt Analiz Raporu</h1>
            <p>Çetinkaya Beauty Yapay Zeka Destekli Cilt Analizi</p>
        </div>

        <div class="patient-info">
            <h2>Kişisel Bilgiler</h2>
            <p><strong>Ad Soyad:</strong> {{ $analysis->name }}</p>
            <p><strong>E-posta:</strong> {{ $analysis->email }}</p>
            <p><strong>Telefon:</strong> {{ $analysis->phone }}</p>
            <p><strong>Analiz Tarihi:</strong> {{ $analysis->created_at->format('d.m.Y H:i') }}</p>
        </div>

        <div class="analysis-section">
            <h2>Cilt Analiz Raporu</h2>

            @foreach($parsedResult as $section => $items)
            <div class="section-item">
                <h3>{{ $section }}</h3>
                <ul>
                    @foreach($items as $item)
                    <li>{!! nl2br(e($item)) !!}</li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>

        <div class="disclaimer">
            <p>Bu rapor yapay zeka teknolojisi kullanılarak otomatik olarak oluşturulmuştur. Profesyonel tıbbi veya estetik danışmanlık yerine geçmez. Detaylı bilgi ve
                kişiselleştirilmiş tedavi planı için lütfen uzmanlarımıza danışınız.</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Çetinkaya Beauty - Tüm Hakları Saklıdır</p>
            <div class="contact">
                <p>Telefon: 0212 123 4567 | E-posta: info@cetinkayabeauty.com</p>
                <p>Adres: İstanbul, Türkiye</p>
                <p>Web: www.cetinscope.com</p>
            </div>
        </div>
    </div>
</body>

</html>