<?php session_start();

// if the user is logged in than he/she has an access to this page
if (isset($_SESSION['userID'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="author" content="Dmytro Dundakov">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your history</title>

        <!-- custom fonts are included -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

        <link rel="icon" type="image/x-icon" href="./img/logo_green.png">

        <!-- css is linked to this page -->
        <link rel="stylesheet" href="styles/main.css">

        <!-- JS library for charts is included -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    </head>

    <!-- header is inserted using template file -->
    <?php
    echo "<body>";

    include_once("./logic/connect.db.php");
    require_once("./logic/calculator.php");
    require_once("./logic/history.php");
    require_once("./templates/header_reg.php");
    ?>


    <!-- navigation between months is written in this <ul> block -->
    <ul class="nav-hist">
        <!-- when the image is clicked the month will be changed to the previous one -->
        <li><a href="./history.php?month=1"><img src="img/left-arrow.png" alt="left-arrow" height="25"></a></li>

        <!-- when the name of the month is clicked the user will be navigated to the calculator.php (an alternative version) -->
        <li class="month-container">
            <a href="./calculator.php">
                <h3 class="month"><?php echo $chMonth . " (" . $chYear . ") "; ?></h3>
            </a>
        </li>

        <!-- when the image is clicked the month will be changed to the next one -->
        <li><a href="./history.php?month=2"><img src="img/right-arrow.png" alt="right-arrow" height="25"></a></li>
    </ul>

    <!-- using the <table> tag the rest of the page is splitted into 2 fields, one is for chart and second is for table with data -->
    <table class="split-page">

        <!-- cell for the chart -->
        <td class="for-graphs">
            <div>

                <!-- here the chart is inserted -->
                <canvas id="myChart"></canvas>

                <!-- in the <script> tag happens the customization and setting of the chart -->
                <script>
                    // values which will be the names of the bars in the chart
                    var xValuesCol = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                        "October", "November", "December"
                    ];

                    // values for the bar chart
                    var yValuesCol = [
                        <?php echo getMonthValue("January", $chYear, 1) + getMonthValue("January", $chYear, 2) + getMonthValue("January", $chYear, 3); ?>,
                        <?php echo getMonthValue("February", $chYear, 1) + getMonthValue("February", $chYear, 2) + getMonthValue("February", $chYear, 3); ?>,
                        <?php echo getMonthValue("March", $chYear, 1) + getMonthValue("March", $chYear, 2) + getMonthValue("March", $chYear, 3); ?>,
                        <?php echo getMonthValue("April", $chYear, 1) + getMonthValue("April", $chYear, 2) + getMonthValue("April", $chYear, 3); ?>,
                        <?php echo getMonthValue("May", $chYear, 1) + getMonthValue("May", $chYear, 2) + getMonthValue("May", $chYear, 3); ?>,
                        <?php echo getMonthValue("June", $chYear, 1) + getMonthValue("June", $chYear, 2) + getMonthValue("June", $chYear, 3); ?>,
                        <?php echo getMonthValue("July", $chYear, 1) + getMonthValue("July", $chYear, 2) + getMonthValue("July", $chYear, 3); ?>,
                        <?php echo getMonthValue("August", $chYear, 1) + getMonthValue("August", $chYear, 2) + getMonthValue("August", $chYear, 3); ?>,
                        <?php echo getMonthValue("September", $chYear, 1) + getMonthValue("September", $chYear, 2) + getMonthValue("September", $chYear, 3); ?>,
                        <?php echo getMonthValue("October", $chYear, 1) + getMonthValue("October", $chYear, 2) + getMonthValue("October", $chYear, 3); ?>,
                        <?php echo getMonthValue("November", $chYear, 1) + getMonthValue("November", $chYear, 2) + getMonthValue("November", $chYear, 3); ?>,
                        <?php echo getMonthValue("December", $chYear, 1) + getMonthValue("December", $chYear, 2) + getMonthValue("December", $chYear, 3); ?>
                    ];

                    // arrays for value of line charts are created
                    var yValuesLine1 = [];
                    var yValuesLine2 = []

                    // values for line charts are written into arrays
                    for (let i = 0; i < 12; i++) {
                        yValuesLine1.push(<?php echo round(getTotal() / getNumberOfRows(), 2); ?>);
                        yValuesLine2.push(<?php echo round(getTotal($chYear) / getNumberOfRows($chYear), 2); ?>);
                    }

                    // variable which has all the data for charts in it
                    var data = {
                        labels: xValuesCol,
                        datasets: [{
                            label: "CO2e",
                            data: yValuesCol,
                            backgroundColor: ["#3b5441", "#3b5441", "#3b5441", "#3b5441", "#3b5441", "#3b5441",
                                "#3b5441", "#3b5441", "#3b5441", "#3b5441", "#3b5441", "#3b5441"
                            ],
                            labels: {
                                font: {
                                    weight: monthIndex !== 'normal'
                                }
                            }
                        }, {
                            type: 'line',
                            label: 'All time average',
                            fill: false,
                            borderColor: 'black',
                            borderWidth: 2,
                            pointRadius: 0,
                            data: yValuesLine1
                        }, {
                            type: 'line',
                            label: 'Year <?php echo $chYear; ?> average',
                            fill: false,
                            borderColor: 'red',
                            borderWidth: 2,
                            pointRadius: 0,
                            data: yValuesLine2
                        }]
                    };

                    // the month which is currently viewed by the user will be highlighted with an alternative color
                    var monthIndex = data.labels.indexOf('<?php echo $chMonth; ?>');
                    if (monthIndex !== -1) {
                        data.datasets[0].backgroundColor[monthIndex] = "#f8c304";
                    }

                    // creation of the charts
                    new Chart(myChart, {
                        type: "bar",
                        data: data,

                        // options which affect the appearance of the charts
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            legend: {
                                display: true
                            },
                            title: {
                                display: true,
                                text: "Your CO2 footprint"
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        var label = ' ';
                                        label += tooltipItem.yLabel + " kg";
                                        return label;
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        </td>

        <!-- cell for the table with data -->
        <td class="for-info">
            <div class="for-padding">
                <div class="hist-info">

                    <!-- table in which common data is written (total and average) -->
                    <table class="in-hist">
                        <tr>
                            <td>All time total:</td>
                            <td>
                                <!-- php function returns total footprint for the whole time -->
                                <?php
                                if (getTotal()) {
                                    if (getTotal() >= 10000) {
                                        echo round(getTotal() / 1000, 2);
                                        echo " t";
                                    } else {
                                        echo getTotal();
                                        echo " kg";
                                    }
                                } else {
                                    echo "0";
                                    echo " kg";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <!-- php function returns all time average footprint -->
                            <td>All time average:</td>
                            <td>
                                <?php
                                if (getTotal()) {
                                    echo round(getTotal() / getNumberOfRows(), 2);
                                } else {
                                    echo "0";
                                }
                                echo " kg"; ?>
                            </td>
                        </tr>
                        <tr>
                            <!-- php function returns total footprint for the current year -->
                            <td>Year <?php echo $chYear; ?> total:</td>
                            <td>
                                <?php
                                if (getTotal($chYear)) {
                                    echo getTotal($chYear);
                                } else {
                                    echo "0";
                                }
                                echo " kg"; ?>
                            </td>
                        </tr>
                        <tr>
                            <!-- php function returns the current year average footprint -->
                            <td>Year <?php echo $chYear; ?> average:</td>
                            <td>
                                <?php
                                if (getNumberOfRows($chYear)) {
                                    echo round(getTotal($chYear) / getNumberOfRows($chYear), 2);
                                } else {
                                    echo "0";
                                }
                                echo " kg"; ?>
                            </td>
                        </tr>
                    </table>

                    <!-- table in which data about the specific month is displayed -->
                    <table class="hist">
                        <tr>
                            <td>House</td>
                            <td>
                                <!-- php function returns the current month CO2 footprint made while living in the house -->
                                <?php
                                if (getMonthValue($chMonth, $chYear, 1)) {
                                    echo getMonthValue($chMonth, $chYear, 1);
                                } else {
                                    echo "0";
                                }
                                echo " kg"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Secondary</td>
                            <td>
                                <!-- php function returns the current month CO2 footprint made while spending money on some secondary things -->
                                <?php
                                if (getMonthValue($chMonth, $chYear, 2)) {
                                    echo getMonthValue($chMonth, $chYear, 2);
                                } else {
                                    echo "0";
                                }
                                echo " kg"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Transport</td>
                            <td>
                                <!-- php function returns the current month CO2 footprint made while travelling via different vehicles -->
                                <?php
                                if (getMonthValue($chMonth, $chYear, 3)) {
                                    echo getMonthValue($chMonth, $chYear, 3);
                                } else {
                                    echo "0";
                                }
                                echo " kg"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Month total</b></td>
                            <td>
                                <b>
                                    <!-- php function returns the current month total CO2 footprint -->
                                    <?php echo round(getMonthValue($chMonth, $chYear, 1) + getMonthValue($chMonth, $chYear, 2) + getMonthValue($chMonth, $chYear, 3), 2) . " kg"; ?>
                                </b>
                            </td>
                        </tr>
                    </table>

                    <!-- form for export button which gives the user an opportunity to download all his data in .csv format (logic is written in download.php)-->
                    <form method="post" action="./logic/download.php" class="button-form">
                        <input type="submit" name="export" value="Export" class="button-export">
                    </form>

                    <!-- form for delete button which deletes current month data -->
                    <button name="delete" class="button-export" onclick="remove()">Delete</button>
                </div>
            </div>
        </td>
    </table>

    <!-- footer is inserted using template file -->
    <?php require_once("./templates/footer_reg.php"); ?>
    </body>

    </html>

<?php

    // if the user isn't logged in and somehow reached the history page he/she will be redirected to the login.php
} else {
    header("Window-target: _parent");
    header("Location: login.php");
}
?>