<?php

//URL DO PROJETO: http://cursophppdo.jc/

$dsn        = 'mysql'; //driver de conexão.
$host       = 'mysql'; //localhost
$database   = 'curso_php_pdo';
$user       = 'root';
$password   = 'root';
$port       = 3306; //opcional

try {

    $pdo = new PDO("{$dsn}:host={$host};port={$port};dbname={$database}", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // gera erros caso aconteça algum

    $name = 'Cadeira';
    $desc = 'Giratória';

    /*=========================================================================== */

    //Inserindo dados no DB com o método exec
    /*
        $sql = "INSERT INTO products (name, description) VALUES ('{$name}', '{$desc}');";
        $insert = $pdo->exec($sql);
        var_dump($insert);
    */

    /*=========================================================================== */

    /* Inserindo valores com bindValue para previnir ataque sql injection
    /*
        $sql = 'INSERT INTO products (name, description) VALUES (?, ?)';
        $query = $pdo->prepare($sql);
        $query->bindValue(1, $name);
        $query->bindValue(2, $desc);
        $insert = $query->execute();
    */

    /*=========================================================================== */

    /* Inserindo valores com parâmetros no bindValue
    //outra maneira de se inserir. Ao invés de colocar o ?, coloca o : e o nome de referencia. Da no mesmo!
        $sql = 'INSERT INTO products (name, description) VALUES (:name, :desc)';
        $query = $pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':desc', $desc);
        $insert = $query->execute();
    */

    /*=========================================================================== */

    //retorna o id do último objeto inserido
    /*  echo $pdo->lastInsertId();  */
    
    /*=========================================================================== */

    //EXIBINDO VALORES CADASTRADOS NO DB
    /*
        $id = 51;
        $query = $pdo->prepare('SELECT * FROM products where id=:id');
        $query->bindParam(':id', $id);
        $query->execute();
        $qtd = $query->rowCount();//retorna o total de linhas inseridas na tabela.

        if($qtd > 0){
            $products = $query->fetchAll(); //pega todos os dados da tabela
            foreach($products as $product){
                echo "{$product['id']} - {$product['name']} - {$product['description']} <br>";
            }
        } else {
            echo 'Nenhum resultado!';
        }
    */

    /*=========================================================================== */

    //mostra quais bancos de dados estão disponiveis no meu ambiente.
    //var_dump(PDO::getAvailableDrivers());

    /*=========================================================================== */

    //INSERINDO DADOS APÓS VERIFICAÇÃO DE COMMIT
    
    $pdo->beginTransaction(); // Obriga fazer a verificação de commit e rollback antes de gravar os dados no bd.

    //outra maneira de se inserir. Ao invés de colocar o ?, coloca o : e o nome de referencia. Da no mesmo!
    $sql = 'INSERT INTO products (name, description) VALUES (:name, :desc)';
    $query = $pdo->prepare($sql);
    $query->bindValue(':name', $name);
    $query->bindValue(':desc', $desc);
    $insert = $query->execute();

    //se inserir em todas as tabelas, ele grava. Senão, dá um roolback e não grava em nenhuma.
    //isso vale para todas as tabelas relacionadas entre si também.
    if ($insert) {
        $pdo->commit();
        echo 'Sucesso!';
    } else {
        $pdo->rollBack();
        echo 'Falou!';
    }
    

} catch (Throwable | PDOException $e) {
    echo $e->getCode() . '<br>';
    echo $e->getMessage();
}
