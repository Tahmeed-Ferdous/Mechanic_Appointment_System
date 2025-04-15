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

if(isset($_REQUEST['stuPassUpdateBtn'])){
    if(($_REQUEST['stuNewPass']=='')){
        $passmsg = '<div class="alert alert-warning mt-2" role="alert">Fill all fields</div>';
    }else{
        $sql = "SELECT * FROM student WHERE stu_email = '$stuLogEmail'";
        $result = $conn->query($sql);
        if($result->num_rows == 1) {
            $stuPass = $_REQUEST['stuNewPass'];
            $sql = "UPDATE student SET stu_pass = '$stuPass' WHERE stu_email = '$stuLogEmail'";
            if($conn->query($sql) == TRUE) {
                $passmsg = '<div class="alert alert-success mt-2" role="alert">Password Updated Successfully</div>';
            } else {
                $passmsg = '<div class="alert alert-danger mt-2" role="alert">Unable to Update Password</div>';
            }
    }
}
}
?>

<div class="container mt-5" style="margin-left: 250px;"> 
    <form action="" method="POST" class="mt-3">
        <div class="form-group">
            <label for="stuEmail">Email</label>
            <input type="email" class="form-control" id="stuEmail" name="stuEmail" value="<?php if(isset($stuLogEmail)) { echo $stuLogEmail; } ?>" readonly>
        </div>
        <div class="form-group">
            <label for="stuNewPass">New Password</label>
            <input type="password" class="form-control" id="stuNewPass" name="stuNewPass" placeholder="Enter New Password">
        </div>
        <button type="submit" class="btn btn-primary mt-2" name="stuPassUpdateBtn">Update</button>
        <?php if(isset($passmsg)) { echo $passmsg; } ?>
    </form>
</div>
