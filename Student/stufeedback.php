<?php 
if(!isset($_SESSION)){
    session_start(); 
}
include("stuinclude/header.php");
include_once("../dbConnection.php");

if(isset($_SESSION['is_login'])) {
    $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script>location.href='../index.php';</script>";
}

$sql = "SELECT * FROM student WHERE stu_email = '$stuLogEmail'";
$result = $conn->query($sql);
if($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stuId = $row['stu_id'];
}

if(isset($_REQUEST['submitFeedback'])){
    if(($_REQUEST['f_content'] == "")){
        $passmsg = '<div class="alert alert-warning mt-2" role="alert">Fill all fields</div>';
    } else {
        $fcontent = $_REQUEST['f_content'];
        $sql = "INSERT INTO feedback (f_content, stu_id) VALUES ('$fcontent', '$stuId')";
        if($conn->query($sql) == TRUE) {
            $passmsg = '<div class="alert alert-success mt-2" role="alert">Feedback Submitted Successfully</div>';
        } else {
            $passmsg = '<div class="alert alert-danger mt-2" role="alert">Unable to Submit Feedback</div>';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <style>
  body {
    margin: 0;
    padding: 0;
    display: flex;
  }

  .main-content {
    margin-left: 250px;
    padding: 40px;
    width: 100%;
    background-color: #f8f9fa;
    min-height: 100vh;
  }

  .profile-form {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    max-width: 600px;
    margin: auto;
  }

  .profile-form h2 {
    margin-bottom: 20px;
    text-align: center;
  }

  .profile-form label {
    font-weight: bold;
  }

  .profile-form img {
    margin-top: 10px;
    width: 100px;
    border-radius: 8px;
  }

  .profile-form .form-group {
    margin-bottom: 20px;
  }

  .profile-form .btn {
    width: 100%;
  }
</style>
</head>
<body>

<div class="main-content">
  <div class="profile-form">
    <h2>Profile</h2>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label>Customer ID</label>
        <input type="text" class="form-control" id="stuId" name="stuId" value="<?php if(isset($row['stu_id'])){echo $row['stu_id'];} ?>" readonly>
      </div>
      <div class="form-group">
        <label>Write Feedback:</label>
        <textarea class="form-control" name="f_content" id="f_content"><?php if(isset($fcontent)){echo $fcontent;} ?></textarea>
      </div>
      <button type="submit" class="btn" style="background-color: hsl(214, 57%, 51%); color: white;" name="submitFeedback">Submit</button>
      
      <div class="mt-3">
        <?php if(isset($passmsg)) { echo $passmsg; } ?>
      </div>
    </form>
  </div>
</div>
    
</body>
</html>