<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="HeaderStyle.css">
    <title></title>
  </head>
  <body>
      <?php
          session_start();
          $page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
          if($page !='Login' && $page !='Signup'){
          if(!isset($_SESSION['name'])) {
              header("location: ../Login/Login.php");
            }
          }

      ?>
      <!-- This div is for the top navigation bar. -->

      <div class="Navbar">
          <ul>
              <!-- This is the left part of the navbar. -->
              <?php
                if($page == 'Login') :
              ?>
              <a href="Login.php"><img src="logo.png" class="Logo"></a>
              <a href="Login.php" class="navname">UNIVERSITY LIBRARY</a>
              <?php
                elseif($page == 'Signup') :
              ?>
              <a href="../Login/Login.php"><img src="logo.png" class="Logo"></a>
              <a href="../Login/Login.php" class="navname">UNIVERSITY LIBRARY</a>
              <?php
                elseif($_SESSION['role'] == 'Admin' && $page == 'HomeAdmin') :
              ?>
              <a href="HomeAdmin.php"><img src="logo.png" class="Logo"></a>
              <a href="HomeAdmin.php" class="navname">UNIVERSITY LIBRARY</a>
              <?php
                elseif($_SESSION['role'] == 'Admin' && $page != 'HomeAdmin') :
              ?>
              <a href="../Home (Admin)/HomeAdmin.php"><img src="logo.png" class="Logo"></a>
              <a href="../Home (Admin)/HomeAdmin.php" class="navname">UNIVERSITY LIBRARY</a>
              <?php
                elseif($_SESSION['role'] == 'Student' && $page == 'HomeStudent') :
              ?>
              <a href="HomeStudent.php"><img src="logo.png" class="Logo"></a>
              <a href="HomeStudent.php" class="navname">UNIVERSITY LIBRARY</a>
              <?php
                elseif($_SESSION['role'] == 'Student' && $page != 'HomeStudent') :
              ?>
              <a href="../Home (Student)/HomeStudent.php"><img src="logo.png" class="Logo"></a>
              <a href="../Home (Student)/HomeStudent.php" class="navname">UNIVERSITY LIBRARY</a>
              <?php endif; ?>

              <!-- End of the left part of the navbar. -->
              <li class="li2">
                  <?php
                    if($page == 'HomeAdmin' || $page == 'HomeStudent') :
                    if(isset($_COOKIE['name'])) :
                  ?>
                      <p><?php echo 'Hi: ' . $_COOKIE['name']; ?><p>
                  <?php else: ?>
                      <p><?php echo 'Hello, User';?><p>
                  <?php endif ?>
                <?php endif ?>

               </li>

              <!-- This is the right part of the navbar. -->
              <?php
                if($page == 'Login') :
              ?>
              <li><a href="../Sign up/Signup.php">Sign up</a></li>
              <?php
                elseif($page == 'Signup') :
              ?>
              <li><a href="../Login/Login.php">Login</a></li>
              <?php
                else :
              ?>
              <li><a href="../Login/Login.php">Log out</a></li>
              <?php endif ?>

              <!-- End ot the right part of the navbar. -->
          </ul>
      </div>

      <!-- End of the navigation bar div. -->
</html>
