<?php
   session_start();
   unset($_SESSION["email"]);
   unset($_SESSION["password"]);
   
   header('Refresh: 1; URL = logoutredirect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <title>Zodiak Bear | Logging out...</title>
</head>
<body class="registration-login-page">
   <div class="logout-container">
         <h1><strong><b>Logging out...</b></strong></h1>
         <div class="progress-bar">
            <span></span>
         </div>
   </div>
</body>
</html>