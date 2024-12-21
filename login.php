<?php
session_start();

if (isset($_POST['login'])) {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "Lab_5b");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to check for the user
    $sql = "SELECT * FROM users WHERE matric = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $matric, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = [
            'matric' => $user['matric'],
            'name' => $user['name'],
            'role' => $user['role']
        ]; // Store user data in the session
    
        header("Location: display.php");
        exit();
    } else {
        header("Location: login.php?error=invalid");
        exit();
    }
    

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit" name="login">Log In</button>
    </form>
    <p>Register <a href="register.php">here</a> if you have not.</p>
    
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'invalid') {
        echo '<p style="color: red;">Invalid username or password, try <a href="login.php">login</a> again.</p>';
    }
    ?>
</body>
</html>
