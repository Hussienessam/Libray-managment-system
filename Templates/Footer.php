<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="FooterStyle.css">
    <title></title>
  </head>
    <!-- This is the div that conatins the footer and all it's elements. -->

    <div class="grid-container">

        <div class="grid-item">
          <?php
            if($page == 'Login') :
          ?>
          <a href="Login.php"><img src="logo.png" style="width: 250px; height: 250px"></a><br>
          <a href="Login.php" class="footername">UNIVERSITY LIBRARY</a>
          <?php
            elseif($page == 'Signup') :
          ?>
          <a href="../Login/Login.php"><img src="logo.png" style="width: 250px; height: 250px"></a><br>
          <a href="../Login/Login.php" class="footername">UNIVERSITY LIBRARY</a>
          <?php
            elseif($_SESSION['role'] == 'Admin') :
          ?>
          <a href="../Home (Admin)/HomeAdmin.php"><img src="logo.png" style="width: 250px; height: 250px"></a><br>
          <a href="../Home (Admin)/HomeAdmin.php" class="footername">UNIVERSITY LIBRARY</a>
          <?php
            elseif($_SESSION['role'] == 'Student') :
          ?>
          <a href="../Home (Student)/HomeStudent.php"><img src="logo.png" style="width: 250px; height: 250px"></a><br>
          <a href="../Home (Student)/HomeStudent.php" class="footername">UNIVERSITY LIBRARY</a>
          <?php endif; ?>

        </div>

        <div class="grid-item">
            <h3 style="display: inline; ">Read about us :</h3><br><br>
            <P style="display: inline; ">University library stems its objectives from its educational institution. The success of the university in accomplishing its message depends on the validity of its libraries, which are responsible for the educational and research process at the university. It helps the student, the researcher, and the professor carry cut their job as it provides them with the varied sources of information. Besides, the library sorts out these sources and keeps them. Similarly, it is responsible for orienting library frequenters to know how to find out sources of information and how to make advantage of them. </P><br>
            <h3>Contact us :</h3>
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google"></a>
            <a href="#" class="fa fa-linkedin"></a>
        </div>

        <div class="grid-item">
            <h2>Find us here :</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4992.366372889475!2d31.204071411182923!3d30.022723227557307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145846db01520851%3A0xbd9781bf40115c5d!2sCairo%20University!5e0!3m2!1sen!2seg!4v1589574421952!5m2!1sen!2seg" width="300" height="250" frameborder="0" style="border:1px black; border-radius: 3px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>

    </div>
    <!-- End of the footer div. -->
  </body>
</html>
