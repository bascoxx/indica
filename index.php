            <?php
            if (isset($_GET['x']) && $_GET['x'] == 'home') {
                $page = "home.php";
                include "main.php";
            } elseif (isset($_GET['x']) && $_GET['x'] == 'Product') {
                $page = "Product.php";
                include "main.php";
            } elseif (isset($_GET['x']) && $_GET['x'] == 'Report') {
                $page = "Report.php";
                include "main.php";
            } elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
                include "login.php";
            } else {
                include "main.php";
            }
            ?>