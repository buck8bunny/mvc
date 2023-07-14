
    <!DOCTYPE html>
<html>
<head>
    <title>Registered Members</title>
    <style>
        table, h2 {
            border-collapse: collapse;
            margin: 0 auto;
            text-align: center;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #E8F5E9;
        }

        tr:hover {
            background-color: #C8E6C9;
        }
    </style>
</head>
<body>
    <h2>Registered Members</h2>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "test";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Connectivity Check
    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    // Getting data from the database
    $sql = "SELECT file_name, fullname, report, email FROM users";
    $result = $conn->query($sql);

    // Data Existence Check
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Photo</th><th>Full Name</th><th>Report subject</th><th>Email</th></tr>";

        // Outputting data to a table
        while ($row = $result->fetch_assoc()) {
            $photoPath = "uploads/" . $row["file_name"];
            echo "<tr><td><img src='" . $photoPath . "' width='100' height='100'></td><td>" . $row["fullname"] . "</td><td>" . $row["report"] . "</td><td>" . $row["email"] . "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "No data";
    }

    $conn->close();
    ?>
</body>
</html>

   