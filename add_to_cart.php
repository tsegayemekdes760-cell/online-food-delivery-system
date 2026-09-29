<?php
session_start();

if (!isset($_GET['id'])) {
    header("Location: menu.php");
    exit();
}

$food_id = (int)$_GET['id'];

if ($food_id <= 0) {
    header("Location: menu.php");
    exit();
}

// Create cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add food or increase quantity
if (isset($_SESSION['cart'][$food_id])) {
    $_SESSION['cart'][$food_id]++;
} else {
    $_SESSION['cart'][$food_id] = 1;
}

// Go to cart
header("Location: cart.php");
exit();
?>