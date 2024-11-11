<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Game Results</title>
    </head>
    <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "softball";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM games ORDER BY id";
        $result = $conn->query($sql);

        echo "<table>";

        echo "<tr>
                <th>ID</th>
                <th>Opponent</th>
                <th>Site</th>
                <th>Result</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['opponent'] . "</td>";
            echo "<td>" . $row['site'] . "</td>";
            echo "<td>" . $row['result'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";

        $conn->close();
        ?>
    </body>
</html>
