<?php
    $conn = mysqli_connect('localhost', 'Hussien', '1234', 'WebProject');

    if(!$conn) {
        echo 'Conncection error: ' . mysqli_connect_error();
    }
    $sql = "SELECT UserName, UserEmail FROM borrow";
    $result = mysqli_query($conn, $sql);
    $borrows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $borrows = array_map("unserialize", array_unique(array_map("serialize", $borrows)));
?>

<!DOCTYPE html>
<html>
<head>
	<title>Send Mail</title>
    <link rel="stylesheet" href="../Browse Books/BrowseBooksStyle.css">
    <!-- Link for the social media icons at the footer. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/63b4afebca.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="grid-container">
        <?php foreach($borrows as $borrow): ?>
        <div class="grid-item">
            <span class="booklabels">User Name: </span><span class="bookname"><?php echo $borrow['UserName']?></span><br>
            <span class="booklabels">User Email: </span><span class="bookname"><?php echo $borrow['UserEmail']?></span><br>
            <form action="AdminHome.php" method="POST">
                <input type="submit" name="Submit" class="bookbtn" value="Send Mail"></input>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>