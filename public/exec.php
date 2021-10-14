<?php
//Insere com o método exec

$sql = "INSERT INTO products (name, description) VALUES ('{$name}', '{$desc}');";
$insert = $pdo->exec($sql);
var_dump( $insert);

//Atualiza com o método exec
$update = $pdo->exec("UPDATE products SET name='{$name}', description='{$desc}' WHERE id<>5");
var_dump($update);
