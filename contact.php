<?php
session_start();
include "db.php";

$message_sent = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    if (
        empty($name) ||
        empty($email) ||
        empty($subject) ||
        empty($message)
    ) {
        $error = "Please fill in all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";

    } else {

        $stmt = $conn->prepare("
            INSERT INTO contact_messages
            (name, email, subject, message)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "ssss",
            $name,
            $email,
            $subject,
            $message
        );

        if ($stmt->execute()) {
            $message_sent = true;
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Contact - Online Food Delivery</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .navbar {
            background: #ff6600;
            color: white;
            padding: 18px 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
        }

        .contact-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ddd;
        }

        h1 {
            text-align: center;
            color: #333;
        }

       label {
    display: block;
    margin-top: 15px;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

     input,
textarea {
    display: block;
    width: 100%;
    padding: 12px;
    margin-bottom: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}
        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 13px;

            background: #ff6600;
            color: white;

            border: none;
            border-radius: 5px;

            font-size: 18px;
            cursor: pointer;
        }

        button:hover {
            background: #e65c00;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        @media (max-width: 600px) {

            .navbar {
                flex-direction: column;
                gap: 10px;
            }

            .navbar a {
                margin-left: 8px;
            }

            .container {
                width: 95%;
            }

            .contact-box {
                padding: 20px;
            }
        }

    </style>

</head>

<body>

<div class="navbar">

    <h2>Online Food Delivery</h2>

    <div>

        <a href="menu.php">Menu</a>

        <a href="cart.php">Cart</a>

        <a href="dashboard.php">Dashboard</a>

        <a href="logout.php">Logout</a>

    </div>

</div>


<div class="container">

    <div class="contact-box">

        <h1>Contact Us</h1>

        <?php if ($message_sent): ?>

            <div class="success">
                Your message has been sent successfully!
            </div>

        <?php endif; ?>


        <?php if (!empty($error)): ?>

            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>


        <form method="POST"
              action="contact.php"
              onsubmit="return validateForm()">

            <label for="name">Name</label>

            <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter your name"
            >


            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
            >


            <label for="subject">Subject</label>

            <input
                type="text"
                id="subject"
                name="subject"
                placeholder="Enter subject"
            >


            <label for="message">Message</label>

            <textarea
                id="message"
                name="message"
                placeholder="Write your message..."
            ></textarea>


            <button type="submit">
                Send Message
            </button>

        </form>

    </div>

</div>


<script>

function validateForm() {

    let name =
        document.getElementById("name").value.trim();

    let email =
        document.getElementById("email").value.trim();

    let subject =
        document.getElementById("subject").value.trim();

    let message =
        document.getElementById("message").value.trim();


    if (
        name === "" ||
        email === "" ||
        subject === "" ||
        message === ""
    ) {

        alert("Please fill in all fields.");

        return false;
    }


    let emailPattern =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


    if (!emailPattern.test(email)) {

        alert("Please enter a valid email.");

        return false;
    }


    return true;
}

</script>

</body>

</html>