<?php
    $conn = mysqli_connect('localhost', 'Hussien', '1234', 'WebProject');

    if(!$conn) {
        echo 'Conncection error: ' . mysqli_connect_error();
    }
    header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', FALSE);
    header('Pragma: no-cache');
    session_start();
    $sort_by = 'ID';
    $sql = "SELECT * FROM books ORDER BY {$sort_by}";
    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(isset($_POST['sorting_by'])) {
        $sort_by = $_POST['select'];
        $sql9 = "SELECT * FROM books ORDER BY {$sort_by}";
        if(!mysqli_query($conn, $sql9)) {
            echo 'Query error: ' . mysqli_error($conn);
        }
        $result4 = mysqli_query($conn, $sql9);
        $books = mysqli_fetch_all($result4, MYSQLI_ASSOC);
    }
    if(isset($_POST['Submit'])) {
        $id = $_POST['book_id'];
        $sql2 = "SELECT * FROM books WHERE ID = '$id'";
        $result2 = mysqli_query($conn, $sql2);
        $book = mysqli_fetch_assoc($result2);
        $userName = $_SESSION['name']; 
        $userEmail = $_SESSION['email'];
        $sql5 = "SELECT * FROM borrow";
        $result3 = mysqli_query($conn, $sql5);
        $borrows = mysqli_fetch_all($result3, MYSQLI_ASSOC);
        $bool = false;
        $borrow_id = 0;
        foreach($borrows as $borrow) {
            if($borrow['UserName'] == $userName) {
                $borrow_id = $borrow['Borrow_ID'];
                $bool = true;
                break;
            }
        }
        if($_POST['Submit'] == 'Borrow') {
            if($book['No_of_Copies'] <= 0) {
                $message = "There is no available copies for the book";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else {
                $sql3 = "INSERT INTO borrow(UserName, UserEmail, Book_ID) VALUES('$userName', '$userEmail', '$id')";
                if(!mysqli_query($conn, $sql3)) {
                    echo 'Query error: ' . mysqli_error($conn);
                }
                else {
                    $sql4 = "UPDATE books SET No_of_Copies = No_of_Copies-1 WHERE ID = '$id'";
                    if(!mysqli_query($conn, $sql4)) {
                        echo 'Query error: ' . mysqli_error($conn);
                    }
                }
            }
        }
        else if($_POST['Submit'] == 'Return') {
            if ($bool) {
                $sql6 = "DELETE FROM borrow WHERE Borrow_ID = '$borrow_id'";
                mysqli_query($conn, $sql6);
                $sql7 = "UPDATE books SET No_of_Copies = No_of_Copies+1 WHERE ID = '$id'";
                mysqli_query($conn, $sql7);
            }
            else {
                $message = "You have not borrowed this book!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        else if($_POST['Submit'] == 'Extend') {
            if ($bool) {
                $sql8 = "UPDATE borrow SET BorrowPeriod = BorrowPeriod+15 WHERE Book_ID = '$id'";
                if(!mysqli_query($conn, $sql8)) {
                    echo 'Query error: ' . mysqli_error($conn);
                }
            }
            else {
                $message = "You have not borrowed this book!!";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }  
        }
        clearstatcache();
        mysqli_free_result($result);
        mysqli_free_result($result2);
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Browse Books</title>
    <!-- Link for the logo in the title. -->
    <link rel="shortcut icon" href="logo.png" />
    <!-- Link for the stylesheet. -->
    <link rel="stylesheet" href="BrowseBooksStyle.css">
    <!-- Link for the social media icons at the footer. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/63b4afebca.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if(!isset($_SESSION['name'])) {
        header("location: ../Login/Login.php"); }
    ?>

    <!-- This div is for the top navigation bar. -->

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

    <div class="sortby">
        <form action="BrowseBooks.php" method="POST">    
            <label >Sort By:</label>
            <select id="options" name="select">
                <option value="" selected></option>
                <option value="Name">Book Name</option>
                <option value="ISBN">ISBN</option>
                <option value="PublicationYear">Publication Year</option>
                <option value="Author">Author</option>
            </select>
            <input type="submit" name="sorting_by" class="bookbtn" value="Sort"></input>
        </form>
    </div>
    
    <!-- The Books and the page content -->
    <div class="grid-container">
        <?php foreach($books as $book): ?>
        <div class="grid-item">
            <img src="Book-Covers/book1.jpg" style="width: 150px; height: 220px;"><br>
            <span class="booklabels">Book name: </span><span class="bookname"><?php echo $book['Name']?></span><br>
            <span class="booklabels">Author name: </span><span class="author"><?php echo $book['Author']?></span><br>
            <span class="booklabels">Publication year: </span><span class="year"><?php echo $book['PublicationYear']?></span><br>
            <span class="booklabels">ISBN: </span><span class="ISBN"><?php echo $book['ISBN']?></span><br>
            <span class="booklabels">No of Copies: </span><span class="year"><?php echo $book['No_of_Copies']?></span><br><br>
            <form action="BrowseBooks.php" method="POST">
                <input type="hidden" name="book_id" value="<?php echo $book['ID']; ?>">
                <input type="submit" name="Submit" class="bookbtn" value="Borrow"></input>
                <input type="submit" name="Submit" class="bookbtn" value="Return"></input>
                <input type="submit" name="Submit" class="bookbtn" value="Extend"></input>
            </form>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- End of the content. -->
</body>

</html>