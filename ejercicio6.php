<?php
require_once 'classes/ArbolBinario.php';
$preorden = $_POST['preorden'] ?? '';
$inorden = $_POST['inorden'] ?? '';
$postorden = $_POST['postorden'] ?? '';
$arbol = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arbol = new ArbolBinario($preorden, $inorden, $postorden);
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
    <h1>6. Árbol Binario por Recorridos</h1>
    <div class="contenedor-ejercicio ancho">
        <div class="tarjeta">
            <div class="tarjeta-volver">
                <a href="index.php" class="btn-volver">← Volver al menú</a>
            </div>
            <form action="ejercicio6.php" method="post">
                <div class="form-group">
                    <label for="preorden">Preorden:</label>
                    <input type="text" name="preorden" id="preorden" value="<?= htmlspecialchars($preorden) ?>" placeholder="A B D E C">
                </div>
                <div class="form-group">
                    <label for="inorden">Inorden:</label>
                    <input type="text" name="inorden" id="inorden" value="<?= htmlspecialchars($inorden) ?>" placeholder="D B E A C">
                </div>
                <div class="form-group">
                    <label for="postorden">Postorden:</label>
                    <input type="text" name="postorden" id="postorden" value="<?= htmlspecialchars($postorden) ?>" placeholder="D E B C A">
                </div>
                <p class="ayuda">Ingrese mínimo dos recorridos. Los nodos se separan con espacios, comas o flechas (→). Si ingresa los tres, se usa preorden - inorden.</p>
                <button type="submit">Construir árbol</button>
            </form>

            <?php if ($arbol !== null): ?>
                <?php if (count($arbol->get_errores()) > 0): ?>
                    <?php foreach ($arbol->get_errores() as $mensaje): ?>
                        <div class="error"><?= htmlspecialchars($mensaje) ?></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="resultado resultado-lista">
                        <b>Construido con:</b> <?= htmlspecialchars($arbol->get_metodo()) ?><br><br>
                        <b>Preorden:</b> <?= htmlspecialchars(implode(' → ', $arbol->preorden())) ?><br>
                        <b>Inorden:</b> <?= htmlspecialchars(implode(' → ', $arbol->inorden())) ?><br>
                        <b>Postorden:</b> <?= htmlspecialchars(implode(' → ', $arbol->postorden())) ?>
                    </div>
                    <div class="organigrama-wrapper">
                        <?= $arbol->dibujarOrganigrama() ?>
                    </div>
                    <?php if ($arbol->get_metodo() === 'preorden - postorden'): ?>
                        <div class="aviso">Con preorden y postorden el árbol puede no ser único; si un nodo tiene un solo hijo, se dibuja a la izquierda.</div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
