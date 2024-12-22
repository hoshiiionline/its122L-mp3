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
