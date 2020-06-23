<?php
    $conn = mysqli_connect('localhost', 'Hussien', '1234', 'WebProject');

    if(!$conn) {
        echo 'Conncection error: ' . mysqli_connect_error();
    }
    session_start();
    if(isset($_POST['Submit'])) {
        $bool = true;
        $name = mysqli_real_escape_string($conn, $_POST['Name']);
        $sql2 = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql2);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($users as $user) {
            if($user['Name'] == $name) {
                $bool = false;
            }
        }
        if(!$bool) {
            $message = "user already exists";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else {
            $password = mysqli_real_escape_string($conn, $_POST['Password']);
            $email = mysqli_real_escape_string($conn, $_POST['Email']);
            $username = $_SESSION['name'];
    $sql = "UPDATE users SET Name = '$name' , Password = '$password', Email = '$email' WHERE Name = '$username'";
            mysqli_query($conn, $sql);
            if(!mysqli_query($conn, $sql)) {
                echo 'Query error: ' . mysqli_error($conn);
            }
            else {
                mysqli_free_result($result);
                mysqli_close($conn);
                if($_SESSION['role'] == 'Admin') {
                   header("location: ../Home (Admin)/HomeAdmin.php");
                }
                else {
                    header("location: ../Home (Student)/HomeStudent.php");
                }
            }
         }
    }
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Update User Details</title>
    <!-- Link for the logo in the title. -->
    <link rel="shortcut icon" href="logo.png" />
    <!-- Link for the stylesheet. -->
    <link rel="stylesheet" href="UpdateUserStyle.css">
    <!-- Link for the social media icons at the footer. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/63b4afebca.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- This div is for the top navigation bar. -->
    <?php
        if(!isset($_SESSION['name'])) {
            header("location: ../Login/Login.php"); }
    ?>

    <div class="Navbar">
        <ul>
            <!-- This is the left part of the navbar. -->

            <?php if($_SESSION['role'] == 'Admin') : ?>
            <a href="../Home (Admin)/HomeAdmin.php"><img src="logo.png" class="Logo"></a>
            <a href="../Home (Admin)/HomeAdmin.php" class="navname">UNIVERSITY LIBRARY</a>
            <?php elseif($_SESSION['role'] == 'Student') : ?>
            <a href="../Home (Student)/HomeStudent.php"><img src="logo.png" class="Logo"></a>
            <a href="../Home (Student)/HomeStudent.php" class="navname">UNIVERSITY LIBRARY</a>
            <?php endif; ?>

            <!-- End of the left part of the navbar. -->

    
            <!-- This is the right part of the navbar. -->

            <li><a href="../Login/Login.php">Log out</a></li>
            
            <!-- End ot the right part of the navbar. -->
        </ul>
    </div>

    <!-- End of the navigation bar div. -->
    
        <!-- This is the div that conatins the form box and all it's elements. -->
    
    <div class="Maindiv">
        <form class="form" name="form1" action="#" method="POST" onsubmit="return validateForm()">
            <h1>UPDATE USER DETAILS</h1>
            <p style="font-size: 18px; font-family:monospace;">Complete the form below to update your account info.</p><br>
            <?php if($_SESSION['role'] == 'Admin') : ?>
            <a href="../Home (Admin)/HomeAdmin.php"><img src="logo.png" class="rightpartimg"></a>
            <?php elseif($_SESSION['role'] == 'Student') : ?>
            <a href="../Home (Student)/HomeStudent.php"><img src="logo.png" class="rightpartimg"></a>
            <?php endif; ?>

            <label for="Name"><span id="labels">Enter a new username</span></label><br>
            <input type="text" id="In" name="Name" placeholder="Enter username"><br><br>
            <label for="Email"><span id="labels">Enter a new email address</span></label><br>
            <input type="email" id="In" name="Email" placeholder="Enter Email"><br><br>
            <label for="Password"><span id="labels">Enter a new Password</span></label><br>
            <input type="password" id="In" name="Password" placeholder="Enter Password"><br><br>
            <label for="Password"><span id="labels">Confirm your new Password</span></label><br>
            <input type="password" id="In" name="confirmPassword" placeholder="Re-Enter Password"><br><br>
            <input type="submit" name='Submit' value="Submit" id="Submit">
            <br><br>

        </form>
    </div>

    <!-- End of the Form div. -->
    
    <!-- This is the div that conatins the footer and all it's elements. -->

    <div class="grid-container">
        
        <div class="grid-item">
            <?php if($_SESSION['role'] == 'Admin') : ?>
            <a href="../Home (Admin)/HomeAdmin.php"><img src="logo.png" class="Logo"></a><img src="logo.png" style="width: 250px; height: 250px"></a><br>
            <a href="../Home (Admin)/HomeAdmin.php" class="footername">UNIVERSITY LIBRARY</a>
            <?php elseif($_SESSION['role'] == 'Student') : ?>
            <a href="../Home (Student)/HomeStudent.php">><img src="logo.png" class="Logo"></a><img src="logo.png" style="width: 250px; height: 250px"></a><br>
            <a href="../Home (Student)/HomeStudent.php"> class="footername">UNIVERSITY LIBRARY</a>
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

    <script type="text/javascript">
        function validateForm() {
            var bool = false;
            var x = document.forms["form1"]["Name"].value;
            if (x == "") {
                alert("Name must be filled out");
                bool = false;
            }
            else {
                bool = true;
            }
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form1.Email.value)) {
                bool = true;
            }
            else {
                alert("You have entered an invalid email address!")
                bool = false;   
            }
            if (form1.Password.value === form1.confirmPassword.value) {
                bool = true;   
            }
            else {
                alert("Not matched passwords")
                bool = false;   
            }
            if(form1.Password.value.length < 8 || form1.Password.value.length == 0) {
                alert("Password should be at least 8 characters")
                bool = false;  
            }
            else {
                bool = true;
            }
            return (bool)           
        }
    </script>
    
</body>

</html>
