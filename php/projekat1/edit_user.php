<?php
session_start();

// Check if the user is not logged in or is not an admin user
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Include the config.php file to establish the database connection
require_once 'config/config.php';

// Check if the form is submitted
if (isset($_POST['updateUser'])) {
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $zastupnikID = $_POST['zastupnikID'];
    $entity = $_POST['entity'];

    // Prepare and execute the update query
    $stmt = $pdo->prepare("UPDATE users SET username = ?, name = ?, surname = ?, zastupnikID = ?, entity = ? WHERE id = ?");
    $stmt->execute([$username, $name, $surname, $zastupnikID, $entity, $userId]);

    // Redirect to the admin page after updating
    header('Location: admin.php');
    exit();
}

// Retrieve the user details from the database
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare and execute the select query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);

    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists
    if (!$user) {
        // User not found, redirect to admin page or display an error message
        header('Location: admin.php');
        exit();
    }
} else {
    // No user ID specified, redirect to admin page or display an error message
    header('Location: admin.php');
    exit();
}

// Include the header file
require 'inc/header.php';
?>
<div class="container">
    <!-- HTML form for updating user details -->
    <form method="post" class="user-form">
        <input type="hidden" name="userId" value="<?php echo $user['id']; ?>">
        <div class="mb-3">
            <label for="username" class="form-label">Korisničko ime:</label>
            <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>"
                class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Ime:</label>
            <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Prezime:</label>
            <input type="text" name="surname" id="surname" value="<?php echo $user['surname']; ?>" class="form-control"
                required>
        </div>
        <div class="mb-3">
            <label for="zastupnikID" class="form-label">Zastupnik Šifra:</label>
            <input type="text" name="zastupnikID" id="zastupnikID" value="<?php echo $user['zastupnikID']; ?>"
                class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="entity" class="form-label">Entitet:</label>
            <input type="text" name="entity" id="entity" value="<?php echo $user['entity']; ?>" class="form-control"
                required>
        </div>
        <button type="submit" name="updateUser" class="btn btn-primary">Snimi</button>
    </form>
</div>
<?php
// Include the footer file
require 'inc/footer.php';
?>