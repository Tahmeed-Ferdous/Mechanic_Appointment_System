<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include("admininclude/header.php");
include("../dbConnection.php"); 

if(isset($_SESSION['is_admin_login'])) {
    $adminemail = $_SESSION['adminemail'];}
else {
    echo "<script>location.href='../index.php';</script>";
  }
  
  if(isset($_REQUEST['courseSubmitBtn'])){
    // checking for empty fields
    if(($_REQUEST['course_name'] == "" ) || ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_author'] == "") || ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_original_price'] == "") || ($_REQUEST['course_price'] == "")){
      $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill all fields</div>';
    }else{
      // Assigning user values to variables
      $course_name = $_REQUEST['course_name'];
      $course_desc = $_REQUEST['course_desc'];
      $course_author = $_REQUEST['course_author'];
      $course_duration = $_REQUEST['course_duration'];
      $course_original_price = $_REQUEST['course_original_price'];
      $course_price = $_REQUEST['course_price'];
      $course_img = $_FILES['course_img']['name'];
      $course_img_temp = $_FILES['course_img']['tmp_name'];
      $img_folder = "../img/courseimg/".$course_img;
      move_uploaded_file($course_img_temp, $img_folder);

      $sql = "INSERT INTO course (course_name, course_desc, course_author, course_duration, course_original_price, course_price, course_img) VALUES ('$course_name', '$course_desc', '$course_author', '$course_duration', '$course_original_price', '$course_price', '$img_folder')";

      if($conn->query($sql) == TRUE){
        $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Course Added Successfully</div>';
      }else{
        $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Add Course</div>';
      }
    }

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Mechanic</title>
  <link rel="stylesheet" href="admininclude/headerstyle.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background: #f0f2f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

      height: 100vh;
      margin: 20px;
    }
    .form-container {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 400px;
    }
    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #333;
    }
    .form-group {
      margin-bottom: 1rem;
    }
    label {
      display: block;
      margin-bottom: 0.5rem;
      color: #555;
      font-weight: bold;
    }
    input[type="text"],
    input[type="number"],
    input[type="file"],
    textarea {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1rem;
      box-sizing: border-box;
    }
    textarea {
      resize: vertical;
      min-height: 80px;
    }
    .button-group {
      display: flex;
      justify-content: space-between;
      margin-top: 1.5rem;
    }
    .btn {
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .btn-submit {
      background: #28a745;
      color: #fff;
    }
    .btn-submit:hover {
      background: #218838;
    }
    .btn-close {
      background: #dc3545;
      color: #fff;
    }
    .btn-close:hover {
      background: #c82333;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Add Mechanics</h2>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="courseName">Mechanic Name</label>
        <input type="text" id="course_name" name="course_name" required>
      </div>
      <div class="form-group">
        <label for="courseDescription">Mechanic Description</label>
        <textarea id="course_desc" name="course_desc" required></textarea>
      </div>
      <div class="form-group">
        <label for="courseAuthor">Mechanic number</label>
        <input type="text" id="course_author" name="course_author" required>
      </div>
      <div class="form-group">
        <label for="courseDuration">Mechanic Duration</label>
        <input type="text" id="course_duration" name="course_duration" placeholder="e.g., 10 hours" required>
      </div>
      <div class="form-group">
        <label for="courseOriginalPrice">Mechanic Original Price</label>
        <input type="number" id="course_original_price" name="course_original_price" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="courseSellingPrice">Mechanic Selling Price</label>
        <input type="number" id="course_price" name="course_price" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="courseImage">Mechanic Image</label>
        <input type="file" id="course_img" name="course_img" accept="image/*">
      </div>
      <div class="button-group">
        <button type="submit" class="btn btn-submit" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
        <a class="btn btn-close" href='courses.php'>Close</a>
      </div>
    <?php if(isset($msg)) { echo $msg; } ?>

    </form>
  </div>
  <script src="../js/adminscript.js"></script>
  <script src="../js/adminajaxrequest.js"></script>
</body>
</html>
