<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Phishing Awareness</title>
  <style>
    /* ---------------------- RESET ---------------------- */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      color: #333;
      line-height: 1.6;
    }

    img {
      max-width: 100%;
      display: block;
    }

    /* ---------------------- HEADER ---------------------- */
    .explanation-section {
      width: 100%;
      padding: 60px 20px;
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .header-container {
      max-width: 1100px;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      flex-wrap: wrap;
    }

    .header-text {
      font-size: 2em;
      font-weight: 700;
      color: #4a148c;
      line-height: 1.3;
    }

    .header-text .highlight {
      color: #e67c1c;
    }

    .header-image-container {
      flex-shrink: 0;
      width: 300px;
    }

    /* ---------------------- EXPLANATION BOX ---------------------- */
    .explanation-box {
      background-color: #ffffff;
      border-left: 6px solid #e67c1c;
      padding: 24px 32px;
      border-radius: 10px;
      max-width: 900px;
      margin-top: 40px;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      gap: 24px;
    }

    .explanation-box img.email-icon {
      width: 80px;
      height: 80px;
      object-fit: contain;
    }

    .explanation-box p {
      font-size: 1.1em;
      color: #444;
      margin: 0;
    }

    /* ---------------------- FIRST SECTION ---------------------- */
    .first-section {
      padding: 60px 20px;
      background-color: #f0f0f0;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 60px;
    }

    .content-block {
      max-width: 1200px;
      width: 100%;
      display: flex;
      align-items: center;
      gap: 40px;
      background: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
    }

    .content-block-text {
      flex: 1;
      text-align: left;
    }

    .content-block-text h2 {
      font-size: 2em;
      color: #4a148c;
      margin-bottom: 15px;
    }

    .content-block-text p {
      font-size: 1.05em;
      color: #333;
      margin: 0;
    }

    .content-block-image {
      flex-shrink: 0;
      width: 250px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .content-block.image-left {
      flex-direction: row-reverse;
    }

    /* ---------------------- ORANGE SECTION ---------------------- */
    .orange-section {
      background-color: #e67c1c;
      color: #fff;
      padding: 60px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 40px;
      text-align: center;
    }

    .statistic-block {
      max-width: 900px;
    }

    .statistic-block .main-text {
      font-size: 1.4em;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .statistic-block .source-text {
      font-size: 0.95em;
      opacity: 0.9;
    }

    /* ---------------------- HOW TO PREVENT SECTION ---------------------- */
    .how-to-prevent-section {
      padding: 60px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 60px;
      background-color: #fff;
    }

    .prevention-block {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      max-width: 1100px;
      gap: 40px;
    }

    .prevention-block-text {
      flex: 1;
      min-width: 280px;
    }

    .prevention-block-text h2 {
      font-size: 2em;
      color: #4a148c;
      margin-bottom: 15px;
    }

    .prevention-block-text p {
      font-size: 1.05em;
      color: #333;
    }

    .prevention-block-examples {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .prevention-block-examples img {
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 480px;
      max-width: 100%;
    }

    .text-right {
      flex-direction: row-reverse;
    }

    /* ---------------------- HOW TO PROTECT SECTION ---------------------- */
    .how-to-protect-section {
      padding: 80px 20px;
      background-color: #f0f0f0;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 50px;
      text-align: center;
    }

    .section-title-bulb {
      display: flex;
      align-items: center;
      gap: 20px;
      color: #4a148c;
    }

    .section-title-bulb img {
      width: 60px;
      height: 60px;
    }

    .tip-block-wrapper {
      display: flex;
      flex-direction: column;
      gap: 40px;
      max-width: 1000px;
    }

    .tip-block {
      background: #fff;
      border-left: 6px solid #e67c1c;
      border-radius: 10px;
      padding: 30px;
      text-align: left;
      display: flex;
      align-items: flex-start;
      gap: 20px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .tip-block.number-right {
      flex-direction: row-reverse;
      border-left: none;
      border-right: 6px solid #e67c1c;
    }

    .tip-number-circle {
      background: #e67c1c;
      color: #fff;
      font-size: 1.4em;
      font-weight: bold;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .tip-content h3 {
      color: #4a148c;
      margin-bottom: 10px;
    }

    .tip-content p {
      font-size: 1.05em;
      color: #333;
    }

    .tip-example-image {
      margin-top: 15px;
      border-radius: 6px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      max-width: 100%;
    }

    /* ---------------------- RESPONSIVE ---------------------- */
    @media (max-width: 900px) {
      .header-container {
        flex-direction: column;
        text-align: center;
      }

      .content-block {
        flex-direction: column;
        text-align: center;
      }

      .content-block.image-left {
        flex-direction: column;
      }

      .content-block-image {
        width: 200px;
      }

      .tip-block, .tip-block.number-right {
        flex-direction: column;
        text-align: center;
      }
    }

    @media (max-width: 600px) {
      .header-text {
        font-size: 1.6em;
      }

      .content-block-text h2 {
        font-size: 1.6em;
      }

      .content-block-text p {
        font-size: 1em;
      }
    }
  </style>
</head>

<body>
  <!-- ===== Cabeçalho ===== -->
  <section class="explanation-section">
    <div class="header-container">
      <div class="header-text">
        A INTERNET PODE SER <br> MUITO DIVERTIDA. MAS <br>
        A SUA <span class="highlight">SEGURANÇA</span> É <br> COISA SÉRIA
      </div>
      <div class="header-image-container">
        <img src="/images/fishing.gif" alt="Pessoa pescando um computador">
      </div>
    </div>

    <div class="explanation-box">
      <img src="/images/phishing-method.jpg" alt="Phishing Method" class="email-icon">
      <p>
        Phishing é um ataque que tenta roubar seu dinheiro ou a sua identidade fazendo com que você revele informações pessoais, tais como números de cartão de crédito, informações bancárias ou senhas em sites que fingem ser legítimos.
      </p>
    </div>
  </section>

  <!-- ===== Blocos explicativos ===== -->
  <section class="first-section">
    <div class="content-block">
      <div class="content-block-text">
        <h2>Riscos</h2>
        <p>
          Cair em um golpe de phishing é como abrir a porta da sua casa para um desconhecido dizendo "entra, fica à vontade!"...
        </p>
      </div>
      <div class="content-block-image">
        <img src="/images/icon-hacking.png" alt="Personagem mascarado">
      </div>
    </div>

    <div class="content-block image-left">
      <div class="content-block-text">
        <h2>Malandro</h2>
        <p>
          Phishing é aquele golpe que adora se disfarçar de mensagem urgente ou irresistível para te fisgar...
        </p>
      </div>
      <div class="content-block-image">
        <img src="/images/money.png" alt="Pilhas de dinheiro">
      </div>
    </div>

    <div class="content-block">
      <div class="content-block-text">
        <h2>Dúvida</h2>
        <p>
          No final das contas, o phishing usa curiosidade, urgência e promessas boas demais...
        </p>
      </div>
      <div class="content-block-image">
        <img src="/images/question.png" alt="Personagem com ponto de interrogação">
      </div>
    </div>
  </section>

  <!-- ===== Estatísticas ===== -->
  <section class="orange-section">
    <div class="statistic-block">
      <p class="main-text">Uma em cada 4 pessoas no Brasil sofreu tentativas de golpe...</p>
      <p class="source-text">Fonte: Associação de Defesa de Dados Pessoais e do Consumidor</p>
    </div>

    <div class="statistic-block">
      <p class="main-text">Phishing foi detectado em 61% dos ciberataques em 2024...</p>
      <p class="source-text">Fonte: Centro de Operações de Segurança da Appgate</p>
    </div>
  </section>

  <!-- ===== Como identificar ===== -->
  <section class="how-to-prevent-section">
    <div class="prevention-block">
      <div class="prevention-block-text">
        <h2>Verifique o e-mail</h2>
        <p>Observe o endereço do remetente — empresas legítimas usam domínios corporativos como <a>@empresa.com</a>.</p>
      </div>
      <div class="prevention-block-examples">
        <img src="/images/netflix-golpe.jpeg" alt="Exemplo de E-mail 1">
        <img src="/images/governo-fake.png" alt="Exemplo de E-mail 2">
      </div>
    </div>

    <div class="prevention-block text-right">
      <div class="prevention-block-text">
        <h2>Erros visuais</h2>
        <p>Erros de alinhamento, logotipos antigos e falhas ortográficas são sinais de fraude.</p>
      </div>
      <div class="prevention-block-examples">
        <img src="/images/americanas-phishing.jpg" alt="Erro Visual 1">
        <img src="/images/americanas-phishing.jpg" alt="Erro Visual 2">
      </div>
    </div>
  </section>

  <!-- ===== Como se proteger ===== -->
  <section class="how-to-protect-section">
    <div class="section-title-bulb">
      <h2>Então, como se proteger?</h2>
      <img src="/images/icon-idea.png" alt="Lâmpada de Ideia">
    </div>

    <div class="tip-block-wrapper">
      <div class="tip-block">
        <div class="tip-number-circle">1</div>
        <div class="tip-content">
          <h3>Não clique em anexos ou links suspeitos.</h3>
          <p>Passe o mouse sobre o link para verificar o destino antes de clicar.</p>
          <img src="/images/how-to-protect-icon.png" alt="Exemplo de link suspeito" class="tip-example-image">
        </div>
      </div>

      <div class="tip-block number-right">
        <div class="tip-number-circle">2</div>
        <div class="tip-content">
          <h3>Não forneça informações privadas.</h3>
          <p>Empresas legítimas <strong style="color: #f83c3c;">nunca solicitam senhas</strong> por e-mail ou telefone.</p>
        </div>
      </div>

      <div class="tip-block">
        <div class="tip-number-circle">3</div>
        <div class="tip-content">
          <h3>Confirme e denuncie.</h3>
          <p>Entre em contato com a empresa por <strong style="color: #4a148c;">meios oficiais</strong>.</p>
        </div>
      </div>
    </div>
  </section>
</body>
</html>