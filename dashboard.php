<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Food Delivery</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
        }

        .navbar {
            background: #ff6600;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            color: white;
            margin: 0;
        }

        .logout {
            background: white;
            color: #ff6600;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 5px;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Online Food Delivery</h2>

        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="container">

        <h1>
            Welcome,
            <?php echo htmlspecialchars($_SESSION["user_name"]); ?>!
        </h1>

        <p>You are successfully logged in.</p>

        <p>
            Email:
            <?php echo htmlspecialchars($_SESSION["user_email"]); ?>
        </p>

    </div>

</body>
</html>