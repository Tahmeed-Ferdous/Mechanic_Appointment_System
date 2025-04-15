<?php  
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include("../dbConnection.php"); 

if(isset($_SESSION['is_admin_login'])) {
    $adminemail = $_SESSION['adminemail'];}
else {
    echo "<script>location.href='../index.php';</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- bootstrap -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="admininclude/headerstyle.css">
  </head>
  <body class="">

  <?php include("admininclude/header.php") ?>




     <script src="../js/adminscript.js"></script>
     <script src="../js/adminajaxrequest.js"></script>


    </body>
    </html>