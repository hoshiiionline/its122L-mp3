<?php
require 'config.php';

$selectedAlt = '';
$zodiac_name = 'Select a zodiac sign from the horoscope wheel.';
$zodiac_date_range = 'The date range will pop up here';    
$zodiac_desc = 'Find out about zodiac signs by clicking on the cards in the horoscope wheel.';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alt'])) {
    $selectedAlt = htmlspecialchars($_POST['alt']);
}

if ($stmt = $conn->prepare("SELECT zodiac_name, zodiac_date_range, zodiac_desc FROM zodiac_signs WHERE zodiac_name = ?")) {
    $stmt->bind_param("s", $selectedAlt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $zodiac_name = $row['zodiac_name'];
            $zodiac_date_range = $row['zodiac_date_range'];
            $zodiac_desc = $row['zodiac_desc'];
        }
    } 

    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zodiac Dashboard</title>
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
                <div class="form-section">
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
                </div>
            </div>
        </div>
    </div>
    
    <form id="altForm" method="POST" style="display: none;">
        <input type="hidden" name="alt" id="altInput">
    </form>

    <script src="script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.card');
            const altForm = document.getElementById('altForm');
            const altInput = document.getElementById('altInput');

            cards.forEach(card => {
                card.addEventListener('click', () => {
                    const altText = card.alt;
                    altInput.value = altText;
                    altForm.submit();
                });
            });
        });
    </script>
</body>
</html>
