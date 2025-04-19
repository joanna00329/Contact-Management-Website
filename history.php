<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Call History</title>
  <link href="https://bootswatch.com/5/minty/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
        background-color: #ff; 
    }
    .navbar {
        margin-bottom: 20px;
    }
    .history-table {
        margin: 20px auto;
        max-width: 800px; 
        border-radius: 5px;
        overflow: hidden;
        background-color: #ffffff; 
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    .table thead th {
        background-color: #add8e6;
        color: #555;
    }
    .table tbody tr:nth-child(even) {
        background-color: #d0ebff; 
    }
    .table tbody tr:nth-child(odd) {
        background-color: #e6f7ff; 
    }
    .table tbody tr:hover {
        background-color: #cce7ff;
    }
    .container {
        margin-top: 20px;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #555;
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
          <a class="nav-link active" href="history.php"><strong>History</strong></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <h2>Call History</h2>
    <table class="table table-striped table-hover history-table">
        <thead>
            <tr>
                <th scope="col">Contact Name</th>
                <th scope="col">Call Start</th>
                <th scope="col">Call End</th>
            </tr>
        </thead>
        <tbody>
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

            // Fetch the call history from the database
            $sql = "SELECT h.call_start, h.call_end, c.name FROM history h LEFT JOIN contact c ON h.contact_id = c.id ORDER BY h.call_start DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["call_start"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["call_end"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No call history found.</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
