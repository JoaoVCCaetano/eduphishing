<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚠️ Você Foi Vítima de um Phishing Educativo!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .alert-icon {
            font-size: 80px;
            margin-bottom: 20px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .content {
            padding: 40px;
        }

        .warning-box {
            background: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .warning-box h2 {
            color: #856404;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .warning-box p {
            color: #856404;
            line-height: 1.6;
            font-size: 16px;
        }

        .info-section {
            margin-bottom: 30px;
        }

        .info-section h3 {
            color: #333;
            margin-bottom: 15px;
            font-size: 22px;
            border-bottom: 2px solid #ff6b6b;
            padding-bottom: 10px;
        }

        .data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .data-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #ff6b6b;
        }

        .data-item label {
            display: block;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
            font-size: 12px;
            text-transform: uppercase;
        }

        .data-item value {
            color: #333;
            word-break: break-word;
            font-size: 14px;
        }

        .tips {
            background: #d1ecf1;
            border-left: 5px solid #0c5460;
            padding: 20px;
            margin-top: 30px;
            border-radius: 5px;
        }

        .tips h3 {
            color: #0c5460;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .tips ul {
            margin-left: 20px;
            color: #0c5460;
        }

        .tips li {
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .sender-info {
            background: #e7f3ff;
            border: 2px solid #2196f3;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }

        .sender-info h3 {
            color: #1976d2;
            margin-bottom: 10px;
        }

        .sender-info p {
            color: #333;
            font-size: 16px;
            margin: 5px 0;
        }

        .sender-info strong {
            color: #1976d2;
        }

        .geolocation-box {
            background: #f8f9fa;
            border: 2px dashed #6c757d;
            padding: 20px;
            border-radius: 8px;
            margin-top: 15px;
            text-align: center;
        }

        #locationInfo {
            margin-top: 15px;
            font-size: 14px;
            color: #333;
        }

        .btn-container {
            text-align: center;
            margin-top: 40px;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 24px;
            }
            
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="alert-icon">⚠️</div>
            <h1>ATENÇÃO! Você Foi Vítima de um Phishing Educativo</h1>
            <p style="font-size: 18px; margin-top: 10px;">Este é um exercício educacional sobre segurança digital</p>
        </div>

        <div class="content">
            <div class="warning-box">
                <h2>🎓 O Que Aconteceu?</h2>
                <p>
                    Você clicou em um link de um e-mail de <strong>phishing educativo</strong>. 
                    Embora este seja um exercício de conscientização, em uma situação real, 
                    um criminoso poderia ter coletado informações sensíveis sobre você.
                </p>
            </div>

            <div class="sender-info">
                <h3>📧 Informações do Remetente</h3>
                <p>Este phishing educativo foi enviado por:</p>
                <p><strong><?= htmlspecialchars($educationalData['sender_name']) ?></strong></p>
                <p><?= htmlspecialchars($educationalData['sender_email']) ?></p>
                <p style="margin-top: 10px; font-size: 14px; color: #666;">
                    Tipo: <?= htmlspecialchars($educationalData['phishing_type']) ?>
                </p>
            </div>

            <div class="info-section">
                <h3>🔍 Dados Que Poderiam Ter Sido Coletados</h3>
                <p style="margin-bottom: 20px; color: #666;">
                    <strong>Importante:</strong> Estes dados são mostrados apenas para fins educacionais. 
                    <span style="color: #ff6b6b; font-weight: bold;">Nenhuma informação está sendo armazenada!</span>
                </p>

                <div class="data-grid">
                    <div class="data-item">
                        <label>🌐 Endereço IP</label>
                        <value><?= htmlspecialchars($educationalData['ip']) ?></value>
                    </div>

                    <div class="data-item">
                        <label>💻 Navegador</label>
                        <value><?= htmlspecialchars($educationalData['browser']) ?></value>
                    </div>

                    <div class="data-item">
                        <label>🖥️ Sistema Operacional</label>
                        <value><?= htmlspecialchars($educationalData['os']) ?></value>
                    </div>

                    <div class="data-item">
                        <label>🌍 Idioma do Navegador</label>
                        <value><?= htmlspecialchars(substr($educationalData['language'], 0, 5)) ?></value>
                    </div>

                    <div class="data-item">
                        <label>📱 User Agent</label>
                        <value style="font-size: 11px;"><?= htmlspecialchars(substr($educationalData['user_agent'], 0, 50)) ?>...</value>
                    </div>

                    <div class="data-item">
                        <label>📍 Origem do Acesso</label>
                        <value><?= htmlspecialchars($educationalData['referer']) ?></value>
                    </div>
                </div>

                <div class="educational-data">
                    <h2>Atenção! Você caiu em um teste de phishing educativo.</h2>
                    <p>Veja abaixo os dados que poderiam ser coletados por um atacante:</p>
                    <ul>
                        <li><strong>Seu IP:</strong> <?php echo htmlspecialchars($educationalData['ip']); ?></li>
                        <li><strong>Informações de tela:</strong> <span id="screenInfo"></span></li>
                        <li><strong>Geolocalização:</strong> <span id="geoInfo"></span></li>
                        <li><strong>Cookies:</strong> <span id="cookieInfo"></span></li>
                        <li><strong>Câmera:</strong> <span id="cameraInfo"></span></li>
                    </ul>
                    <p><em>Esses dados não foram salvos, são exibidos apenas para fins educativos.</em></p>
                </div>
                <script>
                    document.getElementById('screenInfo').textContent = window.screen.width + 'x' + window.screen.height + 'px';
                    document.getElementById('cookieInfo').textContent = document.cookie || 'Nenhum cookie detectado';
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(pos) {
                            document.getElementById('geoInfo').textContent = pos.coords.latitude + ', ' + pos.coords.longitude;
                        }, function() {
                            document.getElementById('geoInfo').textContent = 'Permissão negada ou não disponível';
                        });
                    } else {
                        document.getElementById('geoInfo').textContent = 'Não suportado';
                    }
                    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                        document.getElementById('cameraInfo').textContent = 'Acesso possível via JavaScript';
                    } else {
                        document.getElementById('cameraInfo').textContent = 'Não suportado';
                    }
                </script>
            </div>

            <div class="btn-container">
                <a href="/" class="btn">Entendi! Quero saber como me proteger</a>
            </div>
        </div>

        <div class="footer">
            <p><strong>EduPhishing</strong> - Plataforma Educacional de Conscientização sobre Phishing</p>
            <p>Projeto Acadêmico para Fins Educativos</p>
        </div>
    </div>

    <script>
        // Geolocalização (não salvamos, apenas mostramos)
        document.getElementById('getLocation').addEventListener('click', function() {
            const locationInfo = document.getElementById('locationInfo');
            locationInfo.innerHTML = '<p style="color: #666; margin-top: 10px;">🔄 Obtendo localização...</p>';
            
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude.toFixed(6);
                        const lon = position.coords.longitude.toFixed(6);
                        const accuracy = Math.round(position.coords.accuracy);
                        
                        locationInfo.innerHTML = `
                            <div style="margin-top: 15px; padding: 15px; background: #fff; border-radius: 5px;">
                                <p style="color: #ff6b6b; font-weight: bold;">⚠️ Localização Detectada!</p>
                                <p style="margin-top: 10px;"><strong>Latitude:</strong> ${lat}</p>
                                <p><strong>Longitude:</strong> ${lon}</p>
                                <p><strong>Precisão:</strong> ~${accuracy} metros</p>
                                <p style="margin-top: 10px; font-size: 12px; color: #666;">
                                    Um criminoso poderia usar isso para saber onde você está!
                                </p>
                            </div>
                        `;
                    },
                    function(error) {
                        locationInfo.innerHTML = `
                            <p style="color: #28a745; margin-top: 10px; font-weight: bold;">
                                ✅ Ótimo! Você negou o acesso à localização ou ela não está disponível.
                            </p>
                        `;
                    }
                );
            } else {
                locationInfo.innerHTML = '<p style="color: #666; margin-top: 10px;">Geolocalização não suportada pelo navegador.</p>';
            }
        });

        // Conta cookies (apenas para demonstração)
        document.getElementById('cookieCount').textContent = document.cookie.split(';').filter(c => c.trim()).length || 'Nenhum';

        // Informações adicionais que poderiam ser coletadas
        console.log('👁️ DADOS DETECTÁVEIS VIA JAVASCRIPT (não salvos):');
        console.log('Resolução de Tela:', screen.width + 'x' + screen.height);
        console.log('Fuso Horário:', Intl.DateTimeFormat().resolvedOptions().timeZone);
        console.log('Idioma:', navigator.language);
        console.log('Plataforma:', navigator.platform);
        console.log('Cookies Habilitados:', navigator.cookieEnabled);
    </script>
</body>
</html>
