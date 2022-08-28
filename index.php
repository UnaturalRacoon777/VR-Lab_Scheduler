<?php
    session_start();
    @include 'config.php';
    @include 'reserveValidation.php';
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Victor Ojeda">
    <meta name="description" content="Lewis University Lab Scheduler Webpage">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Home - My Lewis VR Lab Scheduler</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="main.css" type="text/css">
    <script defer src="main.js" type="module"></script>
    <script defer src="dateTimeSelectors.js" type="module"></script>
</head>

<!-- BODY -->
<body>
    
    <!-- HEADER -->
    <?php
        @include 'header.php';
    ?>

    <!-- BUTTONS -->

    <?php
        if (isset($_SESSION['userID']))
        {
        }
        else
        {
            echo  '<div class="buttons-container">
                        <a href="login.php">
                            <button href="login.php" class="login-button">Log in</button>
                        </a>
                
                        <a href="signup.php">
                            <button class="signup-button">Sign up</button>
                        </a>
                    </div>';
        }
    ?>

    <!-- Calendar -->
    <div class="dateTime-container">
        <div class="calendar">

            <div class="month">
                <i class="fas fa-angle-left prev"></i>
                <div class="date">
                    <h1></h1>
                    <p></p>
                </div>
                <i class="fas fa-angle-right next"></i>
            </div>

            <div class="weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
            </div>

            <div class="days"></div>
        </div>

        <table class="deviceTbl">

            <thead>
                <tr>
                    <th>User</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>

            <tbody id="tableDevice">
                <?php loadScheduleTable($conn); ?>
            </tbody>

            <tfoot>
                <tr>
                    <td></td><td></td><td></td><td></td>
                </tr>
            </tfoot>
        </table>


    </div>

    <!-- FOOTER -->
    <footer>
        <span class="copyright">Copyright © 2022 My Lewis VR Lab Scheduler</span>
    </footer>

</body>

</html>