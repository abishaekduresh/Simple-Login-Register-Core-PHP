<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($fullName) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required');</script>";
    } elseif (strlen($password) < 7) {
        echo "<script>alert('Password length should be more than 6 characters');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo "<script>alert('Email already exists!');</script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $fullName, $email, $password_hash);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!');
                            window.location.href = 'login.php';
                        </script>";
                exit();
            } else {
                echo "<script>alert('Error occurred, please try again later.');</script>";
            }
        }
        $stmt->close();
    }
}
?>

<html>
<head>
    <title>User Registration | Simple Login Register</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="" method="POST" autocomplete="off">
            <div class="form-group">
                <label for="full-name">Full Name</label>
                <input type="text" name="fullName" placeholder="Enter full name" required/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter email" required/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter password" required/>
            </div>
            <div class="form-button">
                <button type="submit">Submit</button>
            </div>
        </form>
        <div id="footer">
            <a href="login.php"><p>Click to Login</p></a>
        </div>
        <div id="developer">
            Developed by Abishaek Duresh
        </div>
    </div>
</body>
</html>
