<?php
session_start();
?>

<nav class="" style="background-color: #ee6e73;" role="navigation">
    <div class="nav-wrapper container">
        <a href="index.php " id="logo-container" class="brand-logo valign-wrapper"> <img class="responsive-image" src="img/logo.png" style=" height:9vh;  object-fit:contain;  ">
        </a>
        <a href="index.php " style="margin-left: 7%;" class="brand-logo valign-wrapper hide-on-med-and-down">
            Lotti
        </a>

        <ul class="right hide-on-med-and-down">
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <li><a href="user_dash.php">
                        <?php
                        echo $_SESSION['username']; ?><i class="material-icons left">account_circle</i></a></li>
                <li><a href="partial/logout.php">Logout<i class="material-icons left">power_settings_new</i></a></li>

            <?php
            } elseif (isset($_SESSION['admin_username'])) {
            ?>
                <li><a href="admin_dash.php">
                        <?php
                        echo $_SESSION['admin_username']; ?><i class="material-icons left">dashboard</i></a></li>
                <li><a href="admin/logout.php">Logout<i class="material-icons left">power_settings_new</i></a></li>

            <?php
            } else {
            ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Register</a></li>
            <?php
            }
            ?>
        </ul>

        <!-- mobile -->
        <ul id="nav-mobile" class="sidenav">
            <?php
            if (isset($_SESSION['username'])) {
            ?>
                <li><a href="#!">
                        <?php
                        echo $_SESSION['username']; ?><i class="material-icons left">account_circle</i></a></li>
                <li><a href="user_dash.php">Dashboard<i class="material-icons left">dashboard</i></a></li>
                <li><a href="partial/logout.php">Logout<i class="material-icons left">power_settings_new</i></a></li>
            <?php
            } elseif (isset($_SESSION['admin_username'])) {
            ?>
                <li><a href="#!">
                        <?php
                        echo $_SESSION['admin_username']; ?><i class="material-icons left">account_circle</i></a></li>
                <li><a href="admin_dash.php">Dashboard<i class="material-icons left">dashboard</i></a></li>
                <li><a href="admin/logout.php">Logout<i class="material-icons left">power_settings_new</i></a></li>

            <?php
            } else {
            ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Register</a></li>
            <?php
            }
            ?>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"> <i class="material-icons">menu</i></a>
    </div>

</nav>
<ul id="user" class="dropdown-content" style="margin-top: 100px;">

    <li class="divider"></li>
    <li><a href="partial/logout.php">Logout</a></li>
</ul>
<ul id="admin" class="dropdown-content" style="margin-top: 100px;">
    <li><a href="admin_dash.php">Dashboard</a></li>
    <li class="divider"></li>
    <li><a href="admin/logout.php">Logout</a></li>
</ul>
<?php
include_once 'partial/scripts.php';
?>

<script>
    $('.dropdown-trigger').dropdown();
</script>
<style>
    .dropdown-content {
        background-color: rgba(238, 110, 115, 0.6);
        backdrop-filter: blur(10px);
        border-radius: 3px;
        color: #f1f1f1 !important;
    }

    .dropdown-content li>a {
        color: #f6f6f6;
    }

    .dropdown-content li>:hover {
        background-color: #ef5350;
    }
</style>