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

// update customer details
if(isset($_REQUEST['newStuSubmitBtn'])) {
  if(($_REQUEST['stu_name'] == "") || ($_REQUEST['stu_email'] == "") || ($_REQUEST['stu_pass'] == "") || ($_REQUEST['stu_occ'] == "") || ($_REQUEST['stu_id'] == "") || ($_REQUEST['phone'] == "") || ($_REQUEST['car_reg_no'] == "") || ($_REQUEST['appointment_date'] == "")) {
    $msg = "<div class='alert alert-warning'>Fill All Fields</div>";
  } else {
    $stu_name = $_REQUEST['stu_name'];
    $stu_email = $_REQUEST['stu_email'];
    $stu_pass = $_REQUEST['stu_pass'];
    $stu_occ = $_REQUEST['stu_occ'];
    $stu_id = $_REQUEST['stu_id'];
    $phone = $_REQUEST['phone'];
    $car_reg_no = $_REQUEST['car_reg_no'];
    $appointment_date = $_REQUEST['appointment_date'];

    $sql = "UPDATE student SET stu_name = '$stu_name', stu_email = '$stu_email', stu_pass = '$stu_pass', stu_occ = '$stu_occ', phone = '$phone', car_reg_no = '$car_reg_no', appointment_date = '$appointment_date' WHERE stu_id = $stu_id";
    if($conn->query($sql) == TRUE) {
      $msg = "<div class='alert alert-success'>Customer Updated</div>";
    } else {
      $msg = "<div class='alert alert-danger'>Unable to Update Customer</div>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
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
    
<?php include("admininclude/header.php") ?>

<div class="form-container">
    <h2>Update Customer</h2>
    <?php 
      if(isset($_REQUEST['view'])) {
      $sql = "SELECT * FROM student WHERE stu_id = {$_REQUEST['id']}";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
      <label for="stu_id">ID</label>
      <input type="text" id="stu_id" name="stu_id" value="<?php if(isset($row['stu_id'])){ echo $row['stu_id']; } ?>" readonly>
      </div>
      <div class="form-group">
      <label for="stu_name">Name</label>
      <input type="text" id="stu_name" name="stu_name" value="<?php if(isset($row['stu_name'])){ echo $row['stu_name']; } ?>" required >
      </div>
      <div class="form-group">
      <label for="stu_email">Email</label>
      <textarea id="stu_email" name="stu_email" required><?php if(isset($row['stu_email'])){ echo $row['stu_email']; } ?></textarea>
      </div>
      <div class="form-group">
      <label for="stu_pass">Password</label>
      <input type="text" id="stu_pass" name="stu_pass" value="<?php if(isset($row['stu_pass'])){ echo $row['stu_pass']; } ?>" required>
      </div>
      <div class="form-group">
      <label for="stu_occ">Occupation</label>
      <input type="text" id="stu_occ" name="stu_occ" value="<?php if(isset($row['stu_occ'])){ echo $row['stu_occ']; } ?>" required>
      </div>
      <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" id="phone" name="phone" value="<?php if(isset($row['phone'])){ echo $row['phone']; } ?>" required>
      </div>
      <div class="form-group">
      <label for="car_reg_no">Car Registration Number</label>
      <input type="text" id="car_reg_no" name="car_reg_no" value="<?php if(isset($row['car_reg_no'])){ echo $row['car_reg_no']; } ?>" required>
      </div>
      <div class="form-group">
      <label for="appointment_date">Appointment Date</label>
      <input type="date" id="appointment_date" name="appointment_date" value="<?php if(isset($row['appointment_date'])){ echo $row['appointment_date']; } ?>" required>
      </div>
      <div class="button-group">
      <button type="submit" class="btn btn-submit" id="newStuSubmitBtn" name="newStuSubmitBtn">Submit</button>
      <a class="btn btn-close" href='students.php'>Close</a>
      </div>
    <?php if(isset($msg)) { echo $msg; } ?>

    </form>
    </div>



<script src="../js/adminscript.js"></script>
<script src="../js/adminajaxrequest.js"></script>

</body>
</html>