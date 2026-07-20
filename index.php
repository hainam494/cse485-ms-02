<?php 

require_once 'data.php';
require_once 'helpers.php';

$categoryMap = [];

foreach ($categories as $category){
    $categoryMap[$category['id']] = $category['name'];
}

$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

$filteredProducts = fileterByCategory($products, $categoryId);

$totalValue = inventoryValue($products);
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>MiniShop - Buoi 2</title>
    </head>
    <body>
        <h2>MiniShop - Buoi 2</h2>
    <p>
        <a href="index.php">Tat ca</a> |
        <a href="?category_id=1">ban phim</a> |
        <a href="?category_id=2">chuot</a> |
        <a href="?category_id=3">Man hinh</a>
    </p>
    <table>
        <tr>
            <th>SKU</th>
            <th>Ten</th>
            <th>Danh muc</th>
            <th>Gia</th>
            <th>So Luong</th>
            <th>Thanh Tien</th>
            <th>Muc ton</th>
        </tr>
        <?php renderProductRows($filteredProducts,$categoryMap); ?>
    </table>
    <h3>Tong gia tri kho: <?= number_format($totalValue) ?></h3>
    <h3>Quy mo kho: <?= rankInventory($totalValue) ?></h3>
    <h3>Bao cao danh muc</h3>
    <table>
        <tr>
            <th>Danh muc</th>
            <th>So san pham</th>
            <th>Tong gia tri</th>
        </tr>
        <?php foreach($categories as $category): ?>
            <?php
            $count = countByCategory($products, $category['id']);
            $value = 0;
            foreach($products as $product){
                if($product['category_id'] == $category['id']){
                    $value += lineTotal($product);
                }
            }
            ?>
            <tr>
                <td><?= htmlspecialchars($category['name']) ?></td>
                <td><?= $count ?></td>
                <td><?= number_format($value)?></td>
            </tr>
            <?php endforeach; ?>

    </table>
<pre>

<?php
    $p = findProductBySku($products, 'MN-02');
    var_dump($p['name']);
?>

</pre>

<!-- MS_EXPECT inventory_value=41380000 rank=Lon -->

    </body>
</html>