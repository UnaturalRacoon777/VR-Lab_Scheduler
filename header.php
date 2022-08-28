<?php
    session_start();
?>
<header>
    <div class="header-container">
        <?php
            if (isset($_SESSION['userID']))
            {
                echo '<a href="reserve.php"> <img src="images/Logo.png" alt="Web page Logo" style="width:220px;height:90px;"> </a>';
            }
            else
            {
                echo '<a href="index.php"> <img src="images/Logo.png" alt="Web page Logo" style="width:220px;height:90px;"> </a>';
            }
        ?>

        <a href="#" class="user-icon">
            <img src="images/UserIcon.png" alt="User UserIcon" style="width:45px;height:45px;">
            <div class="username">
            <?php
                    if (isset($_SESSION['userID']))
                    {
                        echo '<p>' . $_SESSION['username'] . '</p>';
                    }
            ?>
            </div>
            <ul class="dropdown">
                <?php
                    if (isset($_SESSION['userID']))
                    {
                        echo '<li><a href="index.php">Reservations</a></li>';
                        echo '<hr />';
                        echo '<li><a href="deviceInformation.php">Edit Devices</a></li>';
                        echo '<hr />';
                        echo '<li><a href="logout.php">Log out</a></li>';
                        echo '<hr />';
                        echo '<li><a href="reserve.php">Schedule Reservation</a></li>';
                    }
                    else
                    {
                        echo '<li><a href="login.php">Log in</a></li>';
                        echo '<hr />';
                        echo '<li><a href="signup.php">Sign up</a></li>';
                    }
                ?>
            </ul>
        </a>
    </div>
</header>