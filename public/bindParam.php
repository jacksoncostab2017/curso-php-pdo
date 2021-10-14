<?php

    //outra maneira de se inserir. Ao invés de colocar o ?, coloca o : e o nome de referencia. Da no mesmo!
    $sql = 'INSERT INTO products (name, description) VALUES (:name, :desc)';
    $query = $pdo->prepare($sql);
    $query->bindValue(':name', $name);
    $query->bindValue(':desc', $desc);
    $insert = $query->execute();
    var_dump($insert);