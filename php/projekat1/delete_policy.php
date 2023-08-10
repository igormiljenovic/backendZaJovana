<?php
session_start();

// Check if the user is not logged in or is not a regular user
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'regular') {
    header('Location: login.php');
    exit();
}

// Include the config.php file to establish the database connection
require_once 'config/config.php';

// Check if the policy ID is provided in the URL
if (!isset($_GET['polisa'])) {
    header('Location: dashboard.php');
    exit();
}

$polisaNumber = $_GET['polisa'];

// Fetch the policy based on the provided Polisa number and user ID
$stmt = $pdo->prepare("
    SELECT *,
           (Provizija / Premija) * 100 AS ProvizijaProcenat
    FROM (
        SELECT Polisa, Klijent, PremijaAO AS Premija, ProvizijaAO AS Provizija, 'AO' AS VrstaPolise
        FROM aobaza
        WHERE ZastupnikSifra = (
            SELECT ZastupnikID
            FROM users
            WHERE id = :userId
        ) AND Polisa = :polisaNumber
        UNION ALL
        SELECT Polisa, Klijent, PremijaGR AS Premija, ProvizijaGR AS Provizija, 'GR' AS VrstaPolise
        FROM grbaza
        WHERE ZastupnikSifra = (
            SELECT ZastupnikID
            FROM users
            WHERE id = :userId
        ) AND Polisa = :polisaNumber
        UNION ALL
        SELECT Polisa, Klijent, PremijaIM AS Premija, ProvizijaIM AS Provizija, 'IM' AS VrstaPolise
        FROM imbaza
        WHERE ZastupnikSifra = (
            SELECT ZastupnikID
            FROM users
            WHERE id = :userId
        ) AND Polisa = :polisaNumber
        UNION ALL
        SELECT Polisa, Klijent, PremijaKASKO AS Premija, ProvizijaKASKO AS Provizija, 'KASKO' AS VrstaPolise
        FROM kaskobaza
        WHERE ZastupnikSifra = (
            SELECT ZastupnikID
            FROM users
            WHERE id = :userId
        ) AND Polisa = :polisaNumber
        UNION ALL
        SELECT Polisa, Klijent, PremijaNZ AS Premija, ProvizijaNZ AS Provizija, 'NZ' AS VrstaPolise
        FROM nzbaza
        WHERE ZastupnikSifra = (
            SELECT ZastupnikID
            FROM users
            WHERE id = :userId
        ) AND Polisa = :polisaNumber
        UNION ALL
        SELECT Polisa, Klijent, PremijaZB AS Premija, ProvizijaZB AS Provizija, 'ZB' AS VrstaPolise
        FROM zbbaza
        WHERE ZastupnikSifra = (
            SELECT ZastupnikID
            FROM users
            WHERE id = :userId
        ) AND Polisa = :polisaNumber
        UNION ALL
        SELECT Polisa, Klijent, PremijaZD AS Premija, ProvizijaZD AS Provizija, 'ZD' AS VrstaPolise
        FROM zdbaza
        WHERE ZastupnikSifra = (
            SELECT ZastupnikID
            FROM users
            WHERE id = :userId
        ) AND Polisa = :polisaNumber
    ) AS policies
");

$stmt->execute(['userId' => $_SESSION['user_id'], 'polisaNumber' => $polisaNumber]);
$policy = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the policy exists
if (!$policy) {
    header('Location: dashboard.php');
    exit();
}

// Get the ZastupnikSifra from the users table using user_id
$stmt = $pdo->prepare("SELECT ZastupnikID FROM users WHERE id = :userId");
$stmt->execute(['userId' => $_SESSION['user_id']]);
$zastupnikSifra = $stmt->fetchColumn();

// Insert the deleted policy into the policies table with edited value = '1'
$stmt = $pdo->prepare("INSERT INTO policies (Polisa, Klijent, ZastupnikSifra, Premija, Provizija, Komentar, edited, created_at) VALUES (?, ?, ?, ?, ?, ?, '1', CURRENT_TIMESTAMP)");
$stmt->execute([$policy['Polisa'], $policy['Klijent'], $zastupnikSifra, $policy['Premija'], $policy['Provizija'], $policy['Komentar']]);

// Redirect back to the dashboard page after the deletion
header('Location: dashboard.php');
exit();
?>