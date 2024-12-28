<?php
require 'config.php';

$firstName = '';
$lastName = '';
$email = '';
$birthDate = '';
$birthMonth = '';
$birthYear = '';

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
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Sign Out</a></li>
            </ul>
        </div>
    </nav>

    <!-- Dashboard Body -->
    <div class="dashboard">
        <!-- Left Column -->
        <div class="center-column">
            <div class="profile-section">
                <h2>My Profile</h2>
                <img src="/assets/user.png" class="profile-avatar">
                <div class="form-section">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return confirmRegister();">
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
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" readonly>
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
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" disabled>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" disabled>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="other" value="Other" disabled>
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                    </div>
                    <!-- Hidden Submit and Cancel buttons -->
                    <div id="actionButtons" style="display:none;">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" onclick="cancelEdit()">Cancel</button>
                    </div>
                    
                    <!-- Update Information button -->
                    <button type="button" class="btn btn-primary" id="updateButton" onclick="makeEditable()">Update Information</button>
                </form>
                <script>
                    function makeEditable() {
                        // Make all form fields editable
                        document.getElementById('firstName').removeAttribute('readonly');
                        document.getElementById('lastName').removeAttribute('readonly');
                        document.getElementById('email').removeAttribute('readonly');
                        document.getElementById('password').removeAttribute('readonly');
                        document.getElementById('birthMonth').removeAttribute('readonly');
                        document.getElementById('birthDate').removeAttribute('readonly');
                        document.getElementById('birthYear').removeAttribute('readonly');
                        
                        // Enable gender radio buttons
                        document.getElementById('male').removeAttribute('disabled');
                        document.getElementById('female').removeAttribute('disabled');
                        document.getElementById('other').removeAttribute('disabled');
                        
                        // Change background color back to normal
                        document.querySelectorAll('input[readonly]').forEach(function(input) {
                            input.style.backgroundColor = '';
                        });
                        document.querySelectorAll('input[disabled]').forEach(function(input) {
                            input.style.backgroundColor = '';
                        });

                        // Show Submit and Cancel buttons
                        document.getElementById('actionButtons').style.display = 'block';

                        document.getElementById('updateButton').style.display = 'none';
                    }

                    // Initially set background color for readonly and disabled inputs
                    window.onload = function() {
                        document.querySelectorAll('input[readonly]').forEach(function(input) {
                            input.style.backgroundColor = '#f0f0f0';  // Light gray color
                        });
                        document.querySelectorAll('input[disabled]').forEach(function(input) {
                            input.style.backgroundColor = '#f0f0f0';  // Light gray color
                        });
                    };

                    function cancelEdit() {
                        // Reset all fields to non-editable
                        document.getElementById('firstName').setAttribute('readonly', true);
                        document.getElementById('lastName').setAttribute('readonly', true);
                        document.getElementById('email').setAttribute('readonly', true);
                        document.getElementById('password').setAttribute('readonly', true);
                        document.getElementById('birthMonth').setAttribute('readonly', true);
                        document.getElementById('birthDate').setAttribute('readonly', true);
                        document.getElementById('birthYear').setAttribute('readonly', true);

                        // Disable gender radio buttons
                        document.getElementById('male').setAttribute('disabled', true);
                        document.getElementById('female').setAttribute('disabled', true);
                        document.getElementById('other').setAttribute('disabled', true);

                        // Change background color to gray for readonly and disabled fields
                        document.querySelectorAll('input[readonly]').forEach(function(input) {
                            input.style.backgroundColor = '#f0f0f0';  // Light gray color
                        });
                        document.querySelectorAll('input[disabled]').forEach(function(input) {
                            input.style.backgroundColor = '#f0f0f0';  // Light gray color
                        });

                        // Hide Submit and Cancel buttons
                        document.getElementById('actionButtons').style.display = 'none';
                    }
                </script>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
