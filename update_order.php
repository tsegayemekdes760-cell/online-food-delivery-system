<?php

session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET["id"]) && isset($_GET["status"])) {

    $order_id = intval($_GET["id"]);
    $status = $_GET["status"];

    $allowed_status = ["Pending", "Preparing", "Delivered"];

    if (in_array($status, $allowed_status)) {

        $stmt = $conn->prepare(
            "UPDATE orders SET status = ? WHERE id = ?"
        );

        $stmt->bind_param("si", $status, $order_id);

        $stmt->execute();
    }
}

header("Location: admin_orders.php");
exit();

?>