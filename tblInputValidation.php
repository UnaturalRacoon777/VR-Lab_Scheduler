<?php

function emptyTableForm($deviceName, $programsList)
{
    $result;

    if (empty($deviceName) || empty($programsList))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

    return $result;
}

function deviceExists($conn, $deviceName)
{
    $sql = " SELECT * FROM Devices WHERE device = ?;";

    $stamt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stamt, $sql))
    {
        header("location: deviceInformation.php?error=Invalid-inputs-detected");
        exit();
    }

    mysqli_stmt_bind_param($stamt, "s", $deviceName);
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

function addDevice($conn, $deviceName, $programsList)
{
    $deviceExists = deviceExists($conn, $deviceName);

    if ($deviceExists !== false)
    {
        return 'device already exist';
    }

    $sql = " INSERT INTO Devices(device, programs) VALUES(?, ?)";

    $stamt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stamt, $sql))
    {
        header("location: signup.php?error=Invalid_inputs");
        exit();
    }

    mysqli_stmt_bind_param($stamt, "ss", $deviceName, $programsList);
    mysqli_stmt_execute($stamt);

    header("location: deviceInformation.php?Device_Added_SUCCESFULY");
    exit();
}

function loadDeviceTbl($conn)
{
    $sql = " SELECT id, device, programs, dateCreated FROM Devices";

    $result = $conn -> query($sql);

    if ($result->num_rows > 0)
    {
        while ($row = $result -> fetch_assoc())
        {
            echo "<tr> <td>" . $row["id"] . "</td> <td class='device'>" . $row["device"] . "</td> <td class='programs'>" . $row["programs"] . "</td> <td>" . $row["dateCreated"] . "</td> </tr>";
        }
    }
    else
    {
        echo 'No data';
    }
    $conn -> close();
}

function deviceIDExists($conn, $deviceID)
{
    $sql = " SELECT * FROM Devices WHERE id = ?;";

    $stamt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stamt, $sql))
    {
        header("location: deviceInformation.php?error=Invalid-inputs-detected");
        exit();
    }

    mysqli_stmt_bind_param($stamt, "i", $deviceID);
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

function updateProgramsList($conn, $deviceID, $programsList)
{
    if (!preg_match("/^[0-9]*$/", $deviceID))
    {
        return "Input was not a number";
    }

    $deviceIDExists = deviceIDExists($conn, $deviceID);

    if ($deviceIDExists === false)
    {
        return 'Device ID of programs not found';
    }


    $sql = " UPDATE Devices SET programs = ? WHERE id = ?";

    $stamt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stamt, $sql))
    {
        header("location: deviceInformation.php?error=Invalid_inputs");
        exit();
    }

    mysqli_stmt_bind_param($stamt, "si", $programsList, $deviceID);
    mysqli_stmt_execute($stamt);

    header("location: deviceInformation.php?PROGRAMS_LIST_UPDATED_SUCCESFULY");
    exit();
}

function deleteDevice($conn, $deviceID)
{
    if (!preg_match("/^[0-9]*$/", $deviceID))
    {
        return "Input was not a number";
    }

    $deviceIDExists = deviceIDExists($conn, $deviceID);

    if ($deviceIDExists === false)
    {
        return 'Device ID not found';
    }

    $sql = " DELETE FROM Devices WHERE id = ? ";

    $stamt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stamt, $sql))
    {
        header("location: deviceInformation.php?error=Invalid_inputs");
        exit();
    }

    mysqli_stmt_bind_param($stamt, "i", $deviceID);
    mysqli_stmt_execute($stamt);

    header("location: deviceInformation.php?Device_DELETED_SUCCESFULY");
    exit();
}
?>