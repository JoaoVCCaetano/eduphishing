
<?php 
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <style>
body {
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
  <form method="POST" action="/register" class="login-card" target="_top">
    <h2>Registrar</h2>
    <?php if($error): ?>
      <div class="login-error">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>
  <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="pass" placeholder="Senha" required>
    <button type="submit">Registrar</button>
  </form>
</div>
<!-- Modal removido, apenas formulário para uso com Fancybox -->
