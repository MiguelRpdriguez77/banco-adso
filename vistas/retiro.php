<h2>Realizar Retiro</h2>
<?php if (!empty($error)): ?><p style="color: red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<?php if (!empty($mensaje)): ?><p style="color: green;"><?= htmlspecialchars($mensaje) ?></p><?php endif; ?>

<form action="/retiro" method="POST">
    <label>Monto a retirar:</label><br>
    <input type="number" step="0.01" name="valor" required><br><br>
    <button type="submit">Retirar</button>
</form>