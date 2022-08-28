<?php

@include 'config.php';
@include 'credentialFunctions.php';

$error = '';
$username = '';

if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    if (emptyInputLogin($username, $password) !== false)
    {
        $error = 'Empty input field(s)';
    }
    else
    {
        $error = loginUser($conn, $username, $password);
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="main.css" type="text/css">
    <script defer src="main.js"></script>

    <title>Log in - My Lewis VR Lab Scheduler</title>
</head>

<!-- BODY -->
<body>
    
    <!-- HEADER -->
    <?php
        @include 'header.php';
    ?>

    <!-- LOGIN FORM -->

    <div class="center-container">
        <form action="login.php" method="POST" style="border: 1px">
            <div class="form-container">
                <h1>Log In</h1>

                <div class="error-msg"> <?php echo $error; ?> </div>
    
                <div class="input-field-group">
                    <i class="fas fa-user"></i>
                    <input class="input-field" type="text" placeholder="Enter your Username/Lewis Email" name="username" value="<?php echo htmlspecialchars($username); ?>" autofocus required>
                </div>
    
                <div class="input-field-group">
                    <i class="fas fa-lock"></i>
                    <input class="input-field" type="password" placeholder="Enter Password" name="pass" required>
                </div>
    
                <button class="login-btn" type="submit" name="submit" value="submit">Log In</button>
    
                <p class="form-links">
                    <a href="#">Forgot your password?</a>
                </p>
    
                <p class="form-links">
                    <a href="signup.php">Don't have an account? Sign up!</a>
                </p>
            </div>
        </form>
    </div>


    <!-- FOOTER -->
    <footer>
        <span class="copyright">Copyright © 2022 My Lewis VR Lab Scheduler</span>
    </footer>

</body>

</html>