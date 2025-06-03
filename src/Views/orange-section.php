<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orange Section - Statistics</title>
    <style>
        /* Basic Reset (ensure these are in your main CSS or at the top) */
        html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light gray background for the page */
        }

        /* --- Orange Section Styles --- */
        .orange-section {
            background-color: #e67e22; /* Similar orange to your footer and previous images */
            color: #ffffff; /* White text color */
            padding: 60px 20px; /* Padding inside the section */
            text-align: center; /* Center align all text content */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 40px; /* Space between the two statistic blocks */
        }

        .statistic-block {
            max-width: 900px; /* Max width for the text content */
            width: 100%; /* Ensure it takes available width up to max-width */
            margin: 0 auto; /* Center the block */
        }

        .statistic-block .main-text {
            font-size: 2.2em; /* Large font size for the main statistic */
            line-height: 1.4;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .statistic-block .source-text {
            font-size: 0.9em; /* Smaller font size for the source */
            line-height: 1.5;
            color: rgba(255, 255, 255, 0.8); /* Slightly less prominent white */
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .orange-section {
                padding: 40px 15px;
                gap: 30px;
                border-width: 3px; /* Slightly thinner border on smaller screens */
            }

            .statistic-block .main-text {
                font-size: 1.8em;
            }
        }

        @media (max-width: 480px) {
            .orange-section {
                padding: 30px 10px;
            }

            .statistic-block .main-text {
                font-size: 1.4em;
            }

            .statistic-block .source-text {
                font-size: 0.8em;
            }
        }
    </style>
</head>
<body>

    <section class="orange-section">

        <div class="statistic-block">
            <p class="main-text">Uma em cada 4 pessoas no Brasil sofreu tentativas de golpe, e cerca de 50% delas foram vítimas.</p>
            <p class="source-text">Fonte: Associação de Defesa de Dados Pessoais e do Consumidor</p>
        </div>

        <div class="statistic-block">
            <p class="main-text">Pesquisa indica phishing como líder do ranking global dos ciberataques em 2024. Nos primeiros meses do ano, a prática foi detectada em 61% das vezes.</p>
            <p class="source-text">Fonte: Centro de Operações de Segurança da Appgate</p>
        </div>

    </section>

    </body>
</html>