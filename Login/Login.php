<?php

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

    <?php  include '../Templates/Header.php';?>

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

    <?php  include '../Templates/Footer.php';?>

    <!-- End of the Form div. -->

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

</html>
