<?php

session_start();

@include 'config.php';
@include 'reserveValidation.php';

$userID = $_SESSION['userID'];

$error = '';

if(isset($_POST['submit']))
{
    $date = mysqli_real_escape_string($conn, $_POST['selectedDate']);
    $startTime = mysqli_real_escape_string($conn, $_POST['fromTime']);
    $endTime = mysqli_real_escape_string($conn, $_POST['toTime']);

    if (emptyReservation($userID, $date, $startTime, $endTime) !== false) // if this returns true, it means that there was an empty field
    {
        $error = 'Empty Field';
    }
    else
    {
        $error = addSchedule($conn, $userID, $date, $startTime, $endTime);
    }
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Victor Ojeda">
    <meta name="description" content="Lewis University Lab Scheduler Webpage">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Schedule Reservation - My Lewis VR Lab Scheduler</title>

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
    <!-- Calendar -->
    <div class="dateTime-container">
        
        <div class="calendar">

        <form action="reserve.php" method="POST">
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

                <div class="blockElements">
                    <div class="error-msg"> <?php echo $error; ?> </div>
                    <div></div>
                    <div style="display:flex" class="selectedDate">
                        <p >Selected Date : <span style="display: none" id=slDate></span> </p>
                        <input style="width: 70px" id="dateInput" style="display:inline" type="text" name="selectedDate" readonly>
                    </div>

                    <!-- Time Selector -->
                    <div class="timeSelector">
                        <select id="fromSelector" class="fromSelector" name="fromTime"></select>
                        <select id="toSelector" class="toSelector" name="toTime"></select>
                    </div>

                    <button id="submitBtn" type="submit" name="submit">Submit</button>
                </div>
        </form>
    </div>

    <!-- FOOTER -->
    <footer>
        <span class="copyright">Copyright © 2022 My Lewis VR Lab Scheduler</span>
    </footer>

</body>

</html>