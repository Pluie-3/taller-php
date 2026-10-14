<?php
require_once 'classes/Estadistica.php';
$cadena = $_POST['numeros'] ?? '';
$estadistica = null;
if (isset($_POST['numeros'])) {
    $estadistica = new Estadistica($cadena);
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
                <p class="ayuda">Los decimales van con punto. Ejemplo: 4.5, 3, 3, 8.25</p>
                <button type="submit">Calcular Estadísticas</button>
            </form>
            <?php if ($estadistica !== null): ?>
                <?php if ($estadistica->get_cantidad() === 0): ?>
                    <div class="error">No se encontró ningún número válido.</div>
                <?php else: ?>
                    <div class="resultado">
                        <b>Cantidad de datos:</b> <?= $estadistica->get_cantidad() ?><br><br>
                        <b>Promedio (media):</b> <?= round($estadistica->get_promedio(), 2) ?><br><br>
                        <b>Mediana:</b> <?= round($estadistica->get_mediana(), 2) ?><br><br>
                        <b>Moda:</b> <?= htmlspecialchars($estadistica->get_moda()) ?>
                    </div>
                <?php endif; ?>
                <?php if (count($estadistica->get_invalidos()) > 0): ?>
                    <div class="aviso">Se ignoraron valores no numéricos: <?= htmlspecialchars(implode(', ', $estadistica->get_invalidos())) ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
