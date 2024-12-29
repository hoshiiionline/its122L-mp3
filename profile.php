<?php
require 'config.php';

$firstName = '';
$lastName = '';
$email = '';
$birthDate = '';
$birthMonth = '';
$birthYear = '';
$gender = '';

// determine if user is an admin
if (isset($_SESSION['userID']) && is_numeric($_SESSION['userID'])) {
    if ($stmt = $conn->prepare("SELECT is_admin FROM users WHERE id = ?")) {
        
        $stmt->bind_param("i", $_SESSION['userID']);
        
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $is_admin = $row['is_admin'];
            }
        } else {
            echo "No user found with the specified ID.";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }
} else {
    echo "Invalid or missing user ID.";
}

if (isset($_SESSION['userID']) && is_numeric($_SESSION['userID'])) {
    if ($stmt = $conn->prepare("SELECT first_name, last_name, email, birth_month, birth_day, birth_year, gender FROM users WHERE id = ?")) {
        
        $stmt->bind_param("i", $_SESSION['userID']);
        
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $firstName = $row['first_name'];
                $lastName = $row['last_name'];
                $email = $row['email'];
                $birthMonth = $row['birth_month'];
                $birthDate = $row['birth_day'];
                $birthYear = $row['birth_year'];
                $gender = $row['gender'];
            }
        } else {
            echo "No user found with the specified ID.";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }
} else {
    echo "Invalid or missing user ID.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit-change-details'])) {
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $email = trim($_POST['email']);
        $birthMonth = intval($_POST['birthMonth']);
        $birthDate = intval($_POST['birthDate']);
        $birthYear = intval($_POST['birthYear']);
        $gender = trim($_POST['gender']);

        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, birth_month = ?, birth_day = ?, birth_year = ?, gender = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssiiisi", $firstName, $lastName, $email, $birthMonth, $birthDate, $birthYear, $gender, $_SESSION['userID']);

            if (mysqli_stmt_execute($stmt)) {
                $regis_success = "Information details updated successfully!";
            } else {
                $regis_err = "Error updating record: " . mysqli_stmt_error($stmt);
            }

            $stmt->close();
        } else {
            $regis_err = "Error preparing the statement: " . mysqli_error($conn);
        }
    } else if (isset($_POST['submit-change-pw'])) {
        $curr_password = $_POST['currentPassword'];
        $new_password = $_POST['newPassword'];
        $conf_password = $_POST['confirmPassword'];

        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $stored_hash);
        mysqli_stmt_fetch($stmt);

        $stmt->close();

        if (password_verify($curr_password, $stored_hash)) {
            if ($new_password != $conf_password) {
                $regis_err = "Passwords do not match!";
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                $sql = "UPDATE users SET password = ? WHERE id = ?";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "si", $hashed_password, $_SESSION['userID']);

                    if (mysqli_stmt_execute($stmt)) {
                        $regis_success = "Password updated successfully!";
                    } else {
                        $regis_err = "Error updating password: " . mysqli_error($conn);
                    }

                    $stmt->close();
                } else {
                    $regis_err = "Failed to prepare the SQL query.";
                }
            }
        } else {
            $regis_err = "Current password is incorrect.";
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zodiac Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Link to CSS -->

</head>
<body class="dashboard-page">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <h1 class="navbar-title">Zodiac Dashboard</h1>
            <ul class="navbar-links">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="zodiacs.php">Zodiac Wheel</a></li>
                <li><a href="#">Profile</a></li>
                
                <?php 
                if ((int)$is_admin === 1) {
                    echo "<li> | </li>
                    <li><a href='admin.php'>Edit</a></li>";
                }
                ?>
                <li><a href="logout.php">Sign Out</a></li>
            </ul>
        </div>
    </nav>

    <!-- Dashboard Body -->
    <div class="dashboard">
        <!-- Left Column -->
        <div class="center-column" id="change-details">
            <div class="profile-section">
                <h2>My Profile</h2>
                <img src="/assets/user.png" class="profile-avatar">
                <div class="form-section">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter your first name" value="<?php echo htmlspecialchars($firstName); ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter your last name" value="<?php echo htmlspecialchars($lastName); ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address" value="<?php echo htmlspecialchars($email); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="change-pw" class="form-label">Password</label>
                        <button type="button" class="btn btn-primary" onclick="switchChangePassword()">Change Password</button>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="birthMonth" class="form-label">Birth Month</label>
                            <input type="number" class="form-control" name="birthMonth" id="birthMonth" placeholder="MM" min="1" max="12" value="<?php echo htmlspecialchars($birthMonth); ?>" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="birthDate" class="form-label">Birth Date</label>
                            <input type="number" class="form-control" name="birthDate" id="birthDate" placeholder="DD" min="1" max="31" value="<?php echo htmlspecialchars($birthDate); ?>" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="birthYear" class="form-label">Birth Year</label>
                            <input type="number" class="form-control" name="birthYear" id="birthYear" placeholder="YYYY" value="<?php echo htmlspecialchars($birthYear); ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Gender</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" 
                                <?php if ($gender === "Male") echo 'checked'; ?>>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" 
                                <?php if ($gender === "Female") echo 'checked'; ?>>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="other" value="Other" 
                                <?php if ($gender === "Other") echo 'checked'; ?>>
                            <label class="form-check-label" for="other">Other</label>
                        </div>
                    </div>
                    <!-- Hidden Submit and Cancel buttons -->
                    <div id="actionButtons" style="display:none;">
                        <button type="submit" name="submit-change-details" class="btn btn-success" style="width: 45%;">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="cancelEdit()" style="width: 45%;">Cancel</button>
                    </div>
                    
                    <!-- Update Information button -->
                    <button type="button" class="btn btn-primary" id="updateButton" onclick="makeEditable()" style="margin-top:48px;">Update Information</button>
                </form>
                </div>
            </div>
        </div>

        <div class="center-column" id="change-password">
            <div class="profile-section">
                <h2>My Profile</h2>
                <img src="/assets/user.png" class="profile-avatar">
                <div class="form-section">
                <form method="post" action="">

                    <div class="mb-3">
                        <label for="password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="currentPassword" id="password" placeholder="Enter your CURRENT password">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="newPassword" id="password" placeholder="Enter your NEW password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm your NEW password">
                    </div>

                    <!-- Hidden Submit and Cancel buttons -->
                    <div id="actionButtons" style="display:none;">
                        <button type="submit" class="btn btn-success" style="width: 45%;">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="cancelEdit()" style="width: 45%;">Cancel</button>
                    </div>
                    
                    <div style="width: 100%; margin: 0 auto; text-align: center; margin-top: 48px;">
                        <button type="submit" name="submit-change-pw" class="btn btn-success" style="width: 45%;">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="switchChangeDetails()" style="width: 45%;">Cancel</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
