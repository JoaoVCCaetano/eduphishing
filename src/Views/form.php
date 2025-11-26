<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Envio de E-mail Fake Educacional</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 30px 15px;
      min-height: 100vh;
      margin: 0;
    }

    .container {
      background: white;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 420px;
      text-align: center;
    }

    h2 {
      margin-bottom: 10px;
      color: #4a148c;
    }

    p {
      font-size: 14px;
      color: #555;
      margin-bottom: 20px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 6px;
      border: 1.5px solid #ccc;
      font-size: 15px;
      transition: border 0.2s;
    }

    input:focus, select:focus {
      border-color: #4a148c;
      outline: none;
    }

    .preview {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 20px;
    }

    .preview img {
      width: 180px;
      height: 160px;
      border-radius: 10px;
      border: 2px solid #4a148c;
      object-fit: cover;
    }

    .preview span {
      margin-top: 8px;
      font-weight: bold;
      color: #4a148c;
    }

    button {
      background-color: #e67c1c;
      color: white;
      padding: 12px 18px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      margin-top: 20px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #d35400;
    }

    /* MODAL AVISO */
    #disclaimerModalOverlay {
      display: none;
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.7);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    #disclaimerModalContent {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      max-width: 550px;
      text-align: center;
      box-shadow: 0 4px 15px rgba(0,0,0,0.3);
      transform: scale(0.95);
      transition: transform 0.3s ease, opacity 0.3s ease;
      opacity: 0;
    }

    #disclaimerModalContent h2 {
      color: #9c27b0;
      margin-bottom: 15px;
    }

    #disclaimerModalContent p {
      font-size: 15px;
      color: #333;
      margin-bottom: 25px;
    }

    #disclaimerModalContent button {
      padding: 10px 22px;
      font-size: 15px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }

    #agreeButton {
      background-color: #4CAF50;
      color: #fff;
    }

    #cancelButton {
      background-color: #f44336;
      color: #fff;
    }
  </style>
</head>
<body>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
?>

  <div class="container">
    <h2>Envie um e-mail fake</h2>
    <p>O destinatário receberá um e-mail de phishing simulado, apenas para fins educativos.</p>

    <form id="emailForm" action="email" method="POST">
      <input type="text" name="sender_name" placeholder="Seu nome" required>
      
      <input type="text" name="recipient_name" placeholder="Nome do destinatário" required>
      
      <input type="email" name="email" placeholder="E-mail do destinatário" required>

      <select name="opcao-select" id="opcao-select" required>
        <option value="" disabled selected>Escolha um modelo</option>
        <option value="Netflix">Netflix</option>
        <option value="Facebook">Facebook</option>
        <option value="Instagram">Instagram</option>
        <option value="Google">Google</option>
      </select>

      <div class="preview">
        <img id="preview-img" src="/images/social-media.png" alt="Preview do e-mail">
        <span>Preview</span>
      </div>

      <button type="submit">Enviar</button>
    </form>
  </div>


  <!-- MODAL DE AVISO -->
  <div id="disclaimerModalOverlay">
    <div id="disclaimerModalContent">
      <h2>Aviso Importante</h2>
      <p>
        Este é um simulador educacional de phishing. Ao enviar, você confirma que está usando para fins
        <strong>éticos e de conscientização</strong>.
      </p>
      <div style="display: flex; justify-content: center; gap: 20px;">
        <button id="agreeButton">Concordar e Enviar</button>
        <button id="cancelButton">Cancelar</button>
      </div>
    </div>
  </div>

  <script>
    // --- Preview dinâmico ---
    const select = document.getElementById('opcao-select');
    const previewImg = document.getElementById('preview-img');
    const images = {
      Netflix: '/images/netflix-preview.png',
      Facebook: '/images/facebook-preview.png',
      Instagram: '/images/instagram-preview.png',
      Google: '/images/google-preview.png'
    };
    select.addEventListener('change', () => {
      previewImg.src = images[select.value] || '/images/social-media.png';
    });

    // --- Modal de confirmação ---
    document.addEventListener('DOMContentLoaded', function () {
      const emailForm = document.getElementById('emailForm');
      const modalOverlay = document.getElementById('disclaimerModalOverlay');
      const modalContent = document.getElementById('disclaimerModalContent');
      const agreeButton = document.getElementById('agreeButton');
      const cancelButton = document.getElementById('cancelButton');
      let confirmed = false;

      function showModal() {
        modalOverlay.style.display = 'flex';
        setTimeout(() => {
          modalContent.style.opacity = '1';
          modalContent.style.transform = 'scale(1)';
        }, 10);
      }

      function hideModal() {
        modalContent.style.opacity = '0';
        modalContent.style.transform = 'scale(0.95)';
        setTimeout(() => {
          modalOverlay.style.display = 'none';
        }, 300);
      }

      emailForm.addEventListener('submit', function (event) {
        if (!confirmed) {
          event.preventDefault();
          showModal();
        }
      });

      agreeButton.addEventListener('click', function () {
        hideModal();
        confirmed = true;
        emailForm.submit();
        // Fecha o Fancybox após o envio, se dentro de iframe:
        if (window.parent && window.parent.jQuery && window.parent.jQuery.fancybox) {
          window.parent.jQuery.fancybox.close();
        }
      });

      cancelButton.addEventListener('click', function () {
        hideModal();
      });
    });
  </script>
</body>
</html>
