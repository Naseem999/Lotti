<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once 'partial/head.php';
    ?>
    <title>Lotti - Winning List</title>
</head>

<body>
    <?php
    $check = 0;
    include_once 'partial/header.php';
    if (isset($_SESSION['username'])) {
        $user = $_SESSION['username'];
        $check = 0;
    } elseif ($_SESSION['admin_username']) {
        $admin = $_SESSION['admin_username'];
        $check = 1;
    }


    if (isset($_POST['send_money'])) {

        $winning_amount = mysqli_real_escape_string($con, $_POST['winning_amount']);
        $winner_mail = mysqli_real_escape_string($con, $_POST['winner_mail']);
        // 
        $sql = "SELECT * FROM user WHERE email='$winner_mail';";
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        // 
        $old_amount = $row['balance'];
        if (empty($winning_amount) || $winning_amount == 0) {
            $Err = "Fill All the Feilds";
            echo "<script>alert('add at Least 1 Rupee');
        window.location.assign('user_dash.php');
        </script>";
        } else {
            $new_winner_balance = $old_amount + $winning_amount;

            date_default_timezone_set('Asia/Kolkata');
            $currentdate = date('Y-m-d');

            $sql = "SELECT * FROM gifts WHERE winner_email='$winner_mail';";
            $result = mysqli_query($con, $sql);
            $resultch = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if ($row['timestamp_'] == $currentdate) {
                echo "<script>alert('You Aleardy Sent a Gift To Winner Today');
            window.location.assign('winning_list.php');
            </script>";   
            } else {
                $sql1 = "INSERT INTO gifts (winner_email,amount,timestamp_) VALUES('$winner_mail','$winning_amount',now());";
                if (mysqli_query($con, $sql1)) {
                    $sql = "UPDATE user SET balance='$new_winner_balance' WHERE email='$winner_mail';";
                    if (mysqli_query($con, $sql)) {
                        echo "<script>alert('Winning Amount $winning_amount sent to Winner');
            window.location.assign('winning_list.php');
            </script>";
                    } else {
                        echo "<script>alert('Smothing went wrong');
        window.location.assign('winning_list.php');
        </script>";
                    }
                }
            }
        }
    }
    ?>
    <div class="row main_row">
        <div class="card z-depth-2 cards " style="border-radius: 8px; border: 1px solid #e57373;">
            <div class="card-content ">
                <div class="row" style="margin-bottom: 0px;">
                    <div class="col s12 m12 l12 " style=" margin-top: -4em;">
                        <div class="card" style="  background-color: #e57373; padding: 10px;   box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                            <div class="card-image cneter-align">
                                <?php
                                if (isset($_SESSION['admin_username'])) {
                                ?>
                                    <p style="text-align: center;">
                                        <a> <img class="responsive-image" src="img/logo.png" style=" width: 100%; margin-bottom: 0px; height:10vh;  object-fit:contain;  "></a>
                                    </p>
                                <?php
                                } elseif (isset($_SESSION['username'])) {
                                ?>
                                    <p style="text-align: center;">
                                        <a href="user_dash.php"> <img class="responsive-image" src="img/logo.png" style=" width: 100%; margin-bottom: 0px; height:10vh;  object-fit:contain;  "></a>
                                    </p>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l12 ">
                        <table class="responsive-table highlight ">
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $sql = "SELECT * FROM winlist order by id desc;";
                                $result = mysqli_query($con, $sql);
                                $resultch = mysqli_num_rows($result);
                                if ($resultch < 1) {
                                } else {
                                    while ($row = mysqli_fetch_assoc($result)) {

                                        $winner_email = $row['win_user_email'];
                                ?>
                                        <tr>
                                            <td><?php echo  $row['win_number']; ?></td>
                                            <td><?php echo  $row['win_username']; ?></td>
                                            <td><?php echo  $row['win_user_email']; ?></td>
                                            <td><?php echo  $row['date']; ?></td>
                                            <td><?php echo  $row['time']; ?></td>
                                            <?php
                                            if ($check == 1) {
                                            ?>
                                                <td><a class="waves-effect waves-light btn modal-trigger" style="background-color: #e57373;" href="#<?php echo $winner_email; ?>">Send Gift</a></td>
                                            <?php
                                            }
                                            ?>

                                        </tr>

                                        <div id="<?php echo $winner_email; ?>" class="modal">
                                            <div class="container">
                                                <p style="font-size: 3vh; text-align: center;">Enter Winning Amount</p>
                                                <hr style="width: 20px;">
                                                <form action="winning_list.php" method="POST">
                                                    <input type="hidden" name="winner_mail" value="<?php echo $winner_email; ?>">
                                                    <div class="input-field col s12 l12 m12">
                                                        <input type="number" style="text-align: center;" name="winning_amount" class="validate">
                                                    </div>
                                                    <div class="input-field col s12 l12 m12">
                                                        <p style="text-align: center;">
                                                            <button name="send_money" type="submit" class="red lighten-2 z-depth-2 btn ">
                                                                Send
                                                            </button>
                                                        </p>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include_once 'partial/scripts.php';
    ?>


</body>

</html>

<script>
    $(document).ready(function() {
        $('.modal').modal();
    });
</script>
<style>
    .main_row {
        margin: 100px;

    }

    @media only screen and (max-width: 600px) {


        .main_row {
            margin-top: 5em !important;
            margin: 5px;
            padding: 0px;
        }
    }
</style>