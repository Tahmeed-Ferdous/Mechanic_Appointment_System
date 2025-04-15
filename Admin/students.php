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
    <title>Users</title>
    <link rel="stylesheet" href="admininclude/headerstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        /* ----------------- Table Section ----------------- */
.table-section {
  margin: 0px 100px 200px 0px;
}

.table-title {
  font-size: 1.5rem;
  margin-bottom: 10px;
  color: var(--primary-color);
  font-weight: 600;
}

.table-responsive {
  width: 100%;
  overflow-x: auto;
}

.orders-table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  border-radius: 0.5rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.orders-table thead {
  background: var(--primary-color);
  color: #fff;
}

.orders-table th,
.orders-table td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

.orders-table tbody tr:hover {
  background: var(--primary-color-light);
}

.delete-btn {
  background: #ff4d4d;
  color: #fff;
  border: none;
  padding: 6px 12px;
  border-radius: 0.3rem;
  cursor: pointer;
  transition: background 0.3s ease;
}

.delete-btn:hover {
  background: #e60000;
}


@media (max-width: 768px) {
  .orders-table th,
  .orders-table td {
    padding: 8px 10px;
    font-size: 0.9rem;
  }
}
    </style>

</head>
<body>
    
<?php include("admininclude/header.php") ?>

<!-- Table Section -->
<div class="table-section">
  <h2 class="table-title">List of Customers</h2>
  <div class="table-responsive">
    <?php 
      $sql = "SELECT * FROM student";
      $result = $conn->query($sql);
      if ($result->num_rows > 0){
    ?>
    <table class="orders-table">
      <thead>
        <tr>
          <th>Customer ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Car Registration No</th>
          <th>Appointment Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['stu_id'] . "</td>";
        echo "<td>" . $row['stu_name'] . "</td>";
        echo "<td>" . $row['stu_email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['car_reg_no'] . "</td>";
        echo "<td>" . $row['appointment_date'] . "</td>";
        echo "<td>
        <form action='' method='POST' style='display: inline-block; margin-right: 5px;'>
            <input type='hidden' name='id' value='" . $row['stu_id'] . "'>
            <button type='submit' name='delete' value='Delete' class='delete-btn'>Delete</button>
        </form>
        <form method='POST' action='editstudent.php' style='display: inline-block;'>
        <input type='hidden' name='id' value='" . $row['stu_id'] . "'> 
        <button class='btn-secondary' type='submit' name='view' value='View' style='display: inline-block;'>Edit</button>
        </form>
        </td>";
        echo "</tr>";
       }
       ?>
      </tbody>
    </table>
    <?php 
    } else {
      echo "<p>No customers found.</p>";
    }
    if(isset($_REQUEST['delete'])){
    $sql = "DELETE FROM student WHERE stu_id = {$_REQUEST['id']}";
      if($conn->query($sql) == TRUE){
        echo "<script>alert('Customer Deleted');</script>";
      } else {
        echo "<script>alert('Unable to Delete Customer');</script>";
      }
    }
    ?>
  </div>
</div>


<style>
 .course-add-button {
  position: fixed;
  left: 1230px; /* Adjust horizontal positioning */
  bottom: 20px; /* Adjust vertical positioning */
  background-color: var(--primary-color);
  color: #fff;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  text-decoration: none;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease;
  z-index: 200;
}

.course-add-button:hover {
  background-color: var(--primary-color-light);
}

</style>
<a href="addnewstudent.php" class="course-add-button">
  <i class='bx bx-plus'></i>
</a>


<script src="../js/adminscript.js"></script>
<script src="../js/adminajaxrequest.js"></script>

</body>
</html>