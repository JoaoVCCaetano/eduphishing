<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Protect Yourself</title>
    <style>
        /* Basic Reset (ensure these are in your main CSS or at the top) */
        html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light gray background for the page */
        }

        /* --- How-To-Protect Section Styles --- */
        .how-to-protect-section {
            background-color: #ffffff; /* White background for this section */
            padding: 60px 20px; /* Padding for the entire section */
            display: flex;
            flex-direction: column;
            align-items: center; /* Center content horizontally */
            gap: 60px; /* Space between main title/bulb and the first tip */
        }

        .section-title-bulb {
            max-width: 900px; /* Limit width of title block */
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center; /* Center items for larger screens initially */
            gap: 20px; /* Space between title and bulb */
            margin-bottom: 40px; /* Space before the first tip */
        }

        .section-title-bulb h2 {
            font-size: 2.5em;
            color: #4a148c; /* Purple color */
            margin: 0;
            text-align: center;
        }

        .section-title-bulb img {
            height: 100px; /* Adjust bulb image size */
            width: auto;
            flex-shrink: 0; /* Prevent bulb from shrinking */
        }

        .tip-block-wrapper {
            max-width: 900px; /* Max width for the tips container */
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 60px; /* Space between each tip block */
        }

        .tip-block {
            display: flex;
            align-items: flex-start; /* Align number and text to the top */
            gap: 30px; /* Space between number circle and text */
        }

        .tip-number-circle {
            flex-shrink: 0; /* Prevent circle from shrinking */
            width: 70px; /* Size of the number circle */
            height: 70px;
            border-radius: 50%;
            background-color: #4a148c; /* Purple color */
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2em;
            font-weight: bold;
        }

        .tip-content {
            flex: 1; /* Allow content to take available space */
            text-align: left;
        }

        .tip-content h3 {
            font-size: 1.6em;
            color: #333333;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .tip-content p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #555555;
            margin-bottom: 20px; /* Space before image if present */
        }

        .tip-content p strong {
            color: #f83c3c; /* Red color for highlighted words like "dados pessoais" */
        }

        .tip-example-image {
            max-width: 400px; /* Max width for example image */
            width: 100%;
            height: auto;
            border: 1px solid #ddd; /* Subtle border for images */
            box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Subtle shadow */
            display: block; /* Remove extra space below image */
            margin-top: 15px; /* Space from text above */
        }

        /* Specific styles for odd/even tips if numbers are on alternating sides */
        /* Based on the image, numbers seem to be consistently on the left of their text,
           but the *entire block* could alternate, or numbers could swap sides relative to content.
           For now, assuming number always left of its own content. */

        /* To alternate the whole tip block if number is right for some tips (like in image) */
        .tip-block.number-right {
            flex-direction: row-reverse; /* Put number on the right */
            justify-content: flex-end; /* Push content to the right */
        }


        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .how-to-protect-section {
                padding: 40px 15px;
                gap: 40px;
            }

            .section-title-bulb {
                flex-direction: column; /* Stack title and bulb */
                text-align: center;
            }
            .section-title-bulb h2 {
                font-size: 2em;
                margin-bottom: 15px;
            }
            .section-title-bulb img {
                height: 80px;
            }

            .tip-block-wrapper {
                gap: 40px;
            }

            .tip-block, .tip-block.number-right {
                flex-direction: column; /* Stack number and content vertically */
                align-items: center; /* Center them when stacked */
                text-align: center;
                gap: 20px;
            }

            .tip-content h3 {
                font-size: 1.4em;
            }
            .tip-content p {
                font-size: 1em;
            }

            .tip-example-image {
                max-width: 80%; /* Adjust example image size */
            }
        }

        @media (max-width: 480px) {
            .how-to-protect-section {
                padding: 30px 10px;
            }

            .section-title-bulb h2 {
                font-size: 1.8em;
            }

            .section-title-bulb img {
                height: 60px;
            }

            .tip-number-circle {
                width: 60px;
                height: 60px;
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>

    <section class="how-to-protect-section">

        <div class="section-title-bulb">
            <h2>Então, como se proteger?</h2>
            <img src="/images/icon-idea.png" alt="Lâmpada de Ideia">
        </div>

        <div class="tip-block-wrapper">
            <div class="tip-block">
                <div class="tip-number-circle">1</div>
                <div class="tip-content">
                    <h3>Não clique em anexos ou links enviados por e-mails suspeitos.</h3>
                    <p>Dica: Passe o cursor sobre o link para verificar o destino antes de clicar.</p>
                    <img src="/images/how-to-protect-icon.png" alt="Exemplo de link suspeito" class="tip-example-image">
                </div>
            </div>

            <div class="tip-block number-right">
                <div class="tip-number-circle">2</div>
                <div class="tip-content">
                    <h3>Não forneça informações privadas por e-mail, telefone ou SMS.</h3>
                    <p>Empresas legítimas <strong style="color: #f83c3c;">nunca solicitarão seus dados pessoais</strong>, como senhas ou informações bancárias, por esses meios.</p>
                </div>
            </div>

            <div class="tip-block">
                <div class="tip-number-circle">3</div>
                <div class="tip-content">
                    <h3>Confirme e denuncie diretamente com a empresa.</h3>
                    <p>Entre em contato com a empresa por <strong style="color: #4a148c;">meios oficiais</strong>, como o site ou o telefone listado em sua página oficial.</p>
                </div>
            </div>
        </div>

    </section>

    </body>
</html>