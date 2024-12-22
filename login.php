<?php
session_start();
$login_err = "";

$host = 'localhost';
$db_username = 'root'; 
$db_password = '';
$database = 'horoscope_users';

$conn = mysqli_connect($host, $db_username, $db_password, $database, null, '/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');

if (mysqli_connect_errno()) {  
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query  = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row["is_admin"] == 1) {
            echo 'Login successful! You are an admin!';
        } else {
            echo'Login successful! You are a user!';
        }
    } else {
        $login_err = "Invalid email or password!";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="registration-login-page">
    <div class="registration-container">
        <!-- Illustration Column -->
        <div class="illustration"></div>

        <!-- Registration Form Column -->
        <div class="form-section">
            <h2 class="form-title">Login</h2>
            <?php
                if(!empty($login_err)){
                    echo '<div class="error-message">' . $login_err . '</div>';
                } 
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                </div>
                <button type="submit" class="btn btn-primary">Log In!</button>
            </form>
            <p class="text-center mt-3">
                Don't have an account? <a href="#">Sign Up!</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
