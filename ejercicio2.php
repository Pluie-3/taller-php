<?php
require_once 'classes/Matematicas.php';

$numero = $_POST['numero'] ?? '';
$operacion = $_POST['operacion'] ?? 'fibonacci';
$resultado = null;

if (isset($_POST['numero'])) {
    $numInt = intval($numero);
    $objMatematica = new Matematicas($numInt);

    if ($operacion === 'factorial') {
        $resultado = $objMatematica->obtenerFactorial();
    } else {
        $resultado = $objMatematica->obtenerFibonacci();
    }
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
                    <input type="number" name="numero" id="numero" min="1" max="30" value="<?= htmlspecialchars($numero) ?>" required placeholder="Ej: 8">
                </div>

                <div class="form-group">
                    <label for="operacion">Tipo de cálculo:</label>
                    <select name="operacion" id="operacion">
                        <option value="fibonacci" <?= $operacion === 'fibonacci' ? 'selected' : '' ?>>Sucesión de Fibonacci</option>
                        <option value="factorial" <?= $operacion === 'factorial' ? 'selected' : '' ?>>Factorial</option>
                    </select>
                </div>

                <button type="submit">Calcular</button>
            </form>

            <?php if ($resultado !== null): ?>
                <div class="resultado">
                    <b>Resultado (<?= ucfirst($operacion) ?>):</b><br><br>
                    <?= implode($operacion === 'factorial' ? '<br>' : ', ', $resultado) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>