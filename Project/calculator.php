<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="author" content="Nazar Zhuhan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="./img/logo_green.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/main.css">
</head>

<body>

    <?php
    // if user is logged then header_reg will be seen otherwise header_empty
    if (isset($_SESSION['userID'])) {
        require_once("./templates/header_reg.php");
    } else {
        require_once("./templates/header_empty.php");
    } ?>
    <?php
    // include logic (variables) to current page
    require_once("./logic/calculator.php"); ?>
    <main>
        <h1 hidden>Tables</h1>
        <?php
        // if user is logged then navigation between monthes is seen
        if (!isset($_SESSION['userID'])) {
        ?>
            <form action="./calculator.php" id="submit-table" class="container" method="post">
            <?php
        } else { ?>
                <ul class="nav-hist">
                    <li><a href="./calculator.php?month=1"><img src="img/left-arrow.png" alt="left-arrow" height="25"></a></li>
                    <li class="month-container">
                        <a href="./history.php">
                            <h3 class="month"><?php echo $chMonth . " (" . $chYear . ")"; ?></h3>
                        </a>
                    </li>
                    <li><a href="./calculator.php?month=2"><img src="img/right-arrow.png" alt="right-arrow" height="25"></a></li>
                </ul>
                <form action="./calculator.php" id="submit-table" method="post"> <?php } ?>
                <div class="container-table">

                    <!-- creating 3 tables -->
                    <div class="table-bg">
                        <h2>House</h2>
                        <table class="table">
                            <tr class="calc-row">
                                <td class="first-item">Electricity (kWh): </td>
                                <td class="second-item"><input type="number" value=0 name="electricity" id="electricity" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Natural gas (m<sup>3</sup>):</td>
                                <td class="second-item"><input type="number" value=0 name="gas" id="gas" step="0.1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Heating oil (liters):</td>
                                <td class="second-item"><input type="number" value=0 name="oil" id="oil" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Coal (kg):</td>
                                <td class="second-item"><input type="number" value=0 name="coal" id="coal" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Butane (liters): </td>
                                <td class="second-item"><input type="number" value=0 name="butane" id="butane" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Propane (liters):</td>
                                <td class="second-item"><input type="number" value=0 name="propane" id="propane" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Wood (kg):</td>
                                <td class="second-item"><input type="number" value=0 name="wood" id="wood" step="1" min="0"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-bg">
                        <h2>Secondary (euros)</h2>
                        <table class="table">
                            <tbody>
                                <tr class="calc-row">
                                    <td class="first-item">Food&drink (meat eater):</td>
                                    <td class="second-item"><input type="number" value=0 name="food-meat" id="food-meat" step="1" min="0"></td>
                                </tr>
                                <tr class="calc-row">
                                    <td class="first-item">Food&drink (vegetarian):</td>
                                    <td class="second-item"><input type="number" value=0 name="food-vegetarian" id="food-vegetarian" step="1" min="0"></td>
                                </tr>
                                <tr class="calc-row">
                                    <td class="first-item">Food&drink (vegan):</td>
                                    <td class="second-item"><input type="number" value=0 name="food-vegan" id="food-vegan" step="1" min="0"></td>
                                </tr>
                                <tr class="calc-row">
                                    <td class="first-item">Pharmaceuticals:</td>
                                    <td class="second-item"><input type="number" value=0 name="pharm" id="pharm" step="1" min="0"></td>
                                </tr>
                                <tr class="calc-row">
                                    <td class="first-item">Clothes, textiles and shoes:</td>
                                    <td class="second-item"><input type="number" value=0 name="clothes" id="clothes" step="1" min="0"></td>
                                </tr>
                                <tr class="calc-row">
                                    <td class="first-item">Paper based products:</td>
                                    <td class="second-item"><input type="number" value=0 name="paper" id="paper" step="1" min="0"></td>
                                </tr>
                                <tr class="calc-row">
                                    <td class="first-item">Electronics:</td>
                                    <td class="second-item"><input type="number" value=0 name="electronics" id="electronics" step="1" min="0"></td>
                                </tr>
                                <tr class="calc-row">
                                    <td class="first-item">Motor vehicles:</td>
                                    <td class="second-item"><input type="number" value=0 name="vehicle" id="vehicle" step="1" min="0"></td>
                                </tr>
                                <tr class="calc-row">
                                    <td class="first-item">Furniture& manufactured goods:</td>
                                    <td class="second-item"><input type="number" value=0 name="furniture" id="furniture" step="1" min="0"></td>
                                </tr>
                                <tr class="calc-row">
                                    <td class="first-item">Hotels, restaurants, and pubs:</td>
                                    <td class="second-item"><input type="number" value=0 name="hotel" id="hotel" step="1" min="0"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-bg">
                        <h2>Transportation (km)</h2>
                        <table class="table">
                            <tr class="calc-row">
                                <td class="first-item">Car:</td>
                                <td class="second-item"><input type="number" value=0 name="car" id="car" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Bus:</td>
                                <td class="second-item"><input type="number" value=0 name="bus" id="bus" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Coach:</td>
                                <td class="second-item"><input type="number" value=0 name="coach" id="coach" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Rail:</td>
                                <td class="second-item"><input type="number" value=0 name="rail" id="rail" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Tram:</td>
                                <td class="second-item"><input type="number" value=0 name="tram" id="tram" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Subway:</td>
                                <td class="second-item"><input type="number" value=0 name="subway" id="subway" step="1" min="0"></td>
                            </tr>
                            <tr class="calc-row">
                                <td class="first-item">Plane:</td>
                                <td class="second-item"><input type="number" value=0 name="plane" id="plane" step="1" min="0"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
                // if data is send and it is valid
                if (isset($_POST["submit"]) and $house + $secondary + $transportation > 0) {

                    if ($house + $secondary + $transportation < 2 ** 55) {
                ?>
                        <div class="value">
                            <div class="center-results">
                                <h3>Total:</h3>
                                <p><?php echo round($total / 1000, 2); ?> kg of CO2e</p>
                            </div>
                        </div>

                <?php
                    } else {
                        echo "<div class='errorDiv'><p>";
                        echo "Too big values";
                        echo "</p></div>";
                    }
                }
                ?>
                <div class="center-results buttons">
                    <input type="submit" name="submit" value="Calculate" class="button-calculator">
                    <?php
                    // if data is send and it is valid
                    if (
                        isset($_POST["submit"])
                        and ($house + $secondary + $transportation > 0)
                        and isset($_SESSION['userID'])
                        and ($house + $secondary + $transportation < 2**55)
                    ) {

                        // sending hidden form with variables
                    ?>
                        <form action="./calculator.php" method="post">
                            <input type="hidden" name="house" value='<?php echo $house ?>'>
                            <input type="hidden" name="second" value='<?php echo $secondary ?>'>
                            <input type="hidden" name="trans" value='<?php echo $transportation ?>'>
                            <input type="hidden" name="year" value='<?php echo $chYear ?>'>
                            <input type="hidden" name="month" value='<?php echo $chMonth ?>'>
                            <input type="submit" name="save" value="Save" class="button-calculator">
                        </form>
                    <?php
                    }
                    ?>
                </div>
                </form>
    </main>

    <?php
    // including footer
    require_once("./templates/footer_reg.php"); ?>
</body>

</html>