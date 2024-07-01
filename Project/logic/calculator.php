<?php
// connection for DB
include_once("./logic/connect.db.php");
$link = mysqli_connect($server, $user, $password, $database);
if (!$link)
    die("Connection to DB failed: " . mysqli_connect_error());

// coeficient constants
const ELECTRICITY = 6600;
const GAS = 1876;
const OIL = 25401;
const COAL = 28832;
const BUTANE = 15571;
const PROPANE = 15435;
const WOOD = 505;

const MEAT = 1.63 * 30;
const VEGETARIAN = 1.10 * 30;
const VEGAN = 0.84 * 30;
const PHARM = 1.20 * 30;
const CLOTHES = 1.83 * 30;
const PAPER = 1.63 * 30;
const ELECTRONICS = 0.68 * 30;
const VEHICLE = 0.86 * 30;
const FURNITURE = 1.32 * 30;
const HOTEL = 0.56 * 30;

const CAR = 170;
const BUS = 105;
const COACH = 27.33;
const RAIL = 40.98;
const TRAM = 34.61;
const SUBWAY = 30.81;
const PLANE = 150;


$total = 0;
$house = 0;
$secondary = 0;
$transportation = 0;

// Session variable to show year and month
$clickCounter = $_SESSION['page'];
$chMonth = date('F', strtotime("-$clickCounter month"));
$chYear = date('Y', strtotime("-$clickCounter month"));

// actions on GET request
if (isset($_GET["month"])) {
    if ($_GET['month'] == 1) {
        $_SESSION['page'] += 1;
        $clickCounter = $_SESSION['page'];

        $chMonth = date('F', strtotime("-$clickCounter month"));
        $chYear = date('Y', strtotime("-$clickCounter month"));
    }

    if ($_GET['month'] == 2) {
        // make a threshold, i.e. you cannot go in the future
        if ($_SESSION['page'] >= 1) {
            $_SESSION['page'] -= 1;
        } else {
?>
            <!-- function to give an alert that it is the possible last month -->
            <script>
                function alert_custom() {
                    // creating an object
                    const Alert = {
                        open(options) {
                            options = Object.assign({}, {
                                title: '',
                                message: '',
                                okText: 'OK',
                                oncancel: function() {}
                            }, options);

                            // html code to be inserted
                            const html = `
                                <div class="confirm">
                                    <div class="confirm__window">
                                        <div class="confirm__titlebar">
                                            <span class="confirm__title">${options.title}</span>
                                        </div>
                                        <div class="confirm__content">${options.message}</div>
                                        <div class="confirm__buttons">
                                            <button class="confirm__button confrim__button--ok">${options.okText}</button>
                                        </div>
                                    </div>
                                </div>
                            `;

                            // creating an element from html code
                            const template = document.createElement('template');
                            template.innerHTML = html;
                            // console.log(template);

                            const confirmEl = template.content.querySelector(".confirm");
                            const btnOk = template.content.querySelector(".confrim__button--ok");

                            // add different actions on clicking different areas
                            confirmEl.addEventListener('click', e => {
                                if (e.target === confirmEl) {
                                    options.oncancel();
                                    this._close(confirmEl);
                                }
                            });

                            btnOk.addEventListener('click', e => {
                                options.oncancel();
                                this._close(confirmEl);
                            });

                            document.body.appendChild(template.content);
                        },
                        _close(confirmEl) {
                            confirmEl.classList.add('confirm--close');

                            confirmEl.addEventListener('animationend', () => {
                                document.body.removeChild(confirmEl);
                            })
                        }
                    };

                    Alert.open({
                        title: 'Last month',
                        message: `You are on the last possible month!`,

                    });
                }
                alert_custom();
            </script>
<?php
        }
        $clickCounter = $_SESSION['page'];
        $chMonth = date('F', strtotime("-$clickCounter month"));
        $chYear = date('Y', strtotime("-$clickCounter month"));
    }
}

// on submitting the form
if ($_POST) {

    $total = 0;
    $house = 0;
    $secondary = 0;
    $transportation = 0;

    if (isset($_POST["submit"])) {
        // House form validation
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["electricity"])) {
            $house += $_POST["electricity"] * ELECTRICITY;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["gas"])) {
            $house += $_POST["gas"] * GAS;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["oil"])) {
            $house += $_POST["oil"] * OIL;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,3}$/", $_POST["coal"])) {
            $house += $_POST["coal"] * COAL;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["butane"])) {
            $house += $_POST["butane"] * BUTANE;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["propane"])) {
            $house += $_POST["propane"] * PROPANE;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,3}$/", $_POST["wood"])) {
            $house += $_POST["wood"] * WOOD;
        }

        // Secondary form validation
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["food-meat"])) {
            $secondary += $_POST["food-meat"] * MEAT;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["food-vegetarian"])) {
            $secondary += $_POST["food-vegetarian"] * VEGETARIAN;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["food-vegan"])) {
            $secondary += $_POST["food-vegan"] * VEGAN;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["pharm"])) {
            $secondary += $_POST["pharm"] * PHARM;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["clothes"])) {
            $secondary += $_POST["clothes"] * CLOTHES;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["paper"])) {
            $secondary += $_POST["paper"] * PAPER;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["electronics"])) {
            $secondary += $_POST["electronics"] * ELECTRONICS;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["vehicle"])) {
            $secondary += $_POST["vehicle"] * VEHICLE;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["furniture"])) {
            $secondary += $_POST["furniture"] * FURNITURE;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,2}$/", $_POST["hotel"])) {
            $secondary += $_POST["hotel"] * HOTEL;
        }

        // Transportation form validation
        if (preg_match("/^[0-9]+\.?[0-9]{0,3}$/", $_POST["car"])) {
            $transportation += $_POST["car"] * CAR;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,3}$/", $_POST["bus"])) {
            $transportation += $_POST["bus"] * BUS;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,3}$/", $_POST["coach"])) {
            $transportation += $_POST["coach"] * COACH;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,3}$/", $_POST["rail"])) {
            $transportation += $_POST["rail"] * RAIL;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,3}$/", $_POST["tram"])) {
            $transportation += $_POST["tram"] * TRAM;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,3}$/", $_POST["subway"])) {
            $transportation += $_POST["subway"] * SUBWAY;
        }
        if (preg_match("/^[0-9]+\.?[0-9]{0,3}$/", $_POST["plane"])) {
            $transportation += $_POST["plane"] * PLANE;
        }
    }

    $total = round($house + $secondary + $transportation, 0);

    if (isset($_POST["save"])) {

        // Setting the defautl values
        if (empty($_POST["house"])) {
            $house = 0;
        } else {
            $house = $_POST["house"];
        }
        if (empty($_POST["second"])) {
            $secondary = 0;
        } else {
            $secondary = $_POST["second"];
        }
        if (empty($_POST["trans"])) {
            $transportation = 0;
        } else {
            $transportation = $_POST["trans"];
        }

        // inserting into DB user's data about his/her footprint
        $id = (int)$_SESSION['userID'];
        $insertQuery = "INSERT INTO `data` (users_ID, `year`, `month`, `house`, `secondary`, `transportation`)
        VALUES (?, ?, ?, ?, ?, ?)";
        $queryData = mysqli_prepare($link, $insertQuery);
        mysqli_stmt_bind_param(
            $queryData,
            "iisiii",
            $id,
            $chYear,
            $chMonth,
            $house,
            $secondary,
            $transportation
        );
        mysqli_stmt_execute($queryData);
        mysqli_stmt_store_result($queryData);

        $house = 0;
        $secondary = 0;
        $transportation = 0;
    }
}
