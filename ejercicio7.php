<?php
session_start();
require_once 'classes/Calculadora.php';
require_once 'classes/Historial.php';
$historial = new Historial();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? 'calcular';
    if ($accion === 'borrar') {
        $historial->borrar();
    } else {
        $num1 = $_POST['num1'] ?? '';
        $num2 = $_POST['num2'] ?? '';
        $tipo = $_POST['tipo'] ?? '';
        if (is_numeric($num1) && is_numeric($num2)) {
            try {
                $calculadora = new Calculadora();
                $operacion = $calculadora->ejecutar($tipo, (float) $num1, (float) $num2);
                $texto = $operacion->describir();
                $historial->agregar($texto);
                $_SESSION['ultimo_resultado'] = $texto;
            } catch (Exception $e) {
                $_SESSION['error_calculadora'] = $e->getMessage();
            }
        } else {
            $_SESSION['error_calculadora'] = 'Ingrese dos números válidos.';
        }
    }
    header('Location: ejercicio7.php');// Se redirige para que al recargar la página no se repita la operación
    exit;
}

$error = $_SESSION['error_calculadora'] ?? '';
$ultimo = $_SESSION['ultimo_resultado'] ?? '';
unset($_SESSION['error_calculadora'], $_SESSION['ultimo_resultado']);
$registros = array_reverse($historial->get_registros());
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7 - Calculadora</title>
    <link rel="stylesheet" href="css/tarjetas.css">
</head>
<body>
    <h1>7. Calculadora</h1>
    <div class="contenedor-ejercicio ancho">
        <div class="tarjeta">
            <div class="tarjeta-volver">
                <a href="index.php" class="btn-volver">← Volver al menú</a>
            </div>
            <form action="ejercicio7.php" method="post">
                <input type="hidden" name="accion" value="calcular">
                <div class="fila">
                    <div class="form-group">
                        <label for="num1">Número 1:</label>
                        <input type="number" name="num1" id="num1" step="any" required>
                    </div>
                    <div class="form-group">
                        <label for="num2">Número 2:</label>
                        <input type="number" name="num2" id="num2" step="any" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tipo">Operación:</label>
                    <select name="tipo" id="tipo">
                        <option value="suma">Suma (+)</option>
                        <option value="resta">Resta (-)</option>
                        <option value="multiplicacion">Multiplicación (×)</option>
                        <option value="division">División (÷)</option>
                        <option value="porcentaje">Porcentaje (N1 % de N2)</option>
                    </select>
                </div>
                <button type="submit">Calcular</button>
            </form>
            <?php if ($error !== ''): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($ultimo !== ''): ?>
                <div class="resultado"><b>Resultado:</b> <?= htmlspecialchars($ultimo) ?></div>
            <?php endif; ?>
            <hr>
            <h3>Historial</h3>
            <?php if (count($registros) === 0): ?>
                <p class="ayuda">Todavía no hay operaciones.</p>
            <?php else: ?>
                <ul class="historial">
                    <?php foreach ($registros as $registro): ?>
                        <li><?= htmlspecialchars($registro) ?></li>
                    <?php endforeach; ?>
                </ul>
                <form action="ejercicio7.php" method="post">
                    <input type="hidden" name="accion" value="borrar">
                    <button type="submit" class="secundario">Borrar historial</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
