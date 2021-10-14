<?php

//seleciona os dados na tabela
$query = $pdo->query("SELECT * FROM products");
$products = $query->fetchAll();

foreach ($products as $product) {
    echo $product['name'] . '<br>';
}

/* Insere valores com o método query */
$sql = "INSERT INTO products (name, description) VALUES ('{$name}', '{$desc}');";
$insert = $pdo->query($sql);
var_dump($insert);
