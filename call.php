<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Call</title>
  <link href="https://bootswatch.com/5/minty/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .call-detail {
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
        text-align: center;
    }
    .btn {
        margin: 5px;
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
          <a class="nav-link" href="new_contact.php"><strong>New Contact</strong></a>
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
    $sql = "SELECT id, name, number FROM contact WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the contact
        $row = $result->fetch_assoc();
        
        $contact_id = $row["id"];
        $contact_name = htmlspecialchars($row["name"]);
        $contact_number = htmlspecialchars($row["number"]);

        // Insert call start record into the history table
        $call_start = date('Y-m-d H:i:s');
        $sql_insert = "INSERT INTO history (contact_id, call_start) VALUES ('$contact_id', '$call_start')";
        if ($conn->query($sql_insert) === TRUE) {
            $history_id = $conn->insert_id;
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
            $conn->close();
            exit;
        }

        echo '<div class="call-detail">';
        echo '<h2>Calling ' . $contact_name . '</h2>';
        echo '<p><strong>Number:</strong> ' . $contact_number . '</p>';
        echo '<form method="post" action="end_call.php">';
        echo '<input type="hidden" name="history_id" value="' . $history_id . '">';
        echo '<button type="submit" class="btn btn-danger">End Call</button>';
        echo '</form>';
        echo '</div>';
    } else {
        echo "<p>No details found for this contact.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
