<?php

    include('connect.php');
    $firstname = $lastname = $email = $password = $day = $month = $year = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];

        $sql = "INSERT INTO college_users (firstname, lastname, email, password, day, month, year)VALUES ('$firstname', '$lastname', '$email', '$password', '$day', '$month', '$year')";
        if ($conn->query($sql) === TRUE) {
            header('Location: ../../php-project/college-login.html');
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
    }


?>