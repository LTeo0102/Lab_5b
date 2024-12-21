<?php include 'session_check.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Display Users</title>
</head>
<body>
    <a href="logout.php" style="float: right; color: red;">Logout</a>

    <h2>Users List</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th>Action</th> <!-- New Action Column -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to the database
            $conn = new mysqli("localhost", "root", "", "Lab_5b");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from the users table
            $sql = "SELECT matric, name, role AS level FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td style='text-align: center;'>" . $row['matric'] . "</td>";
                    echo "<td style='text-align: left;'>" . $row['name'] . "</td>";
                    echo "<td style='text-align: center;'>" . $row['level'] . "</td>";
                    echo "<td style='text-align: center;'>
                            <a href='update.php?matric=" . $row['matric'] . "'>Update</a> | 
                            <a href='delete.php?matric=" . $row['matric'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align: center;'>No records found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
