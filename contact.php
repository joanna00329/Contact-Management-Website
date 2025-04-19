<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact</title>
  <link href="https://bootswatch.com/5/minty/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .contact-button {
        display: block;
        width: 100%;
        margin: 10px auto;
        padding: 10px;
        text-align: center;
        background-color: #add8e6;
        color: black;
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        text-decoration: none;
    }

    .contact-button:hover {
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

    // Fetch data from the database
    $sql = "SELECT id, name FROM contact ORDER BY name ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<a href="contact_detail.php?id=' . urlencode($row["id"]) . '" class="contact-button">' . htmlspecialchars($row["name"]) . '</a>';

        }
    } else {
        echo "<p>0 results</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
