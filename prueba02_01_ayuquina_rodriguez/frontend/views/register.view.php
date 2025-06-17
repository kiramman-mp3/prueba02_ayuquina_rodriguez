<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse</title>
  <link rel="stylesheet" href="../css/register.css">
</head>
<body>
  <div class="register-bg">
    <form method="POST" class="register-form">
      <h2 class="register-title">Crear cuenta</h2>

      <?php if (!empty($error)): ?>
        <div class="register-alert-error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="register-alert-success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <div class="register-input-wrapper">
        <span class="register-input-icon">
          <svg width="22" height="22" fill="none" stroke="#8a8a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <circle cx="12" cy="7" r="4"/>
            <path d="M5.5 21a7.5 7.5 0 0 1 13 0"/>
          </svg>
        </span>
        <input type="text" name="name" class="register-input" placeholder="Nombre completo" required>
      </div>
      <div class="register-input-wrapper">
        <span class="register-input-icon">
          <svg width="22" height="22" fill="none" stroke="#8a8a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <path d="M16 21v-2a4 4 0 0 0-8 0v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
        </span>
        <input type="email" name="email" class="register-input" placeholder="Correo electrónico" required>
      </div>
      <div class="register-input-wrapper">
        <span class="register-input-icon">
          <svg width="22" height="22" fill="none" stroke="#8a8a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <rect x="3" y="11" width="18" height="11" rx="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </span>
        <input type="password" name="password" class="register-input" placeholder="Contraseña" required>
      </div>
      <div class="register-input-wrapper">
        <span class="register-input-icon">
          <svg width="22" height="22" fill="none" stroke="#8a8a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <rect x="3" y="11" width="18" height="11" rx="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
        </span>
        <input type="password" name="confirmPassword" class="register-input" placeholder="Confirmar contraseña" required>
      </div>

      <button type="submit" class="register-btn">Registrarse</button>

      <div class="register-wrapper">
        <span class="register-text">¿Ya tienes cuenta?</span>
        <a href="login.php" class="register-link">Inicia sesión</a>
      </div>
    </form>
  </div>

  <script>
  // Add focus effects to inputs
  document.querySelectorAll('.register-input').forEach(input => {
    input.addEventListener('focus', function() {
      this.style.borderColor = '#43cea2';
      this.style.boxShadow = '0 0 0 3px rgba(67, 206, 162, 0.12)';
    });

    input.addEventListener('blur', function() {
      this.style.borderColor = '#e2e8f0';
      this.style.boxShadow = 'none';
    });
  });

  // Add hover effect to button
  const registerBtn = document.querySelector('.register-btn');
  registerBtn.addEventListener('mouseenter', function() {
    this.style.background = 'linear-gradient(90deg, #43cea2 0%, #185a9d 100%)';
    this.style.boxShadow = '0 8px 24px 0 rgba(67, 206, 162, 0.18)';
    this.style.transform = 'translateY(-2px) scale(1.03)';
  });

  registerBtn.addEventListener('mouseleave', function() {
    this.style.background = 'linear-gradient(90deg, #185a9d 0%, #43cea2 100%)';
    this.style.boxShadow = '0 4px 12px 0 rgba(67, 206, 162, 0.10)';
    this.style.transform = 'none';
  });
  </script>
</body>
</html>
