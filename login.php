<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
        echo "<script>alert('All fields are required');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format');</script>";
    } else {
        $stmt = $conn->prepare("SELECT full_name, email, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_full_name, $db_email, $db_password);
            $stmt->fetch();
            if (password_verify($password, $db_password)) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['fullName'] = $db_full_name;
                $_SESSION['email'] = $email;
                echo "<script>alert('Login successful!');
                        window.location.href = 'welcome.php';
                      </script>";
                exit();
            } else {
                echo "<script>alert('Invalid credentials.');</script>";
            }
        } else {
            echo "<script>alert('No user found with that email.');</script>";
        }
        $stmt->close();
    }
}
?>

<html>
    <head>
        <title>User Login | Simple Login Register</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>
        <div class="container">
            <h2>Login Form</h2>
            <form action="" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Enter email" required/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter password" required/>
                </div>
                <div class="form-button">
                    <!-- Apply the container-button class to the submit button -->
                    <button type="submit" class="container-button">Submit</button>
                </div>
            </form>
            <div id="footer">
                <a href="register.php"><p>Click to Register</p></a>
            </div>
            <div id="developer">
                Developed by Abishaek Duresh
            </div>
        </div>
    </body>
</html>
