<h2>Bienvenido, <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></h2>
<p><strong>Número de Cuenta:</strong> <?= htmlspecialchars($numero_cuenta, ENT_QUOTES, 'UTF-8') ?></p>
<p><strong>Saldo Actual:</strong> $<?= number_format($saldo, 2) ?></p>