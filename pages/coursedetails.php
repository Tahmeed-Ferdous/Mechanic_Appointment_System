<?php 
include("../dbConnection.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UniShort</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
  <link rel="stylesheet" href="../style.css">
</head>
<body>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>

    <div class="overlay" data-overlay></div>

    <div class="header-top">
      <div class="container">

        <a href="#" class="logo">
          UNISHORT
        </a>

      </div>
    </div>

    <div class="header-bottom">
      <div class="container">

        <nav class="navbar" data-navbar>

          <ul class="navbar-list">

            <li>
              <a href="../index.php" class="navbar-link" data-nav-link>home</a>
            </li>

            <li>
              <a href="../index.php" class="navbar-link" data-nav-link>Mechanic</a>
            </li>

            <li>
              <a href="../index.php" class="navbar-link" data-nav-link>contact us</a>
            </li>

          </ul>

        </nav>
      </div>
    </div>

  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home" style="min-height: 200px;">
        <!-- Background Video -->
        <video class="hero-video" autoplay muted loop playsinline>
          <source src="../img/0215.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      <br>
      
        <div class="container">
          <p style="color: rgb(213, 213, 213);">Scroll Down</p>
          <a href="#package" style="color: rgb(213, 213, 213);">
            <i class="fas fa-arrow-down"></i>
          </a>
        </div>
      </section>
  
<div class=tongle>
  <?php 
  if(isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
    $_SESSION['course_id'] = $course_id;
    $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    } 
  ?>
    <div class="course-details">
      <img src="<?php echo $row['course_img'] ?>">
      <h1>Mechanic Name: <?php echo $row['course_name']; ?></h1>
      <p><strong>Duration:</strong> <?php echo $row['course_duration']; ?></p>
      <p><strong>author:</strong>  <?php echo $row['course_author']; ?></p>
      <p><strong>Rating:</strong> 5 (25 reviews)</p>
      <p> <?php echo $row['course_desc']; ?></p>
      <p><strong>Price:</strong> <?php echo $row['course_price']; ?></p>
      <form action="checkout.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['course_id'] . ',' . $row['course_price']; ?>">
        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
      </form>
    </div>
</div>

<div class="lesson-table">
  <h2>Lessons</h2>
  <table class="styled-table">
    <thead>
      <tr>
        <th>Lesson No.</th>
        <th>Lesson Name</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(isset($course_id)) {
        $lesson_sql = "SELECT * FROM lesson WHERE course_id = '$course_id'";
        $lesson_result = $conn->query($lesson_sql);
        if ($lesson_result->num_rows > 0) {
          $num=0;
          while($lesson_row = $lesson_result->fetch_assoc()) {
            $num++;
            echo "<tr>";
            echo "<td>" .$num. "</td>";
            echo "<td>" . $lesson_row['lesson_name'] . "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='2'>No lessons available for this course.</td></tr>";
        }
      }
      ?>
    </tbody>
  </table>
</div>

<style>
  .lesson-table {
    text-align: center;
    margin: 20px auto;
    width: 90%;
  }

  .lesson-table h2 {
    font-size: 1.8rem;
    margin-bottom: 15px;
    color: #333;
  }

  .styled-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
    font-size: 1rem;
    font-family: Arial, sans-serif;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }

  .styled-table thead tr {
    background-color:rgb(43, 47, 51);
    color: #ffffff;
    text-align: center;
  }

  .styled-table th, .styled-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
  }

  .styled-table tbody tr:nth-child(even) {
    background-color: #f3f3f3;
  }

  .styled-table tbody tr:hover {
    background-color: #f1f1f1;
  }

  .styled-table tbody tr:last-of-type {
    border-bottom: 2px soli;
  }
</style>

<style>
    .tongle{        
        display: flex;
        align-items: center;
        justify-content: center;
        
    }

    .course-details {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        width: 90%;
        max-width: 400px;
    }
    .course-details img {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>




<?php
  include("footer.php");
  ?>
</body>
</html>