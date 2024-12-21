
<?php include 'session_check.php'; ?>

<?php
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "Lab_5b");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the user from the database
    $sql = "DELETE FROM users WHERE matric = '$matric'";

    if ($conn->query($sql) === TRUE) {
        header("Location: display.php"); // Redirect to display page after successful delete
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Matric number is missing.";
    exit();
}
?>
