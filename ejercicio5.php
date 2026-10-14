<?php
require_once 'classes/Binario.php';
$numero = $_POST['numero'] ?? '';
$binario = null;
$pasos = [];
$error = '';
if (isset($_POST['numero'])) {
    if (!is_numeric($numero)) {
        $error = 'Ingrese un número válido.';
    } elseif ($numero < -999999999999 || $numero > 999999999999) {
        $error = 'Ingrese un número de máximo 12 cifras.';
    } else {
        $valor = (int)$numero;
        $conversor = new Binario($valor);
        $binario = $conversor->get_binario();
        $pasos = $conversor->get_pasos();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Entero a Binario</title>
    <link rel="stylesheet" href="css/tarjetas.css">
</head>
<body>
    <h1>5. Entero a Binario</h1>
    <div class="contenedor-ejercicio">
        <div class="tarjeta">
            <div class="tarjeta-volver">
                <a href="index.php" class="btn-volver">← Volver al menú</a>
            </div>
            <form action="ejercicio5.php" method="post">
                <div class="form-group">
                    <label for="numero">Ingrese un número entero:</label>
                    <input type="number" name="numero" id="numero" step="1" value="<?= htmlspecialchars($numero) ?>" required>
                </div>
                <button type="submit">Convertir</button>
            </form>
            <?php if ($error !== ''): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($binario !== null): ?>
                <div class="resultado">
                    <b>Binario:</b> <?= htmlspecialchars($binario) ?>
                </div>
                <?php if (count($pasos) > 0): ?>
                    <table class="pasos">
                        <tr>
                            <th>Dividendo</th>
                            <th>Cociente (÷ 2)</th>
                            <th>Residuo</th>
                        </tr>
                        <?php foreach ($pasos as $paso): ?>
                            <tr>
                                <td><?= $paso['dividendo'] ?></td>
                                <td><?= $paso['cociente'] ?></td>
                                <td><?= $paso['residuo'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <p class="ayuda">Los residuos, leídos de abajo hacia arriba, forman el número binario.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
