<?php

//Essa forma de inserir previne o ataque sql injection e não insere valores duplicados.


$sql = 'INSERT INTO products (name, description) VALUES (?, ?)';
$query = $pdo->prepare($sql);
$query->bindValue(1, $name);
$query->bindValue(2, $desc);
$insert = $query->execute();
