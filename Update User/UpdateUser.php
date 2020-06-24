<?php

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

<?php  include '../Templates/Header.php';?>

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
