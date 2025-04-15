  <!-- 
    - #FOOTER
  -->

  <footer class="footer" id='footer'>

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand">

            <a href="#" class="logo" style="font-weight: bold; color: white; font-size: 24px;">
            Mechanic
            </a>
              <p class="footer-text">
              We provide top-notch mechanical services to ensure your vehicle runs smoothly. Trust us for quality repairs and maintenance.
              </p>


        </div>

        <div class="footer-contact">

          <h4 class="contact-title">Contact Us</h4>

          <p class="contact-text">
            Feel free to contact and reach us !!
          </p>

          <ul>

            <li class="contact-item">
              <ion-icon name="call-outline"></ion-icon>

              <a href="tel:+01123456790" class="contact-link">+880 (163) 1511 325</a>
            </li>

            <li class="contact-item">
              <ion-icon name="mail-outline"></ion-icon>

              <a href="mailto:info.tourly.com" class="contact-link">mechanic@gmail.com</a>
            </li>

            <li class="contact-item">
              <ion-icon name="location-outline"></ion-icon>

              <address>H-3/4 R-7/A Kaderabad Housing Mohammadpur</address>
            </li>

          </ul>

        </div>

        <div class="footer-form">

          <p class="form-text">
            Subscribe our newsletter for more update & news !!
          </p>

          <form action="" class="form-wrapper">
            <input type="email" name="email" class="input-field" placeholder="Enter Your Email" required>

            <button type="submit" class="btn btn-secondary">Subscribe</button>
          </form>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">

        <p class="copyright">
          &copy; 2025 <a href="">Mechanic</a>. All rights reserved
        </p>

        <ul class="footer-bottom-list">

          <li>
            <a href="#" class="footer-bottom-link">Privacy Policy</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">Term & Condition</a>
          </li>

          <li>
            <a href="#" class="footer-bottom-link">FAQ</a>
          </li>

        </ul>

      </div>
    </div>

  </footer>





  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>


  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
if (file_exists("../js/ajaxrequest.js") && filesize("../js/ajaxrequest.js") > 0) {
  echo '<script type="text/javascript" src="../js/ajaxrequest.js"></script>';
} elseif (file_exists("js/ajaxrequest.js") && filesize("js/ajaxrequest.js") > 0) {
  echo '<script type="text/javascript" src="js/ajaxrequest.js"></script>';
} else {
  echo "<p>Ajax request script is not available.</p>";
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
if (file_exists("../js/adminajaxrequest.js") && filesize("../js/adminajaxrequest.js") > 0) {
  echo '<script type="text/javascript" src="../js/adminajaxrequest.js"></script>';
} elseif (file_exists("js/adminajaxrequest.js") && filesize("js/adminajaxrequest.js") > 0) {
  echo '<script type="text/javascript" src="js/adminajaxrequest.js"></script>';
} else {
  echo "<p>Admin Ajax request script is not available.</p>";
}
?>
<script src="js/app.js"></script>