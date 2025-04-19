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
$name = $_POST["name"];
$email = $_POST["email"];
$number = $_POST["number"];

$sql = "INSERT INTO contact (name, email, number)
        VALUES ('$name', '$email', '$number')";

if ($conn->query($sql) === TRUE) {
  header('Location: contact.php');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
