<?php session_start();
// variable for navigation between monthes on history and calcul page
$_SESSION["page"] = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Naza Zhuhan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="./img/logo_green.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Main</title>
</head>

<body>

    <?php
    // check if user is loged and render appropriate header 
    if (isset($_SESSION['userID'])) {
        require_once("./templates/header_reg.php");
    } else {
        require_once("./templates/header_empty.php");
    }
    ?>

    <main>
        <section class="hero">
            <h1>HOW MUCH ARE YOU GREEN?</h1>
            <a href="./calculator.php" class="button">Calculate</a>
        </section>
        <section class="pluses container">
            <h2>Why it is important</h2>
            <ul class="pluses-list">
                <li class="pluses-item climate">
                    <h3>Mitigates the Effects of Global Climate Change</h3>
                    <p>Reducing carbon emissions slows the rate of temperature rise, sea-level rise, ice melting, and ocean acidification.</p>
                </li>
                <li class="pluses-item health">
                    <h3>Improves Public Health</h3>
                    <p>Reducing carbon emissions lessens the likelihood and severity of extreme weather events, improves air and water quality, maintains biodiversity, and supports a healthy food supply.</p>
                </li>
                <li class="pluses-item economy">
                    <h3>Boosts the Global Economy</h3>
                    <p>Reducing carbon emissions boosts the economy, especially when it becomes economically rewarding to innovate solutions that help protect our planet, fight climate change, and are based on clean energy.</p>
                </li>
                <li class="pluses-item animal">
                    <h3>Maintains Plant and Animal Diversity</h3>
                    <p>Reducing carbon emissions slows the effects of climate change, thereby reducing the adaptation pressure placed on plants and animals.</p>
                </li>
            </ul>
        </section>
    </main>
    <?php require_once("./templates/footer_reg.php"); ?>
</body>

</html>