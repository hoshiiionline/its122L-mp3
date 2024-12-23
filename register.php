<?php
require "config.php";
$regis_success = false;
$regis_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] :"";
    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] :"";
    $email = isset($_POST["email"]) ? $_POST["email"] :"";
    $password = isset($_POST["password"]) ? $_POST["password"] :"";
    $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] :"";
    $birthMonth = isset($_POST["birthMonth"]) ? $_POST["birthMonth"] :"";
    $birthDate = isset($_POST["birthDate"]) ? $_POST["birthDate"] :"";
    $birthYear = isset($_POST["birthYear"]) ? $_POST["birthYear"] :"";
    $gender = isset($_POST["gender"]) ? $_POST["gender"]: "";

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword) || empty($birthMonth) || empty($birthDate) || empty($birthYear) || empty($gender) || empty($gender)) {
        $regis_err = "Please fill out all fields!";
    } else if ($password != $confirmPassword) {
        $regis_err = "Passwords do not match!";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $regis_err = "User with email already exists!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (first_name, last_name, email, password, birth_month, birth_day, birth_year, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssiiis", $firstName, $lastName, $email, $hashed_password, $birthMonth, $birthDate, $birthYear, $gender);
            
            if (mysqli_stmt_execute($stmt)) {
                $regis_success = true;
            } else {
                $regis_err = "Error: " . mysqli_error($conn);
            }
        }
        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body class="registration-login-page">
    <div class="registration-container">
        <!-- Illustration Column -->
        <div class="illustration"></div>

        <!-- Registration Form Column -->
        <div class="form-section">
            <h2 class="form-title">Registration</h2>
            <?php
                if(!empty($regis_err)){
                    echo '<div class="error-message">' . $regis_err . '</div>';
                } 
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return confirmRegister();">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter your first name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter your last name">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm your password">
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="birthMonth" class="form-label">Birth Month</label>
                        <input type="number" class="form-control" name="birthMonth" id="birthMonth" placeholder="MM" min="1" max="12">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="birthDate" class="form-label">Birth Date</label>
                        <input type="number" class="form-control" name="birthDate" id="birthDate" placeholder="DD" min="1" max="31">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="birthYear" class="form-label">Birth Year</label>
                        <input type="number" class="form-control" name="birthYear" id="birthYear" placeholder="YYYY">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="other" value="Other">
                            <label class="form-check-label" for="other">Other</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <p class="text-center mt-3">
                Already have an account? <a href="login.php">Sign in</a>
            </p>
        </div>
    </div>

    <?php if($regis_success) : ?>
        <script>
            alert("Registration successful!");
            window.location.href = "login.php";
        </script>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
