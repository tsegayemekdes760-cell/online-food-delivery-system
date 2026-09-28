<?php
session_start();
include "db.php";

if (!isset($_GET["id"])) {
    die("Food ID is missing.");
}

$food_id = (int) $_GET["id"];

$stmt = $conn->prepare(
    "SELECT id, name, price, image FROM foods WHERE id = ?"
);

$stmt->bind_param("i", $food_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Food not found.");
}

$food = $result->fetch_assoc();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

if (isset($_SESSION["cart"][$food_id])) {
    $_SESSION["cart"][$food_id]++;
} else {
    $_SESSION["cart"][$food_id] = 1;
}

/* TEST */
echo "<h2>Food added successfully!</h2>";

echo "<pre>";
print_r($_SESSION["cart"]);
echo "</pre>";

echo '<a href="cart.php">Go to Cart</a>';
?>
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: dashboard.php");
    exit();
}