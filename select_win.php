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

    $name = $_SESSION['admin_username'];
    $email = $_SESSION['admin_email'];
    $id = $_SESSION['admin_id'];

    date_default_timezone_set('Asia/Kolkata');
    $today_date = date('Y-m-d');
    $yesterday = date('Y.m.d', strtotime("-1 days"));


    if (isset($_GET['number'])) {
        $number_number = mysqli_real_escape_string($con, $_GET['number']);

        $sql4 = "SELECT * FROM winlist WHERE date='$today_date';";
        $result4 = mysqli_query($con, $sql4);
        $resultch4 = mysqli_num_rows($result4);
        if ($resultch4 < 1) {
        } else {
            while ($row4 = mysqli_fetch_assoc($result4)) {
                if ($row4['win_number'] == $number_number) {
                    echo "<script>alert('Already Slected This Winner');
                    window.location.assign('select_win.php');
                    </script>";
                    exit();
                }
            }
        }

        // ============================================================
        $sql = "SELECT * FROM bids WHERE bid_number='$number_number';";
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
        if ($resultch < 1) {
        } else {

            while ($row = mysqli_fetch_assoc($result)) {

                $user_id = $row['users_id'];
                $sql1 = "SELECT * FROM user WHERE id='$user_id';";
                $result1 = mysqli_query($con, $sql1);
                $row1 = mysqli_fetch_assoc($result1);

                $win_username = $row1['username'];
                $win_user_email = $row1['email'];

                $sql = "INSERT INTO winlist(win_number,win_username,win_user_email,date,time) VALUES('$number_number','$win_username','$win_user_email',now(),now());";
                mysqli_query($con, $sql);
            }
        }
        echo "<script>alert('Winner Number $number_number Selected');
        window.location.assign('select_win.php');
        </script>";
        exit();
    }
    ?>



    <div class="row main_number_row">
        <h3 style="font-size: 5vh; text-align: center; color: rgba(238, 110, 115);;">Select Winners</h3>
        <hr style="width: 20px;">
    </div>


    <div class="row main_number_row" style="margin-top: 1em; ">
        <?php
        for ($i = 1; $i <= 50; $i++) {
        ?>
            <div class="col s6 m2 l2">
                <div class="card horizontal z-depth-1" style="border-radius: 10px; border: 1px solid #ffcdd2;">
                    <div class="card-stacked">
                        <div class="card-content">
                            <p style="text-align: center; font-size: 5vh; font-weight: bolder;"><?php echo $i; ?></p>
                        </div>
                        <div class="card-action">
                            <p style="text-align: center; margin: 0px;"><a href="#<?php echo $i; ?>" class="modal-trigger waves-effect waves-light btn red lighten-2">Winner</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="<?php echo $i; ?>" class="modal" style=" border: none; background-color: rgba(238, 110, 115, 0.4); backdrop-filter: blur(10px);">
                <div class="modal-content">
                    <p style="text-align: center; font-size: 3vh; margin: 0px; color:white; ">Are You Sure</p>
                    <hr style="width: 20px;">
                    <div class="row" style="margin-top: 2em;">
                        <div class="col s6 m6 l6">
                            <p style="text-align: right;"> <a href="select_win.php?number=<?php echo $i; ?>" class="modal-trigger waves-effect waves-light btn green darken-4">Yes</a>
                            </p>
                        </div>
                        <div class="col s6 m6 l6">
                            <p style="text-align: left;"> <a class="modal-close waves-effect waves-light btn red darken-3">No</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <!--  Scripts-->

    <script>
        $('.dropdown-trigger').dropdown();
        $(document).ready(function() {
            $('.modal').modal();
        });
    </script>
    <div class="row" style="bottom: 0;">
        <?php
        include_once 'partial/footer.php';
        include_once 'partial/scripts.php';
        ?>
    </div>

</body>

</html>

<style>
    .main_number_row {
        margin: 50px;
    }

    @media only screen and (max-width: 600px) {
        .cards {
            margin-top: 5em;
        }

        .main_number_row {
            margin: 0px;
        }
    }
</style>