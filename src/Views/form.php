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
            width: 150px;
            height: 150px;
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
        .checkbox-label {
            font-size: 14px;
            color: #555;
            display: flex;
            justify-content: center; /* Centraliza o conteúdo */
            align-items: center;
            margin-top: 10px;
        }
        .checkbox-label input {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Envie um email fake</h2>
        <p>O destinatário irá receber um phishing fake para fins educativos e será redirecionado para o presente blog ao inserir seus dados pessoais.</p>
        <form action="email" method="POST">
            <input type="email" name="email" placeholder="Digite seu e-mail" required>
            <select name="opcao">
                <option value="" disabled selected>Escolha uma opção</option>
                <option value="opcao1">Netflix</option>
                <option value="opcao2">Booking</option>
                <option value="opcao3">Amazon</option>
            </select>

            <div class="preview">
                <img src="/public/were-sorry-to-say-goodbye.png" alt="Preview">
                <span>Preview</span>
            </div>

            <div class="checkbox-label">
                <input type="checkbox" name="confirmacao" id="confirmacao" required>
                <label for="confirmacao">Eu concordo com os termos e condições.</label>
            </div>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
