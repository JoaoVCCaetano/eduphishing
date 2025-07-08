<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .preview {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
        }
        .preview img {
            width: 200px;
            height: 180px;
            border-radius: 10px;
            border: 2px solid #000;
            object-fit: cover;
        }
        .preview span {
            margin-top: 10px;
            font-weight: bold;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Envie um email fake</h2>
        <p>O destinatário irá receber um phishing fake para fins educativos e será redirecionado para o presente blog ao inserir seus dados pessoais.</p>
        <form action="email" method="POST" id="emailForm">
            <input type="email" name="email" placeholder="Digite seu e-mail" required>
            <select name="opcao-select" id="opcao-select">
                <option value="disabled" disabled selected>Escolha uma opção</option>
                <option value="Netflix">Netflix</option>
                <option value="Facebook">Facebook</option>
                <option value="Instagram">Instagram</option>
            </select>

            <div class="preview">
                <img id="preview-img" src="/images/social-media.png" alt="Preview">
                <span>Preview</span>
            </div>

            <button type="submit">Enviar</button>
        </form>

        <!---MODAL DE AVISO --->
            <div id="disclaimerModalOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); z-index: 1000; justify-content: center; align-items: center;">                <div id="disclaimerModalContent" style="background-color: white; padding: 30px; border-radius: 10px; max-width: 550px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.3); transform: scale(0.95); transition: transform 0.3s ease-out; opacity: 0;">
                <h2 style="color: #9c27b0; margin-bottom: 20px; font-size: 24px;">Aviso Importante: Uso Educacional</h2>
                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px; color: #333;">
                    Este sistema é uma simulação de engenharia social (phishing) criada exclusivamente para fins <strong>educacionais e de conscientização</strong>.
                    <br><br>
                    Ao prosseguir e enviar o e-mail, você concorda que utilizará esta ferramenta de forma <strong>responsável, ética e sem qualquer intenção maliciosa</strong> para prejudicar terceiros.
                </p>
                <div style="display: flex; justify-content: center; gap: 20px;">
                    <button id="agreeButton" style="background-color: #4CAF50; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; transition: background-color 0.2s ease;">Concordar e Enviar</button>
                    <button id="cancelButton" style="background-color: #f44336; color: white; padding: 12px 25px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; transition: background-color 0.2s ease;">Cancelar</button>
                </div>
            </div>
        </div>
        
        <script>
            const select = document.getElementById('opcao-select');
            const previewImg = document.getElementById('preview-img');

            const images = {
                Netflix: '/images/netflix-preview.png',
                Facebook: '/images/facebook-preview.png',
                Instagram: '/images/instagram-preview.png'
            };

            select.addEventListener('change', function() {
                const value = select.value;
                if (images[value]) {
                    previewImg.src = images[value];
                }
            });
            // --- CÓDIGO DO MODAL CUSTOMIZADO ---
            document.addEventListener('DOMContentLoaded', function() {
                // Obtenha referências aos elementos HTML
                const emailForm = document.querySelector('form'); // Seleciona a primeira tag <form>
                // Se seu formulário tiver um ID, use: document.getElementById('seuFormId'); (e adicione id="emailForm" ao <form>)
                // Ex: <form id="emailForm" action="email" method="POST">

                const sendButton = document.querySelector('button[type="submit"]'); // Seleciona o primeiro botão de submit
                // Se seu botão tiver um ID, use: document.getElementById('seuBotaoDeEnvioId'); (e adicione id="sendEmailButton" ao <button>)

                const modalOverlay = document.getElementById('disclaimerModalOverlay');
                const modalContent = document.getElementById('disclaimerModalContent'); 
                const agreeButton = document.getElementById('agreeButton');
                const cancelButton = document.getElementById('cancelButton');

                let formSubmissionConfirmed = false; // Flag para controlar o envio do formulário

                // --- Funções para mostrar e esconder o modal ---
                function showModal() {
                    modalOverlay.style.display = 'flex'; 
                    // Pequeno atraso para que a transição CSS funcione
                    setTimeout(() => {
                        modalContent.style.transform = 'scale(1)';
                        modalContent.style.opacity = '1';
                    }, 10); 
                }

                function hideModal() {
                    modalContent.style.transform = 'scale(0.95)';
                    modalContent.style.opacity = '0';
                    // Atraso para esconder totalmente depois da transição
                    setTimeout(() => {
                        modalOverlay.style.display = 'none';
                    }, 300); // Deve ser igual ou maior que a duração da transição CSS
                }


                // --- Intercepta o envio do formulário ---
                if (emailForm) {
                    emailForm.addEventListener('submit', function(event) {
                        if (!formSubmissionConfirmed) {
                            event.preventDefault(); // IMPEDE o envio padrão do formulário
                            showModal(); // Mostra o modal de aviso
                        }
                        // Se formSubmissionConfirmed for true, o formulário será enviado normalmente
                    });
                } else {
                    console.warn("Formulário <form> não encontrado para o evento de submit. O modal pode não funcionar como esperado.");
                }

                // --- Listener para o botão "Concordar e Enviar" ---
                if (agreeButton) {
                    agreeButton.addEventListener('click', function() {
                        hideModal(); // Esconde o modal
                        formSubmissionConfirmed = true; // Sinaliza que o usuário concordou
                        
                        // Envia o formulário programaticamente
                        if (emailForm) {
                            emailForm.submit(); 
                        } else {
                            console.error("Não foi possível enviar o formulário, a tag <form> não foi encontrada ou não tem um ID correto.");
                        }
                    });
                }

                // --- Listener para o botão "Cancelar" ---
                if (cancelButton) {
                    cancelButton.addEventListener('click', function() {
                        hideModal(); // Esconde o modal. O formulário não será enviado.
                        formSubmissionConfirmed = false; // Garante que o envio não aconteça
                    });
                }
            });
            // --- FIM DO CÓDIGO DO MODAL CUSTOMIZADO ---

        </script>
    </div>
</body>
</html>
