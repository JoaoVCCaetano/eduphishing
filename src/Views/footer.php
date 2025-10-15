<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Footer - Full Width</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic styles for the body to make the footer visible at the bottom */
        body {
            margin: 0; /* Important: Remove default body margin */
            padding: 0; /* Important: Remove default body padding */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Just for contrast */
        }

        main {
            flex: 1; /* Pushes the footer to the bottom */
            padding: 20px;
            max-width: 1200px; /* Example: You might have a max-width for your main content */
            margin: 0 auto; /* Center the main content */
            width: 100%; /* Ensure main content uses available width */
            box-sizing: border-box; /* Include padding in width */
        }

        /* Footer Styles */
        .footer {
            background-color: #e67e22; /* Similar orange to the image */
            color: #ffffff;
            padding: 40px 20px; /* Adjust padding as needed */
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            font-size: 14px;
            box-sizing: border-box; /* Include padding in the element's total width */
        }

        /* Content within the footer should have its own max-width for readability,
           but the background color should span full width. */
        .footer-content-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%; /* Take full width of its parent (.footer) */
            max-width: 1200px; /* Set a max-width for the content inside the footer */
            margin: 0 auto; /* Center the content within the footer */
            box-sizing: border-box;
        }


        .footer-left {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 20px;
            max-width: 300px; /* Adjust as needed */
            text-align: left;
        }

        .footer-logo {
            margin-bottom: 15px;
        }

        .footer-logo img {
            height: 50px; /* Adjust logo size as needed */
            width: auto;
            filter: brightness(0) invert(1); /* Makes the logo white for better contrast */
        }

        .footer-description {
            line-height: 1.6;
        }

        .footer-column {
            margin-bottom: 20px;
        }

        .footer-column h4 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column ul li a {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-column ul li a:hover {
            color: #cccccc;
        }

        .footer-bottom {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 20px;
        }

        .footer-copyright {
            margin-bottom: 10px;
        }

        .footer-social-icons {
            display: flex;
            gap: 15px;
        }

        .footer-social-icons a {
            color: #ffffff;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-social-icons a:hover {
            color: #cccccc;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .footer-content-wrapper {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .footer-left {
                margin-bottom: 30px;
                max-width: 100%;
                align-items: center;
            }

            .footer-column {
                text-align: center;
                width: 100%;
                margin-bottom: 30px;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-copyright {
                margin-bottom: 15px;
            }
        }

        @media (max-width: 480px) {
            .footer {
                padding: 30px 15px;
            }

            .footer-logo img {
                height: 40px;
            }

            .footer-social-icons {
                gap: 10px;
            }
        }
    </style>
</head>
    <footer class="footer">
        <div class="footer-content-wrapper">
            <div class="footer-left">
                <div class="footer-logo">
                    <img src="/images/phishing_logo.png" alt="Company Logo">
                </div>
                <p class="footer-description">Eduphishing.</p>
            </div>

        </div>
    </footer>
</html>