```php
<?php

session_start();
include "db.php";

/* Check if user is logged in */
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

/* Admin only */
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: dashboard.php");
    exit();
}

/* Check order ID and status */
if (!isset($_GET["id"]) || !isset($_GET["status"])) {
    header("Location: admin_orders.php");
    exit();
}

$order_id = (int) $_GET["id"];
$status = $_GET["status"];

/* Allowed statuses */
$allowed_statuses = [
    "Pending",
    "Preparing",
    "Delivered"
];

/* Check status */
if (!in_array($status, $allowed_statuses, true)) {
    header("Location: admin_orders.php");
    exit();
}

/* Update order status */
$stmt = $conn->prepare(
    "UPDATE orders
     SET status = ?
     WHERE id = ?"
);

$stmt->bind_param(
    "si",
    $status,
    $order_id
);

if ($stmt->execute()) {
    $stmt->close();

    header("Location: admin_orders.php");
    exit();
}

/* If update fails */
$stmt->close();

echo "Failed to update order status.";

?>
```
```php
<?php

session_start();
include "db.php";

/* Check if user is logged in */
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

/* Admin only */
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: dashboard.php");
    exit();
}

/* Check order ID and status */
if (!isset($_GET["id"]) || !isset($_GET["status"])) {
    header("Location: admin_orders.php");
    exit();
}

$order_id = (int) $_GET["id"];
$status = $_GET["status"];

/* Allowed statuses */
$allowed_statuses = [
    "Pending",
    "Preparing",
    "Delivered"
];

/* Check status */
if (!in_array($status, $allowed_statuses, true)) {
    header("Location: admin_orders.php");
    exit();
}

/* Update order status */
$stmt = $conn->prepare(
    "UPDATE orders
     SET status = ?
     WHERE id = ?"
);

$stmt->bind_param(
    "si",
    $status,
    $order_id
);

if ($stmt->execute()) {
    $stmt->close();

    header("Location: admin_orders.php");
    exit();
}

/* If update fails */
$stmt->close();

echo "Failed to update order status.";

?>
```
