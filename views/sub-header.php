<div class="login-bar">
    <div class="sec-container">
        <div class="social-buttons">
            <i class="fa fa-facebook first"></i>
            <i class="fa fa-google-plus"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-pinterest"></i>
            <i class="fa fa-youtube"></i>
        </div>

        <div class="login-buttons">
            <ul class="login-menu">

                <?php
                $_url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

                if (isset($_SESSION)){
                    if(session_status() === PHP_SESSION_NONE){
                        session_start();
                    }
                }else{
                    session_start();
                }

                if ($_SERVER['REQUEST_URI'] == "/"){
                    if (isset($_SESSION["username"])){
                        if ($_SESSION["username"] != ""){
                            echo '<li class="btn-dash"><a href="../views/dash-member.php">Dashboard ('. $_SESSION["username"] .')</a></li>';
                            echo '<li class="btn-logout last"><a href="../controllers/logout.php">Logout</a></li>';
                        }else{
                            echo '<li class="btn-home"><a href="../views/login.php">Login</a></li>';
                            echo '<li class="btn-Register last"><a href="../views/register.php">Register</a></li>';
                        }
                    }else{
                        echo '<li class="btn-home"><a href="../views/login.php">Login</a></li>';
                        echo '<li class="btn-Register last"><a href="../views/register.php">Register</a></li>';
                    }

                }else if (strpos($_url, "/views/review.php")){
                    if (isset($_SESSION["username"])){
                        if ($_SESSION["username"] != ""){
                            echo '<li class="btn-home"><a href="../">Home</a></li>';
                            echo '<li class="btn-dash"><a href="../views/dash-member.php">Dashboard ('. $_SESSION["username"] .')</a></li>';
                            echo '<li class="btn-logout last"><a href="../controllers/logout.php">Logout</a></li>';
                        }else{
                            echo '<li class="btn-home"><a href="../">Home</a></li>';
                            echo '<li class="btn-Login"><a href="../views/login.php">Login</a></li>';
                            echo '<li class="btn-Register last"><a href="../views/register.php">Register</a></li>';
                        }
                    }else{
                        echo '<li class="btn-home"><a href="../">Home</a></li>';
                        echo '<li class="btn-Login"><a href="../views/login.php">Login</a></li>';
                        echo '<li class="btn-Register last"><a href="../views/register.php">Register</a></li>';
                    }

                }else if ($_SERVER['REQUEST_URI'] == "/views/login.php"){
                    if (isset($_SESSION["username"])){
                        if ($_SESSION["username"] != ""){
                            header("Location:../");
                        }else{
                            echo '<li class="btn-home"><a href="../">Home</a></li>';
                            echo '<li class="btn-Register last"><a href="../views/register.php">Register</a></li>';
                        }
                    }else{
                        echo '<li class="btn-home"><a href="../">Home</a></li>';
                        echo '<li class="btn-Register last"><a href="../views/register.php">Register</a></li>';
                    }

                }else if ($_SERVER['REQUEST_URI'] == "/views/register.php") {
                    if (isset($_SESSION["username"])) {
                        if ($_SESSION["username"] != "") {
                            header("Location:../");
                        } else {
                            echo '<li class="btn-home"><a href="../">Home</a></li>';
                            echo '<li class="btn-Login last"><a href="../views/login.php">Login</a></li>';
                        }
                    } else {
                        echo '<li class="btn-home"><a href="../">Home</a></li>';
                        echo '<li class="btn-Login last"><a href="../views/login.php">Login</a></li>';
                    }
                }else if ($_SERVER['REQUEST_URI'] == "/views/confirmation.php") {
                    if (isset($_SESSION["username"])) {
                        if ($_SESSION["username"] != "") {
                            header("Location:../");
                        } else {
                            echo '<li class="btn-home"><a href="../">Home</a></li>';
                            echo '<li class="btn-Login"><a href="../views/login.php">Login</a></li>';
                            echo '<li class="btn-Register last"><a href="../views/register.php">Register</a></li>';
                        }
                    } else {
                        echo '<li class="btn-home"><a href="../">Home</a></li>';
                        echo '<li class="btn-Login"><a href="../views/login.php">Login</a></li>';
                        echo '<li class="btn-Register last"><a href="../views/register.php">Register</a></li>';
                    }
                }
                ?>


            </ul>
        </div>
    </div>
</div>