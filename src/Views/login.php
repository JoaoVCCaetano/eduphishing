
<?php 
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<style>
body.login-bg {
  background: #f4f4f4;
  min-height: 100vh;
  margin: 0;
}
.login-card {
  background: #fff;
  padding: 36px 28px 32px 28px;
  border-radius: 12px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.10);
  min-width: 340px;
  max-width: 95vw;
  margin-bottom: 32px;
}
.login-card h2 {
  text-align: center;
  margin-bottom: 28px;
  color: #e67c1c;
  font-weight: 700;
  letter-spacing: 1px;
}
.login-card input[type="text"],
.login-card input[type="password"] {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1.5px solid #e67c1c;
  margin-bottom: 18px;
  font-size: 16px;
  background: #fafafa;
  transition: border 0.2s;
}
.login-card input[type="text"]:focus,
.login-card input[type="password"]:focus {
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
<div>
  <form method="POST" action="/login" class="login-card">
    <h2>Login</h2>
    <?php if($error): ?>
      <div class="login-error">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>
    <input type="text" name="user" placeholder="Usuário" required>
    <input type="password" name="pass" placeholder="Senha" required>
    <button type="submit">Entrar</button>
    <div style="text-align:center; margin-top:18px;">
      <span>Não tem conta?</span>
      <button type="button" style="margin-left:8px; background:#fff; color:#e67c1c; border:1.5px solid #e67c1c; padding:8px 18px; border-radius:5px; font-weight:600; cursor:pointer;" onclick="abrirModal('register')">Registrar</button>
    </div>
  </form>
</div>
<!-- Modal removido, apenas formulário para uso com Fancybox -->
