<?php

var_dump($_ENV);

$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$db = 'miniwine';

$dns = "mysql:host={$host};port={$port};dbname={$db}";
$user = 'root';
$pass = 'root';

$pdo = new PDO($dns, $user, $pass);
$data = $pdo->query('SELECT VERSION()')->fetch();

var_dump($data);
