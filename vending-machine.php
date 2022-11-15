<?php

function createProduct($name, $size, $price)
{
    $product = new stdClass();
    $product->name = $name;
    $product->size = $size;
    $product->price = $price;
    return $product;
}

$products = [
    createProduct("Coffee (L) (1.90$)", 'L',190),
    createProduct("Coffee (XL) (2.80$)", 'XL',280),
    createProduct("Hot chocolate (L) (1.80$)", 'L',180),
    createProduct("Irish coffee (L) (2.10$)", 'L',210),
    createProduct( "Green tea (L) (1.50$)", 'L',150),
    createProduct("Black tea (L) (1.50$)", 'L' ,150)
];

$coins = [
    200 => 300,
    100 => 500,
    50 => 1000,
    20 => 1500,
    10 => 1800,
    5 => 2000,
    2 => 2000,
    1 => 2000
];

foreach ($products as $key => $product) {
    echo "[{$key}] {$product->name}\n";
}

$selection = (int)readline("Please, select a drink: \n");
echo "You selected {$selection} = {$products[$selection]->name}\n";

$cashRegister = 0;
while ($cashRegister < $products[$selection]->price) {
    $insertCoins = (int)readline("Please, insert coins: \n");

    $reminder = $insertCoins - $products[$selection]->price;

    foreach ($coins as $coin => $amount) {
        $coinAmount = intdiv($reminder, $coin);
        $coins[$coin] -= $coinAmount;

        if ($coinAmount > 0) {
            $reminder -= $coin * $coinAmount;
            echo "Giving {$coin} x {$coinAmount}" . PHP_EOL;
        }
    }
    $cashRegister += $insertCoins;

    if ($reminder !== 0) {
        echo "Not enough coins :(\n";
        echo $insertCoins;
    } else {
        echo "Thank You! Here is your change!\n";
    }

    if ($reminder > 0) {
        echo "Failed to give back reminder\n";
        break;
    }
}
foreach ($coins as $coin => $amount) {
    echo "| {$coin} = {$amount}|\n";
}
