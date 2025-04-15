<?php 
if(!isset($_SESSION)){ 
    session_start(); 
}

include("admininclude/header.php");
include("../dbConnection.php");

if(isset($_SESSION['is_admin_login'])){
    $adminEmail = $_SESSION['adminemail'];
} else {
    echo "<script>location.href='../index.php';</script>";
}
?>

<!-- Boxicons CDN for icons -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<link rel="stylesheet" href="admininclude/headerstyle.css">

<!-- Custom CSS for Feedback Page -->
<style>
    .feedback-wrapper {
        margin: 30px auto;
        max-width: 90%;
        background-color: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .feedback-wrapper h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
        font-weight: bold;
    }

    .feedback-table {
        width: 100%;
        border-collapse: collapse;
    }

    .feedback-table thead {
        background-color: #343a40;
        color: white;
    }

    .feedback-table th, .feedback-table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    .feedback-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .feedback-delete-btn {
        background-color: transparent;
        border: none;
        color: #dc3545;
        font-size: 20px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .feedback-delete-btn:hover {
        color: #a71d2a;
        transform: scale(1.2);
    }

    .no-feedback-msg {
        text-align: center;
        font-size: 18px;
        color: #888;
    }
</style>

<title>Feedback</title>

<div class="feedback-wrapper">
    <h2>📋Feedback</h2>
    <?php 
      $sql = "SELECT * FROM feedback";
      $result = $conn->query($sql);
      if($result->num_rows > 0) {
          echo "<table class='feedback-table'>";
          echo "<thead><tr><th>Feedback ID</th><th>Feedback Content</th><th>Student ID</th><th>Action</th></tr></thead>";
          echo "<tbody>";
          while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>".$row['f_id']."</td>";
              echo "<td>".$row['f_content']."</td>";
              echo "<td>".$row['stu_id']."</td>";
              echo "<td>
                      <form action='' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this feedback?');\">
                          <input type='hidden' name='id' value='".$row['f_id']."'>
                          <button type='submit' name='delete' class='feedback-delete-btn' title='Delete'><i class='bx bxs-trash'></i></button>
                      </form>
                    </td>";
              echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
      } else {
          echo "<p class='no-feedback-msg'>No feedback available.</p>";
      }

      if(isset($_POST['delete'])) {
          $sql = "DELETE FROM feedback WHERE f_id = {$_REQUEST['id']}";
          if($conn->query($sql) == TRUE) {
              echo "<meta http-equiv='refresh' content='0'>";
          } else {
              echo "<div class='alert alert-danger mt-2' role='alert'>Unable to Delete Feedback</div>";
          }
      }
    ?>
</div>

<script src="../js/adminscript.js"></script>
<script src="../js/adminajaxrequest.js"></script>
