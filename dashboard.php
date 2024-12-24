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
            <img src="/assets/horoscope-wheel.png" alt="Horoscope Wheel" class="horoscope-img">
            <!--
            <div id="horoscope-wheel">
            <div class="sign" id="aries" onclick="selectSign('aries')">Aries</div>
            <div class="sign" id="taurus" onclick="selectSign('taurus')">Taurus</div>
            <div class="sign" id="gemini" onclick="selectSign('gemini')">Gemini</div>
            <div class="sign" id="cancer" onclick="selectSign('cancer')">Cancer</div>
            <div class="sign" id="leo" onclick="selectSign('leo')">Leo</div>
            <div class="sign" id="virgo" onclick="selectSign('virgo')">Virgo</div>
            <div class="sign" id="libra" onclick="selectSign('libra')">Libra</div>
            <div class="sign" id="scorpio" onclick="selectSign('scorpio')">Scorpio</div>
            <div class="sign" id="sagittarius" onclick="selectSign('sagittarius')">Sagittarius</div>
            <div class="sign" id="capricorn" onclick="selectSign('capricorn')">Capricorn</div>
            <div class="sign" id="aquarius" onclick="selectSign('aquarius')">Aquarius</div>
            <div class="sign" id="pisces" onclick="selectSign('pisces')">Pisces</div>
            </div>

            <p>Selected Zodiac: <span id="selected-zodiac">Aries</span></p>
            -->
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <!-- Description Section -->
            <div class="description">
                <h2>Zodiac Sign</h2>
                <p><strong>Date Range:</strong> March 21 - April 19</p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum vestibulum. 
                    Cras venenatis euismod malesuada.
                </p>
            </div>

            <!-- External Articles Section -->
            <div class="external-articles">
                <?php include 'news.php'?>
            </div>
        
        </div>
    </div>
</body>
</html>
