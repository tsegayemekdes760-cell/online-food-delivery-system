```php
<?php

include "db.php";

/* New admin password */
$new_password = "maki@121212";

/* Hash password */
$hashed_password = password_hash(
    $new_password,
    PASSWORD_DEFAULT
);

/* Admin email */
$email = "tsegayemekdes760@gmail.com";

/* Update password */
$stmt = $conn->prepare(
    "UPDATE users
     SET password = ?, role = 'admin'
     WHERE email = ?"
);

$stmt->bind_param(
    "ss",
    $hashed_password,
    $email
);

if ($stmt->execute()) {

    echo "<h2>Admin password updated successfully!</h2>";
    echo "<p>Email: tsegayemekdes760@gmail.com</p>";
    echo "<p>Password: maki@121212</p>";
    echo "<p>Role: admin</p>";

} else {

    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
```
