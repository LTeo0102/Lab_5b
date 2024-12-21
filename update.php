<?php include 'session_check.php'; ?>

<?php
// Check if matric is passed in the URL
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "Lab_5b");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user details for the given matric
    $sql = "SELECT matric, name, role FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the updated values from the form
        $name = $_POST['name'];
        $role = $_POST['role'];

        // Update the user in the database
        $update_sql = "UPDATE users SET name = '$name', role = '$role' WHERE matric = '$matric'";

        if ($conn->query($update_sql) === TRUE) {
            header("Location: display.php"); // Redirect to display page after successful update
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $conn->close();
} else {
    echo "Matric number is missing.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="POST">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" value="<?php echo $user['matric']; ?>" readonly><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required><br><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="Student" <?php echo ($user['role'] == 'Student') ? 'selected' : ''; ?>>Student</option>
            <option value="Staff" <?php echo ($user['role'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
        </select><br><br>

        <button type="submit">Update</button>
        <a href="display.php" style="color: red; margin-left: 10px;">Cancel</a>
    </form>
</body>
</html>
