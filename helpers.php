<?php

    function lineTotal(array $product): int
    {
        return $product['price'] * $product['qty'];
    }
    function inventoryValue(array $product): int
    {
        $sum = 0;

        foreach ($product as $product){
            $sum += lineTotal($product);
        }
        return $sum;
    }
    function findProductBySku(array $products, string $sku) : ?array
    {
        foreach ($products as $product){
            if ($product['sku'] == $sku){
                return $product;
            }
        }
        return null;  
    }
    function countByCategory(array $products, int $categoryId): int 
    {
        $count = 0;
        foreach($products as $product){
            if ($product['category_id'] ===$categoryId ){
                $count++;
            }
        }
        return $count;    
    }
    function stockLevel(array $product): string
    {
        if($product['qty'] >= 5){
            return "Du";
        }
        if ($product['qty'] >= 2){
            return "Sap het";
        }
        return "Can nhap";
    }
    function fileterByCategory(array $products, ?int $categoryId): array
    {
        if(!$categoryId){
            return $products;
        }
        $result = [];

        foreach($products as $product)
        {
            if($product['category_id'] == $categoryId){
                $result[] = $product;
            }
        }
        return $result;
    }
    function rankInventory(int $value): string
    {
        if ($value < 15000000){
            return "Nho";
        }
        if ($value < 35000000){
            return "Trung binh";
        }
        return "Lon";
    }
    function renderProductRows(array $products, array $categoryMap): void
    {
        foreach($products as $product) {
            echo "<tr>";
            
            echo "<td>" . htmlspecialchars($product['sku']) . "</td>";
            
            echo "<td>" . htmlspecialchars($product['name']) . "</td>";
        
            echo "<td>" . htmlspecialchars($categoryMap[$product['category_id']]) . "</td>";
            
            echo "<td>" . number_format($product['price']) . "</td>";

            echo "<td>" . $product['qty'] . "</td>";

            echo "<td>" . number_format(lineTotal($product)) . "</td>";

            echo "<td?>" . stockLevel($product) . "</td>";

            echo "</tr>";
        }
    }