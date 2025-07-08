<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Basic Reset */
        html, body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light gray background for the page outside the header */
        }

        /* Header Section Styles */
        .header-section {
            background-color:rgb(255, 255, 255); /* Black background */
            color:rgb(0, 0, 0);
            padding: 40px 20px; /* Padding inside the header section */
            display: flex;
            flex-direction: column; /* Default to column for small screens */
            align-items: center; /* Center items when in column mode */
            position: relative; /* For absolute positioning of decorative elements */
            overflow: hidden; /* Hide parts of decorative elements that go outside */
        }

        .header-container {
            max-width: 1200px; /* Max width for content inside header */
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center; /* Align items vertically in the center */
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            position: relative; /* To position logo and text relative to this container */
            z-index: 2; /* Ensure content is above other elements */
        }

        .header-logo {
            position: absolute; /* Position logo absolutely */
            top: 20px; /* Adjust as needed */
            left: 20px; /* Adjust as needed */
            z-index: 3; /* Ensure logo is on top */
        }

        .header-logo img {
            height: 130px; /* Adjust logo size */
            width: auto;
            border-radius: 50%; /* If logo is circular */
            padding: 5px; /* Spacing inside the logo circle */
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding-top: 80px; 
            padding-bottom: 80px; 
        }

        .header-text {
            flex: 1; /* Allows text to take available space */
            max-width: 600px; /* Limit text width for readability */
            margin-right: 20px; /* Space between text and image */
            font-size: 3.5em; /* Large font size */
            line-height: 1.2;
            font-weight: bold;
            text-align: left;
            padding-left: 20px; /* Align with logo's left edge visually */
        }

        .header-text span.highlight {
            color: #f83c3c; /* Red color for highlighted text */
        }

        /* Styles for the image container */
        .header-image-container {
            flex-shrink: 0; /* Prevent image from shrinking */
            width: 300px; /* Desired width for the image area */
            height: 300px; /* Desired height for the image area */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; /* Hide parts of the image if it exceeds container */
            margin-left: auto; /* Push to the right */
            margin-right: 50px; /* Give some space from the right edge */
        }

        .header-image-container img {
            width: 100%; /* Make image fill its container */
            height: 100%; /* Make image fill its container */
            object-fit: cover; /* Cover the container, cropping if necessary */
            display: block; /* Remove extra space below image */
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .header-text {
                font-size: 2.8em;
            }
            .header-image-container {
                width: 250px;
                height: 250px;
            }
        }

        @media (max-width: 768px) {
            .header-logo {
                position: relative; /* Revert to relative positioning on smaller screens */
                top: auto;
                left: auto;
                margin-bottom: 20px; /* Add space below logo */
                align-self: flex-start; /* Align to the left in column mode */
            }

            .header-content {
                flex-direction: column; /* Stack text and image vertically */
                padding-top: 20px; /* Reduce top padding */
                padding-bottom: 40px; /* Adjust bottom padding */
            }

            .header-text {
                font-size: 2.5em;
                text-align: center; /* Center text on small screens */
                margin-right: 0;
                margin-bottom: 40px; /* Space between text and image */
                padding-left: 0;
            }

            .header-image-container {
                margin-left: 0;
                margin-right: 0;
                width: 200px; /* Adjust image size for smaller screens */
                height: 200px;
            }
        }

        @media (max-width: 480px) {
            .header-text {
                font-size: 2em;
            }
            .header-logo img {
                height: 50px;
            }
        }

        /* Styles for the explanation box (kept from previous example) */
        .explanation-section {
            background-color: #f0f0f0; /* Matches the body background */
            padding: 40px 20px;
            display: flex;
            justify-content: center; /* Center the box */
            align-items: center;
            min-height: 200px; /* Just for spacing */
        }

        .explanation-box {
            background-color: #9c27b0; /* Purple color from your image */
            color: #ffffff;
            padding: 30px;
            border-radius: 35px; 
            max-width: 700px; 
            display: flex;
            align-items: flex-start; 
            gap: 20px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            transition: transform 0.2s ease-out, box-shadow 0.2s ease-out;
            cursor: default; 
        }

        .explanation-box .email-icon {
            flex-shrink: 0; 
            width: 110px; 
            height: 110px;
            border-radius: 50%; 
        }

        .explanation-box:hover {
            transform: translateY(2px) scale(0.98); 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
        }

        .explanation-box p {
            margin: 0;
            line-height: 1.6;
            font-size: 1.1em;
        }

        @media (max-width: 600px) {
            .explanation-box {
                flex-direction: column; /* Stack icon and text on small screens */
                text-align: center;
                align-items: center;
                padding: 20px;
            }
            .explanation-box .email-icon {
                margin-bottom: 15px;
            }
        }
    </style>
    </head>
    <body>

        <section class="header-section">
            <div class="header-logo">
                <img src="/images/phishing_logo.png" alt="Phishing Logo">
            </div>
            <div class="header-container">
                <div class="header-content">
                    <div class="header-text">
                        A INTERNET PODE SER <br> MUITO DIVERTIDA. MAS <br> A SUA <span class="highlight">SEGURANÇA</span> É <br> COISA SÉRIA
                    </div>
                    <div class="header-image-container">
                        <img src="/images/fishing.gif" alt="Sua Foto">
                    </div>
                </div>
            </div>
        </section>

        <section class="explanation-section">
            <div class="explanation-box">
                <img src="/images/phishing-method.jpg" alt="Phishing Method" class="email-icon">
                <p>Phishing é um ataque que tenta roubar seu dinheiro ou a sua identidade fazendo com que você revele informações pessoais, tais como números de cartão de crédito, informações bancárias ou senhas em sites que fingem ser legítimos.</p>
            </div>
        </section>
    </body>
</html>