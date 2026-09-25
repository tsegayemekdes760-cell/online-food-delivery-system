<?php
include "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($name) || empty($email) || empty($password)) {
        $message = "Please fill in all fields.";
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $message = "Email already exists.";
        } else {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
            );

            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $message = "Registration successful!";
            } else {
                $message = "Registration failed.";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Food Delivery</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .register-box {
            width: 350px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #ff6600;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #e65c00;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="register-box">

    <h2>Create Account</h2>

    <?php if ($message != ""): ?>
        <div class="message">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">

        <input
            type="text"
            name="name"
            placeholder="Full Name"
            required
        >

        <input
            type="email"
            name="email"
            placeholder="Email"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >

        <input
            type="password"
            name="confirm_password"
            placeholder="Confirm Password"
            required
        >

        <button type="submit">Register</button>

    </form>

    <p style="text-align:center;">
        Already have an account?
        <a href="login.php">Login</a>
    </p>

</div>

</body>
</html>