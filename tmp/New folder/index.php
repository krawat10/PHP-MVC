<?php

require_once 'functions.php';

$db = get_db();
$products = $db->products->find();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Produkty</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<table>
    <thead>
    <tr>
        <th>Nazwa</th>
        <th>Cena</th>
        <th>Operacje</th>
    </tr>
    </thead>

    <tbody>
    <?php if ($products->count()): ?>
        <?php foreach ($products as $product): ?>
            <tr>
                <td>
                    <a href="view.php?id=<?= $product['_id'] ?>"><?= $product['name'] ?></a>
                </td>
                <td><?= $product['price'] ?> PLN</td>
                <td>
                    <a href="edit.php?id=<?= $product['_id'] ?>">Edytuj</a> |
                    <a href="delete.php?id=<?= $product['_id'] ?>">Usuń</a>
                </td>
            </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="3">Brak produktów</td>
        </tr>
    <?php endif ?>
    </tbody>

    <tfoot>
    <tr>
        <td colspan="2">Łącznie: <?= $products->count() ?></td>
        <td>
            <a href="edit.php">nowy produkt</a>
        </td>
    </tr>
    </tfoot>
</table>


</body>
</html>
