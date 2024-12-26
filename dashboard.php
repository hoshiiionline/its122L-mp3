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
        <div class="left-column">
            <div class="circle-container">
                <div class="circle">
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
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <!-- Description Section -->
            <div class="description">
                <h2>Zodiac Sign: <?php echo"$zodiac_name"?></h2>
                <p><strong>Date Range:</strong> <?php echo"$zodiac_date_range"?></p>
                <p>
                    <?php echo "$zodiac_desc"?>
                </p>
            </div>

            <!-- External Articles Section -->
            <div class="external-articles">
            <?php
                $keyword = $zodiac_name;
                ob_start();

                $tempFile = tmpfile();
                $tempFilePath = stream_get_meta_data($tempFile)['uri'];
                $phpCode = '<?php $_GET["keyword"] = "' . addslashes($keyword) . '"; include "news.php"; ?>';
                fwrite($tempFile, $phpCode);

                include $tempFilePath;

                ob_end_flush();

                fclose($tempFile);
    ?>
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
