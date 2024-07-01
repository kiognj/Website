<?php

# start the session
session_start();
# if logged, redirect to index.php
if (isset($_SESSION['userID'])) {
    header("Window-target: _parent");
    header("Location: index.php");
}

include_once("./logic/connect.db.php");
$link = mysqli_connect($server, $user, $password, $database);
if (!$link)
    die("Connection to DB failed: " . mysqli_connect_error());

# validation on server side
$validation = 0;
if ($_POST && isset($_POST['submitRegestration'])) {
    if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['repassword'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $userdata = [];
        $validation = 1;

        # username validation
        if (preg_match("/^[A-Za-z][A-Za-z0-9_]{6,15}$/", $username) == 1) {
            $userdata[0] = $username;
        } else {
            $validation = 2;
            $error_message = "Some issues with username!";
        }
        # email validation
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $userdata[1] = $email;
        } else {
            $validation = 2;
            $error_message = "Some issues with email!";
        }
        # password validation and checking on identical in both fields
        if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~`!@#$%^&*()_\-+={[}\]|:;'<,>.?\/]).{8,16}$/", $password) == 1) {
            if ($password == $repassword) {
                $userdata[2] = $password;
            } else {
                $validation = 2;
                $error_message = "Please type same password in both fields!";
            }
        } else {
            $validation = 2;
            $error_message = "Some issues with password!";
        }

        # SQL queries to retrieve username and email to check if credentials are in DB
        $askForUsername = "SELECT * FROM users WHERE username=?";
        $queryUsername = mysqli_prepare($link, $askForUsername);
        mysqli_stmt_bind_param($queryUsername, "s", $username);
        mysqli_stmt_execute($queryUsername);
        mysqli_stmt_store_result($queryUsername);
        # check of presented username
        if (mysqli_stmt_num_rows($queryUsername) > 0) {
            $validation = 2;
            $error_message = "Username is already in use!";
        }

        $askForEmail = "SELECT * FROM users WHERE email=?";
        $queryEmail = mysqli_prepare($link, $askForEmail);
        mysqli_stmt_bind_param($queryEmail, "s", $email);
        mysqli_stmt_execute($queryEmail);
        mysqli_stmt_store_result($queryEmail);
        # check if e-mail is in use
        if (mysqli_stmt_num_rows($queryEmail) > 0) {
            $validation = 2;
            $error_message = "E-mail is already in use!";
        }


        # data writing process 
        # SQL implementation
        if ($validation == 1) {
            $file = fopen('./data/regdata.csv', 'a');
            fputcsv($file, $userdata, ";");
            $addUserQuery = "INSERT INTO users (`username`, `email`, `password`) VALUES (?,?,?)";
            $queryUser = mysqli_prepare($link, $addUserQuery);
            mysqli_stmt_bind_param($queryUser, "sss", $username, $email, $password);
            mysqli_stmt_execute($queryUser);
            mysqli_stmt_store_result($queryUser);
        }
    }
} else if ($_POST) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $userdata = [];
    $validation = 1;

    # username validation
    if (preg_match("/^[A-Za-z][A-Za-z0-9_]{6,15}$/", $username) == 1) {
        $userdata[0] = $username;
    } else {
        $validation = 2;
        $error_message = "Some issues with username!";
    }
    # email validation
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $userdata[1] = $email;
    } else {
        $validation = 2;
        $error_message = "Some issues with email!";
    }
    # password validation and checking on identical in both fields
    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~`!@#$%^&*()_\-+={[}\]|:;'<,>.?\/]).{8,16}$/", $password) == 1) {
        if ($password == $repassword) {
            $userdata[2] = $password;
        } else {
            $validation = 2;
            $error_message = "Please type same password in both fields!";
        }
    } else {
        $validation = 2;
        $error_message = "Some issues with password!";
    }

    if ($validation == 1) {
        $validation = 2;
        $error_message = "You forgot about submitRegister!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kirill Ognjov">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="./img/logo_green.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/reglog.css">
    <script>
        // function to reveal password with a closing and opening eye for both fields
        var Revealed = false;
        var ReRevealed = false;

        function ShowPassword() {
            if (Revealed == false) {
                document.getElementById("password").type = 'text';
                Revealed = true;
                document.getElementById("reveal1").setAttribute("src", "img/opened_eye.svg");
            } else {
                document.getElementById("password").type = 'password';
                Revealed = false;
                document.getElementById("reveal1").setAttribute("src", "img/closed_eye.svg");
            }
        }

        function ShowRePassword() {
            if (ReRevealed == false) {
                document.getElementById("repassword").type = 'text';
                ReRevealed = true;
                document.getElementById("reveal2").setAttribute("src", "img/opened_eye.svg");
            } else {
                document.getElementById("repassword").type = 'password';
                ReRevealed = false;
                document.getElementById("reveal2").setAttribute("src", "img/closed_eye.svg");
            }
        }
    </script>
    <title>Register</title>
</head>

<body>
    <nav class="menu">
    </nav>
    <div class="form_wrapper">
        <div class="logo">
            <a href="./index.php">
                <img src="img/logo_yellow.png" alt="logo" title="logo" width="70">
            </a>
        </div>
        <div class="title_container">
            <a href="./index.php">
                <h1>CO<sub>2</sub></h1>
            </a>
            <h3>Register to track your carbon foorprint!</h3>
        </div>
        <div class="form">

            <form method="POST" action="register.php" id="formReg">
                <div class="step">
                    <label for="clear1" class="form_text"><b>Username</b></label>
                    <br>
                    <input class="input_field" type="text" name="username" id="clear1" title="Use letters AND digits! First symbol must be letter!" placeholder="7-15 symbols" required minlength="7" maxlength="15" pattern="[A-Za-z][A-Za-z0-9_']{6,15}">
                    <br>
                </div>
                <div class="step">
                    <label for="email" class="form_text"><b>E-mail</b></label><br>
                    <input class="input_field" type="email" name="email" id="email" placeholder="..." required pattern="[A-Za-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                </div>
                <div class="step">
                    <label for="password" class="form_text"><b>Password</b></label>
                    <br>
                    <input class="input_field" id="password" type="password" name="password" id="clear2" title="Must be used letters (upper and lower case), at least one number and one special character" placeholder="8-16 symbols" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~`!@#$%^&*()_\-+={[}\]|:;'<,>.?\/]).{8,16}$">
                    <img id="reveal1" width="20" src="img/closed_eye.svg" alt="eye" onclick="ShowPassword()">
                    <br>
                </div>
                <div class="step">
                    <label for="repassword" class="form_text"><b>Re-enter Password</b></label>
                    <input class="input_field" id="repassword" type="password" name="repassword" placeholder="..." required>
                    <img id="reveal2" width="20" src="img/closed_eye.svg" alt="eye" onclick="ShowRePassword()">
                </div>
                <div class="button_div">
                    <input class="button" name="submitRegestration" type="submit" value="Register">
                </div>
            </form>
        </div>
        <?php
        # message about registration completion or error
        if ($validation == 2) {
            echo "<div class='errorDiv'><p>";
            echo $error_message;
            echo "</p></div>";
        } elseif ($validation == 1) {
            echo "<div class='successDiv'><p>";
            echo "Registration completed!";
            echo "</p></div>";
        }
        ?>
        <div class="referto">
            <p>Already have an account?<a class="login_link" href="login.php" target="_self">Log&nbsp;in</a></p>
        </div>
    </div>
    <footer>
    </footer>
</body>

</html>