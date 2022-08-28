<?php

    function emptyInputSignup($email, $username, $password, $confirm_pass)
    {
        $result;

        if (empty($email) || empty($username) || empty($password) || empty($confirm_pass))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }

        return $result;
    }

    function invalidEmail($email)
    {
        $result;

        if (!preg_match("/@lewisu\.edu$/", $email) && !preg_match("/@lewis\.edu$/", $email))
        {
            $result = true;
        }

        else
        {
            $result = false;
        }

        return $result;
    }

    function invalidUsername($username)
    {
        $result;
        
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }

        return $result;
    }

    function dontMatch($password, $confirm_pass)
    {
        $result;

        if ($password !== $confirm_pass)
        {
            $result = true;
        }
        else
        {
            $result = false;
        }

        return $result;
    }

    function userExists($conn, $email, $username)
    {
        $sql = " SELECT * FROM USERS WHERE Email = ? OR Username = ?;";

        $stamt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stamt, $sql))
        {
            header("location: signup.php?error=Invalid_Username_Email-inputs");
            exit();
        }

        mysqli_stmt_bind_param($stamt, "ss", $email, $username);
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

    function createUser($conn, $email, $username, $password)
    {
        $sql = " INSERT INTO USERS(Email, Username, Password) VALUES(?, ?, ?)";

        $stamt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stamt, $sql))
        {
            header("location: signup.php?error=Invalid_Username_Email_Password_inputs");
            exit();
        }

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stamt, "sss", $email, $username, $hashedPass);
        mysqli_stmt_execute($stamt);

        header("location: index.php?SignUp_Successful");
        exit();
    }

    function emptyInputLogin($username, $password)
    {
        $result;

        if (empty($username) || empty($password))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }

        return $result;
    }

    function loginUser($conn, $username, $password)
    {
        $userExists = userExists($conn, $username, $username);

        if ($userExists === false)
        {
            return 'Username/Email DOESN\'T exist';
        }

        $hashedPass = $userExists["Password"];

        $verifyPass = password_verify($password, $hashedPass);

        if ($verifyPass === false)
        {
            return 'Incorrect Password';
        }
        elseif ($verifyPass === true)
        {
            session_start();
            $_SESSION["userID"] = $userExists["UserID"];
            $_SESSION["username"] = $userExists["Username"];
            header("location: index.php?_Login_Succesfull");
            exit();
        }
    }
?>