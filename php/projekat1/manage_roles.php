<?php
session_start();

// Check if the user is not logged in or is not an admin user
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Include the config.php file to establish the database connection
require_once 'config/config.php';

// Function to fetch users based on search query
function searchUsers($searchQuery)
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE name LIKE ? OR surname LIKE ?");
    $stmt->execute(["%$searchQuery%", "%$searchQuery%"]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to fetch all users
function getAllUsers()
{
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to update user role
function updateUserRole($id, $userType)
{
    global $pdo;

    $stmt = $pdo->prepare("UPDATE users SET user_type = ? WHERE id = ?");
    $result = $stmt->execute([$userType, $id]);

    if ($result) {
        return $stmt->rowCount();
    } else {
        // Display the error message if the query fails
        echo "Error updating user role: " . $stmt->errorInfo()[2];
        return false;
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['updateRole'])) {
        $id = $_POST['id'];
        $userType = $_POST['userType'];

        // Check if the user role has changed
        if ($userType !== $_POST['currentRole']) {
            updateUserRole($id, $userType);
        }
    }
    
    // Redirect to the same page to prevent form resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all users
$users = getAllUsers();

// Handle search submissions
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    // Perform search if search query is not empty
    if (!empty($searchQuery)) {
        $users = searchUsers($searchQuery);
    }
}

// Include the header file
require 'inc/header.php';
?>


<div class="container">
    <h3 class="mb-4">Upravljaj Ulogama Korisnika</h3>
    <!-- Search bar -->
    <div class="search-bar">
        <form method="GET" action="">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Pretražite po imenu ili prezimenu"
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit" class="btn btn-primary">Pretraži</button>
            </div>
        </form>
    </div>

    <!-- Display the user table -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Ime i Prezime</th>
                    <th>Zastupnik Šifra</th>
                    <th>Uloga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user['name'] . ' ' . $user['surname']; ?></td>
                    <td><?php echo $user['zastupnikID']; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                            <input type="hidden" name="currentRole" value="<?php echo $user['user_type']; ?>">
                            <select name="userType" onchange="this.form.submit()" class="form-control">
                                <option value="regular"
                                    <?php echo $user['user_type'] === 'regular' ? 'selected' : ''; ?>>
                                    Korisnik</option>
                                <option value="admin" <?php echo $user['user_type'] === 'admin' ? 'selected' : ''; ?>>
                                    Admin
                                </option>
                            </select>
                            <input type="hidden" name="updateRole" value="1">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Include the footer file
require 'inc/footer.php';
?>