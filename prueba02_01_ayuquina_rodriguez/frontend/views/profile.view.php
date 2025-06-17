<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi perfil</title>
  <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
  <div class="profile-container">
    <h1>Bienvenido, <?= htmlspecialchars($user['name']) ?> 👋</h1>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Rol:</strong> <?= htmlspecialchars($user['role']) ?></p>

    <form method="POST" action="logout.php">
      <button type="submit" class="logout-btn">Cerrar sesión</button>
    </form>
  </div>
</body>
</html>
