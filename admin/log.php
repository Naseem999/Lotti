<?php
session_start();
include_once '../partial/head.php';
$Err = "";

if (isset($_POST['login_submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    if (empty($email) || empty($pass)) {
        $Err = "Fill All the Feilds To Login";
        header("Location:../admin.php?error=$Err");
        exit();
    } else {

        $sql = "SELECT * FROM admin WHERE email='$email';";
        $result = mysqli_query($con, $sql);
        $resultch = mysqli_num_rows($result);
        if ($resultch < 1) {
            $Err = "Invalid Login";
            header("Location:../admin.php?error=$Err");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                //dehashing of password user type
                $hashedPwdCheck = password_verify($pass, $row['pass']);
                if ($hashedPwdCheck == false) {
                    $Err = "Invalid Login Password Not matched";
                    header("Location:../admin.php?error=$Err");
                } elseif ($hashedPwdCheck == true) {
                    //log in the user in website here creating session verible for user
                    $_SESSION['admin_username'] = $row['username'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];

                    header("Location:../admin_dash.php?login=You Are Logged In Successfully");
                    exit();
                }
            }
        }
    }
}
