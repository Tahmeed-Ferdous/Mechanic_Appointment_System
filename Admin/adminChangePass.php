<?php 
if(!isset($_SESSION)) {
    session_start();
}
include("../dbConnection.php");

if(isset($_SESSION['is_admin_login'])) {
    $adminemail = $_SESSION['adminemail'];
} else {
    echo "<script>location.href='../index.php';</script>";
}
$adminemail = $_SESSION['adminemail'];
if(isset($_REQUEST['adminPassUpdatebtn'])){
    if(($_REQUEST['adminPass'] == "")){
        $msg = "<div class='alert alert-warning'>Fill All Fields</div>";
    } else {
        $sql = "SELECT * FROM admin WHERE admin_email = '$adminemail'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $adminPass = $_REQUEST['adminPass'];
            $sql = "UPDATE admin SET admin_pass = '$adminPass' WHERE admin_email = '$adminemail'";
            if($conn->query($sql) == TRUE){
                $msg = "<div class='alert alert-success'>Password Updated</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Unable to Update Password</div>";
            }
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
    <h2>Update Password</h2>
    <form action="" method="POST">
    <?php 
    if(isset($msg)) {
        echo $msg;
    }
    ?>
    <div class="form-group">
        <label for="adminemail">Email</label>
        <input type="email" class="form-control" id="adminemail" name="adminemail" 
               value="<?php echo $adminemail; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="adminPass">New Password</label>
        <input type="password" class="form-control" id="adminPass" name="adminPass" placeholder="Enter new password">
    </div>
    <button type="submit" name="adminPassUpdatebtn" class="btn btn-primary">Update</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
  </div>



<script src="../js/adminscript.js"></script>
<script src="../js/adminajaxrequest.js"></script>

</body>
</html>