<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$id = $_POST["contact_id"];
$name = $_POST["name"];
$email = $_POST["email"];
$number = $_POST["number"];


$sql = "UPDATE contact SET name = '$name', email = '$email', number = '$number' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
  header('Location: contact.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
