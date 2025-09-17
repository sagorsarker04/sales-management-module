<?php

if (!function_exists('calculateSaleTotal')) {
    function calculateSaleTotal(array $items): float
    {
        $total = 0;
        foreach ($items as $item) {
            $total += ($item['price'] * $item['quantity']) - $item['discount'];
        }
        return $total;
    }
}
