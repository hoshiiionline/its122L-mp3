<?php
   session_start();
   unset($_SESSION["email"]);
   unset($_SESSION["password"]);
   
   header('Refresh: 1; URL = login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   <title>Logging out...</title>
</head>
<body class="registration-login-page">
<div class="register-container">
      <h1><strong><b>Logged out</b></strong></h1>
      <h4>You have successfully logged out!</h4>
</div>
</body>
</html>