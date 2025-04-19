<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Detail</title>
  <link href="https://bootswatch.com/5/minty/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .contact-detail {
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .btn {
        margin: 5px;
    }

    .btn:hover {
   	box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19); 
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="contact.php"><strong>Contact</strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="new_contact.html"><strong>New Contact</strong></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="history.php"><strong>History</strong></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <?php

    date_default_timezone_set('Asia/Jakarta');
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

    // Get the id from the URL parameter
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Fetch the contact details from the database
    $sql = "SELECT id, name, email, number, deleted FROM contact WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the contact
        $row = $result->fetch_assoc();
        
        // Check if JSON response is requested
        if (isset($_GET['json']) && $_GET['json'] == 1) {
            header('Content-Type: application/json');
            echo json_encode($row);
            exit;
        }

        echo '<div class="contact-detail">';
        echo '<h2>' . htmlspecialchars($row["name"]) . '</h2>';
        echo '<p><strong>Email:</strong> ' . htmlspecialchars($row["email"]) . '</p>';
        echo '<p><strong>Number:</strong> ' . htmlspecialchars($row["number"]) . '</p>';
        echo '<a href="contact.php" class="btn btn-primary">Return</a>';
        echo '<a href="update_contact.html?id=' . $row["id"] . '" class="btn btn-warning">Update</a>';
        
        // Display the delete/undelete button
        if ($row["deleted"]) {
            echo '<a class="btn btn-success" href="delete_contact.php?id=' . $row["id"] . '&action=undelete">Undelete</a>';
            echo '<a class="btn btn-secondary disabled" href="#">Call</a>';
        } else {
            echo '<a class="btn btn-danger" href="delete_contact.php?id=' . $row["id"] . '&action=delete">Delete</a>';
            echo '<a class="btn btn-success" href="call.php?id=' . $row["id"] . '">Call</a>';
        }

        echo '</div>';
    } else {
        echo "<p>No details found for this contact.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
