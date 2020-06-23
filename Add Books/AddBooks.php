<?php

    $conn = mysqli_connect('localhost', 'Hussien', '1234', 'WebProject');

    if(!$conn) {
        echo 'Conncection error: ' . mysqli_connect_error();
    }
    if(isset($_POST['Submit'])) {
        $bool = true;
        $ISBN = mysqli_real_escape_string($conn, $_POST['ISBN']);
        $sql2 = "SELECT * FROM books";
        $result = mysqli_query($conn, $sql2);
        $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($books as $book) {
            if($book['ISBN'] == $ISBN) {
                $bool = false;
            }
        }
        if(!$bool) {
            $message = "ISBN for a book must be unique";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else {
            $name = mysqli_real_escape_string($conn, $_POST['Name']);
            $publicationYear = mysqli_real_escape_string($conn, $_POST['PublicationYear']);
            $author = mysqli_real_escape_string($conn, $_POST['Author']);
            $no_of_Copies = mysqli_real_escape_string($conn, $_POST['No_of_Copies']);
$sql = "INSERT INTO books(Name, ISBN, PublicationYear, Author, No_of_Copies) VALUES('$name', '$ISBN', '$publicationYear', '$author', '$no_of_Copies')";
            if(!mysqli_query($conn, $sql)) {
                echo 'Query error: ' . mysqli_error($conn);
            }
            else {
                mysqli_free_result($result);
                mysqli_close($conn);
                header("location: ../Browse Books/BrowseBooks.php");
            }
        }
    }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Books</title>
    <!-- Link for the logo in the title. -->
    <link rel="shortcut icon" href="logo.png" />
    <!-- Link for the stylesheet. -->
    <link rel="stylesheet" href="AddBooksStyle.css">
    <!-- Link for the social media icons at the footer. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/63b4afebca.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        session_start();
        if(!isset($_SESSION['name'])) {
            header("location: ../Login/Login.php"); }
    ?>

    <!-- This div is for the top navigation bar. -->

    <div class="Navbar">
        <ul>
            <!-- This is the left part of the navbar. -->

            <a href="../Home (Admin)/HomeAdmin.php"><img src="logo.png" class="Logo"></a>
            <a href="../Home (Admin)/HomeAdmin.php" class="navname">UNIVERSITY LIBRARY</a>

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
            <h1>ADD NEW BOOK</h1>
            <p style="font-size: 18px; font-family:monospace;">Complete the form below to add new book.</p><br>
            <a href="../Home (Admin)/HomeAdmin.php"><img src="logo.png" class="rightpartimg"></a>
            <label><span id="labels">Book Name</span></label><br>
            <input type="text" id="In" name="Name" placeholder="Enter book name"><br><br>
            <label><span id="labels">Book Author</span></label><br>
            <input type="text" id="In" name="Author" placeholder="Enter book author"><br><br>
            <label><span id="labels">ISBN</span></label><br>
            <input type="text" id="In" name="ISBN" placeholder="Enter ISBN"><br><br>
            <label><span id="labels">Publication Year</span></label><br>
            <input type="text" id="In" name="PublicationYear" placeholder="Enter publication year"><br><br>
            <label><span id="labels">No of Copies</span></label><br>
            <input type="text" id="In" name="No_of_Copies" placeholder="Enter no of copies of the book"><br><br>
            <input type="submit" name="Submit" value="Save" id="Submit">
            <input type="submit" value="Return" id="Submit" style="margin-left: 4%;">
            <br><br>

        </form>
    </div>

    <!-- End of the Form div. -->
    
    
    
    <!-- This is the div that conatins the footer and all it's elements. -->

    <div class="grid-container">
        
        <div class="grid-item">
            <a href="../Home (Admin)/HomeAdmin.php"><img src="logo.png" style="width: 250px; height: 250px"></a><br>
            <a href="../Home (Admin)/HomeAdmin.php" class="footername">UNIVERSITY LIBRARY</a>
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
                return (bool)  
            }
            else {
                bool = true;
            }
            x = document.forms["form1"]["Author"].value;
            if (x == "") {
                alert("Author must be filled out");
                bool = false;
                return (bool)  
            }
            else {
                bool = true;
            }
            x = document.forms["form1"]["ISBN"].value;
            if (isNaN(x) || x == "") {
                alert("ISBN must be specified correctly");
                bool = false;
                return (bool)    
            }
            else {
                bool = true;
            }
            x = document.forms["form1"]["PublicationYear"].value;
            if (isNaN(x) || x == "") {
                alert("Publication Year must be specified correctly");
                bool = false;
                return (bool)    
            }
            else {
                bool = true;
            }
            x = document.forms["form1"]["No_of_Copies"].value;
            if (isNaN(x) || x == "") {
                alert("No of Copies must be specified correctly");
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
