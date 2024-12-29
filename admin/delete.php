<?php 
include_once("../config/config.php");

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

if ($table == 'users') {
    $result = mysqli_query($conn, "DELETE FROM users WHERE id=$id");
} else if ($table == 'zodiac') {
    $result = mysqli_query($conn, "DELETE FROM zodiac_signs WHERE id=$id");
} else {
    echo "Error: Table not found.";
}

header("Location:../admin/admin.php");
?>