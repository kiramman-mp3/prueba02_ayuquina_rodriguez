<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi perfil</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../frontend/css/profile.css">
</head>
<body>
  <div class="profile-container">
    <div class="profile-card">
      <h1>Bienvenido <?= htmlspecialchars($user['name']) ?> 👋</h1>
      
      <div class="profile-info">
        <p>
          <strong>Email:</strong>
          <span><?= htmlspecialchars($user['email']) ?></span>
        </p>
        <p>
          <strong>Rol:</strong>
          <span><?= htmlspecialchars($user['role']) ?></span>
        </p>
      </div>

      <form method="POST" action="logout.php">
        <button type="submit" class="logout-btn">Cerrar sesión</button>
      </form>
    </div>
  </div>
</body>
</html>
