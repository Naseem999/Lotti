<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once 'partial/head.php';
    ?>
    <title>Lotti - Withdrawal Resuests</title>
</head>

<body>
    <?php
    include_once 'partial/header.php';

    if (!isset($_SESSION['admin_username'])) {
        echo "<script>alert('Please Login As Admin');
        window.location.assign('admin.php');
        </script>";
    }

    if (isset($_GET['req_id'])) {

        $req_id = mysqli_real_escape_string($con, $_GET['req_id']);
        $from = mysqli_real_escape_string($con, $_GET['from']);
        $amount = mysqli_real_escape_string($con, $_GET['amount']);
        $req_type = mysqli_real_escape_string($con, $_GET['req_type']);

        if (empty($req_id)) {
            echo "<script>alert('Smothing Wrong');
        window.location.assign('withdraw_req.php');
        </script>";
        } else {
            $sql = "SELECT * FROM user WHERE id='$from';";
            $result = mysqli_query($con, $sql);
            $resultch = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            $balance = $row['balance'];

            if($req_type=='withdraw'){
                $new_balance = $balance - $amount;
            }
            if($req_type=='add'){
                $new_balance = $balance + $amount;
            }
            

            

            $sql = "UPDATE user SET balance='$new_balance' WHERE id='$from';";

            if (mysqli_query($con, $sql)) {
                $sql = "UPDATE requests SET status='Checked' WHERE id='$req_id';";
                if (mysqli_query($con, $sql)) {
                    echo "<script>alert(' Request Accepted');
            window.location.assign('withdraw_req.php');
            </script>";
                } else {
                    echo "<script>alert('Smothing went wrong');
        window.location.assign('withdraw_req.php');
        </script>";
                }
            }
        }
    }

    // if (isset($_POST['send_money'])) {

    //     $winning_amount = mysqli_real_escape_string($con, $_POST['winning_amount']);
    //     $winner_mail = mysqli_real_escape_string($con, $_POST['winner_mail']);
    //     $req_id = mysqli_real_escape_string($con, $_POST['req_id']);

    //     $sql1 = "UPDATE requests SET status='Accepted' WHERE id='$req_id';";
    //     mysqli_query($con, $sql1);
    //     // 
    //     $sql = "SELECT * FROM user WHERE email='$winner_mail';";
    //     $result = mysqli_query($con, $sql);
    //     $resultch = mysqli_num_rows($result);
    //     $row = mysqli_fetch_assoc($result);
    //     // 
    //     $old_amount = $row['balance'];
    //     if (empty($winning_amount) || $winning_amount == 0) {
    //         echo "<script>alert('Enter Smothing');
    //     window.location.assign('admin_dash.php');
    //     </script>";
    //     } else {
    //         $new_winner_balance = $old_amount - $winning_amount;
    //         $sql = "UPDATE user SET balance='$new_winner_balance' WHERE email='$winner_mail';";
    //         if (mysqli_query($con, $sql)) {
    //             echo "<script>alert('Withdrawal Amount $winning_amount sent to Winner');
    //         window.location.assign('withdraw_req.php');
    //         </script>";
    //         } else {
    //             echo "<script>alert('Smothing went wrong');
    //     window.location.assign('withdraw_req.php');
    //     </script>";
    //         }
    //     }
    // }
    ?>
    <div class="row main_row">
        <div class="card z-depth-2 cards " style="border-radius: 8px; border: 1px solid #e57373;">
            <div class="card-content ">
                <div class="row" style="margin-bottom: 0px;">
                    <div class="col s12 m12 l12 " style=" margin-top: -4em;">
                        <div class="card" style="  background-color: #e57373; padding: 10px;   box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                            <div class="card-image cneter-align">
                                <p style="text-align: center; font-size: 5vh; color: white; font-weight: bold;">
                                    Withdrawal Resuests
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l12 ">
                        <table class="responsive-table highlight ">
                            <thead>
                                <tr>
                                    <th>Request_Type</th>
                                    <th>Request_from</th>
                                    <th>Email</th>
                                    <th>Phone No</th>
                                    <th>Amount</th>
                                    <th>Account no.</th>
                                    <th>IFSC</th>
                                    <th>UPI</th>
                                    <th>Timestamp</th>
                                    <th>Change Status</th>

                                    <th></th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                $sql = "SELECT * FROM requests ORDER BY id DESC";
                                $result = mysqli_query($con, $sql);
                                $resultch = mysqli_num_rows($result);
                                if ($resultch < 1) {
                                } else {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id = $row['id'];
                                        $status = $row['status'];
                                        $user_id = $row['request_from'];
                                        $sql1 = "SELECT * FROM user WHERE id='$user_id' ";
                                        $result1 = mysqli_query($con, $sql1);
                                        $resultch1 = mysqli_num_rows($result1);
                                        if (!$resultch1 < 1) {
                                            $row1 = mysqli_fetch_assoc($result1);
                                            $username = $row1['username'];
                                            $email = $row1['email'];
                                            $phone = $row1['phone'];
                                        }


                                ?>
                                        <tr>
                                            <td><?php echo  $row['request_type']; ?></td>
                                            <td><?php echo  $username; ?></td>
                                            <td><?php echo  $email; ?></td>
                                            <td><?php echo  $phone; ?></td>
                                            <td><?php echo  $row['amount']; ?></td>
                                            <?php
                                            if ($row['account_no'] == '') {
                                            ?>
                                                <td>--</td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><?php echo $row['account_no']; ?></td>
                                            <?php
                                            }
                                            ?>
                                            <!--  -->
                                            <?php
                                            if ($row['ifsc'] == '') {
                                            ?>
                                                <td>--</td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><?php echo $row['ifsc']; ?></td>
                                            <?php
                                            }
                                            ?>
                                            <!--  -->
                                            <?php
                                            if ($row['upi'] == '') {
                                            ?>
                                                <td>--</td>
                                            <?php
                                            } else {
                                            ?>
                                                <td><?php echo $row['upi']; ?></td>
                                            <?php
                                            }
                                            ?>
                                            <td><?php echo  $row['timestamp_']; ?></td>
                                            <td><a style="color: #e57373; font-weight: bold;" href="withdraw_req.php?req_type=<?php echo $row['request_type'];?>&req_id=<?php echo $id; ?>&from=<?php echo $user_id; ?>&amount=<?php echo $row['amount']; ?>"><?php echo  $row['status']; ?></a></td>


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