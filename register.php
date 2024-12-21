<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <form method="POST" action="">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="" disabled selected>Please select</option>
            <option value="Student">Student</option>
            <option value="Staff">Staff</option>
        </select><br><br>

        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $password = $_POST['password']; 
        $role = $_POST['role'];

        // Connect to MySQL database
        $conn = new mysqli("localhost", "root", "", "Lab_5b");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data into the table
        $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
