<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../frontend/css/login.css">
</head>
<body>
    
    <div class="login-bg">
        <form method="POST" class="login-form">
            <h2 class="login-title">Iniciar sesión</h2>

            <?php if (!empty($error)): ?>
                <div class="login-alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="login-alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <div class="login-input-wrapper">
                <span class="login-input-icon">
                    <svg width="22" height="22" fill="none" stroke="#8a8a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M5.5 21a7.5 7.5 0 0 1 13 0"/>
                    </svg>
                </span>
                <input
                    type="email"
                    name="email"
                    class="login-input"
                    placeholder="Correo electrónico"
                    required
                >
            </div>

            <div class="login-input-wrapper">
                <span class="login-input-icon">
                    <svg width="22" height="22" fill="none" stroke="#8a8a8a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <input
                    type="password"
                    name="password"
                    class="login-input"
                    placeholder="Contraseña"
                    required
                >
            </div>

            <button type="submit" class="login-btn">
                Entrar
            </button>

            <div class="login-wrapper">
                <span class="login-text">¿No tienes cuenta?</span>
                <a href="register.php" class="login-link">Regístrate</a>
            </div>
        </form>
    </div>
</body>
</html>
