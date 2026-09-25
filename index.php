<?php

require_once "config/database.php";

$stmt = $pdo->query("SELECT * FROM foods");

$foods = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($foods as $food) {
    echo $food['name'] . " - ";
    echo $food['price'] . " ETB";
    echo "<br>";
}

?>