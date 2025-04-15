<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('./dbConnection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mechanic Appointment</title>
  <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header" data-header>

    <div class="overlay" data-overlay></div>

    <div class="header-top">
      <div class="container">

        <a href="#" class="logo">
          Mechanic Appointment
        </a>

      </div>
    </div>

    <div class="header-bottom">
      <div class="container">

        <nav class="navbar" data-navbar>

          <ul class="navbar-list">

            <li>
              <a href="#home" class="navbar-link" data-nav-link>home</a>
            </li>

            <li>
              <a href="#mechanics" class="navbar-link" data-nav-link>Mechanics</a>
            </li>

            <li>
              <a href="#footer" class="navbar-link" data-nav-link>Contact us</a>
            </li>

            </nav>
            <!-- Login Modal  -->
            <?php
            if (file_exists("pages/login.php") && filesize("pages/login.php") > 0) {
                include("pages/login.php");
            } elseif (file_exists("./login.php") && filesize("./login.php") > 0) {
                include("./login.php");
            } else {
                echo "<p>Login module is not available.</p>";
            }
            ?>
            <!-- Login Modal  -->


          </div>
    </div>

  </header>

  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home">
        <!-- Background Video -->
        <video class="hero-video" autoplay muted loop playsinline>
          <source src="img/mechanics.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      
        <div class="container">
          <h2 class="h1 hero-title">Find Your Mechanic Easily</h2>
            
          <p class="hero-text">
            Keep Your Vehicle Running Smoothly: Expert Mechanic Services at Your Fingertips.
            <br> Discover reliable and professional mechanic solutions tailored to your needs.
          </p>
            <div class="btn-group">
            <!-- Sign up modal -->
            <?php
            if (isset($_SESSION['is_login'])) {
              echo '<button class="btn btn-primary"><a href="student/studentProfile.php" style="color: aliceblue;">Profile</a></button>';
            } else {
              include("pages/signup.php");
            }
            ?>
            <!-- Sign up modal -->


            <button class="btn btn-secondary"><a href="#mechanics" style="color: aliceblue;">Mechanics</a></button>
          </div>
        </div>
      </section>


            <!-- 
        - #PACKAGE
      -->

      <section class="package" id="mechanics">
        <div class="container">

          <p class="section-subtitle">Popular Mechanics</p>

          <h2 class="h2 section-title">Checkout Our Mechanics</h2>

          <p class="section-text">
            Explore our wide range of mechanic services, including engine diagnostics, brake repairs, oil changes, and tire replacements. Our skilled professionals ensure top-notch service for your vehicle.
          </p>

          <ul class="package-list">
            <?php 
            $sql = "SELECT * FROM course LIMIT 3";
            $result = $conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_assoc()){
                $course_id = $row['course_id'];
                echo '
              <li>
              <div class="package-card">

                <figure class="card-banner">
                  <img src="'.str_replace('..', '.', $row['course_img']).'" alt="Course Image" loading="lazy">
                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">'.$row['course_name'].'</h3>

                  <p class="card-text">
                    '.$row['course_desc'].'
                  </p>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <div class="meta-box">
                        <ion-icon name="time"></ion-icon>

                        <p class="text">'.$row['course_duration'].'</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                        <ion-icon name="people"></ion-icon>

                        <p class="text">'.$row['course_author'].'</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                        <ion-icon name="location"></ion-icon>

                        <p class="text">Specialist</p>
                      </div>
                    </li>

                  </ul>

                </div>

                <div class="card-price">

                  <div class="wrapper">

                    <p class="reviews">(25 reviews)</p>

                    <div class="card-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                    </div>

                  </div>

                    <p class="price">
                    $'.$row['course_price'].'
                    <span style="text-decoration: line-through; color: white; font-size: medium;">'.$row['course_original_price'].'</span>
                    </p>

                  <a class="btn btn-secondary" href="pages/coursedetails.php?course_id='.$course_id.'" >Book</a>

                </div>

              </div>
            </li>
                ';
              }
            }

            ?>

          </ul>

        </div>
      </section>
      
          



      <!-- 
        - #POPULAR
      -->

      <section class="popular" id="visualisations">
        <div class="container">

          <p class="section-subtitle">Uncover the secrets</p>

          <h2 class="h2 section-title">Popular Feedbacks</h2>

            <p class="section-text">
            Hear what our customers have to say about their experiences with our mechanics. Their feedback helps us improve and ensures we provide the best service possible.
          </p>

            <ul class="popular-list" style="display: flex; flex-wrap: wrap; gap: 20px;">

            <?php 
            $sql = "SELECT stu_name, stu_occ, stu_img, f_content FROM student JOIN feedback ON student.stu_id = feedback.stu_id LIMIT 3";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
              $stu_img = $row['stu_img'];
              $n_img = str_replace('..', '.', $stu_img);
            ?>

            <li style="flex: 1 1 calc(33.333% - 20px); box-sizing: border-box;">

              <div class="popular-card">

              <figure class="card-img">
                <img src="<?php echo $n_img ?>" alt="" loading="lazy">
              </figure>

              <div class="card-content">

                <div class="card-rating">
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
                <ion-icon name="star"></ion-icon>
                </div>

                <p class="card-subtitle">
                <a href=""><?php echo $row['stu_occ']; ?></a>
                </p>

                <h3 class="h3 card-title">
                <a href=""><?php echo $row['stu_name'] ?></a>
                </h3>

                <p class="card-text">
                <?php echo $row['f_content']; ?>
                </p>

              </div>

              </div>

            </li>

            <?php }
            } ?>

            </ul>

        </div>
      </section>

    </article>
  </main>

  <?php
  include("pages/footer.php");
  ?>
</body>
</html>