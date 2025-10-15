<?php 
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <style>
.login-card {
  min-width: 340px;
  max-width: 95vw;
}
.login-card h2 {
  text-align: center;
  margin-bottom: 28px;
  color: #e67c1c;
  font-weight: 700;
  letter-spacing: 1px;
}
.login-card input[type="text"],
.login-card input[type="password"],
.login-card input[type="email"] {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1.5px solid #e67c1c;
  margin-bottom: 18px;
  font-size: 16px;
  background: #fafafa;
  transition: border 0.2s;
}
.login-card input:focus {
  border: 1.5px solid #d35400;
  outline: none;
}
.login-card button {
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
.login-card button:hover {
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
</style>
</head>
<body>
<div>
  <form method="POST" action="/register" class="login-card" target="_top" id="registerForm">
    <h2>Registrar</h2>
    <div id="jsError" class="login-error" style="display:none;"></div>

    <?php if($error): ?>
      <div class="login-error">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="pass" id="pass" placeholder="Senha" required>
    <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirmar Senha" required>

    <button type="submit">Registrar</button>
  </form>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
  const senha = document.getElementById('pass').value.trim();
  const confirmar = document.getElementById('confirm_pass').value.trim();
  const erroDiv = document.getElementById('jsError');

  if (senha !== confirmar) {
    e.preventDefault(); // impede envio
    erroDiv.style.display = 'block';
    erroDiv.textContent = 'As senhas não coincidem. Verifique e tente novamente.';
    return false;
  } else {
    erroDiv.style.display = 'none';
  }
});
</script>
</body>
</html>
