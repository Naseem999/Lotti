<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once 'partial/head.php';
    ?>
    <title>Lotti</title>
</head>

<body>
    <?php
    include_once 'partial/header.php';

    if (isset($_SESSION['admin_id'])) {

        $name = $_SESSION['admin_username'];
        $id = $_SESSION['admin_id'];

        date_default_timezone_set('Asia/Kolkata');
        $today_date = date('Y-m-d');

        $sql1 = "SELECT * FROM bids WHERE date='$today_date'";
        $result1 = mysqli_query($con, $sql1);
        $total_placed_bids = mysqli_num_rows($result1);

        $sql1 = "SELECT * FROM user ";
        $result1 = mysqli_query($con, $sql1);
        $total_users = mysqli_num_rows($result1);
    } else {
        echo "<script>alert('Please Login As Admin');
    window.location.assign('admin.php');
    </script>";
    }

    $sql = "SELECT * FROM admin WHERE id='$id';";
    $result = mysqli_query($con, $sql);
    $resultch = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);




    ?>






    <div class="row main_row" style="margin-top: 5em;">
        <!--  -->
        <div class="col s12 m4 l4 ">
            <div class="col s12 m12 l12">
                <div class="card z-depth-3 cards1 " style="border-radius: 8px; border: 1px solid transparent;">
                    <div class="card-content " style="padding: 18px;">
                        <div class="card" style="background-color: transparent;  box-shadow: none; padding: 17px;  margin-top: -6em;">
                            <p style="text-align: center;"> <img style=" height: 8em; width:8em;" src="  ./img/user.svg" alt="" class="z-depth-3  circle responsive-img">
                            </p>
                        </div>
                        <div class="row">
                            <p style="text-align: center; font-weight: bold; color: #6f6f6f; font-size: 1em; ">
                                <?php
                                echo  $name;
                                ?>
                            </p>
                            <hr style="width: 20px;">
                            <div class="col s12 m12 l12" style="margin-top: 1em;">
                                <p style="text-align: center;  color: #6f6f6f; font-size: 1em;  font-weight: bold;">
                                    <?php
                                    echo $row['phone'];
                                    ?>
                                </p>
                                <p style="text-align: center;  color: #6f6f6f; font-size: 1.3em; margin-top: 0.5em; ">
                                    <?php
                                    echo  $row['email'];
                                    ?>
                                </p>



                            </div>
                            <div class="input-field col s12 m12 l12">
                                <p style="text-align: center;margin-top: 2em;">
                                    <a href="admin/logout.php" class="waves-effect waves-light btn  " style=" background: linear-gradient(60deg, #ef5350, #e53935);
                             box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4);text-align: left;">
                                        Logout
                                    </a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col s12 m8 l8 " style="padding: 0px;">
            <div class="col m1 l1"></div>
            <div class="col s12 l12 m12 " style="margin-top: 0em;">
                <div class="card z-depth-0" style="background-color: #e57373; border-radius: 10px;">
                    <div class="card-content white-text">
                        <P style="text-align: center; font-size: 5vh; font-weight: bold;">Welcome <?php echo $name; ?>
                            <hr style="width: 20px;">
                        </P>
                        <div class="row" style="margin-top: 2em;">


                            <div class="col s12 m6 l6 small_cards">
                                <div class="card z-depth-5 cards " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 0px;">
                                            <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                                <div class="card" style="  height: 7em; border-radius: 5px;
                                                     background: linear-gradient(60deg, #ffa726, #fb8c00);
                             box-shadow:0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4);">
                                                    <div class="card-image cneter-align">
                                                        <p style="text-align: center;">
                                                            <i style="padding: 20px;margin-top: 0.2em;margin-bottom: 0.2em; color: white;" class="fas fa-users fa-3x"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s5 m6 l6" style="margin-top: 0px">
                                                <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Users Registered</p>
                                                <h1 style="font-size:3.5vh; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                    <?php echo $total_users; ?></h1>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em;">All Users Registered</p>

                                    </div>
                                </div>

                            </div>

                            <div class="col s12 m6 l6 small_cards">
                                <div class="card z-depth-5 cards " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 0px;">
                                            <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                                <div class="card" style="  height: 7em; background: linear-gradient(60deg, #66bb6a, #43a047);    box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                                                    <div class="card-image cneter-align">
                                                        <p style="text-align: center;">
                                                            <i style="padding: 20px;margin-top: 0.2em;margin-bottom: 0.2em; color: white;" class="fas fa-check-circle fa-3x"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Today Placed Bids</p>
                                                <h1 style="font-size:3.5vh; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                    <?php echo $total_placed_bids; ?></h1>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em;">Number Of Bids Placed Today</p>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- ====================== -->
                        <div class="row">

                            <div class="col s12 m6 l6 small_cards">
                                <div class="card z-depth-0  " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col s6 m6 l6 ">
                                                <p style="text-align: center;">
                                                    <i style="color: #6f6f6f;" class="fas fa-dollar-sign fa-3x"></i>
                                                </p>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="text-align: center; margin-top: 0.2em;">
                                                    <a class=" red lighten-2 z-depth-2 btn " href="withdraw_req.php">
                                                     Requests
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em; text-align: center;">Users Signed Up</p>
                                    </div>
                                </div>

                            </div>

                            <div class="col s12 m6 l6 small_cards">
                                <div class="card z-depth-0  " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col s6 m6 l6 ">
                                                <p style="text-align: center;">
                                                    <i style="color: #6f6f6f;" class="fas fa-user-check fa-3x"></i>
                                                </p>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="text-align: center; margin-top: 0.2em;">
                                                    <a class=" red lighten-2 z-depth-2 btn " href="users.php">
                                                        Users
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em; text-align: center;">Users Signed Up</p>
                                    </div>
                                </div>

                            </div>

                            <div class="col s12 m6 l6 small_cards ">
                                <div class="card z-depth-0  " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col s6 m6 l6 ">
                                                <p style="text-align: center;">
                                                    <i style="color: #6f6f6f;" class="fas fa-trophy  fa-3x"></i>
                                                </p>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="text-align: center; margin-top: 0.2em;">
                                                    <a class=" red lighten-2 z-depth-2 btn" href="select_win.php">
                                                        Winners
                                                    </a>

                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em; text-align: center;">Select Winner</p>
                                    </div>
                                </div>

                            </div>

                            <div class="col s12 m6 l6  small_cards">
                                <div class="card z-depth-0 " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col s6 m6 l6 ">
                                                <p style="text-align: center;">
                                                    <i style="color: #6f6f6f;" class="fas fa-clipboard fa-3x"></i>
                                                </p>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="text-align: center; margin-top: 0.2em;">
                                                    <a class="  red lighten-2 z-depth-2 btn" href="bids.php">
                                                        Bids
                                                    </a>

                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em; text-align: center;">Recored of Bids Placed </p>
                                    </div>
                                </div>

                            </div>

                            <div class="col s12 m6 l6  small_cards">
                                <div class="card z-depth-0 " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col s6 m6 l6 ">
                                                <p style="text-align: center;">
                                                    <i style="color: #6f6f6f;" class="fas fa-clipboard-check fa-3x"></i>
                                                </p>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="text-align: center; margin-top: 0.1em;">
                                                    < <a class=" red lighten-2 z-depth-2 btn" href="winning_list.php">
                                                        Win List
                                                        </a>
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em; text-align: center;">Recored of all Winner </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!--  Scripts-->

    <script>
        $('.dropdown-trigger').dropdown();
        $(document).ready(function() {
            $('.modal').modal();
        });
        $(document).ready(function() {
            $('.sidenav').sidenav();
        });
    </script>
    <?php
    include_once 'partial/footer.php';
    include_once 'partial/scripts.php';
    ?>

</body>

</html>

<style>
    @media only screen and (max-width: 600px) {
        .cards {
            margin-top: 2em;
            padding: 0px !important;
        }

        .cards1 {
            margin-top: 1em;
        }

        .main_row {
            margin: 0px;
            padding: 0px;
        }

        .small_cards {
            padding: 0px !important;
        }

    }
</style>