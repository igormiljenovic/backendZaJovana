<?php
// Include the config.php file to establish the database connection
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Perform form validation
    $errors = [];

    // Extract the data from the POST request
    $polisa = $_POST['polisa'];
    $premija = $_POST['premija'];
    $provizija = $_POST['provizija'];
    $provizijaProcenat = $_POST['provizijaProcenat'];
    $premijaZB = isset($_POST['premijaZB']) ? $_POST['premijaZB'] : "";
    $provizijaZB = isset($_POST['provizijaZB']) ? $_POST['provizijaZB'] : 1;
    $provizijaProcenatZB = isset($_POST['provizijaProcenatZB']) ? $_POST['provizijaProcenatZB'] : "";
    $komentar = $_POST['komentar'];

    if (empty($polisa)) {
        $errors[] = 'Polisa polje nedostaje za odabranu polisu.';
    }

    if ($provizija > $premija) {
        $errors[] = 'Provizija mora biti manja od premije za odabranu polisu.';
    }

    if ($provizija == 0 || $provizija == '') {
        $errors[] = 'Provizija za odabranu polisu je jednaka nuli ili prazna.';
    }

    if (isset($_POST['provizijaZB']) > isset($_POST['premijaZB'])) {
        $errors[] = 'Provizija zaštite bonusa mora biti manja od premije za odabranu polisu.';
    }

    if ($provizijaZB == 0 || $provizijaZB == '') {
        $errors[] = 'Provizija zaštite bonusa za odabranu polisu je jednaka nuli ili prazna.';
    }

    if ($provizijaProcenatZB > 99) {
        $errors[] = 'Provizija procenat zaštite bonusa za odabranu polisu je veća od 99%.';
    }

    if ($provizijaProcenat > 99) {
        $errors[] = 'Provizija procenat zaštite bonusa za odabranu polisu je veća od 99%.';
    }

    if (empty($errors)) {
        try {
            // Prepare the UPDATE statement
            $stmt = $pdo->prepare("
                UPDATE policies
                SET Provizija = :provizija,
                    Komentar = :komentar
                WHERE Polisa = :polisa
            ");
                
            // Bind the parameters
            $stmt->bindParam(':polisa', $polisa);
            $stmt->bindParam(':provizija', $provizija);
            $stmt->bindParam(':komentar', $komentar);
            $stmt->execute();

            if ($provizijaZB > 0) {
                $stmt = $pdo->prepare("
                UPDATE policies_dopunskazb 
                SET Provizija = :provizijaZB
                WHERE Polisa = :polisa
                ");
                $stmt->bindParam(':provizijaZB', $provizijaZB);
                $stmt->bindParam(':polisa', $polisa);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            // Handle the error if the query execution fails
            $errors[] = 'Error: ' . $e->getMessage();
        }
    }


    if (empty($errors)) {
        $response = array(
            'success' => true,
            'message' => 'Polisa uspješno ažurirana.'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => implode("\n", $errors)
        );
    }

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

?>