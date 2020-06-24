<?php

    $conn = mysqli_connect('localhost', 'Hussien', '1234', 'WebProject');

    if(!$conn) {
        echo 'Conncection error: ' . mysqli_connect_error();
    }
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
            $userRole = mysqli_real_escape_string($conn, $_POST['Option']);
        $sql = "INSERT INTO users(Name, Password, Email, UserRole) VALUES('$name', '$password', '$email', '$userRole')";
            if(!mysqli_query($conn, $sql)) {
                echo 'Query error: ' . mysqli_error($conn);
            }
            else {
                mysqli_free_result($result);
                mysqli_close($conn);
                header("location: ../Login/Login.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <!-- Link for the logo in the title. -->
    <link rel="shortcut icon" href="logo.png" />
    <!-- Link for the stylesheet. -->
    <link rel="stylesheet" href="SignUpStyle.css">
    <!-- Link for the social media icons at the footer. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

  <?php  include '../Templates/Header.php';?>

    <!-- This is the div that conatins the form box and all it's elements. -->
    <div class="Maindiv">
        <form class="form" name="form1" action="#" method="POST" onsubmit="return validateForm()">
            <h1>SIGN UP</h1>
            <p style="font-size: 18px; font-family:monospace;">Complete the form below to create a new Univesrity library account.</p><br>
            <a href="../Login/Login.php"><img src="logo.png" class="rightpartimg"></a>
            <label for="Name"><span id="labels">Your username</span></label><br>
            <input type="text" id="In" name="Name" placeholder="Enter full name"><br><br>
            <label for="Email"><span id="labels">Your Email address</span></label><br>
            <input type="text" id="In" name="Email" placeholder="Enter Email"><br><br>
            <label for="Password"><span id="labels">Enter a Password</span></label><br>
            <input type="password" id="In" name="Password" placeholder="Enter Password"><br><br>
            <label for="Password"><span id="labels">Confirm your Password</span></label><br>
            <input type="password" id="In" name="confirmPassword" placeholder="Re-Enter Password"><br><br>
            <h2 style="font-family:monospace;">You are : </h2>
            <label class="container">Admin
                <input type="radio" checked="checked" value="Admin" name="Option">
                <span class="checkmark"></span>
            </label>
            <label class="container">Student
                <input type="radio" value="Student" name="Option">
                <span class="checkmark"></span>
            </label><br>
            <input type="checkbox" id="Checkbox">
            <label for="checkbox"><span id="lowerlabel">Send me monthly updates from the University library.</span></label><br><br>
            <p style=" font-family: monospace;">By signing up, you agree to the University library <a href="#" style="color:#FF6B00; font-family: monospace;">Terms of Service.</a> </p>
            <input type="submit" name='Submit' value="Sign Up" id="Submit"><br><br>

        </form>
    </div>

    <!-- End of the Form div. -->

    <?php  include '../Templates/Footer.php';?>

    <script type="text/javascript">
        function validateForm() {
            var bool = false;
            var x = document.forms["form1"]["Name"].value;
            if (x == "") {
                alert("Name must be filled out");
                bool = false;
                return (bool)
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
                return (bool)
            }
            if (form1.Password.value === form1.confirmPassword.value) {
                bool = true;
            }
            else {
                alert("Not matched passwords")
                bool = false;
                return (bool)
            }
            if(form1.Password.value.length < 8 || form1.Password.value.length == 0) {
                alert("Password should be at least 8 characters")
                bool = false;
                return (bool)
            }
            else {
                bool = true;
            }
            return (bool)
        }
    </script>

</html>
