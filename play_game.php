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

    $name = $_SESSION['username'];
    $email = $_SESSION['email'];
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM user WHERE id='$id';";
    $result = mysqli_query($con, $sql);
    $resultch = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($row['balance'] < 50) {
        echo "<script>alert('Add More Money To Place Bid');
        window.location.assign('user_dash.php');
        </script>";
    } else {
        if (isset($_GET['number'])) {
            $number_number = mysqli_real_escape_string($con, $_GET['number']);

            $sql = "INSERT INTO bids(users_id,user_email,bid_number,number_bid_value,date,timestamp_) VALUES('$id','$email','$number_number','50',now(),now());";
            mysqli_query($con, $sql);


            $old_amount = $row['balance'];

            if (empty($number_number)) {
                echo "<script>alert('Somthing Wrong');
            window.location.assign('play_game.php');
            </script>";
            } else {
                $amount = $old_amount - 50;
                $sql = "UPDATE user SET balance='$amount' WHERE id='$id';";
                if (mysqli_query($con, $sql)) {
                    echo "<script>alert('Bid Placed On Number $number_number');
                window.location.assign('play_game.php');
                </script>";
                } else {
                    echo "<script>alert('Smothing went wrong');
            window.location.assign('play_game.php');
            </script>";
                }
            }
        }
    }
    ?>






    <div class="row main_number_row" style="margin-top: 5em; ">
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
                            <p style="text-align: center; margin: 0px;"><a href="#<?php echo $i; ?>" class="modal-trigger waves-effect waves-light btn red lighten-2">Place Bid</a></p>
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
                            <p style="text-align: right;"> <a href="play_game.php?number=<?php echo $i; ?>" class="modal-trigger waves-effect waves-light btn green darken-4">Yes</a>
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