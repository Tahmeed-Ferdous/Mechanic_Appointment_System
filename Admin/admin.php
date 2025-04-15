<?php
if(!isset($_SESSION)) {
    session_start();
}
include_once('../dbConnection.php');


// Admin login verification
if(!isset($_SESSION['is_admin_login'])){
 
    if(isset($_POST['checklogemail']) && isset($_POST['adminemail']) && isset($_POST['adminpass'])){
        $adminemail = $_POST['adminemail'];
        $adminpass = $_POST['adminpass'];
    
        $sql = "SELECT * FROM admin WHERE admin_email = '".$adminemail."' AND admin_pass = '".$adminpass."'";
        $result = $conn->query($sql);
    
        $row = $result->num_rows;
        if($row ===1){
            $_SESSION['is_admin_login'] = true;
            $_SESSION['adminemail'] = $adminemail;
            echo json_encode($row);
    
        } else if($row === 0){
            echo json_encode($row);
        
        }
    }
    }
?>