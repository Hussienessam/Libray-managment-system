<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin Home</title>
    <!-- Link for the logo in the title. -->
    <link rel="shortcut icon" href="logo.png" />
    <!-- Link for the stylesheet. -->
    <link rel="stylesheet" href="HomeAdminStyle.css">
    <!-- Link for the social media icons at the footer. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/63b4afebca.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        session_start();
        if(!isset($_SESSION['name'])) {
            header("location: ../Login/Login.php");
        }
    ?>
    <!-- This div is for the top navigation bar. -->

    <div class="Navbar">
        <ul>
            <!-- This is the left part of the navbar. -->

            <a href="HomeAdmin.php"><img src="logo.png" class="Logo"></a>
            <a href="HomeAdmin.php" class="navname">UNIVERSITY LIBRARY</a>

            <!-- End of the left part of the navbar. -->
            <li class="li2">
                <?php if(isset($_COOKIE['name'])) : ?>
                    <p><?php echo 'Hi: ' . $_COOKIE['name']; ?><p>
                <?php else: ?>
                    <p><?php echo 'Hello, User';?><p>
                <?php endif ?>
             </li>

            <!-- This is the right part of the navbar. -->
            <li><a href="../Login/Login.php">Log out</a></li>

            <!-- End ot the right part of the navbar. -->
        </ul>
    </div>

    <!-- End of the navigation bar div. -->

    <!-- The sidebar -->
    <div class="sidebar">
        <a href="../Update User/UpdateUser.php"><i class="fas fa-users-cog"></i> Update user details</a>
        <a href="../Add Books/AddBooks.php"><i class="fas fa-book"></i> Add a book</a>
        <a href="../Update Book/UpdateBook.php"><i class="fas fa-edit"></i> Update a book details</a>
        <a href="../Browse Books/BrowseBooks.php"><i class="fas fa-book-reader"></i> Browse books</a>
        <a href="#" onclick="sendMail()"><i class="fas fa-book-reader"></i> Send mail</a>
    </div>



    <div class="midimg">
        <h1 class="middivheader">UNIVESRITY LIBRARY</h1>
        <h1 class="middivslogan">" ONCE YOU LEARN TO READ, YOU ARE FOREVERE FREE "</h1>
    </div>

    <div class="middiv">
        <img src="Middiv.jpg" style="width: 40%; height: 300px; border: 3px solid #808285; float: left; display: inline;">
        <div class="rightpart">
            <p class="paragraphs">What can I found in a library ? </p>
            <P class="paragraphs">A library is a place where books and sources of information are stored. They make it easier for people to get access to them for various purposes. Libraries are very helpful and economical too. They include books, magazines, newspapers, DVDs, manuscripts and more. In other words, they are an all-encompassing source of information.</P>
        </div>

    </div>

    <div id="div2">
    </div>

    <script>
            function sendMail () {
                var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                    if(this.readyState === 4 && this.status === 200) {
                        document.getElementById("div2").innerHTML = this.responseText;
                    }
                }
                request.open("GET","sendMail.php",true);
                request.send();
            }
    </script>

</body>

</html>
