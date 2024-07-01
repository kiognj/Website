<?php session_start(); ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="author" content="Dmytro Dundakov">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About us</title>

        <!-- custom fonts are included -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

        <link rel="icon" type="image/x-icon" href="./img/logo_green.png">

        <!-- css is linked to this page -->
        <link rel="stylesheet" href="./styles/main.css">

        <!-- JS library for charts is included -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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

        <!-- block where authors are introduced -->
        <div>
            <!-- list with authors -->
            <ul class="photo-about">
                <li>
                    <img src="img/Nazar.png" height="400" width="274" alt="Nazar">

                    <!-- block where the name and links to social networks are given -->
                    <div class="personal-info">
                        <p><b>Nazar Zhuhan</b></p>

                        <!-- block only for scoial networks -->
                        <div class="socnet">
                            <a href="https://www.linkedin.com/in/nazar-zhuhan-218818268/"><svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
                                    <path fill="#3b5441" class="socnet-svg-path" d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M17,20v19h-6V20H17z M11,14.47c0-1.4,1.2-2.47,3-2.47s2.93,1.07,3,2.47c0,1.4-1.12,2.53-3,2.53C12.2,17,11,15.87,11,14.47z M39,39h-6c0,0,0-9.26,0-10 c0-2-1-4-3.5-4.04h-0.08C27,24.96,26,27.02,26,29c0,0.91,0,10,0,10h-6V20h6v2.56c0,0,1.93-2.56,5.81-2.56 c3.97,0,7.19,2.73,7.19,8.26V39z"></path>
                                </svg></a>
                            <a href="https://www.instagram.com/some_one_un_known_/"><svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="64" height="64" viewBox="0 0 64 64">
                                    <path fill="#3b5441" class="socnet-svg-path" d="M 21.580078 7 C 13.541078 7 7 13.544938 7 21.585938 L 7 42.417969 C 7 50.457969 13.544938 57 21.585938 57 L 42.417969 57 C 50.457969 57 57 50.455062 57 42.414062 L 57 21.580078 C 57 13.541078 50.455062 7 42.414062 7 L 21.580078 7 z M 47 15 C 48.104 15 49 15.896 49 17 C 49 18.104 48.104 19 47 19 C 45.896 19 45 18.104 45 17 C 45 15.896 45.896 15 47 15 z M 32 19 C 39.17 19 45 24.83 45 32 C 45 39.17 39.169 45 32 45 C 24.83 45 19 39.169 19 32 C 19 24.831 24.83 19 32 19 z M 32 23 C 27.029 23 23 27.029 23 32 C 23 36.971 27.029 41 32 41 C 36.971 41 41 36.971 41 32 C 41 27.029 36.971 23 32 23 z"></path>
                                </svg></a>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="img/Dima.png" height="400" width="274" alt="Dmytro">

                    <!-- block where the name and links to social networks are given -->
                    <div class="personal-info">
                        <p><b>Dmytro Dundakov</b></p>

                        <!-- block only for scoial networks -->
                        <div class="socnet">
                            <a href="https://www.linkedin.com/in/dmytro-dundakov-334710256/"><svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
                                    <path fill="#3b5441" class="socnet-svg-path" d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M17,20v19h-6V20H17z M11,14.47c0-1.4,1.2-2.47,3-2.47s2.93,1.07,3,2.47c0,1.4-1.12,2.53-3,2.53C12.2,17,11,15.87,11,14.47z M39,39h-6c0,0,0-9.26,0-10 c0-2-1-4-3.5-4.04h-0.08C27,24.96,26,27.02,26,29c0,0.91,0,10,0,10h-6V20h6v2.56c0,0,1.93-2.56,5.81-2.56 c3.97,0,7.19,2.73,7.19,8.26V39z"></path>
                                </svg></a>
                            <a href="https://www.instagram.com/i.am.demetr/"><svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="64" height="64" viewBox="0 0 64 64">
                                    <path fill="#3b5441" class="socnet-svg-path" d="M 21.580078 7 C 13.541078 7 7 13.544938 7 21.585938 L 7 42.417969 C 7 50.457969 13.544938 57 21.585938 57 L 42.417969 57 C 50.457969 57 57 50.455062 57 42.414062 L 57 21.580078 C 57 13.541078 50.455062 7 42.414062 7 L 21.580078 7 z M 47 15 C 48.104 15 49 15.896 49 17 C 49 18.104 48.104 19 47 19 C 45.896 19 45 18.104 45 17 C 45 15.896 45.896 15 47 15 z M 32 19 C 39.17 19 45 24.83 45 32 C 45 39.17 39.169 45 32 45 C 24.83 45 19 39.169 19 32 C 19 24.831 24.83 19 32 19 z M 32 23 C 27.029 23 23 27.029 23 32 C 23 36.971 27.029 41 32 41 C 36.971 41 41 36.971 41 32 C 41 27.029 36.971 23 32 23 z"></path>
                                </svg></a>
                        </div>
                    </div>
                </li>
                <li>
                    <img src="img/Kirill.png" height="400" width="274" alt="Kirill">

                    <!-- block where the name and links to social networks are given -->
                    <div class="personal-info">
                        <p><b>Kirill Ognjov</b></p>

                        <!-- block only for scoial networks -->
                        <div class="socnet">
                            <a href="https://www.linkedin.com/in/kirill-ognjov-189a151a0/"><svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
                                    <path fill="#3b5441" class="socnet-svg-path" d="M41,4H9C6.24,4,4,6.24,4,9v32c0,2.76,2.24,5,5,5h32c2.76,0,5-2.24,5-5V9C46,6.24,43.76,4,41,4z M17,20v19h-6V20H17z M11,14.47c0-1.4,1.2-2.47,3-2.47s2.93,1.07,3,2.47c0,1.4-1.12,2.53-3,2.53C12.2,17,11,15.87,11,14.47z M39,39h-6c0,0,0-9.26,0-10 c0-2-1-4-3.5-4.04h-0.08C27,24.96,26,27.02,26,29c0,0.91,0,10,0,10h-6V20h6v2.56c0,0,1.93-2.56,5.81-2.56 c3.97,0,7.19,2.73,7.19,8.26V39z"></path>
                                </svg></a>
                            <a href="https://www.instagram.com/ogonjochek/"><svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="64" height="64" viewBox="0 0 64 64">
                                    <path fill="#3b5441" class="socnet-svg-path" d="M 21.580078 7 C 13.541078 7 7 13.544938 7 21.585938 L 7 42.417969 C 7 50.457969 13.544938 57 21.585938 57 L 42.417969 57 C 50.457969 57 57 50.455062 57 42.414062 L 57 21.580078 C 57 13.541078 50.455062 7 42.414062 7 L 21.580078 7 z M 47 15 C 48.104 15 49 15.896 49 17 C 49 18.104 48.104 19 47 19 C 45.896 19 45 18.104 45 17 C 45 15.896 45.896 15 47 15 z M 32 19 C 39.17 19 45 24.83 45 32 C 45 39.17 39.169 45 32 45 C 24.83 45 19 39.169 19 32 C 19 24.831 24.83 19 32 19 z M 32 23 C 27.029 23 23 27.029 23 32 C 23 36.971 27.029 41 32 41 C 36.971 41 41 36.971 41 32 C 41 27.029 36.971 23 32 23 z"></path>
                                </svg></a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- text about our team and our project -->
        <p class="introduction">Hello there. We are a team of students studying at Tallinn University of Technology,
            this is our first web project.</p>
        <p class="introduction">Our aim was to create a working CO<sub>2</sub> footprint calculator. We made a deep research and found out all the important information, coefficients and numbers,
            which helped us throughout the process of developing the project.</p>
        <p class="introduction">All in all, we created a tool, which not only gives users an opportunity to count his CO<sub>2</sub> footprint, but also saves their data, if they are logged in, and
            helps them to deduce how much they can reduce their own footprint.</p>
        <br>

        <!-- part where contacts are given -->
        <p id="contact-text">You can always contact us by an email or phone:</p>

        <!-- list for contacts -->
        <ul class="contact-list">
            <li class="contact">
                <a class="our-links" id="link1" href="mailto:support.co2@gmail.com">
                    <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                        <path class="socnet-svg-path" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                    </svg>
                    <p>support.co2@gmail.com</p>
                </a>
            </li>
            <li class="contact">
                <a class="our-links" id="link2" href="tel:+37211111111">
                    <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                        <path class="socnet-svg-path" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                    </svg>
                    <p>+37211111111</p>
                </a>
            </li>
        </ul>

        <!-- footer is inserted using template file -->
        <?php require_once("./templates/footer_reg.php"); ?>
    </body>

    </html>
