<?php
require_once 'config/config.php';

// Start the session
session_start();

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user from the database
    $stmt = $pdo->prepare("SELECT id, username, password, user_type FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Verify password
    if ($user && password_verify($password, $user['password'])) {
        // Authentication successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];

        // Redirect to appropriate page based on user type
        if ($user['user_type'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: dashboard.php');
        }
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid username or password.";
    }
}

require 'inc/header.php';
?>

<style>
body {
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-form {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 400px;
    width: 100%;
}

.login-form h2 {
    color: #902087;
    text-align: center;
    margin-bottom: 20px;
}

.login-form label {
    color: #902087;
    font-weight: bold;
}

.login-form input[type="text"],
.login-form input[type="password"] {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    width: 100%;
}

.login-form input[type="text"]:focus,
.login-form input[type="password"]:focus {
    border-color: #902087;
}

.login-form button[type="submit"] {
    background-color: #902087;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.login-form button[type="submit"]:hover {
    background-color: #EAB930;
}

.login-form p {
    margin-top: 10px;
    text-align: center;
}

.login-form p a {
    color: #902087;
    text-decoration: none;
}

.login-form p a:hover {
    text-decoration: underline;
}

header,
footer {
    width: 100%;
}
</style>

<div class="container">
    <!-- HTML form for login -->
    <div class="login-form">
        <h2>Dobrodošli</h2>
        <form method="POST" action="login.php">
            <label for="username">Korisničko ime:</label>
            <input type="text" name="username" placeholder="Unesite korisničko ime" required>
            <label for="password">Šifra:</label>
            <input type="password" name="password" placeholder="Unesite šifru" required>
            <button type="submit">Prijavi se</button>
        </form>
    </div>
</div>


<?php
// Include the footer file
require 'inc/footer.php';
?>