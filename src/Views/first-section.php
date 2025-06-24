<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Section - Content Blocks</title>
    <style>
        /* Basic Reset (ensure these are in your main CSS or at the top) */
        html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light gray background for the page */
        }

        /* --- first-section Styles --- */
        .first-section {
            padding: 60px 20px; /* Padding for the entire section */
            background-color: #f0f0f0; /* Match body background */
            display: flex;
            flex-direction: column;
            align-items: center; /* Center the content blocks */
            gap: 60px; /* Space between each content block */
        }

        .content-block {
            max-width: 1200px; /* Max width for content inside each block */
            width: 100%;
            display: flex;
            align-items: center; /* Vertically align items in the middle */
            gap: 40px; /* Space between text and image */
            padding: 20px 0; /* Padding inside the block if needed */
        }

        .content-block-text {
            flex: 1; /* Allow text to take available space */
            text-align: left;
        }

        .content-block-text h2 {
            font-size: 2.2em;
            color: #4a148c; /* Purple color from your image */
            margin-bottom: 15px;
        }

        .content-block-text p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #333333;
            margin: 0;
        }

        .content-block-image {
            flex-shrink: 0; /* Prevent image from shrinking */
            width: 250px; /* Fixed width for images */
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content-block-image img {
            max-width: 100%; /* Ensure image fits its container */
            height: auto;
            display: block;
        }

        /* Specific alignment for alternating blocks */
        .content-block.image-left {
            flex-direction: row-reverse; /* Image on the left, text on the right */
        }

        /* Responsive Adjustments */
        @media (max-width: 900px) {
            .content-block {
                flex-direction: column; /* Stack text and image vertically */
                text-align: center;
                gap: 30px;
            }

            .content-block-text {
                margin-bottom: 20px; /* Space below text when stacked */
            }

            .content-block.image-left {
                flex-direction: column; /* Ensure stacking even for image-left blocks */
            }
        }

        @media (max-width: 600px) {
            .first-section {
                padding: 40px 15px;
                gap: 40px;
            }

            .content-block-text h2 {
                font-size: 1.8em;
            }

            .content-block-text p {
                font-size: 1em;
            }

            .content-block-image {
                width: 200px; /* Smaller image size on very small screens */
            }
        }
    </style>
</head>
<body>

    <section class="first-section">

        <div class="content-block">
            <div class="content-block-text">
                <h2>Riscos</h2>
                <p>Cair em um golpe de phishing é como abrir a porta da sua casa para um desconhecido dizendo "entra, fica à vontade!". O risco? Seu dinheiro pode ir parar no bolso de um espertinho, suas senhas caem nas mãos erradas e, pior, alguém pode estar por aí se passando por você. Seu computador? Virado em hotel de vírus, com arquivos infectados de brinde. E não para por aí: seus dados pessoais podem vazar pela internet, estilo spoiler de série que ninguém pediu.</p>
            </div>
            <div class="content-block-image">
                <img src="/images/icon-hacking.png" alt="Personagem mascarado">
            </div>
        </div>

        <div class="content-block image-left">
            <div class="content-block-text">
                <h2>Malandro</h2>
                <p>Phishing é aquele golpe que adora se disfarçar de mensagem urgente ou irresistível para te fisgar. Sabe aquele clássico "Parabéns! Você ganhou um iPhone 15!"? Pois é, você nem participou de sorteio, mas o link está lá, brilhando, só esperando você clicar para roubar seus dados.</p>
            </div>
            <div class="content-block-image">
                <img src="/images/money.png" alt="Pilhas de dinheiro">
            </div>
        </div>

        <div class="content-block">
            <div class="content-block-text">
                <h2>Dúvida</h2>
                <p>No final das contas, o phishing usa curiosidade, urgência e promessas boas demais para serem verdadeiras. Clicou no link suspeito? Já era. O segredo é simples: desconfie sempre e pense duas vezes antes de sair clicando por aí!</p>
            </div>
            <div class="content-block-image">
                <img src="/images/question.png" alt="Personagem com ponto de interrogação">
            </div>
        </div>

    </section>

    </body>
</html>