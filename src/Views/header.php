<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
  <style>
    /* Reset básico */
    html, body {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }

    /* Espaço para não esconder conteúdo atrás do header fixo */
    body {
      padding-top: 70px; /* igual à altura do header */
    }

    /* Header fixo */
    .header-section {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      background: #202639;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .header-logo img {
      height: 50px;
    }

    .header-buttons {
      display: flex;
      gap: 10px;
    }

    .header-buttons .btn {
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.2s;
    }

    .header-buttons .registrar {
      background: #6a0dad;
      color: white;
    }

    .header-buttons .registrar:hover {
      background: #550a9e;
    }

    .header-buttons .logar {
      background: #ffffff;
      color: #202639;
      border: 1px solid #202639;
    }

    .header-buttons .logar:hover {
      background: #f0f0f0;
    }

    .fancybox__container {
        z-index: 100000 !important; /* maior que o header */
    }
  </style>
</head>
<body>

  <section class="header-section">
    <div class="header-logo">
      <img src="/images/phishing_logo.png" alt="Phishing Logo">
    </div>
    <div class="header-buttons">
      <button class="btn registrar" onclick="abrirModal('register')">Registrar</button>
      <button class="btn logar" onclick="abrirModal('login')">Logar</button>
    </div>
  </section>

  <script>
    function abrirModal(url) {
      Fancybox.show([{
        src: url,
        type: "iframe",
        width: 1000,
        height: 600,
      }]);
    }
  </script>
</body>
</html>
