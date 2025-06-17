<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acte de Mariage</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 20px;
            color: #000;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 15px;
            position: relative;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .republic {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 15px 0;
            text-transform: uppercase;
        }
        .subtitle {
            font-size: 18px;
            margin-bottom: 15px;
        }
        .content {
            margin: 20px 0;
            line-height: 1.5;
            text-align: justify;
        }
        .field {
            margin-bottom: 10px;
        }
        .field-label {
            font-weight: bold;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 10px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
            width: 40%;
            float: right;
        }
        .officer-title {
            font-weight: bold;
            margin-bottom: 60px;
        }
        .officer-name {
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            border-top: 1px solid #000;
            padding-top: 10px;
            clear: both;
        }
        .verification {
            margin-top: 20px;
            font-size: 10px;
            text-align: center;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.05);
            z-index: -1;
        }
        .coat-of-arms {
            text-align: center;
            margin-bottom: 10px;
        }
        .coat-of-arms img {
            height: 80px;
        }
        .stamp {
            position: absolute;
            bottom: 100px;
            left: 50px;
            width: 100px;
            height: 100px;
            border: 2px dotted #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-15deg);
            opacity: 0.7;
        }
        .stamp-text {
            font-weight: bold;
            font-size: 12px;
            text-align: center;
        }
        .doc-number {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 12px;
            font-weight: bold;
        }
        .qr-code {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="watermark">OFFICIEL</div>
        
        <div class="doc-number">N° {{ $demande->numero_acte ?? 'XXXXXX' }}</div>
        
        <div class="header">
            <div class="republic">RÉPUBLIQUE DE CÔTE D'IVOIRE</div>
            <div class="republic">Union - Discipline - Travail</div>
            <div class="coat-of-arms">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('photos/armoiries.png'))) }}" alt="Armoiries">
            </div>
            <div class="title">EXTRAIT D'ACTE DE MARIAGE</div>
            <div class="subtitle">État Civil - Commune de {{ $commune ?? 'Abidjan' }}</div>
        </div>
        
        <div class="content">
            <p>
                Il est certifié qu'un mariage a été célébré le <strong>{{ \Carbon\Carbon::parse($acteMariage->date_mariage)->format('d/m/Y') }}</strong> 
                à <strong>{{ ucwords($acteMariage->lieu_mariage) }}</strong>.
            </p>
            
            <div class="section">
                <div class="section-title">ÉPOUX</div>
                <div class="field">
                    <span class="field-label">NOM:</span> {{ strtoupper($acteMariage->nom_epoux) }}
                </div>
                <div class="field">
                    <span class="field-label">PRÉNOMS:</span> {{ ucwords($acteMariage->prenoms_epoux) }}
                </div>
                <div class="field">
                    <span class="field-label">NÉ LE:</span> {{ \Carbon\Carbon::parse($acteMariage->date_naissance_epoux)->format('d/m/Y') }}
                </div>
                <div class="field">
                    <span class="field-label">À:</span> {{ ucwords($acteMariage->lieu_naissance_epoux) }}
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">ÉPOUSE</div>
                <div class="field">
                    <span class="field-label">NOM:</span> {{ strtoupper($acteMariage->nom_epouse) }}
                </div>
                <div class="field">
                    <span class="field-label">PRÉNOMS:</span> {{ ucwords($acteMariage->prenoms_epouse) }}
                </div>
                <div class="field">
                    <span class="field-label">NÉE LE:</span> {{ \Carbon\Carbon::parse($acteMariage->date_naissance_epouse)->format('d/m/Y') }}
                </div>
                <div class="field">
                    <span class="field-label">À:</span> {{ ucwords($acteMariage->lieu_naissance_epouse) }}
                </div>
            </div>
            
            <div class="field">
                <span class="field-label">ACTE DRESSÉ LE:</span> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
            </div>
        </div>
        
        <div class="stamp">
            <div class="stamp-text">ÉTAT CIVIL<br>RÉPUBLIQUE DE<br>CÔTE D'IVOIRE</div>
        </div>
        
        <div class="signature">
            <div class="officer-title">L'Officier d'État Civil</div>
            <div class="officer-name">{{ $officier ?? 'Nom de l\'Officier' }}</div>
        </div>
        
        <div class="footer">
            Le présent extrait est délivré pour servir et valoir ce que de droit.
        </div>
        
        <div class="verification">
            La validité de ce document peut être vérifiée en ligne sur {{ config('app.url') }}/verification/{{ $demande->uuid_verification ?? '' }}
        </div>
        
        
    </div>
</body>
</html>