<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Prevent Phishing</title>
    <style>
        /* Basic Reset (ensure these are in your main CSS or at the top) */
        html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light gray background for the page outside this section */
        }

        /* --- How-To-Prevent Section Styles --- */
        .how-to-prevent-section {
            background-color: #ffffff; /* White background for this section */
            padding: 60px 20px; /* Padding for the entire section */
            display: flex;
            flex-direction: column;
            align-items: center; /* Center the content blocks */
            gap: 80px; /* Space between each prevention block */
        }

        .prevention-block {
            max-width: 1200px; /* Max width for content inside each block */
            width: 100%;
            display: flex;
            align-items: flex-start; /* Align text and image to the top */
            gap: 60px; /* Space between text and image examples */
        }

        .prevention-block-text {
            flex: 1; /* Allow text to take available space */
            text-align: left;
            padding-right: 20px; /* Some padding from the image area */
        }

        .prevention-block-text h2 {
            font-size: 2.2em;
            color: #4a148c; /* Purple color from your image */
            margin-bottom: 20px;
        }

        .prevention-block-text p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #333333;
            margin: 0;
        }

        .prevention-block-text p a {
            color: #007bff; /* Blue for links */
            text-decoration: underline;
        }

        .prevention-block-examples {
            flex-shrink: 0; /* Prevent examples area from shrinking */
            width: 500px; /* Fixed width for the examples area */
            display: flex;
            flex-direction: column;
            gap: 20px; /* Space between example images */
        }

        .prevention-block-examples img {
            max-width: 100%; /* Ensure images fit their container */
            height: auto;
            border: 1px solid #ddd; /* Subtle border for images */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Subtle shadow */
            display: block; /* Remove extra space below images */
        }

        /* Specific alignment for alternating blocks */
        .prevention-block.text-right {
            flex-direction: row-reverse; /* Text on the right, examples on the left */
        }

        .prevention-block.text-right .prevention-block-text {
            padding-left: 20px; /* Padding from the image area */
            padding-right: 0;
        }


        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .prevention-block {
                flex-direction: column; /* Stack text and examples vertically */
                align-items: center; /* Center items when stacked */
                gap: 40px;
            }

            .prevention-block-text {
                padding-right: 0;
                text-align: center; /* Center text when stacked */
            }

            .prevention-block.text-right {
                flex-direction: column; /* Ensure stacking even for text-right blocks */
            }

            .prevention-block.text-right .prevention-block-text {
                 padding-left: 0;
            }

            .prevention-block-examples {
                width: 100%; /* Examples take full width when stacked */
                max-width: 600px; /* Max width for examples when stacked */
                margin: 0 auto; /* Center examples when stacked */
            }
        }

        @media (max-width: 768px) {
            .how-to-prevent-section {
                padding: 40px 15px;
                gap: 60px;
            }

            .prevention-block-text h2 {
                font-size: 1.8em;
            }

            .prevention-block-text p {
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            .how-to-prevent-section {
                padding: 30px 10px;
                gap: 40px;
            }
        }
    </style>
</head>
<body>

    <section class="how-to-prevent-section">

        <div class="prevention-block">
            <div class="prevention-block-text">
                <h2>Verifique o e-mail</h2>
                <p>Para identificar uma tentativa de phishing, observe o endereço de e-mail do remetente: empresas legítimas usam domínios corporativos como <a>@nome_da_empresa.com</a> e não serviços genéricos como <a>@gmail.com</a>, <a>@hotmail.com</a>, <a>@yahoo.com</a>.</p>
            </div>
            <div class="prevention-block-examples">
                <img src="https://via.placeholder.com/500x120?text=Exemplo+Email+1" alt="Exemplo de E-mail de Phishing 1">
                <img src="https://via.placeholder.com/500x200?text=Exemplo+Email+2" alt="Exemplo de E-mail de Phishing 2">
            </div>
        </div>

        <div class="prevention-block text-right">
            <div class="prevention-block-text">
                <h2>Erros visuais</h2>
                <p>O posicionamento das imagens e logotipos pode ajudar a identificar se você está sendo alvo de um ataque. Erros no alinhamento, baixa resolução ou o uso de imagens desatualizadas podem ser indícios de fraude. Erros ortográficos e gramaticais raramente aparecem em mensagens oficiais.</p>
            </div>
            <div class="prevention-block-examples">
                <img src="https://via.placeholder.com/500x250?text=Exemplo+Visual+1" alt="Exemplo de Erro Visual 1">
                <img src="https://via.placeholder.com/500x200?text=Exemplo+Visual+2" alt="Exemplo de Erro Visual 2">
            </div>
        </div>

        <div class="prevention-block">
            <div class="prevention-block-text">
                <h2>O tom da mensagem</h2>
                <p>Fique atento a mensagens que criam senso de urgência ou medo, como "Atualize seus dados agora ou perderá acesso à sua conta."</p>
            </div>
            <div class="prevention-block-examples">
                <img src="https://via.placeholder.com/500x250?text=Exemplo+Tom+1" alt="Exemplo de Tom de Mensagem 1">
                <img src="https://via.placeholder.com/500x200?text=Exemplo+Tom+2" alt="Exemplo de Tom de Mensagem 2">
            </div>
        </div>

    </section>

    </body>
</html>