<?php
require_once 'classes/Matematicas.php';
$numero = $_POST['numero'] ?? '';
$operacion = $_POST['operacion'] ?? 'fibonacci';
$resultado = null;
$aviso = '';
if (isset($_POST['numero'])) {
    $matematicas = new Matematicas(intval($numero));
    if ($operacion === 'factorial') {
        $resultado = $matematicas->get_factorial();
    } else {
        $resultado = $matematicas->get_fibonacci();
    }
    $aviso = $matematicas->get_aviso();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Fibonacci / Factorial</title>
    <link rel="stylesheet" href="css/tarjetas.css">
</head>
<body>
    <h1>2. Fibonacci / Factorial</h1>
    <div class="contenedor-ejercicio">
        <div class="tarjeta">
            <div class="tarjeta-volver">
                <a href="index.php" class="btn-volver">← Volver al menú</a>
            </div>
            <form action="ejercicio2.php" method="post">
                <div class="form-group">
                    <label for="numero">Ingrese un número:</label>
                    <input type="number" name="numero" id="numero" min="1" max="90" value="<?= htmlspecialchars($numero) ?>" required>
                </div>
                <div class="form-group">
                    <label for="operacion">Tipo de cálculo:</label>
                    <select name="operacion" id="operacion">
                        <option value="fibonacci" <?= $operacion === 'fibonacci' ? 'selected' : '' ?>>Sucesión de Fibonacci</option>
                        <option value="factorial" <?= $operacion === 'factorial' ? 'selected' : '' ?>>Factorial</option>
                    </select>
                </div>
                <p class="ayuda">Fibonacci admite hasta 90 términos y factorial hasta 20.</p>
                <button type="submit">Calcular</button>
            </form>
            <?php if ($resultado !== null): ?>
                <div class="resultado">
                    <b>Resultado (<?= ucfirst($operacion) ?>):</b><br><br>
                    <?= implode($operacion === 'factorial' ? '<br>' : ', ', $resultado) ?>
                </div>
                <?php if ($aviso !== ''): ?>
                    <div class="aviso"><?= htmlspecialchars($aviso) ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
