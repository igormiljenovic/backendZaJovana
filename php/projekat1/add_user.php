<?php
require_once 'config/config.php'; // Include your database configuration file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $zastupnikID = $_POST['zastupnikID'];
    $entity = $_POST['entity'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, password, name, surname, zastupnikID, entity) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$username, $hashedPassword, $name, $surname, $zastupnikID, $entity]);

    // Redirect to a success page or perform any other desired action
    header("Location: admin.php");
    exit();
}

// Include the header file
require 'inc/header.php';
?>

<div class="container">
    <h1 class="mb-4">Dodaj Korisnika</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Korisničko ime:</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Šifra:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Ime:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Prezime:</label>
            <input type="text" name="surname" id="surname" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="zastupnikID" class="form-label">Zastupnik Šifra:</label>
            <input type="text" name="zastupnikID" id="zastupnikID" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="entity" class="form-label">Entitet:</label>
            <input type="text" name="entity" id="entity" class="form-control" required>
        </div>

        <input type="submit" value="Dodaj Korisnika" class="btn btn-primary">
        <button onclick="goBack()" class="btn btn-secondary">Nazad</button>
    </form>
</div>

<!-- JavaScript function to navigate back to admin.php -->
<script>
function goBack() {
    window.location.href = 'admin.php';
}
</script>

<?php
// Include the footer file
require 'inc/footer.php';
?>