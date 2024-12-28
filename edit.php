<?php
include("config.php");

// Initialize variables
$zodiac_name = $zodiac_date_range = $zodiac_desc = '';
$first_name = $last_name = $email = $birthMonth = $birthYear = $birthDay = $gender = $zodiacSign = $is_admin = '';
$table = '';

if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = htmlspecialchars($_GET['id']);
    $table = htmlspecialchars($_GET['table']);
} elseif (isset($_POST['id']) && isset($_POST['table'])) {
    $id = htmlspecialchars($_POST['id']);
    $table = htmlspecialchars($_POST['table']);
} else {
    echo 'Error passing information.';
    exit;
}

if ($table == 'zodiac') {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $zodiac_name = $_POST['zodiac_name'];
        $zodiac_date_range = $_POST['zodiac_date_range'];
        $zodiac_desc = $_POST['zodiac_desc'];

        // Update zodiac data
        $result = mysqli_query($conn, "UPDATE zodiac_signs SET zodiac_name = '$zodiac_name', zodiac_date_range = '$zodiac_date_range', zodiac_desc = '$zodiac_desc' WHERE id=$id");

        // Check if the query was successful
        if ($result) {
            // Redirect to homepage to display updated user in list
            header("Location: admin.php");
            exit(); 
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    // Fetch zodiac data based on id
    $result = mysqli_query($conn, "SELECT * FROM zodiac_signs WHERE id=$id");

    while ($user_data = mysqli_fetch_array($result)) {
        $zodiac_name = $user_data['zodiac_name'];
        $zodiac_date_range = $user_data['zodiac_date_range'];
        $zodiac_desc = $user_data['zodiac_desc'];
    }
} elseif ($table == 'users') {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $email = $_POST['email'];
        $birthMonth = $_POST['birthMonth'];
        $birthYear = $_POST['birthYear'];
        $birthDate = $_POST['birthDate'];
        $gender = $_POST['gender'];
        $zodiacSign = $_POST['zodiac_sign'];

        $is_admin = 0;

        if (isset($_POST['admin-priv'])) {
            $is_admin = ($_POST['admin-priv'] === 'true') ? 1 : 0;
        }

        $result = mysqli_query($conn, "UPDATE users SET first_name='$first_name', is_admin='$is_admin', last_name='$last_name', email='$email', birth_month='$birthMonth', birth_day='$birthDate', birth_year='$birthYear', gender='$gender', zodiac_sign='$zodiacSign' WHERE id=$id");

        if ($result) {
            // Redirect to homepage to display updated user in list
            header("Location: admin.php");
            exit(); 
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    // Fetch user data based on id
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");

    while ($user_data = mysqli_fetch_array($result)) {
        $first_name = $user_data['first_name'];
        $last_name = $user_data['last_name'];
        $email = $user_data['email'];
        $birthMonth = $user_data['birth_month'];
        $birthYear = $user_data['birth_year'];
        $birthDay = $user_data['birth_day'];
        $gender = $user_data['gender'];
        $zodiacSign = $user_data['zodiac_sign'];
        $is_admin = $user_data['is_admin'];
    }
} else {
    echo 'Error passing information.';
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</head>
<body class="registration-login-page">
    <div class="registration-container">
        <!-- Registration Form Column -->
        <div class="edit-section">
            <h2 class="form-title">Edit User</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="return confirmEditUser();">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES); ?>">
                <input type="hidden" name="table" value="<?php echo htmlspecialchars($table, ENT_QUOTES); ?>">

                <?php
                    if (!empty($regis_err)) {
                        echo '<div class="error-message">' . $regis_err . '</div>';
                    }

                    if ($table == 'zodiac') {
                        echo '<div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="zodiac_name" class="form-label">Zodiac Name</label>
                                <input type="text" class="form-control" name="zodiac_name" id="zodiac_name" placeholder="Enter name of Zodiac Sign" value="'.htmlspecialchars($zodiac_name, ENT_QUOTES).'">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="zodiac_date_range" class="form-label">Zodiac Date Range</label>
                                <input type="text" class="form-control" name="zodiac_date_range" id="zodiac_date_range" placeholder="Enter Date Range of Zodiac Sign" value="'.htmlspecialchars($zodiac_date_range, ENT_QUOTES).'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="zodiac_desc" class="form-label">Zodiac Description</label>
                                <textarea id="zodiac_desc" name="zodiac_desc" rows="5" class="form-control" placeholder="Enter Zodiac Sign Description">'.htmlspecialchars($zodiac_desc, ENT_QUOTES).'</textarea>
                            </div>
                        </div>
                        <div class="button-container">
                            <a href="admin.php" class="logout-btn">Cancel</a>
                            <input type="submit" name="update" value="Update" class="add-user-btn">
                        </div>';
                    } elseif ($table == 'users') {
                        echo '<div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Enter first name of user" value="'.htmlspecialchars($first_name, ENT_QUOTES).'">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Enter last name of user" value="'.htmlspecialchars($last_name, ENT_QUOTES).'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address of user" value="'.htmlspecialchars($email, ENT_QUOTES).'">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="zodiac_sign" class="form-label">Zodiac Sign</label>
                                <input type="text" class="form-control" name="zodiac_sign" id="zodiac_sign" placeholder="Enter zodiac sign of user" value="'.htmlspecialchars($zodiacSign, ENT_QUOTES).'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="birthMonth" class="form-label">Birth Month</label>
                                <input type="number" class="form-control" name="birthMonth" id="birthMonth" placeholder="MM" value="'.htmlspecialchars($birthMonth, ENT_QUOTES).'" min="1" max="12">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="birthDate" class="form-label">Birth Date</label>
                                <input type="number" class="form-control" name="birthDate" id="birthDate" placeholder="DD" value="'.htmlspecialchars($birthDay, ENT_QUOTES).'" min="1" max="31">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="birthYear" class="form-label">Birth Year</label>
                                <input type="number" class="form-control" name="birthYear" id="birthYear" placeholder="YYYY" value="'.htmlspecialchars($birthYear, ENT_QUOTES).'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male" '.(($gender == 'Male') ? 'checked' : '').'>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female" '.(($gender == 'Female') ? 'checked' : '').'>
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="other" value="Other" '.(($gender == 'Other') ? 'checked' : '').'>
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="admin-priv">Admin Privileges:</label>
                                <input type="checkbox" id="admin-priv" name="admin-priv" value="true" '.(($is_admin == 1) ? 'checked' : '').'>
                            </div>
                        </div>
                        <div class="button-container">
                            <a href="admin.php" class="logout-btn">Cancel</a>
                            <input type="submit" name="update" value="Update" class="add-user-btn">
                        </div>';
                    } else {
                        echo 'Something went wrong. Try again.';
                    }
                ?>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>