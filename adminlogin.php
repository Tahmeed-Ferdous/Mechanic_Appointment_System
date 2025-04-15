<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mechanics</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
  <link rel="stylesheet" href="style.css">
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
          Mechanic
        </a>

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
                <source src="img/0215.mp4" type="video/mp4">
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

        <div class="admin-form-container" style="display: flex; justify-content: center; align-items: center; min-height: 60vh;">
            <div style="background-color: #f9f9f9; padding: 30px; border-radius: 10px; width: 100%; max-width: 400px;">
                <h2 style="text-align: center; margin-bottom: 20px; color: #333;">Admin Login</h2>
                <form>
                    <div style="margin-bottom: 15px;">
                        <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold; color: #555;">Email:</label>
                        <input type="email" id="adminemail" name="adminemail" placeholder="Enter your email" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold; color: #555;">Password:</label>
                        <input type="password" id="adminpass" name="adminpass" placeholder="Enter your password" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                    </div>
                    <small id="statusAdminLogMsg"></small>
                    <button type="button" onclick="checkAdminLogin()" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Login</button>
                </form>
            </div>
        </div>
    </article>
</main>

<?php
  include("pages/footer.php");
  ?>


</body>
</html>
