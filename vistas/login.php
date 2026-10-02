<h2>Iniciar Sesión</h2>
<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
<form action="/login" method="POST">
    <label>Número de Cuenta:</label><br>
    <input type="text" name="numero_cuenta" required><br><br>
    <label>Contraseña:</label><br>
    <input type="password" name="clave" required><br><br>
    <button type="submit">Ingresar</button>
</form>