<!DOCTYPE html>
<html>

<head>
    <title>Aura APP</title>
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        integrity="sha384-..." crossorigin="anonymous">

</head>
<style>
a {
    text-decoration: none;
    color: #902087;
}
</style>

<body>
    <header>
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <div class="logo">
                    </div>
                </div>
                <div class="col-auto">
                    <nav>
                        <ul>
                            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') : ?>
                            <!-- Show admin-specific links -->
                            <li><a href="admin.php">Admin</a></li>
                            <li><a href="manage_roles.php">Upravljaj Ulogama</a></li>
                            <li><a href="add_user.php">Dodaj Korisnika</a></li>
                            <?php elseif (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'regular') : ?>
                            <!-- Show regular user-specific links -->
                            <li><a href="dashboard.php">Lista Polisa</a></li>
                            <li><a href="control_dashboard.php">Kontrolna Lista</a></li>
                            <?php endif; ?>
                            <?php if (basename($_SERVER['PHP_SELF']) !== 'login.php') : ?>
                            <li><a href="logout.php">Odjavi se</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Content of the page goes here -->
    <main>