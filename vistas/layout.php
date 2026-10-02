<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BancoADSO</title>
</head>
<body>
    <header>
        <h1>BancoADSO</h1>
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <nav>
                <a href="/panel">Panel</a> | 
                <a href="/retiro">Retiros</a> | 
                <a href="/transferencias">Transferencias</a> | 
                <a href="/logout">Cerrar Sesión</a>
            </nav>
        <?php endif; ?>
    </header>
    <hr>
    <main>
        <?php 
        if (isset($rutaVista) && file_exists($rutaVista)) {
            require_once $rutaVista;
        }
        ?>
    </main>
</body>
</html>