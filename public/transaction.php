<?php

$pdo->beginTransaction(); // Obriga fazer a verificação de commit e rollback antes de gravar os dados no bd.
$name = 'Cadeira';
$desc = 'Giratória';

//outra maneira de se inserir. Ao invés de colocar o ?, coloca o : e o nome de referencia. Da no mesmo!
$sql = 'INSERT INTO products (name, description) VALUES (:name, :desc)';
$query = $pdo->prepare($sql);
$query->bindValue(':name', $name);
$query->bindValue(':desc', $desc);
$insert = $query->execute();
$insert2 = $query->execute();

//se inserir em todas as tabelas, ele grava. Senão, dá um roolback e não grava em nenhuma.
//isso vale para todas as tabelas relacionadas entre si também.
if($insert && $insert2){
    $pdo->commit();
    echo 'Sucesso!';
} else {
    $pdo->rollBack();
    echo 'Falou!';
}