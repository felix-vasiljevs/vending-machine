<?php

$client = new stdClass();
$client->wallet = 500;

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
    createProduct("Hot chocolate (L) (1.80$)", 'L',1.80),
    createProduct("Irish coffee (L) (2.10$)", 'L',2.10),
    createProduct( "Green tea (L) (1.50$)", 'L',1.50),
    createProduct("Black tea (L) (1.50$)", 'L' ,1.50),
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

$cashRegister = 0;

foreach ($products as $key => $product) {
    echo "[{$key}] {$product->name}\n";
}

$selection = (int)readline("Please, select a drink: \n");
echo "You selected {$selection} = {$product->name}\n";

while ($cashRegister < $client->wallet) {
    $insertCoins = (int)readline("Please, insert coins: \n");

        if ($insertCoins != $product->price) {
            echo "Not enough coins :(\n";
            echo $insertCoins;
        } else {
            echo "Thank You! Here is your change!\n";
        }

    $cashRegister += $insertCoins;
}

    $cashBalance = $cashRegister - $selection[$product->price];

    foreach ($coins as $coin => $value)
    {
        if ($cashBalance <= 0) {
            return;
        }
        $times = floor($cashBalance / $coin);
        echo $coin . "/" . $times;
        $cashBalance -= $coin * $times;

        echo "Reminder is: " . $cashBalance;
    }





