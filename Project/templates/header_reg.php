<!-- Responsive header that will be used on all pages when user is logged -->
<header class="header-line">
    <!-- navigation for mobiles -->
    <div class="mobile-header">
        <a href="./index.php" class="burger-logo top">CO<sub>2</sub></a>
        <button class="hamburger">
            <span class="bar"></span>
        </button>
    </div>
    <nav class="mobile-nav logged">
        <a href="./index.php">Home</a>
        <a href="./history.php">History</a>
        <a href="./calculator.php">Calculator</a>
        <a href="./about-us.php">About us</a>
        <a href="#" onclick="logout()">Log out</a>
    </nav>

    <!-- navigation for PCs -->
    <nav class="nav menu">
        <div class="logo">
            <a href="./index.php" class="logo-img">
                <img src="img/logo_yellow.png" alt="logo" title="logo" width="50">
            </a>
            <a href="./index.php" class="logo-text">CO<sub>2</sub></a>
        </div>
        <div class="page-menu">
            <a href="./index.php">Home</a>
            <a href="./history.php">History</a>
            <a href="./calculator.php">Calculator</a>
            <a href="./about-us.php">About us</a>
        </div>

        <a href="#" onclick="logout()">Log out</a>
    </nav>
</header>