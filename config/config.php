<?php

    $conn = mysqli_connect('localhost', 'Hussien', '1234', 'WebProject');

    if(!$conn) {
        echo 'Conncection error: ' . mysqli_connect_error();
    }

?>
