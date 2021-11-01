<?php
header('Content-type: text/html; charset=utf-8');
require_once './connect.php';
session_start();
$menu = filter_input(INPUT_GET, "menu", FILTER_SANITIZE_STRING);
$login = isset($_SESSION["login"])?$_SESSION["login"]:false;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 30 * 60)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <title>Webshop</title>
        <link rel="stylesheet" href="bootstrap-4.5.3-dist/css/bootstrap.min.css" />
        <script src="bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container">
        <header>
            <ul class="nav nav-pills bg-warning">
                <li class="nav-item">
                    <a class="nav-link <?php echo $menu=="home"?"active":""; ?>" href="index.php?menu=home">Főoldal</a>
                </li>

<?php
        if(!$login){
            ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $menu=="regisztracio"?"active":""; ?>" href="index.php?menu=regisztracio">Regisztráció</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $menu=="bejelentkezes"?"active":""; ?>" href="index.php?menu=bejelentkezes">Bejelentkezés</a>
                </li>
                

                <?php
        } else {
        ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $menu=="termek_hozzaadas"?"active":""; ?>" href="index.php?menu=termek_hozzaadas">Termékek hozzáadása</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $menu=="kilepes"?"active":""; ?>" href="index.php?menu=kilepes">Kilépés</a>
                </li>
                <?php
        }
        ?>
                
              </ul>
        </header>
        <?php
            
        
        require_once './kontroller.php';
        ?>
        </div>
    </body>
</html>
