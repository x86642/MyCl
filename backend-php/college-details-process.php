<?php 

    include('connect.php');


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $selectedCourses = '';
        if (isset($_POST['course']) && is_array($_POST['course'])) {
            $selectedCourses = implode(',', array_map('trim', $_POST['course']));
        }
        
        $university = $_POST['university'];
        $institution = $_POST['institution'];
        $state = $_POST['state'];
        $district = $_POST['district'];
        $address = $_POST['address'];
        $totalSeats = intval($_POST['totalseats']);
        $reserved = intval($_POST['reserved']);
        $management = intval($_POST['management']);
        $email = $_POST['email'];
        $number = $_POST['phone-number'];
        $programs = '';
        if (isset($_POST['programs']) && is_array($_POST['programs'])) {
            $programs = implode(', ', array_map('trim', $_POST['programs']));
        }
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./uploads/" . $filename;

        
        $sql = "SELECT * FROM college_users WHERE certificate = '$filename'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "this already exists";
        }  else {
            $sql = "INSERT INTO college_details (university, institution, state, district, address, programs, course, email, number, total_seats, reserved_seats, management_seats, certificate)
            VALUES ('$university', '$institution', '$state', '$district', '$address', '$programs', '$selectedCourses', '$email', '$number', '$totalSeats', '$reserved', '$management', '$filename')";
            
            if (move_uploaded_file($tempname, $folder) && $conn->query($sql) === TRUE) {
                header('Location: ' . $_SERVER['PHP_SELF']);
            } else {
            }
        }
    }
?>