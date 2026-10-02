<h2>Realizar Transferencia</h2>
<?php if (!empty($error)): ?><p style="color: red;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<?php if (!empty($mensaje)): ?><p style="color: green;"><?= htmlspecialchars($mensaje) ?></p><?php endif; ?>

<form action="/transferencias" method="POST">
    <label>Cuenta Destino:</label><br>
    <input type="text" name="cuenta_destino" required><br><br>
    <label>Monto a transferir:</label><br>
    <input type="number" step="0.01" name="valor" required><br><br>
    <button type="submit">Transferir</button>
</form>