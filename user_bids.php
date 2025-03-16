<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once 'partial/head.php';
    ?>
    <title>Lotti - Your Bids</title>
</head>

<body>
    <?php
    include_once 'partial/header.php';
    ?>
    <div class="row main_row">
        <div class="card z-depth-2 cards " style="border-radius: 8px; border: 1px solid #e57373;">
            <div class="card-content ">
                <div class="row" style="margin-bottom: 0px;">
                    <div class="col s12 m12 l12 " style=" margin-top: -4em;">
                        <div class="card" style="  background-color: #e57373; padding: 10px;   box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 175, 80, 0.4);    border-radius: 5px;">
                            <div class="card-image cneter-align">
                                <p style="text-align: center;">
                                   <a href="user_dash.php"> <img class="responsive-image" src="img/logo.png" style=" width: 100%; margin-bottom: 0px; height:10vh;  object-fit:contain;  "></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m12 l12 ">
                        <table class="responsive-table highlight centered">
                            <thead>
                                <tr>
                                    <th>Bid Number</th>
                                    <th>Bid Value</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if (isset($_SESSION['username'])) {
                                    $id = $_SESSION['id'];
                                }
                                $sql = "SELECT * FROM bids WHERE users_id='$id' order by id desc;";
                                $result = mysqli_query($con, $sql);
                                $resultch = mysqli_num_rows($result);
                                if ($resultch < 1) {
                                } else {
                                    while ($row = mysqli_fetch_assoc($result)) {

                                ?>
                                        <tr>
                                            <td><?php echo  $row['bid_number']; ?></td>
                                            <td><?php echo "$" . $row['number_bid_value']; ?></td>
                                            <td><?php echo  $row['date']; ?></td>
                                            <td><?php echo  $row['timestamp_']; ?></td>


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