<?php 
    if (!isset($_COOKIE['username'])) {
        header('Location: ../pages/home.php');
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/note.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin-home.css" type="text/css">
    <title>Admin page | Dashboard</title>
    <style>
        .logout,.material-icons-sharp {
            cursor: pointer;
        }
        .user-card-heading {
            text-align: center;
            margin-bottom: 20px; /* Add space below the heading */
        }
        /* Style for the user card container */
        .user-card-container {
            display: flex;
            flex-wrap: wrap;
        }

        /* Style for individual user cards */
        .user-card {
            width: 200px; /* Adjust the width as needed */
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        /* Style for user avatars within user cards */
        .avatar-container {
            width: 80px; /* Adjust the width and height to create a circle */
            height: 80px;
            background-color: #f0f0f0; /* Background color for the circle */
            border-radius: 50%; /* Create a circle by setting border-radius to 50% */
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px; /* Center the circle */
        }

        .avatar-container img {
            max-width: 100%;
            border-radius: 50%; /* Ensure the image is also a circle */
        }

        /* Additional styles for the user card text (e.g., first name) */
        h2 {
            margin: 10px 0;
        }

    </style>
</head>

<body>

    <div class="container" style="padding: 25px;">

        <!-- Sidebar section start  -->
        <aside>

            

            <div class="sidebar">
               

                <a href="#" id="">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>User</h3>

                </a>

                

                <a href="admin-home.html" id="" class="active">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>Analylics</h3>

                </a>

                <a href="requests.php" id="">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Requests</h3>
                </a>

                <a href="overview.php" id="">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Overview</h3>

                </a>

                <a href="settings.php" id="">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Settings</h3>
                </a>

    
                <?php
                    if (isset($_COOKIE['username'])) {
                        $user_id = $_COOKIE['username'];
                        echo '
                        <a>
                        <span class="material-icons-sharp">
                            logout
                        </span>
                        <form method="post" action="admin-dashboard.php">
                        <h3><input type="submit" name="logout" value="Logout" class="logout"></h3>
                        </form>
                        </a>';
                    }
                    
                    if (isset($_POST['logout'])) {                        
                        setcookie("username", "", time() - 3600, "/");
                        header("Location: admin-login.php");
                        exit;
                    }
                ?>

            </div>

        </aside>
        <!-- End of Sidebar Section-->

        <!-- Main Content-->
        <main>
            <h1>Analystics</h1>
            <!--Analystics-->

            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h3>Institutions</h3>
                            <?php 
                            include('../backend-php/connect.php');
                            $sql = "SELECT COUNT(*) FROM college_users";

                            $result = $conn->query($sql);
                            if ($result === false) {
                                echo $conn->error;
                            } else {
                                $row = $result->fetch_row();
                                $count = $row[0];
                            }
                            if ($count === 0) {
                                echo '<h1> No Accounts are created';
                            } else {
                                echo "<h1 style='text: align: center;'>" . $count . "</h1>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="visits">
                    <div class="status">
                        <div class="info">
                            <h3>User Accounts</h3>
                            <?php 
                            include('../backend-php/connect.php');
                            $sql = "SELECT COUNT(*) FROM registered_users";

                            $result = $conn->query($sql);
                            if ($result === false) {
                                echo $conn->error;
                            } else {
                                $row = $result->fetch_row();
                                $count = $row[0];
                            }
                            if ($count === 0) {
                                echo '<h1> No Accounts are created';
                            } else {
                                echo "<h1 style='text: align: center;'>" . $count . "</h1>";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="searches">
                    <div class="status">
                        <div class="info">
                            <h3>Searches</h3>
                            <h1>23,452</h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>

                            <div class="percentage">
                                <p>+21%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Analists-->

            <!-- New users Section start-->
            <h1 style="margin-top: 20px;">New Users</h1>
            <?php
                include_once '../backend-php/connect.php';
                $sql = "SELECT * FROM registered_users";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo '<div class="user-card-container">';

                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="user-card">'; 
                        echo '<h2>' . $row['firstname'] . '</h2>';
                        echo '<div class="avatar-container">';
                        ?>
                        <img src="../profile/<?php echo $row['profile']; ?>" alt="">
                        <?php 
                        echo '</div>';
                        echo '</div>'; // End user card
                    }

                    echo '</div>'; // End user card container
                }
            ?>

            <!--end of New user Section-->
        </main>
        <!-- End Of the Main Section-->

        <!--RIght Section-->
        <di
        v class="right-section">

            <!--Nav section-->
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>

            </div>
            <!-- End of the nav Section-->

            <div class="user-profile">
                <div class="logo">
                    <img src="#"
                        alt="">
                    <h2>Shafiiq</h2>
                    <p>Frontend Developer</p>
                    <img src="admin-images/shafeek.jpg" alt="">
                </div>
            </div>

            <div class="user-profile">
                <div class="logo">
                    <img src="#"
                        alt="">
                    <h2>Jxy</h2>
                    <p>Backend Developer</p>
                    <img src="admin-images/jxy.jpg" alt="">
                </div>
            </div>

        </div>
        <!--End of the Nav Section-->

    </div>


    <script src="js/applies.js"></script>
    <script src="js/mainjs.js"></script>
</body>

</html>