<?php 
include_once('../dbConnection.php');
if(!isset($_SESSION)) { 
  session_start(); 
}
if(isset($_SESSION['is_login'])) {
  $stuLogEmail = $_SESSION['stuLogEmail'];
}

if(isset($stuLogEmail)){
  $sql = "SELECT stu_img FROM student WHERE stu_email = '".$stuLogEmail."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $stu_img = $row['stu_img'];
}
?>

<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body {
    margin: 0;
    padding: 0;
    display: flex;
    font-family: Arial, sans-serif;
  }

  .sidebar {
    height: 100vh;
    width: 250px;
    background: #343a40;
    color: #fff;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
  }

  .sidebar .brand {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
  }

  .sidebar .brand i {
    font-size: 2rem;
    margin-right: 10px;
    color: hsl(214, 57%, 51%)
  }

  .sidebar .brand h2 {
    font-size: 1.5rem;
    margin: 0;
  }

  .sidebar .profile {
    text-align: center;
    margin-bottom: 30px;
  }

  .sidebar .profile img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 2px solid  hsl(214, 57%, 51%);
  }

  .sidebar .profile p {
    margin-top: 10px;
    font-size: 0.9rem;
  }

  .sidebar ul.nav {
    list-style: none;
    padding: 0;
  }

  .sidebar ul.nav li {
    margin-bottom: 15px;
  }

  .sidebar ul.nav li a {
    text-decoration: none;
    color: #ddd;
    display: flex;
    align-items: center;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background 0.3s;
  }

  .sidebar ul.nav li a i {
    font-size: 1.2rem;
    margin-right: 10px;
  }

  .sidebar ul.nav li a:hover,
  .sidebar ul.nav li a.active {
    background: #495057;
    color: #fff;
  }

  .sidebar ul.nav li a span {
    font-size: 0.8rem;
    margin-left: 5px;
    color: hsl(214, 57%, 51%);
  }
</style>

<div class="sidebar">
  <div class="brand">
    <a href="../index.php">
    <i class='bx bxs-graduation'></i>
    <h2>Mechanic</h2>
    </a>
  </div>
  <div class="profile">
    <img src="<?php echo $stu_img ?>" alt="Student Profile">
  </div>
  <ul class="nav">
    <li><a href="./studentProfile.php" class="active"><i class='bx bx-user'></i> Profile <span>(current)</span></a></li>
    <li><a href="myCourse.php"><i class='bx bx-book'></i> My Mechanic</a></li>
    <li><a href="./stufeedback.php"><i class='bx bx-message-square-edit'></i> Feedback</a></li>
    <li><a href="./studentChangePass.php"><i class='bx bx-lock'></i> Change Password</a></li>
    <li><a href="../pages/logout.php"><i class='bx bx-log-out'></i> Logout</a></li>
  </ul>
</div>

