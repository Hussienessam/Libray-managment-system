<?php

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

<?php  include '../Templates/Header.php';?>

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

</html>
