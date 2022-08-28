<?php

@include 'config.php';
@include 'credentialFunctions.php';

$error = '';
$email = '';
$username = '';

if(isset($_POST['submit']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']); // the long mysqli text helps avoid bad input from entering the database
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm-pass']);

    if(emptyInputSignup($email, $username, $password, $confirm_pass) !== false)
    {
        $error = 'Empty input field(s)';
    }
    else
    {
        if (invalidEmail($email) !== false)
        {
            $error = 'Only Lewis email allowed';
        }
        else
        {
            if(invalidUsername($username) !== false)
            {
                $error = 'Username not valid, only letters & numbers allowed';
            }
            else
            {
                if (userExists($conn, $email, $username) !== false)
                {
                    $error = 'User already exists, try different email or username';
                }   
                else
                {
                    if (dontMatch($password, $confirm_pass) !== false)
                    {
                        $error = 'Passwords DON\'T match';
                    }
                    else
                    {
                        createUser($conn, $email, $username, $password);
                    }
                }
            }
        }
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

    <title>Sign up - My Lewis VR Lab Scheduler</title>
</head>

<!-- BODY -->
<body>
    
    <!-- HEADER -->
    <?php
        @include 'header.php';
    ?>

    <!-- SIGN UP FORM -->
    <div class="center-container">
        <form action="signup.php" method="POST" style="border: 1px">
            <div class="form-container">
                <h1>Sign Up</h1>

                <p>Create an account to reserve devices at the VR Lab</p>
                <hr>

                <div class="error-msg"> <?php echo $error; ?> </div>
                
                <div class="input-field-group">
                    <i class="fas fa-envelope"></i>
                    <input class="input-field" type="email" placeholder="Enter Lewis Email" name="email" value="<?php echo htmlspecialchars($email); ?>" autofocus required>
                </div>
    
                <div class="input-field-group">
                    <i class="fas fa-user"></i>
                    <input class="input-field" type="text" placeholder="Enter Username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>
    
                <div class="input-field-group">
                    <i class="fas fa-lock"></i>
                    <input class="input-field" type="password" placeholder="Enter Password" name="pass" required>
                </div>
    
                <div class="input-field-group">
                    <i class="fas fa-check"></i>
                    <input class="input-field" type="password" placeholder="Confirm Password" name="confirm-pass" required>
                </div>
    
                <button class="login-btn" type="submit" name="submit" value="submit">Sign Up</button>
    
                <p class="form-links">
                    <a href="login.php">Already have an account? Log in!</a>
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