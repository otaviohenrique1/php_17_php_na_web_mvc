<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = $_POST['url'];
$titulo = $_POST['titulo'];

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $url);
$statement->bindValue(2, $titulo);

if ($statement->execute() === false) {
  header('Location: /index.php?sucesso=0');
} else {
  header('Location: /index.php?sucesso=1');
}
