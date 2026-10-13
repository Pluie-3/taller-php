<?php
require_once 'classes/Acronimo.php';

$frase = $_POST['frase'] ?? '';
$resultado = null;

if (isset($_POST['frase'])) {
    $acronimo = new Acronimo($frase);
    $resultado = $acronimo->convertir();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Acrónimo</title>
    <link rel="stylesheet" href="css/tarjetas.css">
</head>
<body>
    <h1>1. Convertidor de Acrónimos</h1>

    <div class="contenedor-ejercicio">
        <div class="tarjeta">
            <div class="tarjeta-volver">
                <a href="index.php" class="btn-volver">← Volver al menú</a>
            </div>

            <form action="ejercicio1.php" method="post">
                <div class="form-group">
                    <label for="frase">Ingrese la frase:</label>
                    <input type="text" name="frase" id="frase" value="<?= htmlspecialchars($frase) ?>" required>
                </div>
                <button type="submit">Generar Acrónimo</button>
            </form>

            <?php if ($resultado !== null): ?>
                <div class="resultado">
                    <b>Resultado:</b> <?= htmlspecialchars($resultado) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>