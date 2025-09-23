<?php
session_start();

// Database connection details
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'db_pcs';
$DATABASE_PORT = 3306;

// Connect to the database
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME, $DATABASE_PORT);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Validate and sanitize input
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (!$email || !$password) {
    exit('Please fill both the email and password fields!');
}

// Prepare an SQL statement to check for the user
if ($stmt = $con->prepare('SELECT id, username, password, role FROM users WHERE email = ?')) {
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Fetch user data
        $stmt->bind_result($id, $username, $hashed_password, $role);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Regenerate session ID to prevent session fixation
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            // Redirect to appropriate dashboard based on role
            if ($role === 'admin') {
                header('Location: index-admin.php');
            } else {
                header('Location: index-user.php');
            }
            exit();
        } else {
            // Incorrect password
            header("Location: index.php?error=invalid_credentials", true, 303);
            exit();
        }
    } else {
        // Email not found
        header("Location: index.php?error=invalid_credentials", true, 303);
        exit();
    }

    $stmt->close();
} else {
    exit('Failed to prepare statement');
}
?>
