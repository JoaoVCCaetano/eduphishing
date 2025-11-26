<?php 
    if(isset($_SESSION['message'])) {
        echo "<script>
        Swal.fire({
            title: '{$_SESSION['message']['title']}',
            text: '{$_SESSION['message']['text']}',
            icon: 'success',
            confirmButtonText: 'OK'
            });
        </script>";

        unset($_SESSION['message']);
    } 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci Minha Senha</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }



         h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #e67c1c;
            font-weight: 700;
            letter-spacing: 1px;
        }

         p.subtitle {
            text-align: center;
            color: #555;
            font-size: 15px;
            margin-bottom: 24px;
            line-height: 1.5;
        }

         input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1.5px solid #e67c1c;
            margin-bottom: 18px;
            font-size: 16px;
            background: #fafafa;
            transition: border 0.2s;
        }

         input:focus {
            border: 1.5px solid #d35400;
            outline: none;
        }

         button {
            width: 100%;
            padding: 12px;
            background: #e67c1c;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

         button:hover {
            background: #d35400;
        }

        .login-error {
            color: #fff;
            background: #e74c3c;
            padding: 10px 14px;
            border-radius: 4px;
            margin-bottom: 18px;
            text-align: center;
            font-size: 15px;
        }

        .back-link {
            margin-top: 18px;
            text-align: center;
        }

        .back-link a {
            color: #e67c1c;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: color .2s;
        }

        .back-link a:hover {
            color: #d35400;
            text-decoration: underline;
        }

        .icon {
            text-align: center;
            font-size: 44px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div>
    
    <h2>Esqueci Minha Senha</h2>

    <p class="subtitle">
        Digite seu e-mail para enviarmos o link de redefinição.
    </p>

    <form method="POST" action="/forgot-password">
        <input 
            type="email" 
            name="email" 
            placeholder="Seu e-mail"
            required
            autocomplete="email"
        >

        <button type="submit">Enviar Link de Recuperação</button>
    </form>

    <div class="back-link">
        <a href="/login">← Voltar ao Login</a>
    </div>
</div>

</body>
</html>
