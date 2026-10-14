<?php
require_once 'classes/Estadistica.php';
$cadena = $_POST['numeros'] ?? '';
$promedio = null;
$mediana = null;
$moda = null;
if (isset($_POST['numeros'])) {
    $estadistica = new Estadistica($cadena);
    
    $promedio = $estadistica->calcularPromedio();
    $mediana = $estadistica->calcularMediana();
    $moda = $estadistica->calcularModa();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Estadísticas</title>
    <link rel="stylesheet" href="css/tarjetas.css">
</head>
<body>
    <h1>3. Estadísticas (Promedio, Mediana y Moda)</h1>
    <div class="contenedor-ejercicio">
        <div class="tarjeta">
            <div class="tarjeta-volver">
                <a href="index.php" class="btn-volver">← Volver al menú</a>
            </div>
            <form action="ejercicio3.php" method="post">
                <div class="form-group">
                    <label for="numeros">Ingrese los números (separados por comas o espacios):</label>
                    <input type="text" name="numeros" id="numeros" value="<?= htmlspecialchars($cadena) ?>" required>
                </div>
                <button type="submit">Calcular Estadísticas</button>
            </form>
            <?php if ($promedio !== null): ?>
                <div class="resultado">
                    <b>Promedio:</b> <?= round($promedio, 2) ?><br><br>
                    <b>Mediana:</b> <?= round($mediana, 2) ?><br><br>
                    <b>Moda:</b> <?= htmlspecialchars($moda) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>