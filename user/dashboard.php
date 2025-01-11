<?php 
require "../config/config.php";
require "../config/randomGenerator.php";

$page_name = "My Dashboard";

// get user's zodiac sign based on session ID
if ($stmt = $conn->prepare("SELECT zodiac_sign FROM users WHERE id = ?")) {
    $stmt->bind_param("i", $_SESSION['userID']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $zodiac_sign = $row['zodiac_sign'];
        }
    } 

    $stmt->close();
} else {
    echo "Failed to prepare the SQL statement.";
}

// retrieve horoscope-related information based on user's zodiac sign

if ($stmt = $conn->prepare("SELECT zodiac_name, zodiac_date_range, zodiac_desc FROM zodiac_signs WHERE zodiac_name = ?")) {
    $stmt->bind_param("s", $zodiac_sign);
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zodiak Bear | My Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to CSS -->
</head>
<body class="dashboard-page">
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
        <h1 class="navbar-title">Zodiak Bear | <?php echo "$page_name";?></h1>
            <ul class="navbar-links">
                <li><a href="#">Dashboard</a></li>
                <li><a href="zodiacs.php">Zodiac Wheel</a></li>
                <li><a href="profile.php">Profile</a></li>
                
                <?php 
                if ((int)$is_admin === 1) {
                    echo "<li> | </li>
                    <li><a href='../admin/admin.php'>Edit</a></li>";
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
                    echo '
                    <div class="circle">
                        <img src="/assets/zodiacs-alt/'.$zodiac_sign.'.png" class="card-alternative" alt="'.$zodiac_sign.'" onclick="window.location.href=\'/user/zodiacs.php\';">
                    </div>
                    ';
                ?>
            </div>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <!-- Daily Section -->
            <div class="description">
                <h2><b><?php echo"$zodiac_name"?> Horoscope of the Day</b></h2>
                <center><p><q><i><?php echo $horoscopeAries?></i></q></p></center>
                <p><strong>Date Range:</strong> <?php echo"$zodiac_date_range"?></p>
                <p>
                    <?php echo "$zodiac_desc"?>
                </p>
            </div>

            <!-- Stats Section -->
            <div class="description">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <b><h2>Ratings of the Month:</h2></b>
                        <hr>
                        <p>Love:
                            <?php 
                                for ($i = 0; $i < mt_rand(1,5); $i++) {
                                    echo "🩷";
                                }
                            ?>                        
                        </p>
                        <p>Career:
                            <?php 
                                for ($i = 0; $i < mt_rand(1,5); $i++) {
                                    echo "💼";
                                }
                            ?>                        
                        </p>                        
                        <p>Money:
                            <?php 
                                for ($i = 0; $i < mt_rand(1,5); $i++) {
                                    echo "💵";
                                }
                            ?>                        
                        </p>
                        <p>Health:
                            <?php 
                                for ($i = 0; $i < mt_rand(1,5); $i++) {
                                    echo "🌱";
                                }
                            ?>                        
                        </p>
                        <p>Learning:
                            <?php 
                                for ($i = 0; $i < mt_rand(1,5); $i++) {
                                    echo "📚";
                                }
                            ?>                        
                        </p>  
                        <hr>
                        <p>Opportunities:
                            <?php 
                                for ($i = 0; $i < mt_rand(1,5); $i++) {
                                    echo "❕";
                                }
                            ?>                        
                        </p>
                        <p>Challenges:
                            <?php 
                                for ($i = 0; $i < mt_rand(1,5); $i++) {
                                    echo "🛑";
                                }
                            ?>       
                        </p>
                        <p>Overall Rating:
                            <?php 
                                for ($i = 0; $i < mt_rand(1,5); $i++) {
                                    echo "⭐";
                                }
                            ?>
                        </p>               
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <h2>This Month's Matches</h2>
                        <p><strong>Cosmic Allies 🫂:</strong><br>
                            <?php 
                                echo implode(", ", $cosmicAllies);
                            ?>
                        </p>
                        <div class="spacer"></div>   
                        <p><strong>Cosmic Clashes ❌:</strong><br>
                            <?php 
                                echo implode(", ", $cosmicClashes);
                            ?>
                        </p>   
                        <div class="spacer"></div>   
                        <p><strong>Astral Pals 🙌:</strong><br>
                            <?php 
                                echo implode(", ", $astralPals);
                            ?>
                        </p>  
                        <div class="spacer"></div>   
                        <p><strong>Celestial Love Matches 💞:</strong><br>
                            <?php 
                                echo implode(", ", $celestialLoveMatches);
                            ?>
                        </p>   
                        <div class="spacer"></div>   
                        <p><strong>Fortune Stars 💰:</strong><br>
                            <?php 
                                echo implode(", ", $fortuneStars);
                            ?>
                        </p>  
                    </div>
                </div>
            </div>
        </div>
        <div class="right-column">
        <!-- External Articles Section -->
            <div class="external-articles">
            <header><h2><b><?php echo "$zodiac_sign";?> News</b></h2></header>
            <?php
                $keyword = $zodiac_name;
                ob_start();

                $tempFile = tmpfile();
                $tempFilePath = stream_get_meta_data($tempFile)['uri'];
                $phpCode = '<?php $_GET["keyword"] = "' . addslashes($keyword) . '"; include "../config/news.php"; ?>';
                fwrite($tempFile, data: $phpCode);

                include $tempFilePath;

                ob_end_flush();

                fclose($tempFile);
            ?>
            </div>    
        <!-- Google Calendar -->
            <div class="external-articles">
            <header><h2><b>Zodiak Calendar</b></h2></header>    
            <div style = "border-radius: 10px; overflow: hidden; width: 100%; height: 80%;">
                <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=Asia%2FManila&showPrint=0&showTabs=0&title=Zodiak%20Bear&showTz=0&src=Y2I2MWRkZmYzMTJjMDQxZGEzZGVmMGUwOTU1ZDU0OWYyODc3NDMxY2QyZjE2ZDFlZWE3YjE2ODhjN2Y4ZTI2N0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&color=%23A79B8E" style="border:0; border-width:0" width="100%" height="100%" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" ></iframe>            </div>   
            </div>

            <!-- Google Maps -->
            <div class="external-articles">
            <header><h2><b>Find Us Here!</b></h2></header>
                <div style = "border-radius: 10px; overflow: hidden; width: 100%; height: 80%;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3511.941935895708!2d121.04642143846654!3d14.544541819495311!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c8e8c6103bd7%3A0x9ebe82502c3b0c6f!2sEssensa%20East%20Forbes!5e0!3m2!1sen!2sph!4v1736556155055!5m2!1sen!2sph" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>   
    </div>
    </div>

    <script>
    </script>
</body>
</html>
