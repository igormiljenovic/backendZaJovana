<?php
// Connect to the database
$pdo = new PDO("mysql:host=localhost;dbname=auris", "root", "");

// Calculate the date 60 days ago
$deleteDate = date('Y-m-d', strtotime('-60 days'));

// Prepare and execute the delete query
$stmt = $pdo->prepare("DELETE FROM policies WHERE created_at < :deleteDate");
$stmt->execute(['deleteDate' => $deleteDate]);