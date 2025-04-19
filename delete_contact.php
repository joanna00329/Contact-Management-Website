<?php
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

$contact_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$action = isset($_GET["action"]) ? $_GET["action"] : '';

if ($contact_id > 0) {
    if ($action == 'delete') {
        $sql = "UPDATE contact SET deleted = 1 WHERE id = $contact_id";
    } elseif ($action == 'undelete') {
        $sql = "UPDATE contact SET deleted = 0 WHERE id = $contact_id";
    } else {
        die("Invalid action.");
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: contact.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid contact ID.";
}

$conn->close();
?>
