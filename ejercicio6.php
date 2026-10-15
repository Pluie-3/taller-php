<?php
require_once 'classes/ArbolBinario.php';
$entrada = $_POST['valores'] ?? '';
$arbol = null;
if (isset($_POST['valores']) && trim($entrada) !== '') {
    $arbol = new ArbolBinario();
    $elementos = preg_split('/[\s,]+/', trim($entrada));

    foreach ($elementos as $elem) {
        if ($elem !== '') {
            $arbol->insertar($elem);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 - Árbol Binario</title>
    <link rel="stylesheet" href="css/tarjetas.css">
</head>
<body>
    <h1>6. Árbol Binario</h1>
    <div class="contenedor-ejercicio">
        <div class="tarjeta">
            <div class="tarjeta-volver">
                <a href="index.php" class="btn-volver">← Volver al menú</a>
            </div>
            <form action="ejercicio6.php" method="post">
                <div class="form-group">
                    <label for="valores">Ingrese los valores (separados por comas o espacios):</label>
                    <input type="text" name="valores" id="valores" value="<?= htmlspecialchars($entrada) ?>" required placeholder="Ej: 8, 3, 10, 1, 6">
                </div>
                <button type="submit">Generar Árbol y Recorridos</button>
            </form>
            <?php if ($arbol !== null && $arbol->get_raiz() !== null): ?>
                <div class="resultado resultado-lista">
                    <b>Preorden (Raíz-Izq-Der):</b> <?= implode(' → ', $arbol->preorden()) ?><br><br>
                    <b>Inorden (Izq-Raíz-Der):</b> <?= implode(' → ', $arbol->inorden()) ?><br><br>
                    <b>Postorden (Izq-Der-Raíz):</b> <?= implode(' → ', $arbol->postorden()) ?>
                    <hr>
                    <b>Estructura Visual del Árbol (Organigrama):</b>
                    <div class="organigrama-wrapper">
                        <?= $arbol->dibujarOrganigrama() ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>