<?php

@include 'config.php';
@include 'tblInputValidation.php';

$error = '';

if(isset($_POST['save-btn']))
{
    $deviceName = mysqli_real_escape_string($conn, $_POST['deviceName']);
    $programsList = mysqli_real_escape_string($conn, $_POST['programsList']);

    if (emptyTableForm($deviceName, $programsList) !== false) // if this returns true, it means that there was an empty field
    {
        $error = 'Empty Field';
    }
    else
    {
        $error = addDevice($conn, $deviceName, $programsList);
    }
}

if(isset($_POST['saveEdit']))
{
    $programsList = mysqli_real_escape_string($conn, $_POST['programs']);
    $programID = intval(mysqli_real_escape_string($conn, $_POST['editInput']));

    $error = updateProgramsList($conn, $programID, $programsList);
}

if(isset($_POST['remove']))
{
    $deviceID = (mysqli_real_escape_string($conn, $_POST['removeInput']));

    $error = deleteDevice($conn, $deviceID);
}

?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Victor Ojeda">
    <meta name="description" content="Lewis University Lab Scheduler Webpage">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Devices & Programs - My Lewis VR Lab Scheduler</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="main.css" type="text/css">
    <script defer src="main.js" type="module"></script>
    <script defer src="tableFunctions.js" type="module"></script>
</head>

<!-- BODY -->
<body>
    
    <!-- HEADER -->
    <?php
        @include 'header.php';
    ?>

        <!-- Devices and Programs Table -->
    <div class="center-container">
        <div class="tableContainer">

            <div class="error-msg"> <?php echo $error; ?> </div>

            <div class="tableBtns">
                <button class="cancel">Cancel</button>
                <button class="saveEdit" type="submit" name="saveEdit" form="tableForm">Save</button>
                <button class="add">Add</button>
                <button class="edit">Edit</button>
            </div>

            <div class="removeForm">
                <form action="deviceInformation.php" method="POST">
                    Enter the ID of the Device you want to remove : <input id="removeInput" type="text" name="removeInput" onkeydown="return event.key != 'Enter';">
                    <button type="submit" name="remove">Remove</button>
                </form>
            </div>
            
            <form id="tableForm" action="deviceInformation.php" method="POST">
                <span id="editMsg">
                        Enter the ID of the device you want to EDIT then click on its programs cell : <input id="editInput" type="text" name="editInput">
                </span>
                <table class="deviceTbl">

                    <thead>
                        <tr>
                            <th>Device ID</th>
                            <th>Device Name</th>
                            <th>Installed Programs</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>

                    <tbody id="tableDevice">
                        <?php loadDeviceTbl($conn); ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td></td><td></td><td></td><td></td>
                        </tr>
                    </tfoot>
                </table>

            
                <div class="tableInputs">
                    <input type="text" id="deviceName"  name="deviceName">
                    <textarea id='programsList' name="programsList"></textarea>
                    <button id="save-btn" type="submit" name="save-btn" value="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>