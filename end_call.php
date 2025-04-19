<?php

date_default_timezone_set('Asia/Jakarta');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$history_id = isset($_POST["history_id"]) ? intval($_POST["history_id"]) : 0;

if ($history_id > 0) {
    $call_end = date('Y-m-d H:i:s');
    $sql = "UPDATE history SET call_end = '$call_end' WHERE history_id = $history_id";

    if ($conn->query($sql) === TRUE) {
        echo "Call record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid call ID.";
}

$conn->close();

// Redirect to the contact page
header("Location: contact.php");
exit;
?>
