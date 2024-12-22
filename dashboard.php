<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zodiac Dashboard</title>
    <link rel="stylesheet" href="dashboard-styles.css"> <!-- Link to CSS -->
</head>
<body>
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
            <img src="https://via.placeholder.com/1000x1000" alt="Horoscope Wheel" class="horoscope-img">
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
