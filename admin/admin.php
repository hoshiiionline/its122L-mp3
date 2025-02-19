<?php
require '../config/config.php';

$selectedAlt = '';
$zodiac_name = 'Select a zodiac sign from the horoscope wheel.';
$zodiac_date_range = 'Select a zodiac sign to show the date.';
$zodiac_desc = 'Find out about zodiac signs by clicking on the cards in the horoscope wheel.';
$page_name = "Admin Dashboard";
$showWheel = true;

//echo 'userID='. $_SESSION['userID'];
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alt'])) {
    $selectedAlt = htmlspecialchars($_POST['alt']);
    $showWheel = false;
    if ($selectedAlt == 'switch') {
        $showWheel = true;
        $selectedAlt ='';
    }
}

if ($stmt = $conn->prepare("SELECT zodiac_name, zodiac_date_range, zodiac_desc FROM zodiac_signs WHERE zodiac_name = ?")) {
    $stmt->bind_param("s", $selectedAlt);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $zodiac_name = htmlspecialchars($row['zodiac_name']);
            $zodiac_date_range = htmlspecialchars($row['zodiac_date_range']);
            $zodiac_desc = htmlspecialchars($row['zodiac_desc']);
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to CSS -->
    <title>Zodiak Bear | Admin Dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to CSS -->
    <script src="../js/script.js"></script>
</head>
<body class="dashboard-page">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <h1 class="navbar-title">Zodiak Bear | <?php echo "$page_name";?></h1>
            <ul class="navbar-links">
                <li><a href="../user/dashboard.php">Dashboard</a></li>
                <li><a href="../user/zodiacs.php">Zodiac Wheel</a></li>
                <li><a href="../user/profile.php">Profile</a></li>
                <?php 
                if ((int)$is_admin === 1) {
                    echo "<li> | </li>
                    <li><a href='#'>Edit</a></li>";
                }
                ?>
                <li><a href="../login-register/logout.php">Sign Out</a></li>
            </ul>
        </div>
    </nav>

    <!-- Dashboard Body -->
    <div class="dashboard">
        <!-- Left Column -->
        <div class="left-column">
            <div class="circle-container">
                <?php
                    if ($showWheel) {
                        echo '<div class="circle">
                        <img src="/assets/zodiacs-alt/Aries.png" class="card" alt="Aries">
                        <img src="/assets/zodiacs-alt/Taurus.png" class="card" alt="Taurus">
                        <img src="/assets/zodiacs-alt/Gemini.png" class="card" alt="Gemini">
                        <img src="/assets/zodiacs-alt/Cancer.png" class="card" alt="Cancer">
                        <img src="/assets/zodiacs-alt/Leo.png" class="card" alt="Leo">
                        <img src="/assets/zodiacs-alt/Virgo.png" class="card" alt="Virgo">
                        <img src="/assets/zodiacs-alt/Libra.png" class="card" alt="Libra">
                        <img src="/assets/zodiacs-alt/Scorpio.png" class="card" alt="Scorpio">
                        <img src="/assets/zodiacs-alt/Sagittarius.png" class="card" alt="Sagittarius">
                        <img src="/assets/zodiacs-alt/Capricorn.png" class="card" alt="Capricorn">
                        <img src="/assets/zodiacs-alt/Aquarius.png" class="card" alt="Aquarius">
                        <img src="/assets/zodiacs-alt/Pisces.png" class="card" alt="Pisces">
                        </div>';
                    } else {
                        echo '<div class="circle">
                        <img src="/assets/zodiacs-alt/'.$selectedAlt.'.png" class="card-alternative" alt="switch">
                        </div>';
                    }
                ?>
            </div>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <!-- Description Section -->
            <div class="description">
            <?php 
                if ($showWheel) {
                    echo '
                    <div class="zodiac-table-container">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Zodiac Name</th>
                            <th>Date Range</th>
                            <th>Description</th>
                            <th>Operations</th>
                        </tr>
                        </thead>';
                        $result = mysqli_query($conn, "SELECT * FROM zodiac_signs ORDER BY id DESC");
                        if (mysqli_num_rows($result) > 0) {
                            while($user_data = mysqli_fetch_array($result)) {         
                                echo "<tr>";
                                echo "<td>".htmlspecialchars($user_data['zodiac_name'])."</td>";
                                echo "<td>".htmlspecialchars($user_data['zodiac_date_range'])."</td>";
                                echo "<td>".htmlspecialchars($user_data['zodiac_desc'])."</td>";   
                                echo "<td><a href='../admin/edit.php?id=".htmlspecialchars($user_data['id'])."&table=zodiac' class='btn btn-warning btn-xs'>Edit</a> | 
                                <a href='../admin/delete.php?id=".htmlspecialchars($user_data['id'])."&table=zodiac' class='btn btn-danger btn-xs' onclick='return confirmDeleteUser();'>Delete</a>
                                </td>
                                </tr>"; 
                            }
                        }
                    echo '</table>
                    </div>';
                } else {
                    echo "<h2>Zodiac Sign: $zodiac_name</h2>
                            <p><strong>Date Range:</strong> $zodiac_date_range</p>
                            <p>$zodiac_desc</p>";
            }
            ?>
            </div>
            <!-- View Users Section -->
            <div class="external-articles">
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead style="background-color: black !important; color: black;">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email Address</th>
                            <th>Birth Date</th>
                            <th>Gender</th>
                            <th>Zodiac Sign</th>
                            <th>Operations</th>
                        </tr> 
                        </thead>
                        <?php  
                            $result = mysqli_query($conn, "SELECT * FROM users WHERE zodiac_sign = '$selectedAlt' ORDER BY id DESC");
                            if (mysqli_num_rows($result) > 0) {
                                while($user_data = mysqli_fetch_array($result)) {         
                                    echo "<tr>";
                                    echo "<td>".htmlspecialchars($user_data['first_name'])."</td>";
                                    echo "<td>".htmlspecialchars($user_data['last_name'])."</td>";
                                    echo "<td>".htmlspecialchars($user_data['email'])."</td>";   
                                    echo "<td>".htmlspecialchars($user_data['birth_month'])."/".htmlspecialchars($user_data['birth_day'])."/".htmlspecialchars($user_data['birth_year'])."</td>";
                                    echo "<td>".htmlspecialchars($user_data['gender'])."</td>";
                                    echo "<td>".htmlspecialchars($user_data['zodiac_sign'])."</td>";
                                    echo "<td><a href='../admin/edit.php?id=".htmlspecialchars($user_data['id'])."&table=users' class='btn btn-warning btn-xs'>Edit</a> | 
                                    <a href='../admin/delete.php?id=".htmlspecialchars($user_data['id'])."&table=zodiac' class='btn btn-danger btn-xs' onclick='return confirmDeleteUser();'>Delete</a>
                                    </td>
                                    </tr>";        
                                }
                            } else {
                                echo "<tr>
                                <td colspan='7' style='text-align: center;'>No users found!</td>
                                </tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        
        </div>
    </div>
    
    <form id="altForm" method="POST" style="display: none;">
        <input type="hidden" name="alt" id="altInput">
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.card');
            const altForm = document.getElementById('altForm');
            const altInput = document.getElementById('altInput');

            cards.forEach(card => {
                card.addEventListener('click', () => {
                    // Remove 'selected' class from all cards
                    cards.forEach(c => c.classList.remove('selected', 'not-selected'));

                    // Add 'selected' class to the clicked card
                    card.classList.add('selected');

                    // Add 'not-selected' class to all non-selected cards
                    cards.forEach(c => {
                        if (!c.classList.contains('selected')) {
                            c.classList.add('not-selected');
                        }
                    });

                    const altText = card.alt;
                    altInput.value = altText;
                    altForm.submit();
                });
            });
        });
        
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.card-alternative');
            const altForm = document.getElementById('altForm');
            const altInput = document.getElementById('altInput');

            cards.forEach(card => {
                card.addEventListener('click', () => {
                    // Remove 'selected' class from all cards
                    cards.forEach(c => c.classList.remove('selected', 'not-selected'));

                    // Add 'selected' class to the clicked card
                    card.classList.add('selected');

                    // Add 'not-selected' class to all non-selected cards
                    cards.forEach(c => {
                        if (!c.classList.contains('selected')) {
                            c.classList.add('not-selected');
                        }
                    });

                    const altText = card.alt;
                    altInput.value = altText;
                    altForm.submit();
                });
            });
        });
    </script>
</body>
</html>