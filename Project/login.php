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

$validation = 0;
$permission = 0;
# After form submission
if ($_POST && isset($_POST['submitLogin'])) {
    if (isset($_POST['userid'], $_POST['password'])) {
        $username = $_POST['userid'];
        $password = $_POST['password'];
        $validation = 1;

        # SQL query to check the user
        $checkUserQuery = "SELECT `ID` FROM users WHERE (`username`=? AND `password`=?)
                            OR (`email`=? AND `password`=?)";
        $queryUser = mysqli_prepare($link, $checkUserQuery);
        mysqli_stmt_bind_param($queryUser, "ssss", $username, $password, $username, $password);
        mysqli_stmt_execute($queryUser);
        mysqli_stmt_bind_result($queryUser, $userID);
        mysqli_stmt_store_result($queryUser);
        # checks if user is presented in database
        if (mysqli_stmt_num_rows($queryUser) == 1) {
            if (mysqli_stmt_fetch($queryUser)) {
                $permission = 1;
                $validation = 0;
                header("Window-target: _parent");
                header("Location: calculator.php");
                $_SESSION["userID"] = $userID;
                $_SESSION["page"] = 0;
            } else $error_message = "Wrong credentials!";
        } else $error_message = "Wrong credentials!";
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
        // function to reveal password with a closing and opening eye
        var Revealed = false;

        function ShowPassword() {
            if (Revealed == false) {
                document.getElementById("password").type = 'text';
                Revealed = true;
                document.getElementById("reveal").setAttribute("src", "img/opened_eye.svg");
            } else {
                document.getElementById("password").type = 'password';
                Revealed = false;
                document.getElementById("reveal").setAttribute("src", "img/closed_eye.svg");
            }
        }
    </script>
    <title>Log in</title>
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
        </div>
        <div class="form">
            <form method="POST" action="login.php" id="formLog">
                <div class="step">
                    <label for="userid" class="form_text"><b>E-mail or username</b></label>
                    <input class="input_field" type="text" id="userid" name="userid" placeholder="..." required>
                </div>
                <div class="step">
                    <label for="password" class="form_text"><b>Password</b></label>
                    <input class="input_field" id="password" type="password" name="password" placeholder="..." required>
                    <img id="reveal" width="20" src="img/closed_eye.svg" alt="eye" onclick="ShowPassword()">
                </div>
                <div class="button_div">
                    <input class="button" name="submitLogin" type="submit" value="Log in">
                </div>
            </form>
        </div>
        <?php
        # if error occured message displays
        if ($validation == 1) {
            echo "<div class='errorDiv'><p>";
            echo $error_message;
            echo "</p></div>";
        }
        ?>
        <div class="referto">
            <p>Don't have an account? <a class="login_link" href="register.php" target="_self">Register</a></p>
        </div>
    </div>
    <footer>
    </footer>
</body>

</html>