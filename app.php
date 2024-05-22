<?php

$db = new PDO('sqlite:database.db');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

function inserir($db, $ra, $nome, $email){
    $stmt = $db->prepare('INSERT INTO Alunos (ra, nome, email) VALUES (:ra, :nome, :email)');
    $stmt->bindParam(':ra', $ra);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    return $stmt->execute();
}

function primeiraLinha($db){
    $stmt = $db->query("SELECT * FROM Alunos LIMIT 1");
    return $stmt->fetch();
}

function alterar($db, $ra, $nome, $email){
    $stmt = $db->prepare('UPDATE Alunos SET nome = :nome, email = :email WHERE ra = :ra');
    $stmt->bindParam(':ra', $ra);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    return $stmt->execute();
}

function excluir($db, $ra){
    $stmt = $db->prepare('DELETE FROM Alunos WHERE ra = :ra');
    $stmt->bindParam(':ra', $ra);
    return $stmt->execute();
}

function retornarTodos($db){
    $stmt = $db->query('SELECT * FROM Alunos');
    return $stmt->fetchAll();
}

inserir($db, 1, 'Rafaela', 'rafaela@email.com');
inserir($db, 2, 'Nome2', 'email2@email.com');
inserir($db, 3, 'Nome3', 'email3@email.com');

print_r(primeiraLinha($db));

alterar($db, 1, 'Atualizado', 'email@atualizado.com');

excluir($db, 1);

print_r(retornarTodos($db));