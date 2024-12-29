<?php
require "../config/config.php";

$login_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password, is_admin FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $userID, $stored_hash, $is_admin);
    mysqli_stmt_fetch($stmt);

    if (password_verify($password, $stored_hash)) {
        if ($is_admin == 1) {
            $_SESSION['userID'] = $userID;
            header('Location: ../admin/admin.php');
        } else {
            $_SESSION['userID'] = $userID;
            header('Location: ../user/dashboard.php');
        }
    } else {
        $login_err = "Invalid email or password.";
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zodiak Bear | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
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
                <button type="submit" class="btn btn-primary" style="margin-top:32px;">Log In</button>
            </form>
            <p class="text-center mt-3">
                Don't have an account? <a href="register.php">Sign Up</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
