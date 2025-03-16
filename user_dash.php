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

    if (isset($_SESSION['username'])) {
        $name = $_SESSION['username'];
        $user_email = $_SESSION['email'];

        $id = $_SESSION['id'];
        $sql1 = "SELECT * FROM bids WHERE users_id='$id';";
        $result1 = mysqli_query($con, $sql1);
        $total_placed_bids = mysqli_num_rows($result1);


        $sql = "SELECT * FROM user WHERE id='$id';";
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $balance = $row['balance'];


        if (isset($_POST['payment_done'])) {
            $new_balance = $balance + $_POST['payment_done'];
            $sql = "UPDATE  user SET balance='$new_balance' WHERE id='$id';";
            mysqli_query($con, $sql);
            echo "<script>
                window.location.assign('user_dash.php');
                </script>";
            exit();
        }


        // add Money

        // ===============================================================
        if (isset($_POST['add_money'])) {

            $amount_add = mysqli_real_escape_string($con, $_POST['amount_add']);
            $account_no = mysqli_real_escape_string($con, $_POST['account_no']);
            $ifsc = mysqli_real_escape_string($con, $_POST['ifsc']);
            $upi = mysqli_real_escape_string($con, $_POST['upi']);

            if (empty($account_no) && empty($ifsc) && empty($upi)) {
                echo "<script>alert('Please Choose at Least One Method to Withdraw');
            window.location.assign('user_dash.php');
            </script>";
                exit();
            }
            if (!empty($account_no) && !empty($ifsc) && !empty($upi)) {
                echo "<script>alert('Choose One To Withraw');
            window.location.assign('user_dash.php');
            </script>";
                exit();
            }

            if (empty($account_no) && empty($ifsc)) {
                $account_no = Null;
                $ifsc = Null;
            }


            if (empty($upi)) {
                if (empty($account_no) || empty($ifsc)) {
                    echo "<script>alert('Fill Complete information');
                        window.location.assign('user_dash.php');
                        </script>";
                } else {
                    $upi = Null;
                }
            }

            if (empty($amount_add) || $amount_add == 0) {
                echo "<script>alert('enter valid  amount');
            window.location.assign('user_dash.php');
            </script>";
            } else {
                $sql = "INSERT INTO requests(request_type,request_to,request_from,account_no,ifsc,upi,amount,status,timestamp_) VALUES('add','admin','$id','$account_no','$ifsc','$upi','$amount_add','Unchecked',now());";
                if (mysqli_query($con, $sql)) {
                    echo "<script>alert('Request Sent to Admin');
                window.location.assign('user_dash.php');
                </script>";
                } else {
                    echo "<script>alert('Smothing went wrong');
            window.location.assign('user_dash.php');
            </script>";
                }
            }
        }

        // ===============================================================
        if (isset($_POST['withdraw_money'])) {

            $amount_withdraw = mysqli_real_escape_string($con, $_POST['amount_withdraw']);
            $account_no = mysqli_real_escape_string($con, $_POST['account_no']);
            $ifsc = mysqli_real_escape_string($con, $_POST['ifsc']);
            $upi = mysqli_real_escape_string($con, $_POST['upi']);

            $sql = "SELECT * FROM requests WHERE request_from='$id';";
            $result = mysqli_query($con, $sql);
            $resultch = mysqli_num_rows($result);
            $req_balance = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $req_balance = $req_balance + $row['amount'];
            }
            if ($req_balance >= $balance) {
                echo "<script>alert('Already Requested for withdrawal . not enough balance to request');
                window.location.assign('user_dash.php');
                </script>";
                exit();
            }


            if ($amount_withdraw > $balance) {
                echo "<script>alert('Not Enought Balance to withdraw');
                window.location.assign('user_dash.php');
                </script>";
                exit();
            } else {



                if (empty($account_no) && empty($ifsc) && empty($upi)) {
                    echo "<script>alert('Please Choose at Least One Method to Withdraw');
            window.location.assign('user_dash.php');
            </script>";
                    exit();
                }
                if (!empty($account_no) && !empty($ifsc) && !empty($upi)) {
                    echo "<script>alert('Choose One To Withraw');
            window.location.assign('user_dash.php');
            </script>";
                    exit();
                }

                if (empty($account_no) && empty($ifsc)) {
                    $account_no = Null;
                    $ifsc = Null;
                }


                if (empty($upi)) {
                    if (empty($account_no) || empty($ifsc)) {
                        echo "<script>alert('Fill Complete information');
                        window.location.assign('user_dash.php');
                        </script>";
                    } else {
                        $upi = Null;
                    }
                }

                if (empty($amount_withdraw) || $amount_withdraw == 0) {
                    echo "<script>alert('enter valid  amount');
            window.location.assign('user_dash.php');
            </script>";
                } else {
                    $sql = "INSERT INTO requests(request_type,request_to,request_from,account_no,ifsc,upi,amount,status,timestamp_) VALUES('withdraw','admin','$id','$account_no','$ifsc','$upi','$amount_withdraw','Unchecked',now());";
                    if (mysqli_query($con, $sql)) {
                        echo "<script>alert('Request Sent to Admin');
                window.location.assign('user_dash.php');
                </script>";
                    } else {
                        echo "<script>alert('Smothing went wrong');
            window.location.assign('user_dash.php');
            </script>";
                    }
                }
            }
        }
    } else {
        echo "<script>alert('Please Login ');
    window.location.assign('login.php');
    </script>";
    }
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
                            <form method="post" action="pdf_gen.php">
                                <p style="text-align: right; margin-top: -29px;"><input type="submit" name="generate_pdf" class="btn " style="background-color: #e57373;" value="Print" />
                                </p>
                            </form>
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
                                    echo  $_SESSION['email'];
                                    ?>
                                </p>



                            </div>
                            <div class="input-field col s12 m12 l12">
                                <p style="text-align: center;margin-top: 2em;">
                                    <a href="partial/logout.php" class="waves-effect waves-light btn  " style=" background: linear-gradient(60deg, #ef5350, #e53935);
                             box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(244, 67, 54, 0.4);text-align: left;">
                                        Logout
                                    </a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m12 l12">
                <div class="row main_row">
                    <div class="card z-depth-2  " style="margin-top: 3em; border-radius: 8px; border: 1px solid #e57373;">
                        <div class="card-content ">
                            <div class="row" style="margin-bottom: 0px;">
                                <div class="col s12 m12 l12 " style=" margin-top: -4em;">
                                    <div class="card" style="  background-color: #e57373; padding: 10px;   box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                                        <div class="card-image cneter-align">
                                            <p style="text-align: center; font-size: 2.4vh; color: white; font-weight: bold ;">
                                                Requests
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m12 l12 ">
                                    <table class="responsive-table highlight ">
                                        <thead>
                                            <tr>
                                                <th>Request_Type</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Timestamp</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php

                                            $sql = "SELECT * FROM requests WHERE request_from='$id' order by id desc;";
                                            $result = mysqli_query($con, $sql);
                                            $resultch = mysqli_num_rows($result);
                                            if ($resultch < 1) {
                                            } else {
                                                while ($row1 = mysqli_fetch_assoc($result)) {


                                            ?>
                                                    <tr>
                                                        <td><?php echo  $row1['request_type']; ?></td>
                                                        <td><?php echo  $row1['amount']; ?></td>
                                                        <td style="color: #e53935; font-weight: bold;"><?php echo  $row1['status']; ?></td>
                                                        <td><?php echo  $row1['timestamp_']; ?></td>

                                                    </tr>
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
                                <a onclick="orders(); " href="#orders">
                                    <div class="card z-depth-5 cards " style="border-radius: 8px;">
                                        <div class="card-content white-text">
                                            <div class="row" style="margin-bottom: 0px;">
                                                <div class="col s6 m6 l6 " style=" margin-top: -4em;">
                                                    <div class="card" style="  height: 7em; border-radius: 5px;
                                                     background: linear-gradient(60deg, #ffa726, #fb8c00);
                             box-shadow:0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(255, 152, 0, 0.4);">
                                                        <div class="card-image cneter-align">
                                                            <p style="text-align: center;">
                                                                <i style="padding: 20px;margin-top: 0.2em;margin-bottom: 0.2em; color: white;" class="fas fa-wallet fa-3x"></i>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col s5 m6 l6" style="margin-top: 0px">
                                                    <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Available Balance</p>
                                                    <h1 style="font-size:3.5vh; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                        <?php echo "$" . $row['balance']; ?></h1>
                                                </div>
                                            </div>
                                            <hr style="margin-top: 0px;">
                                            <p style="color: #a3a3a3;margin-top: 1em;">Minimum $10 Needed To bid</p>

                                        </div>
                                    </div>
                                </a>
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
                                                <p style="font-size:0.8em; color:#999999;text-align: right; margin-top: -0.5em">Total Placed Bids</p>
                                                <h1 style="font-size:3.5vh; font-weight: lighter; color:#3C4858;text-align: right; margin-top: 5px;">
                                                    <?php echo $total_placed_bids; ?></h1>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em;">Number Of Bids Placed By You</p>

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
                                                    <a class=" red lighten-2 z-depth-2 btn modal-trigger" href="#add_money">
                                                        add money
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em; text-align: center;">Add Money To wallet</p>
                                    </div>
                                </div>

                            </div>

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
                                                    <a class=" red lighten-2 z-depth-2 btn modal-trigger" href="#withdraw_money">
                                                        Withdraw Money
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em; text-align: center;"> Request To WIthdraw Money</p>
                                    </div>
                                </div>

                            </div>

                            <div class="col s12 m6 l6 small_cards ">
                                <div class="card z-depth-0  " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col s6 m6 l6 ">
                                                <p style="text-align: center;">
                                                    <i style="color: #6f6f6f;" class="fas fa-dice fa-3x"></i>
                                                </p>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="text-align: center; margin-top: 0.2em;">
                                                    <a class=" red lighten-2 z-depth-2 btn" href="play_game.php">
                                                        Play Game
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em; text-align: center;">Play Lotter</p>
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
                                                    <a class=" hide-on-med-and-down red lighten-2 z-depth-2 btn" href="user_bids.php">
                                                        Your Bids
                                                    </a>
                                                    <a style="display: none;" class="show-on-small red lighten-2 z-depth-2 btn" href="user_bids.php">
                                                        Records
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <hr style="margin-top: 0px;">
                                        <p style="color: #a3a3a3;margin-top: 1em; text-align: center;">Recored of Bids Placed By You</p>
                                    </div>
                                </div>

                            </div>

                            <div class="col s12 m6 l6  small_cards">
                                <div class="card z-depth-0 " style="border-radius: 8px;">
                                    <div class="card-content white-text">
                                        <div class="row" style="margin-bottom: 20px;">
                                            <div class="col s6 m6 l6 ">
                                                <p style="text-align: center;">
                                                    <i style="color: #6f6f6f;" class="fas fa-trophy fa-3x"></i>
                                                </p>
                                            </div>
                                            <div class="col s6 m6 l6" style="margin-top: 0px">
                                                <p style="text-align: center; margin-top: 0.2em;">
                                                    <a class=" hide-on-med-and-down red lighten-2 z-depth-2 btn" href="winning_list.php">
                                                        Winning List
                                                    </a>
                                                    <a style="display: none;" class="show-on-small red lighten-2 z-depth-2 btn" href="winning_list.php">
                                                        Winners
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

        <div id="add_money" class="modal" style="border: none; border-radius: 20px;">
            <div class="modal-content">
                <div class="container">
                    <p style="font-size: 3vh; text-align: center;">Add Amount</p>
                    <hr style="width: 20px;">
                    <form action="user_dash.php" method="POST">
                        <div class="row">
                            <div class="col s12 m12 l12" style="border: 1px solid #5cef62; background-color: #f6fdf6; border-radius: 8px; padding: 5px;">

                                <div class="col s12 m12 l12 " style="margin-top: 20px;">

                                    <div class="col s12 m6 l6">
                                        <input placeholder="Account no." name="account_no" type="text" style="font-size: 2.5vh; padding: 4px; border:1px solid #dedede;width: 98%; border-radius: 5px;  background-color: white ;">
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <input placeholder="IFSC code" name="ifsc" type="text" style="font-size: 2.5vh; padding: 4px; border:1px solid #dedede;width: 98%; border-radius: 5px;  background-color: white ;">
                                    </div>

                                </div>
                            </div>

                        </div>
                        <p style="text-align: center;">or</p>
                        <div class="row">
                            <div class="col s12 m12 l12" style="border: 1px solid #5cef62; background-color: #f6fdf6; border-radius: 8px; padding: 5px;">
                                <div class="col s2 m1 l1">
                                </div>

                                <div class="col s12 m8 l18 center-align " style=" margin-top: 0.5em;  padding: 0px; display: flex;justify-content: space-between;">
                                    <img style="  padding: 3px; height:6vh;  width: 3em;" class="left responsive-img" src="img/checkout_google-pay.svg">
                                    <img style="  padding: 3px; height:6vh; " class="left responsive-img" src="img/checkout_paytm.svg">
                                    <img style="  padding: 3px; height:6vh;" class="left responsive-img" src="img/checkout_phonepe.svg">
                                    <img style=" padding: 13px; height:6vh;" class="left responsive-img" src="img/checkout_upi.svg">
                                </div>
                                <div class="col s12 m12 l12 " style="margin-top: 20px;">

                                    <div class="col s12 m12 l12" style="padding: 0px;">
                                        <input placeholder="example@upi" name="upi" type="text" style="font-size: 2.5vh; padding: 4px; border:1px solid #dedede;width: 98%; border-radius: 5px;  background-color: white ;">
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="input-field col s12 l12 m12">
                            <input type="number" style="text-align: center;" placeholder="Amount" name="amount_add" class="validate">
                        </div>

                        <div class="input-field col s12 l12 m12">
                            <p style="text-align: center;">
                                <button name="add_money" type="submit" class="red lighten-2 z-depth-2 btn ">
                                    Add Request
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="withdraw_money" class="modal" style="border: none; border-radius: 0px;">
            <div class="modal-content">
                <div class="container">

                    <form action="user_dash.php" method="POST">
                        <div class="row">
                            <div class="col s12 m12 l12" style="border: 1px solid #5cef62; background-color: #f6fdf6; border-radius: 8px; padding: 5px;">

                                <div class="col s12 m12 l12 " style="margin-top: 20px;">

                                    <div class="col s12 m6 l6">
                                        <input placeholder="Account no." name="account_no" type="text" style="font-size: 2.5vh; padding: 4px; border:1px solid #dedede;width: 98%; border-radius: 5px;  background-color: white ;">
                                    </div>
                                    <div class="col s12 m6 l6">
                                        <input placeholder="IFSC code" name="ifsc" type="text" style="font-size: 2.5vh; padding: 4px; border:1px solid #dedede;width: 98%; border-radius: 5px;  background-color: white ;">
                                    </div>

                                </div>
                            </div>

                        </div>
                        <p style="text-align: center;">or</p>
                        <div class="row">
                            <div class="col s12 m12 l12" style="border: 1px solid #5cef62; background-color: #f6fdf6; border-radius: 8px; padding: 5px;">
                                <div class="col s2 m1 l1">
                                </div>

                                <div class="col s12 m8 l18 center-align " style=" margin-top: 0.5em;  padding: 0px; display: flex;justify-content: space-between;">
                                    <img style="  padding: 3px; height:6vh;  width: 3em;" class="left responsive-img" src="img/checkout_google-pay.svg">
                                    <img style="  padding: 3px; height:6vh; " class="left responsive-img" src="img/checkout_paytm.svg">
                                    <img style="  padding: 3px; height:6vh;" class="left responsive-img" src="img/checkout_phonepe.svg">
                                    <img style=" padding: 13px; height:6vh;" class="left responsive-img" src="img/checkout_upi.svg">
                                </div>
                                <div class="col s12 m12 l12 " style="margin-top: 20px;">

                                    <div class="col s12 m12 l12" style="padding: 0px;">
                                        <input placeholder="example@upi" name="upi" type="text" style="font-size: 2.5vh; padding: 4px; border:1px solid #dedede;width: 98%; border-radius: 5px;  background-color: white ;">
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="input-field col s12 l12 m12">
                            <input type="number" style="text-align: center;" placeholder="Amount" name="amount_withdraw" class="validate">
                        </div>

                        <div class="input-field col s12 l12 m12">
                            <p style="text-align: center;">
                                <button name="withdraw_money" type="submit" class="red lighten-2 z-depth-2 btn ">
                                    Send Request
                                </button>
                            </p>
                        </div>
                    </form>
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

    .razorpay-payment-button {
        color: red;
    }
</style>