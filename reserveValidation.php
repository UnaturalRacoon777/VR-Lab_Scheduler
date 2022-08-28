<?php

    function emptyReservation($date, $startTime, $endTime)
    {
        $result;

        if (empty($date) || empty($startTime) || empty($endTime))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }

        return $result;
    }

    function scheduleExists($conn, $userID, $date, $startTime, $endTime)
    {
        $sql = " SELECT * FROM Schedule WHERE user = ? AND date = ? AND startTime = ? AND endTime = ?;";

        $stamt = mysqli_stmt_init($conn); 

        if (!mysqli_stmt_prepare($stamt, $sql))
        {
            header("location: reserve.php?error=Invalid_INPUTS");
            exit();
        }

        mysqli_stmt_bind_param($stamt, "isss", $userID, $date, $startTime, $endTime);
        mysqli_stmt_execute($stamt);

        $result = mysqli_stmt_get_result($stamt);

        if ($row = mysqli_fetch_assoc($result))
        {
            return $row;
        }
        else
        {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stamt);
    }

    function addSchedule($conn, $userID, $date, $startTime, $endTime)
    {
        $scheduleExists = scheduleExists($conn, $userID, $date, $startTime, $endTime);

        if ($scheduleExists !== false)
        {
            return "scheduled time already exists";
        }

        $sql = " INSERT INTO Schedule(user, date, startTime, endTime) VALUES(?, ?, ?, ?)";

        $stamt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stamt, $sql))
        {
            header("location: reservation.php?error=BadInputs");
            exit();
        }

        mysqli_stmt_bind_param($stamt, "ssss", $userID, $date, $startTime, $endTime);
        mysqli_stmt_execute($stamt);

        header("location: reserve.php?=SUCCESS_SUCCESS_SUCCESS_SUCCESS");
        exit();
    }

    function loadScheduleTable($conn)
    {
        $sql = " SELECT Username, date, startTime, endTime FROM Schedule NATURAL JOIN USERS WHERE UserID = user;";

        $result = $conn -> query($sql);

        if ($result->num_rows > 0)
        {
            while ($row = $result -> fetch_assoc())
            {
                echo "<tr><td>" . $row["Username"] . "</td> <td>" . $row["date"] . "</td> <td>" . $row["startTime"] . "</td> <td>" . $row["endTime"] . "</td> </tr>";
            }
        }
        else
        {
            echo 'No data';
        }
        $conn -> close();
    }
?>