<?php

    $conn = mysqli_connect('localhost', 'Hussien', '1234', 'WebProject');

    if(!$conn) {
        echo 'Conncection error: ' . mysqli_connect_error();
    }
    if(isset($_POST['Submit'])) {
        $bool = false;
        $name = mysqli_real_escape_string($conn, $_POST['Name']);
        $password = mysqli_real_escape_string($conn, $_POST['Password']);
        $sql2 = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql2);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($users as $user) {
            if($user['Name'] == $name && $user['Password'] == $password) {
                $bool = true;
                session_start();
                $_SESSION['name'] = $user['Name'];
                $_SESSION['role'] = $user['UserRole'];
                $_SESSION['email'] = $user['Email'];
                setcookie('name', $user['Name'], time() + (86400*7), "/" );
                if(!mysqli_query($conn, $sql2)) {
                    echo 'Query error: ' . mysqli_error($conn);
                }
                else {
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    if($user['UserRole'] == 'Admin') {
                        header("location: ../Home (Admin)/HomeAdmin.php");
                    }
                    else if($user['UserRole'] == 'Student') {
                        header("location: ../Home (Student)/HomeStudent.php");
                    }    
                }
                break;
            }
        }
        if(!$bool) {
            $message = "Wrong username or password";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <!-- Link for the logo in the title. -->
    <link rel="shortcut icon" href="logo.png" />
    <!-- Link for the stylesheet. -->
    <link rel="stylesheet" href="LoginStyle.css">
    <!-- Link for the social media icons at the footer. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- This div is for the top navigation bar. -->

    <div class="Navbar">
        <ul>
            <!-- This is the left part of the navbar. -->

            <a href="#"><img src="logo.png" class="Logo"></a>
            <a href="#" class="navname">UNIVERSITY LIBRARY</a>

            <!-- End of the left part of the navbar. -->

            <!-- This is the right part of the navbar. -->

            <li><a href="../Sign up/Signup.php">Sign up</a></li>
            <li><a href="#">Login</a></li>

            <!-- End ot the right part of the navbar. -->
        </ul>
    </div>

    <!-- End of the navigation bar div. -->



    <!-- This is the div that conatins the form box and all it's elements. -->


    <div class="Maindiv">
        <form class="form" name="form1" action="" method="POST" onsubmit="return inputValidation()">
            <h1>LOG IN</h1>
            <p style="font-size: 18px; font-family:monospace;">Please enter your username and password to access your University Library account.</p><br>
            <a href="Login.html"><img src="logo.png" class="rightpartimg"></a>
            <label for="Name"><span id="labels">Username</span></label><br>
            <input type="text" id="In" name="Name" placeholder="Enter username"><br><br>
            <label for="Password"><span id="labels">Password</span></label><br>
            <input type="password" id="In" name="Password" placeholder="Enter Password"><br><br><br>
            <input type="submit" name ='Submit' value="Login" id="Submit"><br><br>
            <p style="font-family: monospace;">Not a member of University library ? <a href="../Sign up/Signup.php" class="bottom">Sign Up Now</a> </p>
        </form>
    </div>

    <!-- End of the Form div. -->


    <!-- This is the div that conatins the footer and all it's elements. -->

    <div class="grid-container">
        
        <div class="grid-item">
            <a href="Login.php"><img src="logo.png" style="width: 250px; height: 250px"></a><br>
            <a href="Login.php" class="footername">UNIVERSITY LIBRARY</a>
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
        function inputValidation() {
            var bool;
            var name = document.forms["form1"]["Name"].value;
            if (name == "") {
                alert("Name must be filled out");
                bool = false;
                return (bool)    
            }
            else {
                bool = true;
            }
            var password = document.forms["form1"]["Password"].value;
            if (password == "") {
                alert("Empty password field !!")
                bool = false;   
                return (bool)
            }
            else {
                bool = true;   
            }
            return (bool)           
        }
    </script>
    
</body>

</html>