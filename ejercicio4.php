<?php
require_once 'classes/Conjunto.php';
$cadenaA = $_POST['conjunto_a'] ?? '';
$cadenaB = $_POST['conjunto_b'] ?? '';
$conjuntoA = null;
$conjuntoB = null;
$union = null;
$interseccion = null;
$difAB = null;
$difBA = null;

if (isset($_POST['conjunto_a']) && isset($_POST['conjunto_b'])) {
    $objConjunto = new Conjunto($cadenaA, $cadenaB);
    $conjuntoA = $objConjunto->obtenerConjuntoA();
    $conjuntoB = $objConjunto->obtenerConjuntoB();
    $union = $objConjunto->obtenerUnion();
    $interseccion = $objConjunto->obtenerInterseccion();
    $difAB = $objConjunto->obtenerDiferenciaAB();
    $difBA = $objConjunto->obtenerDiferenciaBA();
}
function formatearConjunto(array $elementos): string
{
    if (empty($elementos)) {
        return '∅ (Conjunto Vacío)';
    }
    return '{ ' . implode(', ', $elementos) . ' }';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Conjuntos</title>
    <link rel="stylesheet" href="css/tarjetas.css">
</head>

<body>
    <h1>4. Operaciones con Conjuntos</h1>
    <div class="contenedor-ejercicio">
        <div class="tarjeta">
            <div class="tarjeta-volver">
                <a href="index.php" class="btn-volver">← Volver al menú</a>
            </div>
            <form action="ejercicio4.php" method="post">
                <div class="form-group">
                    <label for="conjunto_a">Conjunto A:</label>
                    <input type="text" name="conjunto_a" id="conjunto_a" value="<?= htmlspecialchars($cadenaA) ?>" required>
                </div>
                <div class="form-group">
                    <label for="conjunto_b">Conjunto B:</label>
                    <input type="text" name="conjunto_b" id="conjunto_b" value="<?= htmlspecialchars($cadenaB) ?>" required>
                </div>
                <button type="submit">Calcular Operaciones</button>
            </form>
            <?php if ($union !== null): ?>
                <div class="resultado resultado-lista">
                    <b>Conjunto A:</b> <?= formatearConjunto($conjuntoA) ?><br><br>
                    <b>Conjunto B:</b> <?= formatearConjunto($conjuntoB) ?><br><br>
                    <hr>
                    <b>Unión (A ∪ B):</b> <?= formatearConjunto($union) ?><br><br>
                    <b>Intersección (A ∩ B):</b> <?= formatearConjunto($interseccion) ?><br><br>
                    <b>Diferencia (A − B):</b> <?= formatearConjunto($difAB) ?><br><br>
                    <b>Diferencia (B − A):</b> <?= formatearConjunto($difBA) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>