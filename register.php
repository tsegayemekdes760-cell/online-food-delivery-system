```php
<?php

include "db.php";

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];


    /* Check empty fields */

    if (
        empty($name) ||
        empty($email) ||
        empty($password) ||
        empty($confirm_password)
    ) {

        $message = "Please fill in all fields.";
        $message_type = "error";

    }

    /* Check password */

    elseif ($password !== $confirm_password) {

        $message = "Passwords do not match.";
        $message_type = "error";

    }

    /* Check password length */

    elseif (strlen($password) < 6) {

        $message = "Password must be at least 6 characters.";
        $message_type = "error";

    }

    else {

        /* Check if email already exists */

        $check = $conn->prepare(
            "SELECT id
             FROM users
             WHERE email = ?"
        );

        $check->bind_param("s", $email);

        $check->execute();

        $result = $check->get_result();


        if ($result->num_rows > 0) {

            $message = "Email already exists.";
            $message_type = "error";

        }

        else {

            /* Secure password hashing */

            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );


            /*
                New users are customers by default.
                Admin can be created later from phpMyAdmin.
            */

            $role = "customer";


            /* Insert user */

            $stmt = $conn->prepare(
                "INSERT INTO users
                (name, email, password, role)
                VALUES (?, ?, ?, ?)"
            );


            $stmt->bind_param(
                "ssss",
                $name,
                $email,
                $hashed_password,
                $role
            );


            if ($stmt->execute()) {

                $message = "Registration successful! You can now login.";
                $message_type = "success";

            }

            else {

                $message = "Registration failed. Please try again.";
                $message_type = "error";

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

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Register - Online Food Delivery
    </title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            font-family: Arial, sans-serif;

            background: #f2f2f2;

            margin: 0;

            padding: 0;
        }


        .register-box {

            width: 400px;

            max-width: 90%;

            margin: 60px auto;

            background: white;

            padding: 30px;

            border-radius: 12px;

            box-shadow: 0 0 15px #ccc;
        }


        h2 {

            text-align: center;

            color: #333;

            margin-bottom: 25px;
        }


        input {

            width: 100%;

            padding: 12px;

            margin: 8px 0;

            border: 1px solid #ccc;

            border-radius: 6px;

            font-size: 15px;
        }


        input:focus {

            outline: none;

            border-color: #ff6600;
        }


        button {

            width: 100%;

            padding: 13px;

            margin-top: 10px;

            background: #ff6600;

            color: white;

            border: none;

            cursor: pointer;

            border-radius: 6px;

            font-size: 16px;

            font-weight: bold;
        }


        button:hover {

            background: #e65c00;
        }


        .message {

            text-align: center;

            margin-bottom: 18px;

            padding: 12px;

            border-radius: 6px;

            font-weight: bold;
        }


        .success {

            background: #d4edda;

            color: #155724;

            border: 1px solid #c3e6cb;
        }


        .error {

            background: #f8d7da;

            color: #721c24;

            border: 1px solid #f5c6cb;
        }


        p {

            text-align: center;

            margin-top: 20px;
        }


        a {

            color: #ff6600;

            font-weight: bold;

            text-decoration: none;
        }


        a:hover {

            text-decoration: underline;
        }

    </style>

</head>


<body>


<div class="register-box">


    <h2>
        🍔 Create Account
    </h2>


    <?php if ($message != ""): ?>

        <div
            class="message <?php
                echo $message_type;
            ?>"
        >

            <?php

            echo htmlspecialchars($message);

            ?>

        </div>

    <?php endif; ?>


    <form
        method="POST"
        action=""
    >


        <!-- Full Name -->

        <input
            type="text"
            name="name"
            placeholder="Full Name"
            value="<?php
                echo isset($_POST["name"])
                    ? htmlspecialchars($_POST["name"])
                    : "";
            ?>"
            required
        >


        <!-- Email -->

        <input
            type="email"
            name="email"
            placeholder="Email"
            value="<?php
                echo isset($_POST["email"])
                    ? htmlspecialchars($_POST["email"])
                    : "";
            ?>"
            required
        >


        <!-- Password -->

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >


        <!-- Confirm Password -->

        <input
            type="password"
            name="confirm_password"
            placeholder="Confirm Password"
            required
        >


        <!-- Register -->

        <button type="submit">
            Register
        </button>


    </form>


    <p>

        Already have an account?

        <a href="login.php">
            Login
        </a>

    </p>


</div>


</body>

</html>
```
