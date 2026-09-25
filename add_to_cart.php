<?php
session_start();
include "db.php";

if (!isset($_GET["id"])) {
    header("Location: menu.php");
    exit();
}

$food_id = (int) $_GET["id"];

$stmt = $conn->prepare("SELECT id, name, price, image FROM foods WHERE id = ?");
$stmt->bind_param("i", $food_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: menu.php");
    exit();
}

$food = $result->fetch_assoc();

/*
    Cart structure:
    $_SESSION["cart"][food_id] = quantity
*/

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

if (isset($_SESSION["cart"][$food_id])) {
    $_SESSION["cart"][$food_id]++;
} else {
    $_SESSION["cart"][$food_id] = 1;
}

header("Location: cart.php");
exit();
?>