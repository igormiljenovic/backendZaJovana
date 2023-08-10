<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auris";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM tblnepostojecizastupnik WHERE id='" . $_GET['id'] . "'";


if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . $conn->error;
  }

$conn->close();
echo "<script>
             window.history.go(-1);
     </script>";
?>
