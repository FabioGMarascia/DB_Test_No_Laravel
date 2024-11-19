<?php
$host = '127.0.0.1'; // l'indirizzo del tuo server
$db = 'db_test'; // nome del tuo database
$user = 'root'; // nome utente del database
$pass = ''; // password del database

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connessione fallita: " . $e->getMessage();
}
